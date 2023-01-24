<?php

session_start();

if (!isset($_SESSION['loggedInUser']) && $_SESSION['loggedInUser']['level'] != 1) {
    header("Location: ./login.php");
    exit;
}

if (isset($_GET['id'])) {
    
    require_once "./includes/database.php";

    $query = "SELECT * FROM cases WHERE `id` = $_GET[id]";
    $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);
    
    if (mysqli_num_rows($result) == 1) {
            $case = mysqli_fetch_assoc($result);
        } else {
            $errors['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }
} else {
    header("Location: ./Cases.php");
}

//Check if Post isset, else do nothing
if (isset($_POST['submit']) && isset($_POST['id'])) {

    require_once "./includes/database.php";

    require_once "./includes/image-helpers.php";

    $query = "SELECT * FROM cases WHERE `id` = $_POST[id]";
    $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);
    
    if (mysqli_num_rows($result) == 1) {
            $case = mysqli_fetch_assoc($result);
            $image = deleteImageFile($case['image']);

            $query = "DELETE FROM cases WHERE `id` = $_POST[id]";
            $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

            header("Location: ./Cases.php");

        } else {
            $errors['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }

}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete case</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css?family=Asap+Condensed" rel="stylesheet" />

</head>

<body class="bg-[#F1F1F1]">

    <?php require "./includes/navbar.php" ?>

    <main>
        <section class="boxsizing">
            <div id="main" class="flex-1 mt-12">

                <div class="text-4xl text-black">
                    <h1 class="text-skew font-asp font-bold py-4 pl-2">Delete case: <?= $case['name'] ?></h1>
                </div>

                <div class="flex flex-wrap">

                </div>

                <div class="w-full">
                    <div class="container bg-white border-2 rounded-md border-gray-200">
                        <?php if (isset($errors['db'])) { ?>
                            <div><span class="errors"><?= $errors['db']; ?></span></div>
                        <?php } ?>
                        <div>
                            <form class="flex flex-col p-6" action="" method="post" enctype="multipart/form-data">
                                <input name="id" id="id" value="<?= $_GET['id'] ?>" hidden>
                                <div class="flex justify-center items-center">
                                <img src="./caseimages/<?= $case['image'] ?>" width="500"/>
                                </div>
                                <div class="flex flex-row">
                                    <a class="rounded button-slanted text-center inline-block bg-[#EF7D00] hover:bg-[#2D2D2D] transition duration-500 ease-in-out" href="./Cases.php">
                                        <p class="font-asp px-3 py-2 text-xl font-bold text-white button-slanted-content uppercase focus:outline-none">Cancel</p>
                                    </a>
                                    <button class="rounded ml-4 button-slanted text-center inline-block bg-red-600 hover:bg-[#2D2D2D] transition duration-500 ease-in-out" type="submit" name="submit">
                                        <p class="font-asp px-3 py-2 text-xl font-bold text-white button-slanted-content uppercase focus:outline-none">Delete</p>
                                    </button>
                                </div>
                            </form>
                        </div>
        </section>


    </main>
    
    <div class="absolute bottom-0 w-full">
        <?php require_once "./includes/footer.php" ?>
    </div>
</body>

</html>