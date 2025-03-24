<?php
session_start();

include("../includes/connect.php");
if (!isset($_SESSION['connected'])) {
  header("location: ../logout.php");
}


$userID = $_SESSION['userID'];


?>


<!doctype html>
<html>

<head>
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>From Doctor</title>
<link rel="shortcut icon" href="../src/Logo 2.png">

  <script src="../src/cdn_tailwindcss.js"></script>

  <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>

  <link rel="stylesheet" href="../fontawesome-free-6.2.0-web/css/all.min.css">
  <link rel="stylesheet" href="../node_modules/DataTables/datatables.min.css">

  <link rel="stylesheet" type="text/css" href="../node_modules/DataTables/Responsive-2.3.0/css/responsive.dataTables.min.css" />

</head>

<body class="h-screen bg-no-repeat bg-cover bg-[url('../src/Background.png')]">
  <?php require_once 'navbar.php'; ?>

  <div style=" background: linear-gradient(-45deg, #a6d0ff, rgba(255, 255, 255, 0.63), rgba(255, 255, 255, 0));" class="h-full ml-56 2xl:ml-80 flex   left-10 right-5  flex-col  px-2   pt-2 2xl:pt-6 pb-14 z-50 ">
    <div class="m-2 ">

    <?php


$userID = $_SESSION['userID'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Iterate through the $_POST array to find the button that was clicked
  foreach ($_POST as $key => $value) {
    if (strpos($key, 'assist_') === 0) {
      // Extract the number from the button name
      $queNo = substr($key, strlen('assist_'));

      $idNumber =  $_POST['rfid' . $queNo];
      $_SESSION['rfid'] = $idNumber;
      $sql = "UPDATE `queing` SET `status`='processing', `nurseAssisting` = '$userID' WHERE `idNumber` = '$idNumber'";
      $results = mysqli_query($con, $sql);
    } else if (strpos($key, 'doneAssist_') === 0) {
      // Extract the number from the button name
      $queNo = substr($key, strlen('doneAssist_'));

      $idNumber =  $_POST['rfid' . $queNo];
      // $_SESSION['rfid'] = $idNumber;
      $sql = "UPDATE `queing` SET `status`='done' WHERE `idNumber` = '$idNumber'";
      $results = mysqli_query($con, $sql);

      // echo $queNo;
    }
  }
}
?>

<div class="text-[9px] 2xl:text-lg mb-5">
  <p class="mb-2"><span class=" self-center text-md font-semibold whitespace-nowrap   text-[#193F9F]">On Queue</span></p>

  <div id="" class="">
    <div class=" p-4 rounded-lg  bg-gray-50 " id="headApproval" role="tabpanel" aria-labelledby="profile-tab">
      <form action="index.php" method="post">
        <section class="mt-2 2xl:mt-10">
          <table id="fromDocQueTable" class="display text-[9px] 2xl:text-sm" style="width:100%">
            <thead>
              <tr>
                <th>No.</th>
                <th>Date</th>
                <th>Name</th>
                <th>Action</th>
                <th>Nurse</th>



                <!-- <th>Days Late</th> -->
                <!-- <th>Assigned to</th> -->
              </tr>
            </thead>
            <tbody>
              <?php
              $queNo = 1;
              $sql = "SELECT consultation.*, 
                        employeespersonalinfo.idNumber, 
                        employeespersonalinfo.Name, 
                        COALESCE(users.name, '') AS nurse_assisting_name
                    FROM 
                        consultation  
                    INNER JOIN 
                        employeespersonalinfo 
                    ON 
                        employeespersonalinfo.idNumber = consultation.idNumber
                    LEFT JOIN
                        users
                    ON
                        consultation.nurseAssisting = users.idNumber WHERE consultation.status = 'nurse2'   ORDER BY
    consultation.id ASC; 
                    
                    ";
                    
              $result = mysqli_query($con, $sql);
              while ($row = mysqli_fetch_assoc($result)) {

              ?> <tr style="background-color: <?php if ($row['status'] == 'processing') {
                                                echo "#d9ffdd";
                                              } ?>">
                  <td> <?php echo $queNo; ?> </td>
                  <td> <?php echo $row['date']; ?> </td>
                  <td> <?php echo $row['Name']; ?> </td>
                  <td>
                    <div class="content-center flex flex-wrap justify-center gap-2">
                      <input type="text" class="hidden" name="rfid<?php echo $queNo; ?>" value="<?php echo $row['idNumber']; ?>">
                      <a type="button" href="doctorsConsultation.php?rf=<?php echo $row['idNumber']; ?>&dcnsltn=<?php echo $row['id']; ?>" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 rounded-full px-3 py-2  text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">View</a>
                      <?php


                      ?>

                    </div>
                    <!-- Dropdown menu -->
                    <div id="dropdownDots<?php echo $queNo; ?>" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                      <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton<?php echo $queNo; ?>">
                        <li>
                          <a href="../nurses/fitToWork.php?rf=<?php echo $row['idNumber']; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Fit To Work</a>
                        </li>
                        <li>
                          <a href="../nurses/consultation.php?rf=<?php echo $row['idNumber']; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Medical Consultation</a>
                        </li>
                        <li>
                          <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dental Consultation</a>
                        </li>
                        <li>
                          <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Medicine Dispense</a>
                        </li>
                        <li>
                          <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Pregnancy Notification</a>
                        </li>
                        <li>
                          <a href="../nurses/medicalRecord.php?rf=<?php echo $row['idNumber']; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Medical Record</a>
                        </li>
                      </ul>

                    </div>
                  </td>
                  <td> <?php echo $row['nurse_assisting_name']; ?> </td>
                </tr> <?php

                      $queNo++;
                    }
                      ?>

            </tbody>
          </table>
        </section>
      </form>
    </div>
  </div>

</div>



    </div>

  </div>

  <script src="../node_modules/jquery/dist/jquery.min.js"></script>

  <script type="text/javascript" src="../node_modules/DataTables/datatables.min.js"></script>
  <script type="text/javascript" src="../node_modules/DataTables/Responsive-2.3.0/js/dataTables.responsive.min.js"></script>


  <script type="text/javascript" src="index.js"></script>
  <script>
    $("#fromDoctorsSide").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");
    $("#sidehistory").removeClass("bg-gray-200");
    $("#sideMyRequest").removeClass("bg-gray-200");
    $("#sidepms").removeClass("bg-gray-200");

    $("#sidehistory1").removeClass("bg-gray-200");
    $("#sideMyRequest1").removeClass("bg-gray-200");
    $("#sidepms1").removeClass("bg-gray-200");
    // $(".homeIcon").attr("fill", "#FFFFFF"); 
    $(".homeIcon").attr("fill", "#4d4d4d");




    const $targetEl = document.getElementById('sidebar');

    const options = {
      placement: 'left',
      backdrop: false,
      bodyScrolling: true,
      edge: false,
      edgeOffset: '',
      backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-30',
      onHide: () => {
        console.log('drawer is hidden');
      },
      onShow: () => {
        console.log('drawer is shown');
      },
      onToggle: () => {
        console.log('drawer has been toggled');
      }
    };

    const drawer = new Drawer($targetEl, options);
    drawer.show();
    var show = true;


    var screenWidth = window.screen.width; // Screen width in pixels
    var screenHeight = window.screen.height; // Screen height in pixels

    console.log("Screen width: " + screenWidth);
    console.log("Screen height: " + screenHeight);
    var sidebar = 0;



    function shows() {
      if (show) {
        drawer.hide();
        show = false;
      } else {
        drawer.show();
        show = true;
      }
      // var sidebar=0;
      if (sidebar == 0) {
        document.getElementById("mainContent").style.width = "100%";
        document.getElementById("mainContent").style.marginLeft = "0px";
        // document.getElementById("sidebar").style.opacity= ""; 
        // document.getElementById("sidebar").style.transition = "all .1s";

        document.getElementById("mainContent").style.transition = "all .3s";






        sidebar = 1;
      } else {
        document.getElementById("mainContent").style.width = "calc(100% - 288px)";
        document.getElementById("mainContent").style.marginLeft = "288px";

        sidebar = 0;
      }


    }

    if (screenWidth <= 1132) {
      shows();

    } else {
      drawer.show();
      // sidebar=0;/

    }
  </script>
</body>

</html>