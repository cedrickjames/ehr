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
</body>

</html>