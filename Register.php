<?php

session_start();

if (isset($_POST['submit'])) {
    /** @var mysqli $db */
    require_once "includes/database.php";

    // Get form data
    $firstname = mysqli_escape_string($db, $_POST['firstname']);
    $lastname = mysqli_escape_string($db, $_POST['lastname']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $password = $_POST['password'];

    // Server-side validation
    $errors = [];
    if ($firstname == '') {
        $errors['firstname'] = 'Please fill in your firstname.';
    }
    if ($lastname == '') {
        $errors['lastname'] = 'Please fill in your lastnamename.';
    }
    if ($email == '') {
        $errors['email'] = 'Please fill in your email.';
    }
    if ($password == '') {
        $errors['password'] = 'Please fill in your password.';
    }
    // If data valid
    if (empty($errors)) {
        // create a secure password, with the PHP function password_hash()
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "SELECT email FROM users WHERE `email` = '$email'";

        $exists = mysqli_query($db, $query);
        
        $user = [];
        while ($row = mysqli_fetch_assoc($exists)) {
            $user[] = $row;
        }
        if (!isset($user[0]['email'])) {
            // store the new user in the database.
            $query = "INSERT INTO users (firstname, lastname, email, password, level) VALUES ('$firstname', '$lastname', '$email', '$password', 0)";
    
            $result = mysqli_query($db, $query);
    
            if ($result) {
                header('Location: login.php');
                exit;
            }
        } else {
            $errors['firstname'] = 'User already registered.';
            $errors['lastname'] = 'User already registered.';
            $errors['email'] = 'User already registered.';
            $errors['password'] = 'User already registered.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="icon" type="image/x-icon" href="./images/#.jpg">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css?family=Asap+Condensed" rel="stylesheet" />

</head>

<body class="min-h-screen">

    <?php require_once "./includes/navbar.php" ?>

    <main class="bg-white max-w-lg mx-auto p-8 md:p-12 mt-14 rounded-lg shadow-2xl">
        <section>
            <h3 class="font-asp text-skew font-bold text-2xl">Register</h3>
            <p class="text-gray-600 pt-2">Create your account</p>
        </section>

        <section class="mt-10">
            <form class="flex flex-col" action="" method="post">
                <div class="mb-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="firstname">Firstname</label>
                    <input type="text" id="firstname" name="firstname" value="<?= $firstname ?? '' ?>" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-[#EF7D00] transition duration-500 px-3 pb-3">
                    <p class="help is-danger">
                        <?= $errors['firstname'] ?? '' ?>
                    </p>
                </div>
                <div class="mb-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="lastname">Lastname</label>
                    <input type="text" id="lastname" name="lastname" value="<?= $lastname ?? '' ?>" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-[#EF7D00] transition duration-500 px-3 pb-3">
                    <p class="help is-danger">
                        <?= $errors['lastname'] ?? '' ?>
                    </p>
                </div>
                <div class="mb-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="email">Email</label>
                    <input type="text" id="email" name="email" value="<?= $email ?? '' ?>" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-[#EF7D00] transition duration-500 px-3 pb-3">
                    <p class="help is-danger">
                        <?= $errors['email'] ?? '' ?>
                    </p>
                </div>
                <div class="mb-6 pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="password">Password</label>
                    <input type="password" id="password" name="password" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-[#EF7D00] transition duration-500 px-3 pb-3">
                    <?= $errors['password'] ?? '' ?>
                </div>
                <button class="button-slanted text-center inline-block bg-[#EF7D00] hover:bg-[#2D2D2D] transition duration-500 ease-in-out" type="submit" name="submit">
                  <p class="font-asp px-3 py-2 text-xl font-bold text-white button-slanted-content uppercase focus:outline-none">Sign up</p>
                </button>
            </form>
        </section>
    </main>
    <div class="max-w-lg mx-auto bg-white rounded-lg md:p-6 mt-4">
        <div class="max-w-lg mx-auto text-center mt-2 mb-6">
            <p class="text-black">Already got an account? <a href="Login.php" class="font-bold hover:underline">Log in</a>.</p>
        </div>
    </div>
        <?php require_once "./includes/footer.php" ?>


</body>

</html>