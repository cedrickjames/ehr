
<?php



if (isset($_POST['submitNewPassword'])) {
  $userName = $_POST['userName'];

  $old_pass = $_POST['currentPass'];
  $new_pass = $_POST['newPassword'];
  $retype_pass = $_POST['retypePassword'];
  $hash_new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
  $userid = $_POST['userIDChangePassword'];
  $sql1 = "Select * FROM `users` WHERE `idNumber`='$userid' AND `status` = '1'";
  $result = mysqli_query($con, $sql1);
  $numrows = mysqli_num_rows($result);
  if ($numrows >= 1) {
    while ($userRow = mysqli_fetch_assoc($result)) {
      $userpass = $userRow['password'];

      if (password_verify($old_pass, $userpass)) {
        if ($new_pass === $retype_pass) {

          $sql = "UPDATE `users` SET `userName`='$userName', `password`= '$hash_new_pass' where `idNumber` = '$userid'";
          $changed_pass = mysqli_query($con, $sql);

          if ($changed_pass) {
            echo "<script>alert('Password changed successfully');</script>";
          } else {
            echo "<script>alert('There is a problem changing your password. Please contact your administrator.');</script>";
          }
        } else {
          echo "<script>alert('Passwords do not match!');</script>";
        }
      } else {
        echo "<script>alert('Please type your current password accurately!');</script>";
      }
    }
  }
}

?>


<nav class=" top-0 text-sm 2xl:text-xl border-gray-200 ">
  <div class="w-screen flex flex-wrap items-center justify-between mx-auto px-4 2xl:px-auto p-1 2xl:p-4">
    <div class="flex">
    <span id="sidebarButton" type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation" aria-controls="drawer-navigation" class="block lg:hidden mx-10 ">
        <i class="fa-solid fa-bars fa-lg"></i>

        </span> 
        <span id="sidebarButton" type="button" onclick="shows()" class="hidden lg:block mx-4 2xl:mx-10  ">
        <i class="fa-solid fa-bars fa-lg"></i>

        </span> 
  <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="../src/Logo 1.png" class="h-8" alt="Flowbite Logo" />
      <span class="self-center  font-semibold whitespace-nowrap   text-[#193F9F]">Electronic Medical Record</span>
  </a>
    </div>
  
  <div class="hidden md:flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
  <span class="pr-10  self-center  font-semibold whitespace-nowrap   text-[#193F9F] "><?php echo $_SESSION['name']; ?></span>
  <button type="button" class="flex mr-3 text-sm  rounded-full sm:mr-0 focus:ring-4 focus:ring-gray-300 " id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
          <span class="sr-only">Open user menu</span>
           <div class="w-10 h-10 rounded-full  ">
          <div class="rounded-full h-full w-full" style="background-color: #C5957F; background-size: cover; background-image: url('../src/default.png')"></div>
  
          </div>
        </button>
      <!-- Dropdown menu -->
      <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow  " id="user-dropdown">
        <div class="px-4 py-3">
          <span class="block text-sm text-gray-900 "><?php echo $_SESSION['name']; ?></span>
          <span class="block text-sm  text-gray-500 truncate "><?php echo $_SESSION['userID']; ?></span>
        </div>
        <ul class="py-2" aria-labelledby="user-menu-button">
        <li>
            <a data-modal-target="changePassword" data-modal-toggle="changePassword" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">Account Settings</a>
          </li>
          
          <li>
            <a href="../logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">Sign out</a>
          </li>
        </ul>
      </div>

  </div>


  
  </div>
</nav>



  <!-- drawer component -->
  <div id="drawer-navigation" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-96 " tabindex="-1" aria-labelledby="drawer-navigation-label">
    <div class="mb-5">
    <h5 id="drawer-navigation-label" class="text-base font-semibold text-gray-500 uppercase ">Helpdesk</h5>
      <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 right-2.5 inline-flex items-center justify-center "  >
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
        <span class="sr-only">Close menu</span>
    </button>

    </div>


      <!-- <button type="button"onclick="shows()"  class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center   >
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
          <span class="sr-only">Close menu</span>
      </button> -->
      <div class="py-5 pr-5 overflow-y-auto">
      <ul class="space-y-2">
          <li>
              <a href="index.php" id="sidehome1" class="  flex items-center p-4 text-base font-normal text-gray-900 rounded-lg  hover:bg-gray-100 ">
                <!-- <svg aria-hidden="true" class="w-6 h-6 text-gray-500 transition duration-75  group-hover:text-gray-900 -white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg> -->
                <i class="fa-solid fa-house"></i>
                <span class="ml-3">Home</span>
              </a>
          </li>
          
        </ul>
    </div>
  </div>
  <!-- side bar drawer component -->
  <div id="sidebar" class="w-80 text-xs 2xl:text-xl hidden lg:block  fixed top-16 left-0 z-40 h-screen pl-4 pr-0 overflow-y-auto transition-transform    transform-none" tabindex="-1" aria-labelledby="sidebar-label" aria-modal="true" role="dialog">

   
      <!-- <button type="button"onclick="shows()"  class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center   >
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
          <span class="sr-only">Close menu</span>
      </button> -->
      <div class="2xl:py-5 pr-5 overflow-y-auto">
      <ul class="space-y-2">

          <li>
        <a id="empside" aria-controls="companies1" data-collapse-toggle="companies1" class="  w-full flex items-center p-1 2xl:p-4  font-normal  rounded-lg  hover:bg-gray-100 ">
        <svg class="w-6 h-6 empIcon" fill="#4d4d4d" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
  <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd"/>
</svg>
          <span class="flex-1 ml-3 font-semibold whitespace-nowrap mr-3">Employees</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
          </svg>
        </a>
        <ul id="companies1" class="hidden  py-2 space-y-2">
          <li>
            <a id="gpiside1" href="employees.php?employer=<?php echo $company; ?>" class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group "><?php echo $company; ?></a>
          </li>
          <!-- <li>
            <a id="maximside1" href="../employees/index.php?employer=Maxim" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">MAXIM</a>
          </li>
          <li>
            <a id="nippiside1" href="../employees/index.php?employer=Nippi" class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">NIPPI</a>
          </li>
          <li>
            <a id="powerlaneside1" href="../employees/index.php?employer=Powerlane" class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">POWERLANE</a>
          </li>
          <li>
            <a id="otreloside1" href="../employees/index.php?employer=Otrelo" class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">OTRELO</a>
          </li>
          <li>
            <a id="mangreatside1" href="../employees/index.php?employer=Mangreat" class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">MANGREAT</a>
          </li>
          <li>
            <a id="alarmside1" href="../employees/index.php?employer=Alarm" class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">ALARM</a>
          </li>
          <li>
            <a id="canteenside1" href="../employees/index.php?employer=Canteen" class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">CANTEEN</a>
          </li> -->
        </ul>
      </li>
      <li>
        <a id="preempside" aria-controls="companies" data-collapse-toggle="companies" class="  flex items-center p-1 2xl:p-4  font-normal text-gray-900 rounded-lg  hover:bg-gray-100 ">
          <svg class="w-6 h-6 preempIcon" fill="#4d4d4d" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1000" zoomAndPan="magnify" viewBox="0 0 750 749.999995" height="1000" preserveAspectRatio="xMidYMid meet" version="1.0">
            <defs>
              <clipPath id="c12ce93f69">
                <path d="M 39 39 L 710.863281 39 L 710.863281 710.863281 L 39 710.863281 Z M 39 39 " clip-rule="nonzero" />
              </clipPath>
            </defs>
            <g clip-path="url(#c12ce93f69)">
              <path d="M 479.3125 282.269531 C 472.914062 282.269531 467.722656 277.078125 467.722656 270.679688 C 467.722656 270.679688 467.722656 73.914062 467.722656 73.914062 C 467.722656 54.707031 452.15625 39.140625 432.949219 39.140625 L 317.042969 39.140625 C 297.835938 39.140625 282.269531 54.707031 282.269531 73.914062 L 282.269531 270.679688 C 282.269531 277.078125 277.078125 282.269531 270.679688 282.269531 C 270.679688 282.269531 73.914062 282.269531 73.914062 282.269531 C 54.707031 282.269531 39.140625 297.835938 39.140625 317.042969 L 39.140625 432.949219 C 39.140625 452.15625 54.707031 467.722656 73.914062 467.722656 L 270.679688 467.722656 C 277.078125 467.722656 282.269531 472.914062 282.269531 479.3125 C 282.269531 479.3125 282.269531 676.082031 282.269531 676.082031 C 282.269531 695.285156 297.835938 710.851562 317.042969 710.851562 L 432.949219 710.851562 C 452.15625 710.851562 467.722656 695.285156 467.722656 676.082031 L 467.722656 479.3125 C 467.722656 472.914062 472.914062 467.722656 479.3125 467.722656 C 479.3125 467.722656 676.082031 467.722656 676.082031 467.722656 C 695.285156 467.722656 710.851562 452.15625 710.851562 432.949219 L 710.851562 317.042969 C 710.851562 297.835938 695.285156 282.269531 676.082031 282.269531 Z M 479.3125 282.269531 " fill-rule="evenodd" />
            </g>
          </svg>

          <span class="flex-1 ml-3 font-semibold whitespace-nowrap mr-3">Pre-Employment </span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
          </svg>
        </a>
        <ul id="companies" class="hidden  py-2 space-y-2">
          <li>
            <a id="gpiside" href="preEmp.php?employer=<?php echo $company; ?>" class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group "><?php echo $company; ?></a>
          </li>
          <!-- <li>
            <a id="maximside" href="../preEmployment/index.php?employer=Maxim" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">MAXIM</a>
          </li>
          <li>
            <a id="nippiside" href="../preEmployment/index.php?employer=Nippi" class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">NIPPI</a>
          </li>
          <li>
            <a id="powerlaneside" href="../preEmployment/index.php?employer=Powerlane" class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">POWERLANE</a>
          </li>
          <li>
            <a id="otreloside" href="../preEmployment/index.php?employer=Otrelo" class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">OTRELO</a>
          </li>
          <li>
            <a id="mangreatside" href="../preEmployment/index.php?employer=Mangreat" class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">MANGREAT</a>
          </li>
          <li>
            <a id="alarmside" href="../preEmployment/index.php?employer=Alarm" class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">ALARM</a>
          </li>
          <li>
            <a id="canteenside" href="../preEmployment/index.php?employer=Canteen" class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">CANTEEN</a>
          </li> -->
        </ul>
      </li>
      <li>
        <a id="annualpeside" aria-controls="agency" data-collapse-toggle="agency" class="  flex items-center p-1 2xl:p-4  font-normal text-gray-900 rounded-lg  hover:bg-gray-100 ">

          <svg class="w-6 h-6 annualpeside" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1000" zoomAndPan="magnify" viewBox="0 0 750 749.999995" height="1000" preserveAspectRatio="xMidYMid meet" version="1.0">
            <defs>
              <clipPath id="fffb405084">
                <path d="M 588.648438 427.660156 L 693.226562 427.660156 L 693.226562 566.875 L 588.648438 566.875 Z M 588.648438 427.660156 " clip-rule="nonzero" />
              </clipPath>
              <clipPath id="4d659e02b9">
                <path d="M 281.222656 254.414062 L 435 254.414062 L 435 566.875 L 281.222656 566.875 Z M 281.222656 254.414062 " clip-rule="nonzero" />
              </clipPath>
              <clipPath id="0148f3bfcd">
                <path d="M 56.78125 275.429688 L 301.96875 275.429688 L 301.96875 566.875 L 56.78125 566.875 Z M 56.78125 275.429688 " clip-rule="nonzero" />
              </clipPath>
            </defs>
            <path  d="M 371.804688 241.820312 C 388.042969 241.820312 401.207031 228.65625 401.207031 212.414062 C 401.207031 196.175781 388.042969 183.011719 371.804688 183.011719 C 355.566406 183.011719 342.398438 196.175781 342.398438 212.414062 C 342.398438 228.65625 355.566406 241.820312 371.804688 241.820312 " fill-opacity="1" fill-rule="nonzero" />
            <path  d="M 130.824219 307.4375 L 227.75 307.4375 C 236.417969 307.4375 243.449219 300.410156 243.449219 291.742188 L 243.449219 259.113281 C 243.449219 250.445312 236.417969 243.417969 227.75 243.417969 L 130.824219 243.417969 C 122.15625 243.417969 115.125 250.445312 115.125 259.113281 L 115.125 291.742188 C 115.125 300.410156 122.15625 307.4375 130.824219 307.4375 " fill-opacity="1" fill-rule="nonzero" />
            <path  d="M 530.304688 288.207031 L 508.304688 390.707031 C 507.5625 394.167969 509.769531 397.578125 513.230469 398.324219 C 514.976562 398.699219 516.707031 398.324219 518.089844 397.417969 C 519.457031 396.527344 520.480469 395.117188 520.851562 393.394531 L 542.851562 290.898438 C 543.589844 287.4375 541.386719 284.027344 537.921875 283.28125 C 534.460938 282.539062 531.046875 284.746094 530.304688 288.207031 " fill-opacity="1" fill-rule="nonzero" />
            <path  d="M 503.324219 295.890625 C 499.859375 295.148438 496.445312 297.351562 495.703125 300.816406 L 481.222656 368.28125 C 480.480469 371.746094 482.6875 375.15625 486.148438 375.898438 C 487.894531 376.273438 489.625 375.902344 491.007812 374.996094 C 492.375 374.101562 493.402344 372.695312 493.769531 370.972656 L 508.25 303.507812 C 508.992188 300.046875 506.785156 296.632812 503.324219 295.890625 " fill-opacity="1" fill-rule="nonzero" />
            <path  d="M 606.242188 296.984375 C 618.570312 315.820312 622.816406 338.363281 618.203125 360.464844 C 613.585938 382.5625 600.675781 401.523438 581.835938 413.851562 C 568.085938 422.851562 552.148438 427.609375 535.746094 427.609375 C 507.066406 427.605469 480.609375 413.339844 464.972656 389.445312 C 439.480469 350.496094 450.429688 298.070312 489.378906 272.578125 C 503.128906 263.578125 519.066406 258.820312 535.464844 258.820312 C 564.144531 258.820312 590.605469 273.089844 606.242188 296.984375 Z M 482.347656 261.84375 C 437.480469 291.207031 424.867188 351.601562 454.234375 396.46875 C 472.253906 424 502.726562 440.4375 535.75 440.4375 C 554.652344 440.4375 573.019531 434.957031 588.867188 424.585938 C 633.730469 395.222656 646.34375 334.828125 616.980469 289.957031 C 598.960938 262.425781 568.492188 245.992188 535.464844 245.992188 C 516.5625 245.992188 498.195312 251.472656 482.347656 261.84375 " fill-opacity="1" fill-rule="nonzero" />
            <g clip-path="url(#fffb405084)">
              <path  d="M 595.886719 435.320312 C 593.582031 436.832031 591.230469 438.246094 588.839844 439.570312 L 652.007812 558.046875 C 656.421875 566.332031 666.738281 569.421875 674.988281 564.945312 C 676.824219 563.949219 678.828125 562.757812 680.996094 561.335938 C 683.164062 559.917969 685.058594 558.5625 686.707031 557.277344 C 694.113281 551.511719 695.40625 540.816406 689.578125 533.457031 L 606.027344 427.820312 C 602.824219 430.480469 599.453125 432.992188 595.886719 435.320312 " fill-opacity="1" fill-rule="nonzero" />
            </g>
            <g clip-path="url(#4d659e02b9)">
              <path  d="M 328.464844 265.390625 L 283.191406 363.496094 C 278.898438 372.804688 282.960938 383.835938 292.269531 388.128906 L 292.273438 388.128906 C 301.582031 392.425781 312.609375 388.363281 316.90625 379.054688 L 326.867188 357.46875 C 327.242188 356.660156 328.457031 356.925781 328.457031 357.820312 L 328.457031 548.363281 C 328.457031 558.652344 336.800781 567 347.09375 567 C 357.382812 567 365.726562 558.652344 365.726562 548.363281 L 365.726562 422.472656 C 365.726562 419.117188 368.445312 416.398438 371.804688 416.398438 C 375.15625 416.398438 377.878906 419.117188 377.878906 422.472656 L 377.878906 548.363281 C 377.878906 558.652344 386.21875 567 396.511719 567 C 406.804688 567 415.148438 558.652344 415.148438 548.363281 L 415.148438 357.820312 C 415.148438 356.925781 416.363281 356.65625 416.738281 357.46875 L 426.699219 379.054688 C 428.480469 382.914062 431.421875 385.867188 434.914062 387.703125 C 422.925781 360.605469 422.714844 330.398438 432.871094 303.808594 L 415.140625 265.390625 C 411.8125 258.175781 404.4375 254.113281 396.953125 254.648438 L 346.652344 254.648438 C 339.167969 254.113281 331.792969 258.175781 328.464844 265.390625 " fill-opacity="1" fill-rule="nonzero" />
            </g>
            <g clip-path="url(#0148f3bfcd)">
              <path  d="M 88.960938 520.171875 L 269.613281 520.171875 C 273.15625 520.171875 276.027344 523.046875 276.027344 526.589844 C 276.027344 530.132812 273.15625 533.003906 269.613281 533.003906 L 88.960938 533.003906 C 85.417969 533.003906 82.546875 530.132812 82.546875 526.589844 C 82.546875 523.046875 85.417969 520.171875 88.960938 520.171875 Z M 88.960938 482.539062 L 269.613281 482.539062 C 273.15625 482.539062 276.027344 485.410156 276.027344 488.953125 C 276.027344 492.496094 273.15625 495.371094 269.613281 495.371094 L 88.960938 495.371094 C 85.417969 495.371094 82.546875 492.496094 82.546875 488.953125 C 82.546875 485.410156 85.417969 482.539062 88.960938 482.539062 Z M 88.960938 444.902344 L 269.613281 444.902344 C 273.15625 444.902344 276.027344 447.773438 276.027344 451.316406 C 276.027344 454.863281 273.15625 457.734375 269.613281 457.734375 L 88.960938 457.734375 C 85.417969 457.734375 82.546875 454.863281 82.546875 451.316406 C 82.546875 447.773438 85.417969 444.902344 88.960938 444.902344 Z M 140.179688 370.164062 C 140.179688 368.054688 141.886719 366.347656 143.996094 366.347656 L 158.96875 366.347656 C 161.078125 366.347656 162.785156 364.636719 162.785156 362.527344 L 162.785156 347.554688 C 162.785156 345.449219 164.496094 343.738281 166.605469 343.738281 L 191.96875 343.738281 C 194.078125 343.738281 195.789062 345.449219 195.789062 347.554688 L 195.789062 362.527344 C 195.789062 364.636719 197.496094 366.347656 199.605469 366.347656 L 214.578125 366.347656 C 216.6875 366.347656 218.394531 368.054688 218.394531 370.164062 L 218.394531 395.53125 C 218.394531 397.636719 216.6875 399.347656 214.578125 399.347656 L 199.605469 399.347656 C 197.496094 399.347656 195.789062 401.054688 195.789062 403.164062 L 195.789062 418.136719 C 195.789062 420.246094 194.078125 421.953125 191.96875 421.953125 L 166.605469 421.953125 C 164.496094 421.953125 162.785156 420.246094 162.785156 418.136719 L 162.785156 403.164062 C 162.785156 401.054688 161.078125 399.347656 158.96875 399.347656 L 143.996094 399.347656 C 141.886719 399.347656 140.179688 397.636719 140.179688 395.53125 Z M 93.765625 567 L 264.808594 567 C 285.234375 567 301.792969 550.4375 301.792969 530.011719 L 301.792969 402.621094 C 301.210938 402.652344 300.625 402.675781 300.039062 402.675781 C 295.476562 402.675781 291.054688 401.699219 286.894531 399.78125 C 279.28125 396.265625 273.488281 390 270.589844 382.128906 C 267.691406 374.261719 268.03125 365.734375 271.542969 358.121094 L 299.023438 298.574219 C 293.488281 285.117188 280.257812 275.640625 264.808594 275.640625 L 256.277344 275.640625 L 256.277344 291.742188 C 256.277344 307.472656 243.480469 320.269531 227.75 320.269531 L 130.824219 320.269531 C 115.09375 320.269531 102.296875 307.472656 102.296875 291.742188 L 102.296875 275.519531 L 93.765625 275.640625 C 73.339844 275.640625 56.78125 292.199219 56.78125 312.625 L 56.78125 530.011719 C 56.78125 550.4375 73.339844 567 93.765625 567 " fill-opacity="1" fill-rule="nonzero" />
            </g>
          </svg>
          <span class="flex-1 ml-3 font-semibold whitespace-nowrap">Annual P.E.</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
          </svg>
        </a>
        <ul id="agency" class="hidden  py-2 space-y-2">
          <li>
            <a id="gpiside_" href="APE.php?employer=<?php echo $company; ?>" class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group "><?php echo $company; ?></a>
          </li>
          <!-- <li>
            <a id="maximside_" href="index.php?employer=Maxim" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">MAXIM</a>
          </li>
          <li>
            <a id="nippiside_" href="index.php?employer=Nippi" class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">NIPPI</a>
          </li>
          <li>
            <a id="powerlaneside_" href="index.php?employer=Powerlane" class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">POWERLANE</a>
          </li>
          <li>
            <a id="otreloside_" href="index.php?employer=Otrelo" class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">OTRELO</a>
          </li>
          <li>
            <a id="mangreatside_" href="index.php?employer=Mangreat" class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">MANGREAT</a>
          </li>
          <li>
            <a id="alarmside_" href="index.php?employer=Alarm" class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">ALARM</a>
          </li>
          <li>
            <a id="canteenside_" href="index.php?employer=Canteen" class="flex items-center w-full p-2  transition duration-75 rounded-lg pl-11 group hover:bg-gray-100">CANTEEN</a>
          </li> -->
        </ul>
      </li>
          
        </ul>
    </div>
  </div>


  
  
<div id="changePassword" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative w-full max-w-md max-h-full">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
      <button type="button" data-modal-toggle="changePassword" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close modal</span>
      </button>
      <div class="px-6 py-6 lg:px-8">
        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Account Settings</h3>
        <form class="space-y-6" action="" method="POST">
          <input type="text" class="hidden" name="userIDChangePassword" value="<?php echo $_SESSION['userID']; ?>">
          <div>
            <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New User Name</label>

            <div>
              <input type="text" name="userName" id="userName" value="<?php echo $_SESSION['username']; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
            </div>
          </div>
          <div>
            <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your current password</label>

            <div>
              <input type="text" name="currentPass" id="currentPass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
            </div>
          </div>
          <div>
            <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your new password</label>

            <div>
              <input type="password" name="newPassword" id="newPassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
            </div>
          </div>
          <div>
            <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Re-enter your new password</label>

            <div>
              <input type="password" name="retypePassword" id="retypePassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
            </div>
          </div>
          <button type="submit" name="submitNewPassword" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Update
          </button>

        </form>
      </div>
    </div>
  </div>
</div>
