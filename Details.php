<?php

session_start();


if (isset($_POST['submit'])) {

    $interior = $_POST['interior'];
    $date = $_POST['date'];
    $amount = $_POST['amount'];
    $id = $_POST['id'];

    $errors = [];
    if ($interior == 'notset') {
        $errors['interior'] = 'Please select an option.';
    }
    if ($id == '') {
        $errors['id'] = 'ID not set.';
    }
    if ($date == '') {
        $errors['date'] = 'Please fill in a date.';
    }
    if ($amount == '') {
        $errors['amount'] = 'Please fill in your amount.';
    }

    if (empty($errors)) {
        header('Location: reservate.php?id=' . $id . '&interior=' . $interior . '&date=' . $date . '&amount=' . $amount . '');
        exit;
    }
}


if (isset($_GET['id'])) {

    require_once "./includes/database.php";

    $query = "SELECT * FROM cases WHERE `id` = $_GET[id]";
    $result = mysqli_query($db, $query) or die('Error: ' . mysqli_error($db) . ' with query ' . $query);

    if (mysqli_num_rows($result) == 1) {
        $case = mysqli_fetch_assoc($result);
    } else {
        $errors['db'] = 'Something went wrong in your database query: ' . mysqli_error($db);
    }
} else {
    header("Location: ./Cases.php");
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Details</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css?family=Asap+Condensed" rel="stylesheet" />

</head>

<body class="bg-[#F1F1F1]">

    <?php require "./includes/navbar.php" ?>

    <main>
        <section class="boxsizing">
            <div class="mt-10 grid gird-cols-2 gap-16">
                <div class="border-2 border-gray-300 bg-white rounded p-6 col-start-1">
                    <h1 class="font-asp font-bold text-5xl text-[#575656]">
                        <?= $case['name'] ?>
                    </h1>
                    <div class="mt-4 flex justify-center items-center">
                        <img src="./caseimages/<?= $case['image'] ?>" width="400px" />
                    </div>
                </div>
                <div class="col-start-2">
                    <div class="border-2 border-gray-300 bg-white rounded py-6 px-10 flex flex-col">
                        <div class="text-[#666666] pb-4">
                            <h2 class="font-semibold text-xl">
                                External dimensions
                            </h2>
                            <p class="text-gl">
                                <?= $case['external'] ?>
                            </p>
                        </div>
                        <div class="text-[#666666] pb-4">
                            <h2 class="font-semibold text-xl">
                                Internal dimensions
                            </h2>
                            <p class="text-gl">
                                <?= $case['internal'] ?>
                            </p>
                        </div>
                        <div class="text-[#666666] pb-4">
                            <h2 class="font-semibold text-xl">
                                Cover depth - bottom
                            </h2>
                            <p class="text-gl">
                                <?= $case['coverdepth'] ?>
                            </p>
                        </div>
                        <div class="text-[#666666] pb-4">
                            <h2 class="font-semibold text-xl">
                                Weight
                            </h2>
                            <p class="text-gl">
                                <?= $case['weight'] ?>
                            </p>
                        </div>
                        <div class="text-[#666666] pb-4">
                            <h2 class="font-semibold text-xl">
                                Temperatures
                            </h2>
                            <p class="text-gl">
                                <?= $case['temp'] ?>
                            </p>
                        </div>
                        <form action="" method="post">
                            <input name="id" id="id" value="<?= $_GET['id'] ?>" hidden>
                            <div class="grid grid-cols-2">
                                <label for="interior" class="font-semibold text-xl text-[#666666]">Interior</label>
                                <select id="interior" class="bg-gray-300 rounded text-[#666666] py-1 px-2" name="interior">
                                    <option value="notset" selected hidden>Chooce an option</option>
                                    <option value="cubefoam">Cube foam</option>
                                    <option value="eggfoam">Egg foam</option>
                                    <option value="none">None</option>
                                </select>
                            </div>
                            <?php if (isset($errors['interior'])) { ?>
                                <p class="text-sm text-red-600">
                                    <?= $errors['interior'] ?>
                                </p>
                            <?php } ?>
                            <div class="grid grid-cols-2 mt-4">
                                <label for="date" class="font-semibold text-xl text-[#666666]">From date</label>
                                <input type="date" id="date" name="date" min="<?= date("Y-m-d") ?>" class="bg-gray-300 rounded text-[#666666] py-1 px-2">
                            </div>
                            <?php if (isset($errors['date'])) { ?>
                                <p class="text-sm text-red-600">
                                    <?= $errors['date'] ?>
                                </p>
                            <?php } ?>
                            <div class="grid grid-cols-2 mt-4">
                                <div>
                                    <input type="number" id="amount" value="1" name="amount" min="1" max="10" class="bg-gray-300 text-center text-skew rounded py-3 pl-2">
                                    <?php if (isset($errors['amount'])) { ?>
                                        <p class="text-sm text-red-600">
                                            <?= $errors['amount'] ?>
                                        </p>
                                    <?php } ?>
                                </div>
                                <div>
                                    <button class="rounded button-slanted text-center inline-block bg-[#EF7D00] hover:bg-[#2D2D2D] transition duration-500 ease-in-out" type="submit" name="submit">
                                        <p class="font-asp px-3 py-2 text-xl font-bold text-white button-slanted-content uppercase focus:outline-none">Reservate</p>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-span-2 mb-6">
                    <div class="border-2 border-gray-300 bg-white rounded col-start-3">
                        <div class="p-4">
                            <h1 class="font-bold text-xl">
                                DESCRIPTION
                            </h1>
                        </div>
                        <div class="border-t-2 p-4">
                            <p class="text-[#575656]">
                                HADO cases are IP67 certified, tough, durable and reliable. They may be used in a variety of applications, ranging from marine,photography, scuba diving, hunting, fishing, special corps and even the manufacturing industry. These cases offer superior protection from the elements, water, dust and impacts, making them suitable for a wide range of sectors and applications.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </main>

    <?php require_once "./includes/footer.php" ?>

</body>

</html>