<?php

session_start();

$id = $_GET['id'];
$interior = $_GET['interior'];
$date = $_GET['date'];
$amount = $_GET['amount'];

if (!isset($id) || !isset($interior) || !isset($date) || !isset($amount)) {
    header('Location: ./Cases.php');
    exit;
}

if (isset($_SESSION['loggedInUser'])) {

    require_once "includes/database.php";

    $email = $_SESSION['loggedInUser']['email'];

    $query = "SELECT email, id FROM users WHERE `email` = '$email'";
    $result = mysqli_query($db, $query) or die('Error: ' . mysqli_error($db) . ' with query ' . $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        $query = "INSERT INTO orders (userId, caseId, date, interior, amount, email) VALUES ('$user[id]', '$id', '$date', '$interior', '$amount','$user[email]')";

        $result = mysqli_query($db, $query);

        if ($result) {
            $reserverd = true;
        }
    } else {
        $errors['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
    }
}


if (isset($_POST['submit'])) {
    /** @var mysqli $db */
    require_once "includes/database.php";

    // Get form data
    $email = mysqli_escape_string($db, $_POST['email']);

    // Server-side validation
    $errors = [];
    if ($email == '') {
        $errors['email'] = 'Please fill in your email.';
    }
    // If data valid
    if (empty($errors)) {
        // create a secure password, with the PHP function password_hash()

        $query = "SELECT email, id FROM users WHERE `email` = '$email'";
        $result = mysqli_query($db, $query) or die('Error: ' . mysqli_error($db) . ' with query ' . $query);
    
        if (mysqli_num_rows($result) == 0) {
    
            $query = "INSERT INTO orders (caseId, date, interior, amount, email) VALUES ('$id', '$date', '$interior', '$amount','$email')";
    
            $result = mysqli_query($db, $query);
    
            if ($result) {
                $reserverd = true;
            }
        } else {
            $errors['email'] = 'Email is registered please log in.';
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
    <title>Reservate</title>
    <link rel="icon" type="image/x-icon" href="./images/#.jpg">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css?family=Asap+Condensed" rel="stylesheet" />

</head>

<body class="min-h-screen">

    <?php require_once "./includes/navbar.php" ?>

    <main class="bg-white max-w-lg mx-auto p-8 md:p-12 mt-14 rounded-lg shadow-2xl">
        <?php
        if (isset($reserverd)) { ?>
            <section>
                <h3 class="font-asp text-skew font-bold text-2xl">Reservation placed.</h3>
                <p class="text-gray-600 pt-2">Thank you for you reservation.</p>
            </section>

            <section class="mt-10">
                <div class="flex flex-col">
                    <a class="button-slanted text-center inline-block bg-[#EF7D00] hover:bg-[#2D2D2D] transition duration-500 ease-in-out" href="./Index.php">
                        <p class="font-asp px-3 py-2 text-xl font-bold text-white button-slanted-content uppercase focus:outline-none">Done</p>
                    </a>
                </div>
            </section>
        <?php } else { ?>
            <section>
                <h3 class="font-asp text-skew font-bold text-2xl">Reservate</h3>
                <p class="text-gray-600 pt-2">Contact info</p>
            </section>

            <section class="mt-10">
                <form class="flex flex-col" action="" method="post">
                    <div class="mb-6 pt-3 rounded bg-gray-200">
                        <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="email">Email</label>
                        <input type="text" id="email" name="email" value="<?= $email ?? '' ?>" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-[#EF7D00] transition duration-500 px-3 pb-3">
                        <p class="help is-danger">
                            <?= $errors['email'] ?? '' ?>
                        </p>
                    </div>
                    <button class="button-slanted text-center inline-block bg-[#EF7D00] hover:bg-[#2D2D2D] transition duration-500 ease-in-out" type="submit" name="submit">
                        <p class="font-asp px-3 py-2 text-xl font-bold text-white button-slanted-content uppercase focus:outline-none">Submit</p>
                    </button>
                </form>
            </section>
        <?php } ?>

    </main>
    <div class="max-w-lg mx-auto bg-white rounded-lg md:p-6 mt-4">
        <div class="max-w-lg mx-auto text-center mt-2 mb-6">
            <p class="text-black">got an account? <a href="Login.php" class="font-bold hover:underline">Log in</a>.</p>
        </div>
    </div>
    <?php require_once "./includes/footer.php" ?>


</body>

</html>