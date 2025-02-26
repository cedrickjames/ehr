<?php

session_start();

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;


// Set the timezone to Manila
include("../includes/connect.php");
if (!isset($_SESSION['connected'])) {
  header("location: ../logout.php");
}
date_default_timezone_set('Asia/Manila');

if (isset($_GET['rf'])) {
  $idNumber = $_GET['rf'];
} else {
  $idNumber = "not found";
}



$userID = $_SESSION['userID'];

?>

<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fit To Work</title>
<link rel="shortcut icon" href="../src/Logo 2.png">

  <script src="../src/cdn_tailwindcss.js"></script>

  <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>

  <link rel="stylesheet" href="../fontawesome-free-6.2.0-web/css/all.min.css">
  <link rel="stylesheet" href="../node_modules/DataTables/datatables.min.css">
  <script src="../node_modules/flowbite/dist/datepicker.js"></script>
  <link href="../node_modules/select2/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="../styles.css" />

  <link rel="stylesheet" type="text/css" href="../node_modules/DataTables/Responsive-2.3.0/css/responsive.dataTables.min.css" />

</head>

<body class="h-screen bg-no-repeat bg-cover bg-[url('../src/Background.png')]">

  <?php require_once '../navbar.php'; ?>
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
  <div  id="content" style="display: none; background: linear-gradient(-45deg, #05458cba, rgba(255, 255, 255, 0.63), rgba(255, 255, 255, 0));" class="h-full ml-56 2xl:ml-80 flex   left-10 right-5  flex-col  px-2   pt-2 2xl:pt-6 pb-14 z-50 ">
  
 
  <?php
    if ($idNumber == "not found") {
      echo "<div class='m-4'>";
      require_once '../employeesData/ftwTable.php';
      echo "</div>";
    } else {
      echo "<div class='mb-5 grid grid-cols-1 sm:grid-cols-11 gap-4 w-full'>
      <div class='overflow-y-auto h-screen relative  sm:col-span-6 '>";

      require_once '../employeesData/employeesPersonalData.php';
      require_once '../employeesData/fitToWork.php';

      echo "</div>
      <div class='overflow-y-auto h-screen sm:col-span-5'>";

      require_once '../employeesData/ftwInfo.php';

      echo "</div>
    </div>";
    } ?>

  </div>




  <script src="../node_modules/jquery/dist/jquery.min.js"></script>

  <script type="text/javascript" src="../node_modules/DataTables/datatables.min.js"></script>
  <script type="text/javascript" src="../node_modules/DataTables/Responsive-2.3.0/js/dataTables.responsive.min.js"></script>
  <script src="../node_modules/select2/dist/js/select2.min.js"></script>

  <script type="text/javascript" src="index.js"></script>
  <script>



<?php
 if ($idNumber != "not found") {
?>

$(document).ready(function () {

if ($('#withPendingCheckBox').is(':checked')) {
      // Code to execute when the checkbox is checked
      $("#pendingLabDueDateDiv").removeClass("hidden");

      var pendingLabDueDate = document.getElementById('pendingLabDueDate');
      pendingLabDueDate.required = true;

      
      // alert('Checkbox is checked!');


    } else {
      // Code to execute when the checkbox is unchecked
      $("#pendingLabDueDateDiv").addClass("hidden");

      var pendingLabDueDate = document.getElementById('pendingLabDueDate');
      pendingLabDueDate.removeAttribute('required');
    }
    
  $('#withPendingCheckBox').change(function () {
    if ($(this).is(':checked')) {
      // Code to execute when the checkbox is checked
      $("#pendingLabDueDateDiv").removeClass("hidden");
      var pendingLabDueDate = document.getElementById('pendingLabDueDate');
      pendingLabDueDate.required = true;
      // alert('Checkbox is checked!');


    } else {
      // Code to execute when the checkbox is unchecked
      $("#pendingLabDueDateDiv").addClass("hidden");
      var pendingLabDueDate = document.getElementById('pendingLabDueDate');
      pendingLabDueDate.removeAttribute('required');
    }
  });
});




document.getElementById('submitWithoutValidation').addEventListener('click', function(event) {
var immediateHead = document.getElementById('immediateHead');
immediateHead.removeAttribute('required');

var immediateEmail = document.getElementById('immediateEmail');
immediateEmail.removeAttribute('required');

});


  $("#fitToWorkSide").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");
  $("#sidehistory").removeClass("bg-gray-200");
  $("#sideMyRequest").removeClass("bg-gray-200");
  $("#sidepms").removeClass("bg-gray-200");

  $("#fitToWorkSide1").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");
  $("#sidehistory1").removeClass("bg-gray-200");
  $("#sideMyRequest1").removeClass("bg-gray-200");
  $("#sidepms1").removeClass("bg-gray-200");
  $(".ftwIcon").attr("fill", "#FFFFFF");
  $(".homeIcon").attr("fill", "#4d4d4d");


  $(".js-diagnosis").select2({
    tags: true
  });



  $(".js-meds").select2({
    tags: true
  });
  $(document).ready(function() {
    if ($('#remarksSelect').val() != "Unfit to work") {

      var ftwDaysOfRest = document.getElementById('ftwDaysOfRest');
ftwDaysOfRest.removeAttribute('required');

var ftwUnfitReason = document.getElementById('ftwUnfitReason');
ftwUnfitReason.removeAttribute('required');

          // Remove the "hidden" class from the input with id "medLab"
          // $("#fitToWorkFields").removeClass("hidden");
        $("#restDays").addClass("hidden");
        $("#unfitReason").addClass("hidden");
        
        

      }
      else{
        var ftwDaysOfRest = document.getElementById('ftwDaysOfRest');
ftwDaysOfRest.required = true;

var ftwUnfitReason = document.getElementById('ftwUnfitReason');
ftwUnfitReason.required = true;

        $("#unfitReason").removeClass("hidden");
        $("#restDays").removeClass("hidden");

        // $("#fitToWorkFields").addClass("hidden");
      }
  })

  $("#remarksSelect").change(function() {
    if ($(this).val() != "Unfit to work") {

      var ftwDaysOfRest = document.getElementById('ftwDaysOfRest');
ftwDaysOfRest.removeAttribute('required');

var ftwUnfitReason = document.getElementById('ftwUnfitReason');
ftwUnfitReason.removeAttribute('required');


          // Remove the "hidden" class from the input with id "medLab"
          // $("#fitToWorkFields").removeClass("hidden");
        $("#restDays").addClass("hidden");
        $("#unfitReason").addClass("hidden");

      }
      else{

        var ftwDaysOfRest = document.getElementById('ftwDaysOfRest');
ftwDaysOfRest.required = true;

var ftwUnfitReason = document.getElementById('ftwUnfitReason');
ftwUnfitReason.required = true;
        $("#unfitReason").removeClass("hidden");

        $("#restDays").removeClass("hidden");
        // $("#fitToWorkFields").addClass("hidden");
      }

  })
  
  $("#interventionSelect").change(function() {

if ($(this).val() === "Clinic Rest Only" || $(this).val() === "Medication, Clinic Rest and Medical Consultation") {

if($(this).val() === "Clinic Rest Only"){
  $("#clinicRestLabel").removeClass("hidden");
$("#clinicRestTime").removeClass("hidden");

$("#medsqtydiv").addClass("hidden");
$("#medsdiv").addClass("hidden");
$("#medicineDivs").addClass("hidden");






}else{
  $("#clinicRestLabel").removeClass("hidden");
$("#clinicRestTime").removeClass("hidden");
$("#medsqtydiv").removeClass("hidden");
$("#medsdiv").removeClass("hidden");
$("#medicineDivs").removeClass("hidden");



}

  // Remove the "hidden" class from the input with id "medLab"


}
else{
$("#clinicRestLabel").addClass("hidden");
$("#clinicRestTime").addClass("hidden");
$("#medsqtydiv").removeClass("hidden");
$("#medsdiv").removeClass("hidden");
$("#medicineDivs").removeClass("hidden");

} 
});


  function addSelectedValue(value, qty) {
    console.log(value);
    $('#ftwMeds').append($('<option>', {
      value: value + "(" + qty + ")",
      text: value + "(" + qty + ")",
      selected: true
    }));
  }


  $(document).ready(function() {
    $('#immediateHead').change(function() {
      var selectedEmail = $(this).find('option:selected').data('email');
      $('#immediateEmail').val(selectedEmail);
    });

    $("#categoriesSelect").change(function() {
      if ($(this).val() === "counted") {
        $("#medicineDivs").removeClass("hidden");

      } else {
        $("#medicineDivs").addClass("hidden");
      }

    });




    
  });


  $("#nameOfMedicine").change(function() {


// Check if the selected option is the one you want
if ($(this).val() === "addMedicineButton") {
  // Remove the "hidden" class from the input with id "medLab"
  modalMedicine.toggle();
  // console.log("kasjhdkas");

} 
});
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



  const $tagertMedicineModal = document.getElementById('addMedicine');

const optionsMedicineModal = {
placement: 'center-center',
backdrop: 'static',
backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
closable: true,
onHide: () => {
console.log('modal is hidden');
},
onShow: () => {
console.log('modal is shown');

},
onToggle: () => {
console.log('modal has been toggled');

}
};
const modalMedicine = new Modal($tagertMedicineModal, optionsMedicineModal);


function addMedicine(){
var medicine = document.getElementById("medicine").value;
console.log(medicine);

var addMedicine = new XMLHttpRequest();
addMedicine.open("POST", "addMedicine.php", true);
addMedicine.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
addMedicine.onreadystatechange = function() {
  if (addMedicine.readyState === XMLHttpRequest.DONE) {
      if (addMedicine.status === 200) {
          // Update was successful
          console.log(addMedicine);

      
      } else {
          console.log("Error: " + addMedicine.status);
      }
  }
};

// Construct the data to be updated
var data = "addedMedicine=" + encodeURIComponent(medicine);

var optionValue = $("#medicine").val();

$("#nameOfMedicine").append($('<option>', {
                  value: optionValue,
                  text: optionValue
              }));
// data += "&computername="+ encodeURIComponent(result);

// Add any other parameters needed for the update

addMedicine.send(data);
modalMedicine.toggle();

}


const $targetPromptModal = document.getElementById('askFirst');
  const optionsPromptModal = {
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
  const modalPrompt = new Modal($targetPromptModal, optionsPromptModal);

  $("#proceedButton").click(function() {

    modalPrompt.toggle();

    });

    $("#proceedButtonUpdate").click(function() {

      fitToWorkModal.toggle();
      var immediateHead = document.getElementById('immediateHead');
immediateHead.removeAttribute('required');

var immediateEmail = document.getElementById('immediateEmail');
immediateEmail.removeAttribute('required');

$('#immediateHeadSection').addClass("hidden")

});


    
const $targetFitToworkModal = document.getElementById('fitToWorkModal');
  const optionsFitToWorkModal = {
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
  const fitToWorkModal = new Modal($targetFitToworkModal, optionsFitToWorkModal);

  $("#proceedToFitToWork").click(function() {

    modalPrompt.toggle();
    fitToWorkModal.toggle();


    });

    // $("#ftwMeds").select2("readonly", true);

  //   const form = document.getElementById('myForm');
  //   const loading = document.getElementById('loading-message');
  //   form.addEventListener('submit', function (e) {
  //   // Show the loading message
  //   $('#loading-message').css('display', 'flex'); 

  //   // loading.style.display = 'block';
  // });


  document.addEventListener('DOMContentLoaded', function () {
    // Hide content until fully loaded
    document.getElementById('content').style.display = 'none';
    console.log("asdasd");

  });

  window.onload = function () {
    console.log("asdasd");
    document.getElementById('loading-message').style.display = 'none';
    document.getElementById('content').style.display = 'block';
  };
  
  
<?php

 }
 else{
  ?>

document.addEventListener('DOMContentLoaded', function () {
    // Hide content until fully loaded
    document.getElementById('content').style.display = 'none';
    console.log("asdasd");

  });

  window.onload = function () {
    console.log("asdasd");
    document.getElementById('loading-message').style.display = 'none';
    document.getElementById('content').style.display = 'block';
  };
  
  <?php
 }
?>

  </script>
</body>

</html>