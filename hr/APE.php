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
  <script src="../src/cdn_tailwindcss.js"></script>

  <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>

  <link rel="stylesheet" href="../fontawesome-free-6.2.0-web/css/all.min.css">
  <link rel="stylesheet" href="../node_modules/DataTables/datatables.min.css">
  <link href="../node_modules/select2/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="../node_modules/DataTables/Responsive-2.3.0/css/responsive.dataTables.min.css" />
  <link rel="stylesheet" type="text/css" href="../styles.css" />
</head>

<body class="h-screen bg-no-repeat bg-cover bg-[url('../src/Background.png')]">
  <?php require_once 'navbar.php'; ?>

  <div style=" background: linear-gradient(-45deg, #a6d0ff, rgba(255, 255, 255, 0.63), rgba(255, 255, 255, 0));" class="h-full ml-56 2xl:ml-[22rem] flex   left-10 right-5  flex-col  px-2   pt-2 2xl:pt-6 pb-14 z-50 ">
    <div class="m-2">

      <?php require_once 'directEmployeesAPE.php'; ?>



    </div>

  </div>

  <script src="../node_modules/jquery/dist/jquery.min.js"></script>
  <script src="../node_modules/select2/dist/js/select2.min.js"></script>
  <script type="text/javascript" src="../node_modules/DataTables/datatables.min.js"></script>
  <script type="text/javascript" src="../node_modules/DataTables/Responsive-2.3.0/js/dataTables.responsive.min.js"></script>


  <script type="text/javascript" src="index.js"></script>
  <script>

    
$(".js-employees").select2({
      tags: true
    });

    $("#annualpeside").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");
    <?php
    $sidebar1;

    if($employer=="GPI"){
      $sidebar1 ="#gpiside_";
    }
    else if($employer=="Maxim"){
      $sidebar1 ="#maximside_";

    }
    else if($employer=="Nippi"){
      $sidebar1 ="#nippiside_";

    }
    else if($employer=="Powerlane"){
      $sidebar1 ="#powerlaneside_";

    }
       else if($employer=="Natcorp"){
      $sidebar1 ="#natcorpside_";

    }
    else if($employer=="Otrelo"){
      $sidebar1 ="#otreloside_";

    }
    else if($employer=="Alarm"){
      $sidebar1 ="#alarmside_";

    }
    else if($employer=="Mangreat"){
      $sidebar1 ="#mangreatside_";

    }
    else if($employer=="Canteen"){
      $sidebar1 ="#canteenside_";

    }
    ?>

    $("<?php echo $sidebar1; ?>").addClass("bg-[#82c7cc]");


    $("#sidehistory").removeClass("bg-gray-200");
    $("#sideMyRequest").removeClass("bg-gray-200");
    $("#sidepms").removeClass("bg-gray-200");

    $("#preempside1").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");
    $("#sidehistory1").removeClass("bg-gray-200");
    $("#sideMyRequest1").removeClass("bg-gray-200");
    $("#sidepms1").removeClass("bg-gray-200");
    $(".preempIcon").attr("fill", "#4d4d4d");
    $(".homeIcon").attr("fill", "#4d4d4d");
    $(".empIcon").attr("fill", "#4d4d4d");
    $(".annualpeside").attr("fill", "#FFFFFF");






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




    $(document).ready(function() {
  var confirmationdate = document.getElementById('confirmationdate');

  $("#status").change(function() {
    if ($(this).val() == "complied") {
      $("#compliancediv").removeClass("hidden");
      confirmationdate.required = true;
    }else{
      $("#compliancediv").addClass("hidden");
      confirmationdate.removeAttribute('required');

    }


    });

    if ($("#status").val() == "complied") {
      $("#compliancediv").removeClass("hidden");
      confirmationdate.required = true;
    }else{
      $("#compliancediv").addClass("hidden");
      confirmationdate.removeAttribute('required');

    }



    var editconfirmationdate = document.getElementById('editConfirmationdate');

$("#editStatus").change(function() {
  if ($(this).val() == "complied") {
    $("#editComplianceDiv").removeClass("hidden");
    editconfirmationdate.required = true;
  }else{
    $("#editComplianceDiv").addClass("hidden");
    editconfirmationdate.removeAttribute('required');

  }


  });
  
 


});

  </script>
</body>

</html>