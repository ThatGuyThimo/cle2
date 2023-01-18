<?php
session_start();
/** @var mysqli $db */

//Require DB settings with connection variable
require_once "includes/database.php";

//Get the result set from the database with a SQL query
if (isset($_GET['trollycase'])) {
  $query = "SELECT * FROM cases WHERE `trollycase` = 1";
} else {
  $query = "SELECT * FROM cases WHERE `trollycase` = 0";
}
$result = mysqli_query($db, $query) or die('Error: ' . $query);

//Loop through the result to create a custom array
$cases = [];
while ($row = mysqli_fetch_assoc($result)) {
  $cases[] = $row;
}

//Close connection
mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cases</title>
  <link rel="icon" type="image/x-icon" href="./images/#.jpg">
  <link rel="stylesheet" href="style/style.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css?family=Asap+Condensed" rel="stylesheet" />

<body class="bg-[#F1F1F1]">
  <?php require "./includes/navbar.php" ?>

  <section>
    <div class="boxsizing grid grid-cols-4">
      <?php foreach($cases as $case) { ?>
        <div class="w-5/6 m-10 p-4 bg-white border-2 border-gray-200 flex flex-col">
          <div class="px-2">
            <img src="./caseimages/<?= $case['image'] ?>"/>
          </div>
          <div>
            <p class="font-asp font-bold text-black text-left text-base">
              <?= $case['name'] ?>
            </p>
          </div>
          <?php if (isset($_SESSION['loggedInUser']) && $_SESSION['loggedInUser']['level'] == 1) { ?>
            <div class="mt-6 grid grid-cols-2 place-content-around">
              <div>
                <div class="button-slanted inline-block rounded bg-[#EF7D00] hover:bg-[#2D2D2D] transition duration-500 ease-in-out text-center">
                  <a class="font-asp px-3 py-2 text-base font-bold text-white button-slanted-content uppercase focus:outline-none" href="./Edit.php?id=<?= $case['id'] ?>">EDIT</a>
                </div>
              </div>
              <div class="flex flex-row-reverse">
                <div class="button-slanted inline-block rounded bg-red-600 hover:bg-[#2D2D2D] transition duration-500 ease-in-out text-center">
                  <a class="font-asp px-3 py-2 text-base font-bold text-white button-slanted-content uppercase focus:outline-none" href="./Delete.php?id=<?= $case['id'] ?>">DELETE</a>
                </div>
              </div>
            </div>
          <?php } else {?>
            <div class="mt-6 ">
              <div class="button-slanted inline-block rounded bg-[#EF7D00] hover:bg-[#2D2D2D] transition duration-500 ease-in-out text-center">
                <a class="font-asp px-3 py-2 text-base font-bold text-white button-slanted-content uppercase focus:outline-none" href="./Details.php?id=<?= $case['id'] ?>">SELECT OPTION</a>
              </div>
            </div>
          <?php } ?>
        </div>
      <?php } ?>
    </div>

  </section>

  <div class="absolute bottom-0 w-screen">
    <?php require_once "./includes/footer.php" ?>
  </div>
  </body>

</html>