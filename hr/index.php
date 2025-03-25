<?php 
session_start();
include ("../includes/connect.php");
if(!isset($_SESSION['connected'])){
  header("location: ../logout.php");
}
include ("../includes/connect.php");
?>


<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="../src/cdn_tailwindcss.js"></script>
  <script src="index.js"></script>

  <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
  
  <link rel="stylesheet" href="../fontawesome-free-6.2.0-web/css/all.min.css">
  <link rel="stylesheet" href="../node_modules/DataTables/datatables.min.css">

<link rel="stylesheet" type="text/css" href="../node_modules/DataTables/Responsive-2.3.0/css/responsive.dataTables.min.css"/>

</head>
<body  class="bg-no-repeat bg-cover bg-[url('../src/Background.png')]">
<?php require_once 'navbar.php';?>

<div style= " background: linear-gradient(-45deg, #a6d0ff, rgba(255, 255, 255, 0.63), rgba(255, 255, 255, 0));"class=" m-auto ml-56 2xl:ml-80 flex   left-10 right-5  flex-col  px-2   pt-2 2xl:pt-6 pb-14 z-50 ">
  <div class="m-2">

  <?php require_once 'hrtable.php';?>
      

    
  </div>

</div>

<script src="../node_modules/jquery/dist/jquery.min.js"></script>

<script type="text/javascript" src="../node_modules/DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="../node_modules/DataTables/Responsive-2.3.0/js/dataTables.responsive.min.js"></script>
    

    <script type="text/javascript" src="index.js"></script>
<script>
    
$("#sidehome").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");
$("#sidehistory").removeClass("bg-gray-200");
$("#sideMyRequest").removeClass("bg-gray-200");
$("#sidepms").removeClass("bg-gray-200");

$("#sidehome1").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");
$("#sidehistory1").removeClass("bg-gray-200");
$("#sideMyRequest1").removeClass("bg-gray-200");
$("#sidepms1").removeClass("bg-gray-200");
$(".homeIcon").attr("fill", "#FFFFFF"); 
// $(".homeIcon").attr("fill", "#4d4d4d"); 




function activateDeactivate(element){
    if(element.getAttribute("data-activate")== "1"){
      $("#deactivateUser").addClass("hidden");
      $("#separationDate").addClass("hidden");
      $("#activateUser").removeClass("hidden");
    }
    else{
      $("#activateUser").addClass("hidden");
      $("#separationDate").removeClass("hidden");
      $("#deactivateUser").removeClass("hidden");
    }
  document.getElementById("idOfUser").value = element.getAttribute("data-id");
    $('#nameofUser').text(element.getAttribute("data-name"));

    if(element.getAttribute("data-activate") == '1'){

    $('#activateDeactivateText').text("activate");

    }
    else{
    $('#activateDeactivateText').text("deactivate");

    }


  modaldeactivate.toggle();
}
  
const $targetDeactivateUser = document.getElementById('activateDeactivate');
  const deactivateModal = {
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
  const modaldeactivate = new Modal($targetDeactivateUser, deactivateModal);

  

</script>
</body>
</html>