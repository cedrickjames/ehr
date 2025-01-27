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

if (isset($_POST['proceedToConsultation'])) {

  $_SESSION['ftwTime'] = $_POST['ftwTime'];
  $_SESSION['ftwCategories'] = $_POST['ftwCategories'];
  $_SESSION['ftwBuilding'] = $_POST['ftwBuilding'];
  $_SESSION['ftwConfinement'] = $_POST['ftwConfinement'];
  $_SESSION['ftwMedCategory'] = $_POST['ftwMedCategory'];
  $_SESSION['ftwSLDateFrom'] = $_POST['ftwSLDateFrom'];
  $_SESSION['ftwSLDateTo'] = $_POST['ftwSLDateTo'];
  $_SESSION['ftwDays'] = $_POST['ftwDays'];
  $_SESSION['ftwAbsenceReason'] = $_POST['ftwAbsenceReason'];
  $_SESSION['ftwDiagnosis'] = $_POST['ftwDiagnosis'];
  $_SESSION['ftwBloodChem'] = $_POST['ftwBloodChem'];
  $_SESSION['ftwCbc'] = $_POST['ftwCbc'];
  $_SESSION['ftwUrinalysis'] = $_POST['ftwUrinalysis'];
  $_SESSION['ftwFecalysis'] = $_POST['ftwFecalysis'];
  $_SESSION['ftwXray'] = $_POST['ftwXray'];
  $_SESSION['ftwOthersLab'] = $_POST['ftwOthersLab'];
  $_SESSION['ftwBp'] = $_POST['ftwBp'];
  $_SESSION['ftwTemp'] = $_POST['ftwTemp'];
  $_SESSION['ftw02Sat'] = $_POST['ftw02Sat'];
  $_SESSION['ftwPr'] = $_POST['ftwPr'];
  $_SESSION['ftwRr'] = $_POST['ftwRr'];
  $_SESSION['ftwRemarks'] = $_POST['ftwRemarks'];
  $_SESSION['ftwOthersRemarks'] = $_POST['ftwOthersRemarks'];
  $_SESSION['ftwCompleted'] = isset($_POST['ftwCompleted']) ? $_POST['ftwCompleted'] : "0";
  $_SESSION['ftwWithPendingLab'] = $_POST['ftwWithPendingLab'];
  $_SESSION['immediateEmail'] = $_POST['immediateEmail'];


  $ftwMeds = $_POST['ftwMeds'];

  if ($ftwMeds != "") {

    $ftwMeds = implode(', ', $ftwMeds);
  }

  $_SESSION['ftwMeds'] = $ftwMeds;


  header("location:consultation.php?rf=$idNumber");
}


$userID = $_SESSION['userID'];

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
  <link href="../node_modules/select2/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="../styles.css" />

  <link rel="stylesheet" type="text/css" href="../node_modules/DataTables/Responsive-2.3.0/css/responsive.dataTables.min.css" />

</head>

<body class="bg-no-repeat bg-cover bg-[url('../src/Background.png')]">
  <?php require_once '../navbar.php'; ?>

  <div style=" background: linear-gradient(-45deg, #a6d0ff, rgba(255, 255, 255, 0.63), rgba(255, 255, 255, 0));" class=" m-auto ml-56 2xl:ml-80 flex   left-10 right-5  flex-col  px-2   pt-2 2xl:pt-6 pb-14 z-50 ">
    <?php
    if ($idNumber == "not found") {
      echo "<div class='m-2'>";
      require_once '../employeesData/vaccinationTable.php';
      echo "</div>";
    } else {
      echo "<div class='mb-5 grid grid-cols-1 sm:grid-cols-11 gap-4 w-full'>
      <div class='overflow-y-auto h-screen relative  sm:col-span-6 '>";

      require_once '../employeesData/employeesPersonalData.php';
      require_once '../employeesData/vaccination.php';

      echo "</div>
      <div class='overflow-y-auto h-screen sm:col-span-5'>";

      require_once '../employeesData/vaccinationRecord.php';

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
    $("#vaccinationSide").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");
    $("#sidehistory").removeClass("bg-gray-200");
    $("#sideMyRequest").removeClass("bg-gray-200");
    $("#sidepms").removeClass("bg-gray-200");

    $("#sidehome1").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");
    $("#sidehistory1").removeClass("bg-gray-200");
    $("#sideMyRequest1").removeClass("bg-gray-200");
    $("#sidepms1").removeClass("bg-gray-200");
    $(".vaccination").attr("fill", "#FFFFFF");
    $(".homeIcon").attr("fill", "#4d4d4d");

        

const $targetVaccine = document.getElementById('addVaccine');
  const vaccineModal = {
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
  const modalVaccine = new Modal($targetVaccine, vaccineModal);

$(document).ready(function() {
    // Attach change event handler to remarksSelect
    $("#vaxType").change(function() {
      // Check if the selected option is the one you want
      if ($(this).val() === "addVaccineType") {
        // Remove the "hidden" class from the input with id "medLab"
        modalVaccine.toggle();
      }
    });

    $("#vaxType2").change(function() {
      // Check if the selected option is the one you want
      if ($(this).val() === "addVaccineType") {
        // Remove the "hidden" class from the input with id "medLab"
        modalVaccine.toggle();
      }
    });
  });


  function addVaccine() {
    var vaccine = document.getElementById("vaccine").value;
    var addVaccine = new XMLHttpRequest();
    addVaccine.open("POST", "addVaccine.php", true);
    addVaccine.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    addVaccine.onreadystatechange = function() {
      if (addVaccine.readyState === XMLHttpRequest.DONE) {
        if (addVaccine.status === 200) {
          // Update was successful
          modalVaccine.toggle();
          alert("Added Successfuly!")
        } else {
          console.log("Error: " + addVaccine.status);
        }
      }
    };

    // Construct the data to be updated
    var data = "addedVaccine=" + encodeURIComponent(vaccine);
    var optionValue = $("#vaccine").val();

    $("#vaxType").append($('<option>', {
      value: optionValue,
      text: optionValue
    }));
    $("#vaxType2").append($('<option>', {
      value: optionValue,
      text: optionValue
    }));
    // data += "&computername="+ encodeURIComponent(result);

    // Add any other parameters needed for the update
    addVaccine.send(data);
  }






$(".js-employees").select2({
      tags: true
    });
    

    $(".js-diagnosis").select2({
      tags: true
    });



    $(".js-meds").select2({
      tags: true
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

    $(document).ready(function() {
      $('#empname').change(function() {
        var selectedID = $(this).find('option:selected').data('rfid');
        $('#idNumber').val(selectedID);
      });





      
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




    $(document).ready(function() {
      // Attach change event handler to remarksSelect
      $("#ftwDiagnosiOption").change(function() {


        // Check if the selected option is the one you want
        if ($(this).val() === "addDiagnosisButton") {
          // Remove the "hidden" class from the input with id "medLab"
          modalDiagnosis.toggle();
          // console.log("kasjhdkas");

        }
      });
    });

    function addDiagnosis() {
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


    }

    


  </script>
</body>

</html>