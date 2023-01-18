<?php

session_start();

if (!isset($_SESSION['loggedInUser']) && $_SESSION['loggedInUser']['level'] != 1) {
    header("Location: ./login.php");
    exit;
}

require_once "./includes/database.php";

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Require database in this file & image helpers
    require_once "./includes/database.php";
    require_once "./includes/image-helpers.php";

    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $casename   = mysqli_escape_string($db, $_POST['casename']);
    $external   = mysqli_escape_string($db, $_POST['external']);
    $internal   = mysqli_escape_string($db, $_POST['internal']);
    $coverdepth   = mysqli_escape_string($db, $_POST['coverdepth']);
    $weight   = mysqli_escape_string($db, $_POST['weight']);
    $temp   = mysqli_escape_string($db, $_POST['temp']);
    
    if (isset($_POST['trollycase'])) {
        $trollycase = 1;
    } else {
        $trollycase = 0;
    };

    //Require the form validation handling
    require_once "./includes/form-validation.php";

    if ($_FILES['image']['error'] == 4) {
        $errors['image'] = 'Image cannot be empty';
    }

    if (empty($errors)) {
        //Store image & retrieve name for database saving
        $image = addImageFile($_FILES['image']);

        //Save the record to the database
        $query = "INSERT INTO cases (name, external, internal, coverdepth, weight, temp, image, trollycase)
                  VALUES ('$casename', '$external', '$internal', '$coverdepth', '$weight', '$temp', '$image', '$trollycase')";
        $result = mysqli_query($db, $query) or die('Error: '.mysqli_error($db). ' with query ' . $query);

        if ($result) {
            header('Location: ./Cases.php');
            exit;
        } else {
            $errors['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }

        //Close connection
        mysqli_close($db);
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add case</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css?family=Asap+Condensed" rel="stylesheet" />

</head>

<body class="bg-[#F1F1F1]">

    <?php require "./includes/navbar.php" ?>

    <main>
        <section class="boxsizing">
            <div id="main" class="main-content flex-1 mt-12 md:mt-2 pb-24 md:pb-5">

                <div class="text-4xl text-black">
                    <h1 class="text-skew font-asp font-bold py-4 pl-2">Add Case</h1>
                </div>

                <div class="flex flex-wrap">

                </div>

                <div class="w-full">
                    <div class="container bg-white border-2 rounded-md border-gray-200">
                        <?php if (isset($errors['db'])) { ?>
                            <div><span class="errors"><?= $errors['db']; ?></span></div>
                        <?php } ?>

                        <!-- enctype="multipart/form-data" no characters will be converted -->
                        <div>
                            <form class="flex flex-col p-6" action="" method="post" enctype="multipart/form-data">
                                <div class="mb-6 pt-3 rounded bg-gray-200">
                                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="casename">Case name</label>
                                    <input type="text" id="casename" name="casename" value="<?= $casename ?? '' ?>" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-[#EF7D00] transition duration-500 px-3 pb-3">
                                    <p class="help is-danger">
                                        <?= $errors['casename'] ?? '' ?>
                                    </p>
                                </div>
                                <div class="mb-6 pt-3 rounded bg-gray-200">
                                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="external">External dimensions</label>
                                    <input type="external" id="external" name="external" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-[#EF7D00] transition duration-500 px-3 pb-3">
                                    <p class="help is-danger">
                                        <?= $errors['external'] ?? '' ?>
                                    </p>
                                </div>
                                <div class="mb-6 pt-3 rounded bg-gray-200">
                                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="internal">Internal dimensions</label>
                                    <input type="internal" id="internal" name="internal" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-[#EF7D00] transition duration-500 px-3 pb-3">
                                    <p class="help is-danger">
                                        <?= $errors['internal'] ?? '' ?>
                                    </p>
                                </div>
                                <div class="mb-6 pt-3 rounded bg-gray-200">
                                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="coverdepth">Cover depth - bottom</label>
                                    <input type="coverdepth" id="coverdepth" name="coverdepth" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-[#EF7D00] transition duration-500 px-3 pb-3">
                                    <p class="help is-danger">
                                        <?= $errors['coverdepth'] ?? '' ?>
                                    </p>
                                </div>
                                <div class="mb-6 pt-3 rounded bg-gray-200">
                                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="weight">Weight</label>
                                    <input type="weight" id="weight" name="weight" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-[#EF7D00] transition duration-500 px-3 pb-3">
                                    <p class="help is-danger">
                                        <?= $errors['weight'] ?? '' ?>
                                    </p>
                                </div>
                                <div class="mb-6 pt-3 rounded bg-gray-200">
                                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="temp">Temperature</label>
                                    <input type="temp" id="temp" name="temp" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-[#EF7D00] transition duration-500 px-3 pb-3">
                                    <p class="help is-danger">
                                        <?= $errors['temp'] ?? '' ?>
                                    </p>
                                </div>
                                <div class="mb-6 pt-3 rounded bg-gray-200">
                                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="trollycase">Trolly case</label>
                                    <input type="checkbox" id="trollycase" name="trollycase" class="bg-gray-200 rounded w-10 text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-[#EF7D00] transition duration-500 px-3 pb-3">
                                    <p class="help is-danger">
                                        <?= $errors['trollycase'] ?? '' ?>
                                    </p>
                                </div>
                                <div class="mb-6 pt-3 rounded bg-gray-200">
                                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="image">Case Image</label>
                                    <input type="file" id="image" name="image" class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-[#EF7D00] transition duration-500 px-3 pb-3">
                                    <p class="help is-danger">
                                        <?= $errors['image'] ?? '' ?>
                                    </p>
                                </div>
                                <div class="flex flex-row">
                                        <button class="rounded button-slanted text-center inline-block bg-[#EF7D00] hover:bg-[#2D2D2D] transition duration-500 ease-in-out" type="submit" name="submit">
                                            <p class="font-asp px-3 py-2 text-xl font-bold text-white button-slanted-content uppercase focus:outline-none">Add</p>
                                        </button>
                                        <a class="rounded ml-4 button-slanted text-center inline-block bg-red-600 hover:bg-[#2D2D2D] transition duration-500 ease-in-out" href="./Cases.php">
                                            <p class="font-asp px-3 py-2 text-xl font-bold text-white button-slanted-content uppercase focus:outline-none">Cancel</p>
                                        </a>
                                </div>
                            </form>
                        </div>
        </section>


    </main>

    <?php require_once "./includes/footer.php" ?>

</body>

</html>