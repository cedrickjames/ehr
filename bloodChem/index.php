<?php
session_start();

include("../includes/connect.php");
if (!isset($_SESSION['connected'])) {
  header("location: ../logout.php");
}

?>


<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HLP</title>
<link rel="shortcut icon" href="../src/Logo 2.png">

  <script src="../src/cdn_tailwindcss.js"></script>

  <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>

  <link rel="stylesheet" href="../fontawesome-free-6.2.0-web/css/all.min.css">
  <link rel="stylesheet" href="../node_modules/DataTables/datatables.min.css">
  <link href="../node_modules/select2/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="../node_modules/DataTables/Responsive-2.3.0/css/responsive.dataTables.min.css" />
  <link rel="stylesheet" type="text/css" href="../styles.css" />

</head>

<body class="bg-no-repeat bg-cover bg-[url('../src/Background.png')]">
  <?php require_once 'navbar.php'; ?>

  <div style=" background: linear-gradient(-45deg, #a6d0ff, rgba(255, 255, 255, 0.63), rgba(255, 255, 255, 0));" class=" m-auto ml-56 2xl:ml-[22rem] flex   left-10 right-5  flex-col  px-2   pt-2 2xl:pt-6 pb-14 z-50 ">
    <div class="m-2">

      <?php require_once 'directEmployees.php'; ?>



    </div>

  </div>

  <script src="../node_modules/jquery/dist/jquery.min.js"></script>

  <script type="text/javascript" src="../node_modules/DataTables/datatables.min.js"></script>
  <script type="text/javascript" src="../node_modules/DataTables/Responsive-2.3.0/js/dataTables.responsive.min.js"></script>

  <script src="../node_modules/select2/dist/js/select2.min.js"></script>
  <script type="text/javascript" src="index.js"></script>
  <script>


$(".js-diagnosis").select2({
    tags: true
  });
  $(".js-meds").select2({
    tags: true
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
        console.log("ced")
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
          try {
                    var response = JSON.parse(addDiagnosis.responseText);
                    if (response.success) {
                        // Update was successful
                        modalDiagnosis.toggle();
                        alert("Diagnosis added successfully!");
                    } else {
                        // Display the SQL error
                        console.log("Error: " + response.error);
                        alert("Error: " + response.error);
                    }
                } catch (e) {
                    console.log("Error parsing JSON response: " + e.message);
                    alert("Error parsing response from server.");
                }
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


$("#nameOfMedicine").change(function() {


// Check if the selected option is the one you want
if ($(this).val() === "addMedicineButton") {
  // Remove the "hidden" class from the input with id "medLab"
  modalMedicine.toggle();
  // console.log("kasjhdkas");

} 
});







$(".js-employees").select2({
      tags: true
    });


    
     <?php
    $sidebar1;

    if($employer=="GPI"){
      $sidebar1 ="#gpiside_1";
    }
    else if($employer=="Maxim"){
      $sidebar1 ="#maximside_1";

    }
    else if($employer=="Nippi"){
      $sidebar1 ="#nippiside_1";

    }
    else if($employer=="Powerlane"){
      $sidebar1 ="#powerlaneside_1";

    }
    else if($employer=="Otrelo"){
      $sidebar1 ="#otreloside_1";

    }
    else if($employer=="Alarm"){
      $sidebar1 ="#alarmside_1";

    }
    else if($employer=="Mangreat"){
      $sidebar1 ="#mangreatside_1";

    }
    else if($employer=="Canteen"){
      $sidebar1 ="#canteenside_1";

    }
    ?>

    $("<?php echo $sidebar1; ?>").addClass("bg-[#82c7cc]");
    $("#bloodchemSide").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");


    $("#sidehistory").removeClass("bg-gray-200");
    $("#sideMyRequest").removeClass("bg-gray-200");
    $("#sidepms").removeClass("bg-gray-200");

    $("#preempside1").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");
    $("#sidehistory1").removeClass("bg-gray-200");
    $("#sideMyRequest1").removeClass("bg-gray-200");
    $("#sidepms1").removeClass("bg-gray-200");
    // $(".preempIcon").attr("fill", "#FFFFFF");
    // $(".homeIcon").attr("fill", "#4d4d4d");

    $(".js-meds").select2({
      tags: true
    });
    $(".js-meds1").select2({
      tags: true
    });

    function addSelectedValue(value, qty) {
      console.log(value);
      $('#hlpftwMeds').append($('<option>', {
        value: value + "(" + qty + ")",
        text: value + "(" + qty + ")",
        selected: true
      }));
    }

    function addSelectedValue1(value, qty) {
      console.log(value);
      $('#editftwMeds').append($('<option>', {
        value: value + "(" + qty + ")",
        text: value + "(" + qty + ")",
        selected: true
      }));
    }


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

<script>





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


const exportBloodChem = document.getElementById('exportModal');

// options with default values
const exportBloodChems = {

    backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 relative inset-0 z-40',
    closable: true,
    onHide: () => {
        console.log('modal is hidden');
    },
    onShow: () => {
        console.log('modal is shown');
    },
    onToggle: () => {
        console.log('modal has been toggled');
    },
};

const modalExport = new Modal(exportBloodChem, exportBloodChems);

function openExportModal(element) {
    modalExport.toggle();

};


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


    

    $(document).ready(function() {
        const hlpfbsmin = parseFloat(document.getElementById('hlpfbsmin').value);
        const hlpfbsmax = parseFloat(document.getElementById('hlpfbsmax').value);

        const hlpcholesterolmin = parseFloat(document.getElementById('hlpcholesterolmin').value);
        const hlpcholesterolmax = parseFloat(document.getElementById('hlpcholesterolmax').value);

        const hlptriglyceridesmin = parseFloat(document.getElementById('hlptriglyceridesmin').value);
        const hlptriglyceridesmax = parseFloat(document.getElementById('hlptriglyceridesmax').value);

        const hlphdlmin = parseFloat(document.getElementById('hlphdlmin').value);
        const hlphdlmax = parseFloat(document.getElementById('hlphdlmax').value);

        const hlpldlmin = parseFloat(document.getElementById('hlpldlmin').value);
        const hlpldlmax = parseFloat(document.getElementById('hlpldlmax').value);

        const hlpbunmin = parseFloat(document.getElementById('hlpbunmin').value);
        const hlpbunmax = parseFloat(document.getElementById('hlpbunmax').value);

        const hlpcreatininemin = parseFloat(document.getElementById('hlpcreatininemin').value);
        const hlpcreatininemax = parseFloat(document.getElementById('hlpcreatininemax').value);

        const hlpbuamin = parseFloat(document.getElementById('hlpbuamin').value);
        const hlpbuamax = parseFloat(document.getElementById('hlpbuamax').value);

        const hlpsgdtmin = parseFloat(document.getElementById('hlpsgdtmin').value);
        const hlpsgdtmax = parseFloat(document.getElementById('hlpsgdtmax').value);

        const hlpsgptmin = parseFloat(document.getElementById('hlpsgptmin').value);
        const hlpsgptmax = parseFloat(document.getElementById('hlpsgptmax').value);

        const hlphbaicmin = parseFloat(document.getElementById('hlphbaicmin').value);
        const hlphbaicmax = parseFloat(document.getElementById('hlphbaicmax').value);

        const hlpKmin = parseFloat(document.getElementById('hlpKmin').value);
        const hlpKmax = parseFloat(document.getElementById('hlpKmax').value);

        const hlpNamin = parseFloat(document.getElementById('hlpNamin').value);
        const hlpNamax = parseFloat(document.getElementById('hlpNamax').value);

        const FT3min = parseFloat(document.getElementById('FT3min').value);
        const FT3max = parseFloat(document.getElementById('FT3max').value);

        const FT4min = parseFloat(document.getElementById('FT4min').value);
        const FT4max = parseFloat(document.getElementById('FT4max').value);

        const TSHmin = parseFloat(document.getElementById('TSHmin').value);
        const TSHmax = parseFloat(document.getElementById('TSHmax').value);


   
        var findings = ['','','','','','','','','','','','','','','',''];

        
const $targetFitToworkModal = document.getElementById('proceedToConsultationModal');
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
  const proceedToConsultationModal = new Modal($targetFitToworkModal, optionsFitToWorkModal);
  $("#proceedToConsultation").click(function() {

    $('#cnsltnBloodChem').val(findings);
    var filteredFindings = findings.filter(function(element) {
    return element !== '';
}).join(' ');

$('#cnsltnBloodChem').val(filteredFindings);

    // modalPrompt.toggle();
    proceedToConsultationModal.toggle();

});



        $('#hlpfbs').on('input', function() {
            const value = $(this).val();
            const valueWithFindings = "FBS: "+value;
            if(value != ""){
                if (value < hlpfbsmin || value > hlpfbsmax) {

                    findings.splice(0, 1, valueWithFindings);

                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                    findings.splice(0, 1, '');
                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(0, 1, '');
             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });

        
        $('#hlpcholesterol').on('input', function() {
            const value = $(this).val();
            const valueWithFindings1 = "Cholesterol: "+value;
            if(value != ""){
                if (value < hlpcholesterolmin || value > hlpcholesterolmax) {
                    findings.splice(1, 1, valueWithFindings1);
                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                    findings.splice(1, 1, '');
                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(1, 1, '');
             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#hlptriglycerides').on('input', function() {
            const value = $(this).val();
            const valueWithFindings2 = "Triglycerides: "+value;
            if(value != ""){
                if (value < hlptriglyceridesmin || value > hlptriglyceridesmax) {
                    findings.splice(2, 1, valueWithFindings2);
                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                    findings.splice(2, 1, '');
                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(2, 1, '');
             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#hlphdl').on('input', function() {
            const value = $(this).val();
            const valueWithFindings3 = "HDL: "+value;
            if(value != ""){
                if (value < hlphdlmin || value > hlphdlmax) {
                    findings.splice(3, 1, valueWithFindings3);
                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                    findings.splice(3, 1, '');
                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(3, 1, '');
             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#hlpldl').on('input', function() {
            const value = $(this).val();
            const valueWithFindings4 = "LDL: "+value;
            if(value != ""){
                if (value < hlpldlmin || value > hlpldlmax) {
                    findings.splice(4, 1, valueWithFindings4);
                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                    findings.splice(4, 1, '');
                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(4, 1, '');

             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#hlpbun').on('input', function() {
            const value = $(this).val();
            const valueWithFindings5 = "BUN: "+value;
            if(value != ""){
                if (value < hlpbunmin || value > hlpbunmax) {
                    findings.splice(5, 1, valueWithFindings5);
                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                    findings.splice(5, 1, '');

                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(5, 1, '');

             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#hlpcreatinine').on('input', function() {
            const value = $(this).val();
            const valueWithFindings6 = "Creatinine: "+value;
            if(value != ""){
                if (value < hlpcreatininemin || value > hlpcreatininemax) {
                    findings.splice(6, 1, valueWithFindings6);

                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                    findings.splice(6, 1, '');
                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(6, 1, '');
             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#hlpbua').on('input', function() {
            const value = $(this).val();
            const valueWithFindings7 = "BUA: "+value;

            if(value != ""){
                if (value < hlpbuamin || value > hlpbuamax) {
                    findings.splice(7, 1, valueWithFindings7);
                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                    findings.splice(7, 1, '');
                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(7, 1, '');
             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#hlpsgdt').on('input', function() {
            const value = $(this).val();
            const valueWithFindings8 = "SGOT: "+value;

            if(value != ""){
                if (value < hlpsgdtmin || value > hlpsgdtmax) {
                    findings.splice(8, 1, valueWithFindings8);

                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                findings.splice(8, 1, '');

                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(8, 1, '');

             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#hlpsgpt').on('input', function() {
            const value = $(this).val();
            const valueWithFindings9 = "SGPT: "+value;

            if(value != ""){
                if (value < hlpsgptmin || value > hlpsgptmax) {
                    findings.splice(9, 1, valueWithFindings9);

                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                findings.splice(9, 1, '');

                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(9, 1, '');

             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#hlphbaic').on('input', function() {
            const value = $(this).val();
            const valueWithFindings10 = "HBA1C: "+value;

            if(value != ""){
                if (value < hlphbaicmin || value > hlphbaicmax) {
                    findings.splice(10, 1, valueWithFindings10);

                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                findings.splice(10, 1, '');

                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(10, 1, '');

             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#hlpK').on('input', function() {
            const value = $(this).val();
            const valueWithFindings11 = "Potassium: "+value;

            if(value != ""){
                if (value < hlpKmin || value > hlpKmax) {
                    findings.splice(11, 1, valueWithFindings11);

                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                findings.splice(11, 1, '');

                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(11, 1, '');

             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#hlpNa').on('input', function() {
            const value = $(this).val();
            const valueWithFindings12 = "Sodium: "+value;

            if(value != ""){
                if (value < hlpNamin || value > hlpNamax) {
                    findings.splice(12, 1, valueWithFindings12);

                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                findings.splice(12, 1, '');

                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(12, 1, '');

             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#FT3').on('input', function() {
            const value = $(this).val();
            const valueWithFindings13 = "FT3: "+value;

            if(value != ""){
                if (value < FT3min || value > FT3max) {
                    findings.splice(13, 1, valueWithFindings13);

                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                findings.splice(13, 1, '');

                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(13, 1, '');

             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#FT4').on('input', function() {
            const value = $(this).val();
            const valueWithFindings14 = "FT4: "+value;

            if(value != ""){
                if (value < FT4min || value > FT4max) {
                    findings.splice(14, 1, valueWithFindings14);

                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                findings.splice(14, 1, '');

                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(14, 1, '');

             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#TSH').on('input', function() {
            const value = $(this).val();
            const valueWithFindings15 = "TSH: "+value;

            if(value != ""){
                if (value < TSHmin || value > TSHmax) {
                    findings.splice(15, 1, valueWithFindings15);

                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                findings.splice(15, 1, '');

                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(15, 1, '');

             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });






        $('#hlpname').change(function() {
            var selectedRfid = $(this).find('option:selected').data('hlprfid');
            $('#hlprfid').val(selectedRfid);
            var selectedSection = $(this).find('option:selected').data('hlpsection');
            $('#hlpsection').val(selectedSection);
            console.log(selectedRfid);
            console.log(selectedSection);
        });
    });

    const editEmployee = document.getElementById('editBloodChem');

    // options with default values
    const editemployees = {

        backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 relative inset-0 z-40',
        closable: true,
        onHide: () => {
            console.log('modal is hidden');
        },
        onShow: () => {
            console.log('modal is shown');
        },
        onToggle: () => {
            console.log('modal has been toggled');
        },
    };

    const modalEdit = new Modal(editEmployee, editemployees);

    function openEditEmployee(element) {
        modalEdit.toggle();
        str = element.getAttribute("data-medications");
        medicine = str.split(',');
        $('#editftwMeds').empty();
        if (medicine != "") {
            function addSelectedValue(value) {
                $('#editftwMeds').append($('<option>', {
                    value: value,
                    text: value,
                    selected: true
                }));
            }
            medicine.forEach(function(value) {
                addSelectedValue(value);
            });
        }
        document.getElementById("editid").value = element.getAttribute("data-id");
        document.getElementById("editrfid").value = element.getAttribute("data-rfid");
        document.getElementById("editname").value = element.getAttribute("data-name");
        document.getElementById("editsection").value = element.getAttribute("data-section");
        document.getElementById("editdate").value = element.getAttribute("data-date");
        document.getElementById("edittime").value = element.getAttribute("data-time");
        document.getElementById("editbuilding_transaction").value = element.getAttribute("data-building");
        document.getElementById("edittype").value = element.getAttribute("data-type");
        document.getElementById("editdiagnosis").value = element.getAttribute("data-diagnosis");
        document.getElementById("editintervention").value = element.getAttribute("data-intervention");
        // document.getElementById("editftwMeds").value = element.getAttribute("data-medications");
        document.getElementById("editfollowupdate").value = element.getAttribute("data-followupdate");
        document.getElementById("editfbs").value = element.getAttribute("data-FBS");
        document.getElementById("editcholesterol").value = element.getAttribute("data-cholesterol");
        document.getElementById("edittriglycerides").value = element.getAttribute("data-triglycerides");
        document.getElementById("edithdl").value = element.getAttribute("data-HDL");
        document.getElementById("editldl").value = element.getAttribute("data-LDL");
        document.getElementById("editbun").value = element.getAttribute("data-BUN");
        document.getElementById("editcreatinine").value = element.getAttribute("data-creatinine");

        document.getElementById("editbua").value = element.getAttribute("data-BUA");
        document.getElementById("editsgpt").value = element.getAttribute("data-SGPT");
        document.getElementById("editsgdt").value = element.getAttribute("data-SGDT");
        document.getElementById("edithbaic").value = element.getAttribute("data-HBA1C");
        document.getElementById("editothers").value = element.getAttribute("data-others");
        document.getElementById("editremarks").value = element.getAttribute("data-remarks");

        document.getElementById("editK").value = element.getAttribute("data-potassium");
        document.getElementById("editNa").value = element.getAttribute("data-sodium");
        document.getElementById("editFT3").value = element.getAttribute("data-FT3");
        document.getElementById("editFT4").value = element.getAttribute("data-FT4");
        document.getElementById("editTSH").value = element.getAttribute("data-TSH");


    }

    document.getElementById("employer").addEventListener("keydown", function(event) {
        event.preventDefault(); // Prevent typing into the input field
    });

    const importBloodChem = document.getElementById('importBloodChem');

    // options with default values
    const importBloodChems = {

        backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 relative inset-0 z-40',
        closable: true,
        onHide: () => {
            console.log('modal is hidden');
        },
        onShow: () => {
            console.log('modal is shown');
        },
        onToggle: () => {
            console.log('modal has been toggled');
        },
    };

    const modalImport = new Modal(importBloodChem, importBloodChems);

    function openImportModal(element) {
        modalImport.toggle();

    };



    const addBloodChemModal = document.getElementById('addBloodChemModal');

    // options with default values
    const addBloodChems = {

        backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 relative inset-0 z-40',
        closable: true,
        onHide: () => {
            console.log('modal is hidden');
        },
        onShow: () => {
            console.log('modal is shown');
        },
        onToggle: () => {
            console.log('modal has been toggled');
        },
    };

    const modalAdd = new Modal(addBloodChemModal, addBloodChems);

    function openAddModal(element) {
        modalAdd.toggle();

    };

    function exportTemplate() {

        var rows = [];

        column1 = 'Date';
        column2 = 'Time';
        column3 = 'Building Transaction';
        column4 = 'ID Number';
        column5 = 'Type';
        column6 = 'Diagnosis';
        column7 = 'Intervention';
        column8 = 'Medications';
        column9 = 'Follow Up Date';
        column10 = 'FBS';
        column11 = 'Cholesterol';
        column12 = 'Triglycerides';
        column13 = 'HDL';
        column14 = 'LDL';
        column15 = 'BUN';
        column16 = 'BUA';
        column17 = 'SGPT';
        column18 = 'SGDT';
        column19 = 'HBA1C';
        column20 = 'Others';
        column21 = 'Remarks';

        rows.push(
            [
                column1,
                column2,
                column3,
                column4,
                column5,
                column6,
                column7,
                column8,
                column9,
                column10,
                column11,
                column12,
                column13,
                column14,
                column15,
                column16,
                column17,
                column18,
                column19,
                column20,
                column21,
            ]
        );

        for (var i = 0, row; i < 1; i++) {
            column1 = '';
            column2 = '';
            column3 = '';
            column4 = "";
            column5 = '';
            column6 = '';
            column7 = '';
            column8 = '';
            column9 = '';
            column10 = '';
            column11 = '';
            column12 = '';
            column13 = '';
            column14 = '';
            column15 = '';
            column16 = '';
            column17 = '';
            column18 = '';
            column19 = '';
            column20 = '';
            column21 = '';
            rows.push(
                [
                    column1,
                    column2,
                    column3,
                    column4,
                    column5,
                    column6,
                    column7,
                    column8,
                    column9,
                    column10,
                    column11,
                    column12,
                    column13,
                    column14,
                    column15,
                    column16,
                    column17,
                    column18,
                    column19,
                    column20,
                    column21,
                ]
            );

        }
        csvContent = "data:text/csv;charset=utf-8,";
        /* add the column delimiter as comma(,) and each row splitted by new line character (\n) */
        rows.forEach(function(rowArray) {
            row = rowArray.join('","');
            row = '"' + row + '"';
            csvContent += row + "\r\n";
        });

        /* create a hidden <a> DOM node and set its download attribute */
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "<?php echo $employer; ?> HLP Template.csv");
        document.body.appendChild(link);
        /* download the data file named "Stock_Price_Report.csv" */
        link.click();
    }
</script>

</body>

</html>