
<?php
session_start();
        // Set the timezone to Manila

        include ("../includes/connect.php");
if(!isset($_SESSION['connected'])){
  header("location: ../logout.php");
}
        date_default_timezone_set('Asia/Manila');

        
// $userID = $_SESSION['userID'];

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

<link rel="stylesheet" type="text/css" href="../node_modules/DataTables/Responsive-2.3.0/css/responsive.dataTables.min.css"/>

</head>
<body  class="bg-no-repeat bg-cover bg-[url('../src/Background.png')]">
<?php require_once '../navbar.php';?>

<div style= " background: linear-gradient(-45deg, #a6d0ff, rgba(255, 255, 255, 0.63), rgba(255, 255, 255, 0));"class=" m-auto ml-52 2xl:ml-80 flex  left-10 right-5  flex-col  px-2   pt-2 2xl:pt-6 pb-14 z-50 ">
  <div class="mb-5 grid grid-cols-1 sm:grid-cols-11 gap-4 w-full ">
    <div class="overflow-y-auto h-screen relative  sm:col-span-6 ">
    <?php require_once '../employeesData/employeesPersonalData.php';?>
    <?php require_once '../employeesData/fromDoctorsConsultation.php';?>
     </div>
     <div class="overflow-y-auto h-screen sm:col-span-5">
    <?php require_once '../employeesData/employeesPastMedicalHistory.php';?>
    <?php require_once '../employeesData/consultationTable.php';?>



    
       
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
$(".consultationIcon").attr("fill", "#4d4d4d"); 
$(".homeIcon").attr("fill", "#4d4d4d"); 
$(".medcertIcon").attr("fill", "#FFFFFF"); 
$(".proceedIcon").attr("fill", "#FFFFFF"); 

$(document).ready(function() {
  if ($("#remarksSelect2").val() === "For Medical Laboratory") {
            // Remove the "hidden" class from the input with id "medLab"
            $("#medLab").removeClass("hidden");
            $("#medDis").addClass("hidden");

        } else if($("#remarksSelect2").val() === "For Medication Dispense") {
            // If the option is not the desired one, you can add the "hidden" class
            $("#medDis").removeClass("hidden");
            $("#medLab").addClass("hidden");

        }
        else{
          $("#medLab").addClass("hidden");
            $("#medDis").addClass("hidden");

        }
    // Attach change event handler to remarksSelect
    $("#remarksSelect2").change(function() {
        // Check if the selected option is the one you want
        if ($(this).val() === "For Medical Laboratory") {
            // Remove the "hidden" class from the input with id "medLab"
            $("#medLab").removeClass("hidden");
            $("#medDis").addClass("hidden");

        } else if($(this).val() === "For Medication Dispense") {
            // If the option is not the desired one, you can add the "hidden" class
            $("#medDis").removeClass("hidden");
            $("#medLab").addClass("hidden");

        }
        else{
          $("#medLab").addClass("hidden");
            $("#medDis").addClass("hidden");

        }
    });


    if ($("#interventionSelect").val() === "Clinic Rest Only" || $("#interventionSelect").val() === "Medication, Clinic Rest and Medical Consultation") {

if($("#interventionSelect").val() === "Clinic Rest Only"){
  $("#clinicRestLabel").removeClass("hidden");
$("#clinicRestTime").removeClass("hidden");

$("#medsqtydiv").addClass("hidden");
$("#medsdiv").addClass("hidden");





}else{
  $("#clinicRestLabel").removeClass("hidden");
$("#clinicRestTime").removeClass("hidden");
$("#medsqtydiv").removeClass("hidden");
$("#medsdiv").removeClass("hidden");
}
$("#interventionId").removeClass("col-span-2");
$("#interventionId").addClass("col-span-4");
  // Remove the "hidden" class from the input with id "medLab"


}
else{
  $("#interventionId").removeClass("col-span-4");
  $("#interventionId").addClass("col-span-2");

$("#clinicRestLabel").addClass("hidden");
$("#clinicRestTime").addClass("hidden");
$("#medsqtydiv").removeClass("hidden");
$("#medsdiv").removeClass("hidden");
} 
    $("#interventionSelect").change(function() {

if ($(this).val() === "Clinic Rest Only" || $(this).val() === "Medication, Clinic Rest and Medical Consultation") {

  if($(this).val() === "Clinic Rest Only"){
    $("#clinicRestLabel").removeClass("hidden");
  $("#clinicRestTime").removeClass("hidden");

  $("#medsqtydiv").addClass("hidden");
  $("#medsdiv").addClass("hidden");

  }else{
    $("#clinicRestLabel").removeClass("hidden");
  $("#clinicRestTime").removeClass("hidden");
  $("#medsqtydiv").removeClass("hidden");
  $("#medsdiv").removeClass("hidden");
  }

  $("#interventionId").removeClass("col-span-2");
$("#interventionId").addClass("col-span-4");
    // Remove the "hidden" class from the input with id "medLab"


}
else{
  $("#interventionId").removeClass("col-span-4");
  $("#interventionId").addClass("col-span-2");

  
  $("#clinicRestLabel").addClass("hidden");
  $("#clinicRestTime").addClass("hidden");
  $("#medsqtydiv").removeClass("hidden");
  $("#medsdiv").removeClass("hidden");
} 
});


});



$(document).ready(function() {
  var selectedRemarksValue = $('#remarksSelect2').find('option:selected').val();
    console.log(selectedRemarksValue);
    if(selectedRemarksValue == 'Fit to Work'){
      
      $('#ftwdiv1').removeClass('hidden');
      $('#ftwdiv2').removeClass('hidden');
      $('#ftwdiv3').removeClass('hidden');
      $('#ftwdiv4').removeClass('hidden');
      $('#ftwdiv5').removeClass('hidden');
      $('#ftwdiv6').removeClass('hidden');
      $('#ftwdiv7').removeClass('hidden');
      $('#ftwdiv8').removeClass('hidden');
      $('#ftwdiv9').removeClass('hidden');



    }
    else{
      $('#ftwdiv1').addClass('hidden');
      $('#ftwdiv2').addClass('hidden');
      $('#ftwdiv3').addClass('hidden');
      $('#ftwdiv4').addClass('hidden');
      $('#ftwdiv5').addClass('hidden');
      $('#ftwdiv6').addClass('hidden');
      $('#ftwdiv7').addClass('hidden');
      $('#ftwdiv8').addClass('hidden');
      $('#ftwdiv9').addClass('hidden');

    }
        $('#remarksSelect2').change(function() {
          var selectedRemarksValue = $(this).find('option:selected').val();
    console.log(selectedRemarksValue);
    if(selectedRemarksValue == 'Fit to Work'){
      
      $('#ftwdiv1').removeClass('hidden');
      $('#ftwdiv2').removeClass('hidden');
      $('#ftwdiv3').removeClass('hidden');
      $('#ftwdiv4').removeClass('hidden');
      $('#ftwdiv5').removeClass('hidden');
      $('#ftwdiv6').removeClass('hidden');
      $('#ftwdiv7').removeClass('hidden');
      $('#ftwdiv8').removeClass('hidden');
      $('#ftwdiv9').removeClass('hidden');



    }
    else{
      $('#ftwdiv1').addClass('hidden');
      $('#ftwdiv2').addClass('hidden');
      $('#ftwdiv3').addClass('hidden');
      $('#ftwdiv4').addClass('hidden');
      $('#ftwdiv5').addClass('hidden');
      $('#ftwdiv6').addClass('hidden');
      $('#ftwdiv7').addClass('hidden');
      $('#ftwdiv8').addClass('hidden');
      $('#ftwdiv9').addClass('hidden');

    }
        });
    });


    $(document).ready(function() {
        $('#immediateHead').change(function() {
            var selectedEmail = $(this).find('option:selected').data('email');
            $('#immediateEmail').val(selectedEmail);
        });
    });

</script>
</body>
</html>