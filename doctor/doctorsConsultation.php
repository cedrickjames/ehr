<?php
session_start();
// Set the timezone to Manila
date_default_timezone_set('Asia/Manila');


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
  <script src="../node_modules/flowbite/dist/datepicker.js"></script>

  <link rel="stylesheet" type="text/css" href="../node_modules/DataTables/Responsive-2.3.0/css/responsive.dataTables.min.css" />

</head>

<body class="bg-no-repeat bg-cover bg-[url('../src/Background.png')]">
  <?php require_once 'navbar.php'; ?>

  <div style=" background: linear-gradient(-45deg, #a6d0ff, rgba(255, 255, 255, 0.63), rgba(255, 255, 255, 0));" class="  h-full ml-56 2xl:ml-[22rem] flex  left-10 right-5  flex-col  px-2   pt-2 2xl:pt-6 pb-14 z-50 ">
    <div class="mb-5 grid grid-cols-1 sm:grid-cols-11 gap-4 w-full ">
      <div class="overflow-y-auto h-screen relative  sm:col-span-6 ">
        <?php require_once '../employeesData/employeesPersonalData.php'; ?>
        <?php require_once '../employeesData/doctorsConsultation.php'; ?>
      </div>
      <div class="overflow-y-auto h-screen sm:col-span-5">
        <?php require_once '../employeesData/employeesPastMedicalHistory.php'; ?>
        <?php require_once '../employeesData/clinicVisits.php'; ?>
        <?php require_once '../employeesData/sickLeave.php'; ?>
        <?php require_once '../employeesData/bloodChem.php'; ?>
        <?php require_once '../employeesData/vacHistory.php'; ?>
        <?php require_once '../employeesData/preEmploymentMedicalResult.php'; ?>
        <?php require_once '../employeesData/annualPhysicalExamResult.php'; ?>
      </div>



    </div>

  </div>

  <script src="../node_modules/jquery/dist/jquery.min.js"></script>

  <script type="text/javascript" src="../node_modules/DataTables/datatables.min.js"></script>
  <script type="text/javascript" src="../node_modules/DataTables/Responsive-2.3.0/js/dataTables.responsive.min.js"></script>


  <script type="text/javascript" src="index.js"></script>
  <script>



    // $("#consultationSide").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");
    $("#sidehome").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");
$("#sidehistory").removeClass("bg-gray-200");
$("#sideMyRequest").removeClass("bg-gray-200");
$("#sidepms").removeClass("bg-gray-200");

$("#sidehome1").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");
$("#sidehistory1").removeClass("bg-gray-200");
$("#sideMyRequest1").removeClass("bg-gray-200");
$("#sidepms1").removeClass("bg-gray-200");
$(".homeIcon").attr("fill", "#FFFFFF"); 



    // $(".consultationIcon").attr("fill", "#FFFFFF");
    $(".homeIcon").attr("fill", "#4d4d4d");
    $(".medcertIcon").attr("fill", "#FFFFFF");
    $(".proceedIcon").attr("fill", "#FFFFFF");

    $("#sidehome").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");
    $("#sidehistory").removeClass("bg-gray-200");
    $("#sideMyRequest").removeClass("bg-gray-200");


    $("#sidehome1").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");
    $("#sidehistory1").removeClass("bg-gray-200");
    $("#sideMyRequest1").removeClass("bg-gray-200");
    $("#sidepms1").removeClass("bg-gray-200");
    $(".homeIcon").attr("fill", "#FFFFFF");


    $(document).ready(function() {
      if ($('#remarksSelect').val() != "Unfit to work") {
            // Remove the "hidden" class from the input with id "medLab"
            
          $("#restDays").addClass("hidden");
          $("#unfitReason").addClass("hidden");
          
          

        }
        else{
          $("#unfitReason").removeClass("hidden");
          $("#restDays").removeClass("hidden");

          
        }
    })

    $("#remarksSelect").change(function() {
      if ($(this).val() != "Unfit to work") {
            // Remove the "hidden" class from the input with id "medLab"
            
          $("#restDays").addClass("hidden");
          $("#unfitReason").addClass("hidden");

        }
        else{
          $("#unfitReason").removeClass("hidden");

          $("#restDays").removeClass("hidden");
          
        }

    })
    
    $(document).ready(function() {
      // if ($("#remarksSelect").val() === "For Medical Laboratory") {
      //       // Remove the "hidden" class from the input with id "medLab"
      //       $("#medLab").removeClass("hidden");

      //   } 
      //   else{
      //     $("#medLab").addClass("hidden");
            

      //   }
    // Attach change event handler to remarksSelect
    // $("#remarksSelect").change(function() {
    //     // Check if the selected option is the one you want
    //     if ($(this).val() === "For Medical Laboratory") {
    //         // Remove the "hidden" class from the input with id "medLab"
    //         $("#medLab").removeClass("hidden");
            

    //     } 
    //     else{
    //       $("#medLab").addClass("hidden");
           

    //     }
    // });



      // var selectedValue = $("#intervention").val();
      // console.log(selectedValue)
      // if (selectedValue == "Clinic Rest Only" || selectedValue == "Medication, Clinic Rest and Medical Consultation") {
      //   $('#clinicrest').removeClass('hidden');
      // } else {
      //   $('#meds').removeClass('col-span-3');
      //   $('#meds').addClass('col-span-4');
      //   $('#fromtotime').addClass('hidden');
      //   $('#clinicrest').addClass('hidden');
      //   $('#meds').removeClass('col-span-3');

      // }
      // $('#intervention').change(function() {
      //   var selectedValue = $("#intervention").val();
      //   console.log(selectedValue)
      //   if (selectedValue == "Clinic Rest Only" || selectedValue == "Medication, Clinic Rest and Medical Consultation") {
      //     $('#clinicrest').removeClass('hidden');
      //     $('#meds').removeClass('col-span-2');
      //     $('#meds').removeClass('col-span-4');

      //     $('#meds').addClass('col-span-2');

      //   } else {
      //     $('#meds').removeClass('col-span-2');
      //     $('#meds').addClass('col-span-4');
      //     $('#clinicrest').addClass('hidden');

      //   }
      // });

      // $('#remarksSelect').change(function() {
      //   var selectedRemarks = $("#remarksSelect").val();
      //   if (selectedRemarks == "Others") {
      //     $('#othersInput').removeClass('hidden');
      //     $('#forLab').addClass('hidden');
      //     $('#forMed').addClass('hidden');
      //   } else if (selectedRemarks == "For Laboratory") {
      //     $('#othersInput').addClass('hidden');
      //     $('#forLab').removeClass('hidden');
      //     $('#forMed').addClass('hidden');
      //   } else if (selectedRemarks == "Medication Dispense") {
      //     $('#othersInput').addClass('hidden');
      //     $('#forLab').addClass('hidden');
      //     $('#forMed').removeClass('hidden');
      //   } else {
      //     $('#othersInput').addClass('hidden');
      //     $('#forLab').addClass('hidden');
      //     $('#forMed').addClass('hidden');

      //   }
      // });
      // var selectedRemarks = $("#remarksSelect").val();
      // if (selectedRemarks == "Others") {
      //   $('#othersInput').removeClass('hidden');
      //   $('#forLab').addClass('hidden');
      //   $('#forMed').addClass('hidden');
      // } else if (selectedRemarks == "For Laboratory") {
      //   $('#othersInput').addClass('hidden');
      //   $('#forLab').removeClass('hidden');
      //   $('#forMed').addClass('hidden');
      // } else if (selectedRemarks == "Medication Dispense") {
      //   $('#othersInput').addClass('hidden');
      //   $('#forLab').addClass('hidden');
      //   $('#forMed').removeClass('hidden');
      // } else {
      //   $('#othersInput').addClass('hidden');
      //   $('#forLab').addClass('hidden');
      //   $('#forMed').addClass('hidden');

      // }
    });
  </script>
</body>

</html>