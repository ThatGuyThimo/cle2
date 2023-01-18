<?php

/** @var mysqli $db */

//Require DB settings with connection variable
require_once "includes/database.php";

//Get the result set from the database with a SQL query
$query = "SELECT * FROM cases";
$result = mysqli_query($db, $query) or die('Error: ' . $query);

//Loop through the result to create a custom array
$eventAlbums = [];
while ($row = mysqli_fetch_assoc($result)) {
  $eventAlbums[] = $row;
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
  <title>cases</title>
  <link rel="icon" type="image/x-icon" href="./images/#.jpg">
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="https://unpkg.com/tailwindcss@3.2.4/dist/tailwind.min.css" />
  <!--Replace with your tailwind.css once created-->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet" />
  <!-- Define your gradient here - use online tools to find a gradient matching your branding-->
  <style>
    .gradient {
      background: linear-gradient(90deg, #d53369 0%, #daae51 100%);
    }
  </style>

  <section class="mb-40 overflow-hidden">

    <?php require "./includes/navbar.php" ?>

    <div class="relative overflow-hidden bg-no-repeat bg-cover" style="background-position: 50%; background-image: url('https://mdbootstrap.com/img/new/standard/city/078.jpg');
          height: 500px;">
      <div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed" style="background-color: rgba(0, 0, 0, 0.75);">
        <div class="flex justify-center items-center h-full">
          <div class="text-center text-white px-6 md:px-12">
            <h1 class="text-5xl md:text-6xl xl:text-7xl font-bold tracking-tight mb-12">The best offer on the market <br /><span>for your business</span></h1>
            <a class="inline-block px-7 py-3 mr-1.5 border-2 border-white text-white font-medium text-sm leading-snug uppercase rounded-full shadow-md hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out" data-mdb-ripple="true" data-mdb-ripple-color="light" href="#!" role="button">Get started</a>
            <a class="inline-block px-7 py-3 border-2 border-transparent bg-transparent text-white font-medium text-sm leading-snug uppercase rounded-full focus:outline-none focus:ring-0 transition duration-150 ease-in-out" data-mdb-ripple="true" data-mdb-ripple-color="light" href="#!" role="button">Learn more</a>
          </div>
        </div>
      </div>
    </div>

    <div class="-mt-2.5 md:-mt-4 lg:-mt-6 xl:-mt-10" style="height: 50px; transform: scale(2); transform-origin: top center; color: #fff;">
      <svg viewBox="0 0 2880 48" xmlns="http://www.w3.org/2000/svg">
        <path d="M 0 48 L 1437.5 48 L 2880 48 L 2880 0 L 2160 0 C 1453.324 60.118 726.013 4.51 720 0 L 0 0 L 0 48 Z" fill="currentColor"></path>
      </svg>
    </div>
  </section>

  <section>
    <?php require "./includes/footer.php" ?>
  </section>
  <script src="evenement.js"></script>
  </body>

</html>