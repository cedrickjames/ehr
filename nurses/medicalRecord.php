<?php

session_start();
include ("../includes/connect.php");
if(!isset($_SESSION['connected'])){
  header("location: ../logout.php");
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

<link rel="stylesheet" type="text/css" href="../node_modules/DataTables/Responsive-2.3.0/css/responsive.dataTables.min.css"/>

</head>
<body  class="bg-no-repeat bg-cover bg-[url('../src/Background.png')]">
<?php require_once '../navbar.php';?>

<div style= " background: linear-gradient(-45deg, #a6d0ff, rgba(255, 255, 255, 0.63), rgba(255, 255, 255, 0));"class=" m-auto ml-0 md:ml-52 2xl:ml-80 flex   left-10 right-5  flex-col  px-2   pt-2 2xl:pt-6 pb-14 z-50 ">
  <div class="mb-5 grid grid-cols-1 sm:grid-cols-11 gap-4 w-full ">
    <div class="overflow-y-auto h-screen relative px-2 2xl:px-auto col-span-11 md:col-span-6 ">
    <?php require_once '../employeesData/employeesPersonalData.php';?>
    <?php require_once '../employeesData/employeesPastMedicalHistory.php';?>
     </div>
     <div class="overflow-y-auto h-screen col-span-11 md:col-span-5">
    <?php require_once '../employeesData/clinicVisits.php';?>
    <?php require_once '../employeesData/sickLeave.php';?>
    <?php require_once '../employeesData/bloodChem.php';?>
    <?php require_once '../employeesData/vaccinationRecord.php';?>
    <?php require_once '../employeesData/preEmploymentMedicalResult.php';?>
    <?php require_once '../employeesData/annualPhysicalExamResult.php';?>


    
       
    </div>
      

    
  </div>

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

$("#sidehome1").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");
$("#sidehistory1").removeClass("bg-gray-200");
$("#sideMyRequest1").removeClass("bg-gray-200");
$("#sidepms1").removeClass("bg-gray-200");
$(".medrecordIcon").attr("fill", "#FFFFFF"); 
$(".homeIcon").attr("fill", "#4d4d4d"); 

</script>
</body>
</html>