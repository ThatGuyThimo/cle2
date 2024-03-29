<?php
session_start();

$login = false;
// Is user logged in?
if (isset($_SESSION['loggedInUser'])) {
    $login = true;
}

if (isset($_POST['submit'])) {
    /** @var mysqli $db */
    require_once "includes/database.php";

    // Get form data
    $email = mysqli_escape_string($db, $_POST['email']);
    $password = $_POST['password'];

    // Server-side validation
    $errors = [];
    if ($email == '') {
        $errors['email'] = 'Please fill in your email.';
    }
    if ($password == '') {
        $errors['password'] = 'Please fill in your password.';
    }

    // If data valid
    if (empty($errors)) {
        // SELECT the user from the database, based on the email address.
        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($db, $query);

        // check if the user exists
        if (mysqli_num_rows($result) == 1) {
            // Get user data from result
            $user = mysqli_fetch_assoc($result);

            // Check if the provided password matches the stored password in the database
            if (password_verify($password, $user['password'])) {
                $login = true;

                // Store the user in the session
                $_SESSION['loggedInUser'] = [
                    'id'    => $user['id'],
                    'firstname'  => $user['firstname'],
                    'lastname'  => $user['lastname'],
                    'level'  => $user['level'],
                    'email' => $user['email'],
                ];

                // Redirect to secure page
            } else {
                //error incorrect log in
                $errors['loginFailed'] = 'The provided credentials do not match.';
            }
        } else {
            //error incorrect log in
            $errors['loginFailed'] = 'The provided credentials do not match.';
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
    <title>login</title>
    <link rel="icon" type="image/x-icon" href="./images/#.jpg">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css?family=Asap+Condensed" rel="stylesheet" />

</head>

<body class="min-h-screen">

    <?php require_once "./includes/navbar.php" ?>

    <main class="bg-white max-w-lg mx-auto p-8 md:p-12 mt-14 rounded-lg shadow-2xl">
        <section>
            <h3 class="font-asp font-bold text-2xl">Login</h3>
            <p class="text-gray-600 pt-2">Log hier in op je account</p>
        </section>

        <?php if ($login) { 
            header('Location: ./Index.php');
            exit;
        } else { ?>
            <section class="mt-10">
                <form class="flex flex-col" action="" method="post">
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
                        <?php if (isset($errors['loginFailed'])) { ?>
                            <div class="notification is-danger">
                                <button class="delete"></button>
                                <?= $errors['loginFailed'] ?>
                            </div>
                        <?php } ?>
                    </div>
                    <button class="button-slanted text-center inline-block bg-[#EF7D00] hover:bg-[#2D2D2D] transition duration-500 ease-in-out" type="submit" name="submit">
                  <p class="font-asp px-3 py-2 text-xl font-bold text-white button-slanted-content uppercase focus:outline-none">Sign in</p>
                </button>
                </form>
            </section>
        <?php } ?>
    </main>
    <div class="max-w-lg mx-auto bg-white rounded-lg md:p-6 mt-4">
        <div class="max-w-lg mx-auto text-center mt-2 mb-6">
            <p class="text-black">Don't have an account? <a href="register.php" class="font-bold hover:underline">Sign up</a>.</p>
        </div>
    </div>

    <div class="absolute bottom-0 w-full">
        <?php require_once "./includes/footer.php" ?>
    </div>


</body>