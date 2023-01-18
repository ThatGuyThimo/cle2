<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hado Tools</title>
  <link rel="icon" type="image/x-icon" href="./images/#.jpg">
  <link rel="stylesheet" href="style/style.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css?family=Asap+Condensed" rel="stylesheet" />

  <?php require "./includes/navbar.php" ?>

  <main>
    <section class="mb-10 overflow-hidden">
      <div class="relative overflow-hidden bg-no-repeat bg-cover index-bg">
        <div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed">
          <div class="boxsizing flex justify-center items-center h-full">
            <div class="text-white grid grid-cols-2 place-content-between">
              <div class="text-left">
                <h1 class="font-asp text-skew text-6xl tracking-wide font-bold mb-5">HADO<br /><span>WATERPROOF CASES</span></h1>
                <p>HADO cases are IP67 certified, tough, durable and reliable. They may be used in a variety of applications, ranging from marine,photography, scuba diving, hunting, fishing, special corps and even the manufacturing industry. These cases offer superior protection from the elements, water, dust and impacts, making them suitable for a wide range of sectors and applications.</p>
                <div class="mt-8 button-slanted inline-block bg-[#EF7D00] hover:bg-[#2D2D2D] transition duration-500 ease-in-out">
                  <a class="font-asp px-3 py-2 text-xl font-bold text-white button-slanted-content uppercase focus:outline-none" href="https://www.hadotools.com/shop/">SHOP NOW!</a>
                </div>
              </div>
              <div class="flex justify-center items-center">
                <img src="./images/hadocase.png" width="400px" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="mb-10 overflow-hidden">
      <div class="boxsizing flex justify-center items-center h-full">
        <div class="grid grid-cols-2 place-content-between">
          <div class="flex justify-center items-center">
            <img src="./images/custom-case-interiors.jpg" width="500px" />
          </div>
          <div class="pl-2">
            <h2 class="font-asp text-skew font-bold text-5xl text-[#575656]">
              DISCOVER THE ENDLESS POSSIBILITIES OF CUSTOM FOAM
            </h2>
            <p class="text-base text-gray-600">
              Case foam inserts provide the ultimate protection for your gear. With laser engraving we can apply custom branding with your logo or specifications.
            </p>
            <div class="mt-8 button-slanted inline-block bg-[#EF7D00] hover:bg-[#2D2D2D] transition duration-500 ease-in-out">
              <a class="font-asp px-3 py-2 text-xl font-bold text-white button-slanted-content uppercase focus:outline-none" href="https://www.hadotools.com/contact/">MORE INFORMATION</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="mt-10 py-14 bg-[#f1f1f1]">
      <div class="boxsizing grid grid-cols-6 place-content-around h-full">
          <div class="flex flex-col justify-center items-center">
            <img src="./images/dust.png" width="140px" />
            <p class="font-asp text-skew font-bold text-2xl text-[#575656]">
              DUST
            </p>
          </div>
          <div class="flex flex-col justify-center items-center">
            <img src="./images/shock.png" width="140px" />
            <p class="font-asp text-skew font-bold text-2xl text-[#575656]">
              SHOCK
            </p>
          </div>
          <div class="flex flex-col justify-center items-center">
            <img src="./images/water.png" width="140px" />
            <p class="font-asp text-skew font-bold text-2xl text-[#575656]">
              WATER
            </p>
          </div>
          <div class="flex flex-col justify-center items-center">
            <img src="./images/vibration.png" width="140px" />
            <p class="font-asp text-skew font-bold text-2xl text-[#575656]">
              VIBRATION
            </p>
          </div>
          <div class="flex flex-col justify-center items-center">
            <img src="./images/temperature.png" width="140px" />
            <p class="font-asp text-skew font-bold text-2xl text-[#575656]">
              TEMPERATURE
            </p>
          </div>
          <div class="flex flex-col justify-center items-center">
            <img src="./images/aircarriage.png" width="140px" />
            <p class="font-asp text-skew font-bold text-2xl text-[#575656]">
            AIR CARRIAGE
            </p>
          </div>
        </div>
    </section>
  </main>


  <?php require "./includes/footer.php" ?>
  </body>

</html>