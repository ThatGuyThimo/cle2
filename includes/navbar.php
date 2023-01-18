
<nav style="text-transform: uppercase;" class="font-asp shadow-md">
  <div class="flex flex-wrap items-center justify-between w-full py-2 md:py-2 px-4 text-md text-white bg-[#575656]">
    <div class="boxsizing text-base font-semibold grid grid-cols-2 place-content-between">
      <div>
        <p>HADO WATER PROOF CASES</p>
      </div>
      <?php
        if (isset($_SESSION['loggedInUser'])) { ?>
        <div class="flex flex-row-reverse">
          <a class="flex flex-row-reverse transition-colors hover:text-[#EF7D00] pl-1" href="./Logout.php">
            <div class="flex flex-row">
              Logout
            </div>
          </a>
          <div class="flex flex-row">
            <img src="./images/user-solid-white.svg" width="24px" height="24px" class="pr-2"/>
            <?= $_SESSION['loggedInUser']['firstname'] ?>
          </div>

        </div>
        <?php } else { ?>
          <a class="flex flex-row-reverse transition-colors hover:text-[#EF7D00]" href="./Login.php">
            <div class="flex flex-row">
              <img src="./images/user-solid-white.svg" width="24px" height="24px" class="pr-2"/>
              Login
            </div>
          </a>
        <?php } ?>
    </div>
  </div>
  <div class=" flex flex-wrap items-center justify-between w-full py-5 md:py-5 px-4 text-xl font-semibold text-white bg-[#2D2D2D] shadow-md">
    <div class="boxsizing">

      <div class="hidden w-full md:flex md:items-center md:w-auto" id="menu">
        <ul class="pt-4 text-white md:flex md:justify-between md:pt-0">
          <li>
            <a href="./index.php">
              <img src="./images/hadotools-wit.png">
            </a>
          </li>
          <li>
            <a class="transition md:p-4 py-2 block hover:opacity-50 duration-500 ease-in-out" href="./Index.php">
              Home
            </a>
          </li>
          <li>
            <a class="transition md:p-4 py-2 block hover:opacity-50 duration-500 ease-in-out" href="./Cases.php">
              Cases
            </a>
          </li>
          <li>
            <a class="transition md:p-4 py-2 block hover:opacity-50 duration-500 ease-in-out" href="./Cases.php?trollycase=1">
              Trolley Cases
            </a>
          </li>
          <li>
            <a class="transition md:p-4 py-2 block hover:opacity-50 duration-500 ease-in-out" href="https://www.hadotools.com/contact/">
              Contact
            </a>
          </li>
          <?php if (isset($_SESSION['loggedInUser']) && $_SESSION['loggedInUser']['level'] == 1) { ?>
          <li>
            <a class="transition md:p-4 py-2 block hover:opacity-50 duration-500 ease-in-out" href="./Create.php">
              Add case
            </a>
          </li>
          <?php }?>
        </ul>
      </div>
    </div>
  </div>
</nav>