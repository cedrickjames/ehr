
<?php 
if (isset($_GET['rf'])) {
  $idNumber = $_GET['rf'];
} else {
$idNumber = "not found";

}


$userID = $_SESSION['userID'];


if (isset($_POST['submitNewPassword'])) {

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

          $sql = "UPDATE `users` SET `password`= '$hash_new_pass' where `idNumber` = '$userid'";
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
        <!-- <i class="fa-solid fa-bars fa-lg"></i> -->

        </span> 
        <span id="sidebarButton" type="button" onclick="shows()" class="hidden lg:block mx-4 2xl:mx-10  ">
        <!-- <i class="fa-solid fa-bars fa-lg"></i> -->

        </span> 
  <a href="./index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="../src/Logo 1.png" href="./index.php" class="h-8" alt="EMR Logo" />
      <span class="self-center  font-semibold whitespace-nowrap   text-[#193F9F]">Electronic Medical Record</span>
  </a>
    </div>
  
  <div class="hidden md:flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
  <span class="pr-10  self-center  font-semibold whitespace-nowrap   text-[#193F9F] "><?php echo $_SESSION['name']; ?></span>
  <button type="button" class="flex mr-3 text-sm  rounded-full sm:mr-0 focus:ring-4 focus:ring-gray-300 " id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
          <span class="sr-only">Open user menu</span>
           <div class="w-10 h-10 rounded-full  ">
          <div class="rounded-full h-full w-full" style="background-color: #C5957F; background-size: cover; background-image: url('../src/doctor.png')"></div>
  
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
            <a href="../que" target="_blank" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 ">Queing</a>
          </li>

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
  
  <!-- side bar drawer component -->
  <div id="sidebar" class="w-52 2xl:w-80 text-xs 2xl:text-xl hidden fixed top-16 left-0 z-40 h-screen pl-4 pr-0 overflow-y-auto transition-transform    transform-none" tabindex="-1" aria-labelledby="sidebar-label" aria-modal="true" role="dialog">

   
      <!-- <button type="button"onclick="shows()"  class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center   >
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
          <span class="sr-only">Close menu</span>
      </button> -->
      <div class="2xl:py-5 pr-5 overflow-y-auto">
      <ul class="space-y-2">
          <li>
              <a href="index.php" id="sidehome" class="  flex items-center p-1 2xl:p-4  font-normal text-gray-900 rounded-lg  hover:bg-gray-100 ">
                <!-- <svg aria-hidden="true" class="w-6 h-6 text-gray-500 transition duration-75  group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg> -->
                <!-- <svg aria-hidden="true" class="w-6 h-6 text-red-500 transition duration-75  group-hover:text-gray-900 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1000" zoomAndPan="magnify" viewBox="0 0 750 749.999995" height="1000" preserveAspectRatio="xMidYMid meet" version="1.0"><defs><clipPath id="9d01e478d3"><path d="M 113 214 L 639 214 L 639 689.25 L 113 689.25 Z M 113 214 " clip-rule="nonzero"/></clipPath></defs><path  d="M 691.773438 281.488281 L 585.324219 203.1875 L 585.324219 109.785156 C 585.324219 95.140625 573.441406 83.296875 558.816406 83.296875 L 515.734375 83.296875 C 501.089844 83.296875 489.226562 95.164062 489.226562 109.785156 L 489.226562 132.476562 L 408.0625 72.78125 C 390.453125 59.796875 361.621094 59.796875 344.011719 72.78125 L 60.300781 281.488281 C 42.6875 294.453125 38.894531 319.488281 51.855469 337.121094 L 59.699219 347.761719 C 72.640625 365.390625 97.675781 369.207031 115.265625 356.246094 L 344.011719 187.902344 C 361.621094 174.9375 390.453125 174.9375 408.0625 187.902344 L 636.785156 356.246094 C 654.398438 369.207031 679.410156 365.371094 692.355469 347.761719 L 700.214844 337.121094 C 713.160156 319.488281 709.363281 294.453125 691.773438 281.488281 Z M 691.773438 281.488281 " /><path  d="M 606.898438 370.886719 L 408 223.886719 C 390.410156 210.882812 361.664062 210.882812 344.074219 223.886719 L 145.175781 370.886719 C 127.585938 383.894531 113.191406 402.914062 113.191406 413.222656 L 113.191406 626.347656 C 113.191406 660.945312 142.851562 689.011719 179.460938 689.011719 L 300.929688 689.011719 L 300.929688 500.484375 C 300.929688 485.925781 312.855469 474.019531 327.417969 474.019531 L 424.613281 474.019531 C 439.175781 474.019531 451.101562 485.925781 451.101562 500.484375 L 451.101562 689.011719 L 572.589844 689.011719 C 609.179688 689.011719 638.820312 660.945312 638.820312 626.347656 L 638.820312 413.222656 C 638.839844 402.914062 624.488281 383.894531 606.898438 370.886719 Z M 606.898438 370.886719 " /></svg> -->
                <!-- <i class="fa-solid fa-house"></i> -->
                <svg aria-hidden="true" class="w-6 h-6 text-red-500 transition duration-75  group-hover:text-gray-900 " xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1000" zoomAndPan="magnify" viewBox="0 0 750 749.999995" height="1000" preserveAspectRatio="xMidYMid meet" version="1.0">
  <defs>
    <clipPath id="9d01e478d3">
      <path d="M 113 214 L 639 214 L 639 689.25 L 113 689.25 Z M 113 214 " clip-rule="nonzero"/>
    </clipPath>
  </defs>
  <path  class="homeIcon" d="M 691.773438 281.488281 L 585.324219 203.1875 L 585.324219 109.785156 C 585.324219 95.140625 573.441406 83.296875 558.816406 83.296875 L 515.734375 83.296875 C 501.089844 83.296875 489.226562 95.164062 489.226562 109.785156 L 489.226562 132.476562 L 408.0625 72.78125 C 390.453125 59.796875 361.621094 59.796875 344.011719 72.78125 L 60.300781 281.488281 C 42.6875 294.453125 38.894531 319.488281 51.855469 337.121094 L 59.699219 347.761719 C 72.640625 365.390625 97.675781 369.207031 115.265625 356.246094 L 344.011719 187.902344 C 361.621094 174.9375 390.453125 174.9375 408.0625 187.902344 L 636.785156 356.246094 C 654.398438 369.207031 679.410156 365.371094 692.355469 347.761719 L 700.214844 337.121094 C 713.160156 319.488281 709.363281 294.453125 691.773438 281.488281 Z M 691.773438 281.488281 " />
  <path  class="homeIcon" d="M 606.898438 370.886719 L 408 223.886719 C 390.410156 210.882812 361.664062 210.882812 344.074219 223.886719 L 145.175781 370.886719 C 127.585938 383.894531 113.191406 402.914062 113.191406 413.222656 L 113.191406 626.347656 C 113.191406 660.945312 142.851562 689.011719 179.460938 689.011719 L 300.929688 689.011719 L 300.929688 500.484375 C 300.929688 485.925781 312.855469 474.019531 327.417969 474.019531 L 424.613281 474.019531 C 439.175781 474.019531 451.101562 485.925781 451.101562 500.484375 L 451.101562 689.011719 L 572.589844 689.011719 C 609.179688 689.011719 638.820312 660.945312 638.820312 626.347656 L 638.820312 413.222656 C 638.839844 402.914062 624.488281 383.894531 606.898438 370.886719 Z M 606.898438 370.886719 " />
</svg>
                <span class="ml-3 font-semibold">Home</span>
              </a>
          </li>
          
          
        </ul>
    </div>
  </div>
  
<div id="changePassword" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
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