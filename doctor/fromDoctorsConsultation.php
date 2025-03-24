
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
  <title>From Doctor</title>
  <link rel="shortcut icon" href="../src/Logo 2.png">

  <script src="../src/cdn_tailwindcss.js"></script>

  <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
  
  <link rel="stylesheet" href="../fontawesome-free-6.2.0-web/css/all.min.css">
  <link rel="stylesheet" href="../node_modules/DataTables/datatables.min.css">
  <script src="../node_modules/flowbite/dist/datepicker.js"></script>
  <link href="../node_modules/select2/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="../styles.css" />


<link rel="stylesheet" type="text/css" href="../node_modules/DataTables/Responsive-2.3.0/css/responsive.dataTables.min.css"/>

</head>
<body  class="bg-no-repeat bg-cover bg-[url('../src/Background.png')]">
<?php require_once 'navbar.php';?>
<div id="loading-message">
        <div role="status" class="self-center flex">
            <svg aria-hidden="true" class="inline w-10 h-10 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
            </svg>
            <span class="">Loading...</span>
            <!-- <p class="inset-y-1/2 absolute">Loading...</p> -->
        </div>

    </div>

<div id="content" style="display: none;"  style= " background: linear-gradient(-45deg, #a6d0ff, rgba(255, 255, 255, 0.63), rgba(255, 255, 255, 0));"class=" m-auto ml-52 2xl:ml-80 flex  left-10 right-5  flex-col  px-2   pt-2 2xl:pt-6 pb-14 z-50 ">
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
    
    <script src="../node_modules/select2/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="index.js"></script>
<script>
    

    $(".js-meds").select2({
      tags: true
    });

    
  $(".js-diagnosis").select2({
    tags: true
  });



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
  

  $("#completeRadio").change(function() {
  
  if ($(this).is(':checked')) {
$("#pendingRadio").prop('checked', false);

$("#pendingLabDueDateDiv").addClass("hidden");
      var pendingLabDueDate = document.getElementById('pendingLabDueDate');
      pendingLabDueDate.removeAttribute('required');

  }

})
$("#pendingRadio").change(function() {
  if ($(this).is(':checked')) {
$("#completeRadio").prop('checked', false);
$("#pendingLabDueDateDiv").removeClass("hidden");
      var pendingLabDueDate = document.getElementById('pendingLabDueDate');
      pendingLabDueDate.required = true;
  }
  else {
      // Code to execute when the checkbox is unchecked
      $("#pendingLabDueDateDiv").addClass("hidden");
      var pendingLabDueDate = document.getElementById('pendingLabDueDate');
      pendingLabDueDate.removeAttribute('required');
    }

})

if ($("#pendingRadio").is(':checked')) {
  console.log("hide")

$("#pendingLabDueDateDiv").removeClass("hidden");
      var pendingLabDueDate = document.getElementById('pendingLabDueDate');
      pendingLabDueDate.required = true;
  }
  else {
      // Code to execute when the checkbox is unchecked
      $("#pendingLabDueDateDiv").addClass("hidden");
      var pendingLabDueDate = document.getElementById('pendingLabDueDate');
      pendingLabDueDate.removeAttribute('required');
    }



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
$("#interventionId").removeClass("col-span-4");
$("#interventionId").addClass("col-span-4");
  // Remove the "hidden" class from the input with id "medLab"


}
else{
  $("#interventionId").removeClass("col-span-4");
  $("#interventionId").addClass("col-span-4");

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

  $("#interventionId").removeClass("col-span-4");
$("#interventionId").addClass("col-span-4");
    // Remove the "hidden" class from the input with id "medLab"


}
else{
  $("#interventionId").removeClass("col-span-4");
  $("#interventionId").addClass("col-span-4");

  
  $("#clinicRestLabel").addClass("hidden");
  $("#clinicRestTime").addClass("hidden");
  $("#medsqtydiv").removeClass("hidden");
  $("#medsdiv").removeClass("hidden");
} 
});


});

function addSelectedValue(value, qty) {
    console.log(value);
    $('#ftwMeds').append($('<option>', {
      value: value + "(" + qty + ")",
      text: value + "(" + qty + ")",
      selected: true
    }));
  }



// $(document).ready(function () {

// if ($('#withPendingCheckBox').is(':checked')) {
//       // Code to execute when the checkbox is checked
//       $("#pendingLabDueDateDiv").removeClass("hidden");

//       var pendingLabDueDate = document.getElementById('pendingLabDueDate');
//       pendingLabDueDate.required = true;

      
//       // alert('Checkbox is checked!');


//     } else {
//       // Code to execute when the checkbox is unchecked
//       $("#pendingLabDueDateDiv").addClass("hidden");

//       var pendingLabDueDate = document.getElementById('pendingLabDueDate');
//       pendingLabDueDate.removeAttribute('required');
//     }
    
//   $('#withPendingCheckBox').change(function () {
//     if ($(this).is(':checked')) {
//       // Code to execute when the checkbox is checked
//       $("#pendingLabDueDateDiv").removeClass("hidden");
//       var pendingLabDueDate = document.getElementById('pendingLabDueDate');
//       pendingLabDueDate.required = true;
//       // alert('Checkbox is checked!');


//     } else {
//       // Code to execute when the checkbox is unchecked
//       $("#pendingLabDueDateDiv").addClass("hidden");
//       var pendingLabDueDate = document.getElementById('pendingLabDueDate');
//       pendingLabDueDate.removeAttribute('required');
//     }
//   });
// });

// $(document).ready(function() {
//   var selectedRemarksValue = $('#remarksSelect2').find('option:selected').val();
//     console.log(selectedRemarksValue);
//     if(selectedRemarksValue == 'Fit to Work'){
      
//       $('#ftwdiv1').removeClass('hidden');
//       $('#ftwdiv2').removeClass('hidden');
//       $('#ftwdiv3').removeClass('hidden');
//       $('#ftwdiv4').removeClass('hidden');
//       $('#ftwdiv5').removeClass('hidden');
//       $('#ftwdiv6').removeClass('hidden');
//       $('#ftwdiv7').removeClass('hidden');
//       $('#ftwdiv8').removeClass('hidden');
//       $('#ftwdiv9').removeClass('hidden');



//     }
//     else{
//       $('#ftwdiv1').addClass('hidden');
//       $('#ftwdiv2').addClass('hidden');
//       $('#ftwdiv3').addClass('hidden');
//       $('#ftwdiv4').addClass('hidden');
//       $('#ftwdiv5').addClass('hidden');
//       $('#ftwdiv6').addClass('hidden');
//       $('#ftwdiv7').addClass('hidden');
//       $('#ftwdiv8').addClass('hidden');
//       $('#ftwdiv9').addClass('hidden');

//     }
//         $('#remarksSelect2').change(function() {
//           var selectedRemarksValue = $(this).find('option:selected').val();
//     console.log(selectedRemarksValue);
//     if(selectedRemarksValue == 'Fit to Work'){
      
//       $('#ftwdiv1').removeClass('hidden');
//       $('#ftwdiv2').removeClass('hidden');
//       $('#ftwdiv3').removeClass('hidden');
//       $('#ftwdiv4').removeClass('hidden');
//       $('#ftwdiv5').removeClass('hidden');
//       $('#ftwdiv6').removeClass('hidden');
//       $('#ftwdiv7').removeClass('hidden');
//       $('#ftwdiv8').removeClass('hidden');
//       $('#ftwdiv9').removeClass('hidden');



//     }
//     else{
//       $('#ftwdiv1').addClass('hidden');
//       $('#ftwdiv2').addClass('hidden');
//       $('#ftwdiv3').addClass('hidden');
//       $('#ftwdiv4').addClass('hidden');
//       $('#ftwdiv5').addClass('hidden');
//       $('#ftwdiv6').addClass('hidden');
//       $('#ftwdiv7').addClass('hidden');
//       $('#ftwdiv8').addClass('hidden');
//       $('#ftwdiv9').addClass('hidden');

//     }
//         });
//     });


const $tagertDiagnosisModal = document.getElementById('addDiagnosis');
  const optionsDiagnosisModal = {
    placement: 'center-center',
    backdrop: 'static',
    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
    closable: true,
    onHide: () => {
    },
    onShow: () => {

    },
    onToggle: () => {
    }
  };
  const modalDiagnosis = new Modal($tagertDiagnosisModal, optionsDiagnosisModal);
  $(document).ready(function() {
    // Attach change event handler to remarksSelect
    $("#ftwDiagnosiOption").change(function() {
      // Check if the selected option is the one you want
      if ($(this).val() === "addDiagnosisButton") {
        // Remove the "hidden" class from the input with id "medLab"
        modalDiagnosis.toggle();
      }
    });
  });

  function addDiagnosis() {
    var diagnosis = document.getElementById("diagnosis").value;
    var addDiagnosis = new XMLHttpRequest();
    addDiagnosis.open("POST", "addDiagnosis.php", true);
    addDiagnosis.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    addDiagnosis.onreadystatechange = function() {
      if (addDiagnosis.readyState === XMLHttpRequest.DONE) {
        if (addDiagnosis.status === 200) {
          // Update was successful
          modalDiagnosis.toggle();
          alert("Added Successfuly!")
        } else {
          console.log("Error: " + addDiagnosis.status);
        }
      }
    };

    // Construct the data to be updated
    var data = "addedDiagnosis=" + encodeURIComponent(diagnosis);
    var optionValue = $("#diagnosis").val();

    $("#ftwDiagnosiOption").append($('<option>', {
      value: optionValue,
      text: optionValue
    }));
    // data += "&computername="+ encodeURIComponent(result);

    // Add any other parameters needed for the update
    addDiagnosis.send(data);
  }



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
      $('#immediateHead').change(function() {
    var selectedOptions = $(this).find('option:selected'); // Get all selected options
    var emailSelect = $('#immediateEmail');

    // Clear existing emails to re-sync with selected heads
    emailSelect.empty();

    selectedOptions.each(function() {
        var selectedEmail = $(this).data('email');
        emailSelect.append($('<option>', {
            value: selectedEmail,
            text: selectedEmail,
            selected: true
        }));
    });
});
    });
    


    
    document.addEventListener('DOMContentLoaded', function () {
      // Hide content until fully loaded
      document.getElementById('content').style.display = 'none';
    });

    window.onload = function () {
      document.getElementById('loading-message').style.display = 'none';
      document.getElementById('content').style.display = 'block';
    };

</script>
</body>
</html>