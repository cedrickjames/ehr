<?php

session_start();
include("../includes/connect.php");
if (!isset($_SESSION['connected'])) {
  header("location: ../logout.php");
}

$userID = $_SESSION['userID'];

if (isset($_GET['rf'])) {
  $idNumber = $_GET['rf'];
} else {
  $idNumber = "not found";
}

?>
<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="../src/cdn_tailwindcss.js"></script>

  <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>

  <link rel="stylesheet" href="../fontawesome-free-6.2.0-web/css/all.min.css">
  <link rel="stylesheet" href="../node_modules/DataTables/datatables.min.css">

  <link rel="stylesheet" type="text/css" href="../node_modules/DataTables/Responsive-2.3.0/css/responsive.dataTables.min.css" />

</head>

<body class="h-screen bg-no-repeat bg-cover bg-[url('../src/Background.png')]">
  <?php require_once '../navbar.php'; ?>

  <div style=" background: linear-gradient(-45deg, #05458cba,rgba(255, 255, 255, 0.63), rgba(255, 255, 255, 0));" class="h-full ml-56 2xl:ml-80 flex   left-10 right-5  flex-col  px-2   pt-2 2xl:pt-6 pb-14 z-50  ">
     
<?php
    if ($idNumber == "not found") {
      echo "<div class='m-4'>";
      require_once '../employeesData/medicalRecordTable.php';
      echo "</div>";
    } else {
      echo "<div class='mb-5 grid grid-cols-1 sm:grid-cols-11 gap-4 w-full'>
      <div class='overflow-y-auto h-screen relative  sm:col-span-6 '>";

      require_once '../employeesData/employeesPersonalData.php';
      require_once '../employeesData/employeesPastMedicalHistory.php';

      echo "</div>
      <div class='overflow-y-auto h-screen col-span-11 md:col-span-5'>";

      require_once '../employeesData/clinicVisits.php';
      require_once '../employeesData/sickLeave.php';
       require_once '../employeesData/bloodChem.php'; 
       require_once '../employeesData/vacHistory.php'; 
       require_once '../employeesData/preEmploymentMedicalResult.php'; 
       require_once '../employeesData/annualPhysicalExamResult.php'; 
      echo "</div>
    </div>";
    } ?>
  
  


  </div>

  <script src="../node_modules/jquery/dist/jquery.min.js"></script>

  <script type="text/javascript" src="../node_modules/DataTables/datatables.min.js"></script>
  <script type="text/javascript" src="../node_modules/DataTables/Responsive-2.3.0/js/dataTables.responsive.min.js"></script>


  <script type="text/javascript" src="index.js"></script>
  <script>
    $("#sidemedrecord").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");
    $("#sidehistory").removeClass("bg-gray-200");
    $("#sideMyRequest").removeClass("bg-gray-200");
    $("#sidepms").removeClass("bg-gray-200");
    
    $("#sidemedrecord1").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");
    $("#sidehistory1").removeClass("bg-gray-200");
    $("#sideMyRequest1").removeClass("bg-gray-200");
    $("#sidepms1").removeClass("bg-gray-200");
    $(".medrecordIcon").attr("fill", "#FFFFFF");
    $(".homeIcon").attr("fill", "#4d4d4d");
  </script>
</body>

</html>