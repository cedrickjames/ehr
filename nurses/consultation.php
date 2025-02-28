
<?php
session_start();
        // Set the timezone to Manila
        include ("../includes/connect.php");
if(!isset($_SESSION['connected'])){
  header("location: ../logout.php");
}
        date_default_timezone_set('Asia/Manila');

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
  <title>Clinic Visit</title>
<link rel="shortcut icon" href="../src/Logo 2.png">

  <script src="../src/cdn_tailwindcss.js"></script>

  <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
  
  <link rel="stylesheet" href="../fontawesome-free-6.2.0-web/css/all.min.css">
  <link rel="stylesheet" href="../node_modules/DataTables/datatables.min.css">
  <script src="../node_modules/flowbite/dist/datepicker.js"></script>
  <link href="../node_modules/select2/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="../node_modules/DataTables/Responsive-2.3.0/css/responsive.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="../styles.css"/>

</head>
<body  class="h-screen bg-no-repeat bg-cover bg-[url('../src/Background.png')]">
<?php require_once '../navbar.php';?>
<div style= " background: linear-gradient(-45deg, #a6d0ff, rgba(255, 255, 255, 0.63), rgba(255, 255, 255, 0));"class="h-full  ml-56 2xl:ml-80 flex   left-10 right-5  flex-col  px-2   pt-2 2xl:pt-6 pb-14 z-50 ">
 
<?php
    if ($idNumber == "not found") {
      echo "<div class='m-2'>";
      require_once '../employeesData/consultationMainTable.php';
      echo "</div>";
    } else {
      echo "<div class='mb-5 grid grid-cols-1 sm:grid-cols-11 gap-4 w-full'>
      <div class='overflow-y-auto h-screen relative  sm:col-span-6 '>";

      require_once '../employeesData/employeesPersonalData.php';
      require_once '../employeesData/consultation.php';

      echo "</div>
      <div class='overflow-y-auto h-screen sm:col-span-5'>";

      require_once '../employeesData/consultationTable.php';

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
    
$("#consultationSide").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");
$("#sidehistory").removeClass("bg-gray-200");
$("#sideMyRequest").removeClass("bg-gray-200");
$("#sidepms").removeClass("bg-gray-200");

$("#sidehome1").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");
$("#sidehistory1").removeClass("bg-gray-200");
$("#sideMyRequest1").removeClass("bg-gray-200");
$("#sidepms1").removeClass("bg-gray-200");
$(".consultationIcon").attr("fill", "#FFFFFF"); 
$(".homeIcon").attr("fill", "#4d4d4d"); 



$("#cnsltnCompletedChecked").change(function() {
  
  if ($(this).is(':checked')) {
$("#withPendingLabCheck").prop('checked', false);
  }

})
$("#withPendingLabCheck").change(function() {
  if ($(this).is(':checked')) {
$("#cnsltnCompletedChecked").prop('checked', false);
  }

})




$(".js-diagnosis").select2({
  tags: true
});

$(".js-meds").select2({
  tags: true
});


function addSelectedValue(value, qty) {
  console.log(value);
    $('#cnsltnMeds').append($('<option>', {
      value: value + "("+qty+")",
      text: value + "("+qty+")",
      selected: true
    }));
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

    



const $tagertDiagnosisModal = document.getElementById('addDiagnosis');

const optionsDiagnosisModal = {
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
const modalDiagnosis = new Modal($tagertDiagnosisModal, optionsDiagnosisModal);




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






    $(document).ready(function() {

      if ($("#remarksSelect").val() === "For Medical Laboratory") {
            // Remove the "hidden" class from the input with id "medLab"
            $("#medLab").removeClass("hidden");
            // $("#medDis").addClass("hidden");
        }  else if($("#remarksSelect").val() === "For Medication Dispense") {
            // If the option is not the desired one, you can add the "hidden" class
            // $("#medDis").removeClass("hidden");
            $("#medLab").addClass("hidden");

        }
        else{
          $("#medLab").addClass("hidden");
            

        }

        $("#remarksSelect").change(function() {
          if ($(this).val() === "For Medical Laboratory") {
            // Remove the "hidden" class from the input with id "medLab"
            $("#medLab").removeClass("hidden");
            // $("#medDis").addClass("hidden");

        } else if($(this).val() === "For Medication Dispense") {
            // If the option is not the desired one, you can add the "hidden" class
            // $("#medDis").removeClass("hidden");
            $("#medLab").addClass("hidden");

        }
        else{
          $("#medLab").addClass("hidden");
            // $("#medDis").addClass("hidden");

        }
    });


      $("#interventionSelect").change(function() {

if ($(this).val() === "Clinic Rest Only" || $(this).val() === "Medication, Clinic Rest and Medical Consultation") {

  if($(this).val() === "Clinic Rest Only"){
    $("#clinicRestLabel").removeClass("hidden");
  $("#clinicRestTime").removeClass("hidden");

  $("#medsqtydiv").addClass("hidden");
  $("#medicineDiv").addClass("hidden");

  $("#medsdiv").addClass("hidden");
  


  

  }else{
    $("#clinicRestLabel").removeClass("hidden");
  $("#clinicRestTime").removeClass("hidden");
  $("#medsqtydiv").removeClass("hidden");
  $("#medicineDiv").removeClass("hidden");

  $("#medsdiv").removeClass("hidden");
  }

    // Remove the "hidden" class from the input with id "medLab"


}
else{
  $("#clinicRestLabel").addClass("hidden");
  $("#clinicRestTime").addClass("hidden");
  $("#medsqtydiv").removeClass("hidden");
  $("#medicineDiv").removeClass("hidden");

  $("#medsdiv").removeClass("hidden");
} 
});


if ($("#interventionSelect").val() === "Clinic Rest Only" || $("#interventionSelect").val() === "Medication, Clinic Rest and Medical Consultation") {

if($("#interventionSelect").val() === "Clinic Rest Only"){
  $("#clinicRestLabel").removeClass("hidden");
$("#clinicRestTime").removeClass("hidden");

$("#medsqtydiv").addClass("hidden");
$("#medicineDiv").addClass("hidden");

$("#medsdiv").addClass("hidden");





}else{
  $("#clinicRestLabel").removeClass("hidden");
$("#clinicRestTime").removeClass("hidden");
$("#medsqtydiv").removeClass("hidden");
$("#medicineDiv").removeClass("hidden");

$("#medsdiv").removeClass("hidden");
}

  // Remove the "hidden" class from the input with id "medLab"


}
else{
$("#clinicRestLabel").addClass("hidden");
$("#clinicRestTime").addClass("hidden");
$("#medsqtydiv").removeClass("hidden");
$("#medicineDiv").removeClass("hidden");

$("#medsdiv").removeClass("hidden");
} 




  // Attach change event handler to remarksSelect
  $("#ftwDiagnosiOption").change(function() {

  
      // Check if the selected option is the one you want
      if ($(this).val() === "addDiagnosisButton") {
          // Remove the "hidden" class from the input with id "medLab"
          modalDiagnosis.toggle();
          // console.log("kasjhdkas");

      } 
  });


  $("#nameOfMedicine").change(function() {

  
// Check if the selected option is the one you want
if ($(this).val() === "addMedicineButton") {
    // Remove the "hidden" class from the input with id "medLab"
    modalMedicine.toggle();
    // console.log("kasjhdkas");

} 
});



});







function addDiagnosis(){
var diagnosis = document.getElementById("diagnosis").value;
console.log(diagnosis);

var addDiagnosis = new XMLHttpRequest();
addDiagnosis.open("POST", "addDiagnosis.php", true);
addDiagnosis.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
addDiagnosis.onreadystatechange = function() {
    if (addDiagnosis.readyState === XMLHttpRequest.DONE) {
        if (addDiagnosis.status === 200) {
            // Update was successful
            console.log(addDiagnosis);

        
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

modalDiagnosis.toggle();
}


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

$(document).ready(function() {

    $('#addmedsbtn').click(function() {

      
    });


    


});


</script>
</body>
</html>