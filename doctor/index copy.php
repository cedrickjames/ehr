<?php 
session_start();

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

<link rel="stylesheet" type="text/css" href="../node_modules/DataTables/Responsive-2.3.0/css/responsive.dataTables.min.css"/>

</head>
<body  class="bg-no-repeat bg-cover bg-[url('../src/Background.png')]">
<?php require_once 'navbar.php';?>

<div style= " background: linear-gradient(-45deg, #a6d0ff, rgba(255, 255, 255, 0.63), rgba(255, 255, 255, 0));"class=" m-auto  flex   left-10 right-5  flex-col  px-2   pt-2 2xl:pt-6 pb-14 z-50 ">
  <div class="m-2">

  <?php require_once '../que/docQueTable.php';?>
      

    
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

// Check if browser supports notifications
// Check if browser supports notifications
// alert("Notification" in window)
if ("Notification" in window) {
    // Request permission
    Notification.requestPermission().then(permission => {
        if (permission === "granted") {
            let notification = new Notification("Hello!", {
                body: "This is your notification message.",
                icon: "http://192.168.5.214/emr/src/Logo 2.png",
                data: {
                    url: "https://192.168.5.214/emr/doctor/index.php"
                }
            });

            // Add click event listener
            notification.onclick = function(event) {
                event.preventDefault(); // Prevent default behavior
                window.open(notification.data.url, "_blank"); // Open URL in a new tab
            };
        }
    });
} else {
    console.log("This browser does not support notifications.");
}






function updateUpcomingConsultation(){
  var upcomingConsultation = new XMLHttpRequest();
    upcomingConsultation.open("POST", "updateUpcomingConsultation.php", true);
    upcomingConsultation.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    upcomingConsultation.onreadystatechange = function() {
      if (upcomingConsultation.readyState === XMLHttpRequest.DONE) {
        if (upcomingConsultation.status === 200) {
          
          location.href='index.php';
          // Update was successful
          // console.log(upcomingConsultation);
          // alert("Medcert Generated")



        } else {
          console.log("Error: " + upcomingConsultation.status);
        }
      }
    };

    upcomingConsultation.send();
}
function checkUpcomingConsultation() {
    var upcomingConsultation = new XMLHttpRequest();
    upcomingConsultation.open("POST", "upcomingConsultation.php", true);
    upcomingConsultation.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    upcomingConsultation.onreadystatechange = function() {
        if (upcomingConsultation.readyState === XMLHttpRequest.DONE) {
            if (upcomingConsultation.status === 200) {
                let count = parseInt(upcomingConsultation.responseText);
                if (count >= 1) {
                    if ("Notification" in window) {
                        Notification.requestPermission().then(permission => {
                            if (permission === "granted") {
                                new Notification("New Consultation", {
                                    body: "You have " + count + " new consultation(s).",
                                    icon: "http://192.168.5.214/src/Logo 2.png"
                                });
                                notification.onclick = function() {
                              window.open("http://192.168.5.214/emr/doctor/index.php", "_blank"); // Opens in a new tab
                          };

                                // Ensure alert still shows, regardless of notification status
                                setTimeout(() => {
                                    alert("You have " + count + " new consultation(s).");
                                }, 5000);
                            // updateUpcomingConsultation(); // Ensure this function is defined

                                
                            } else {
                                // Permission denied, fallback to alert
                                alert("You have " + count + " new consultation(s).");

                            }
                        });
                    } else {
                        console.log("This browser does not support notifications.");
                        alert("You have " + count + " new consultation(s).");
                    }
                    
                    updateUpcomingConsultation();
                }
            } else {
                console.log("Error: " + upcomingConsultation.status);
            }
        }
    };

    upcomingConsultation.send();
}

// Run the function every 5 seconds
setInterval(checkUpcomingConsultation, 5000);


    // console.log("abnkkbsnplako")




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


var screenWidth = window.screen.width;   // Screen width in pixels
var screenHeight = window.screen.height; // Screen height in pixels

console.log("Screen width: " + screenWidth);
console.log("Screen height: " + screenHeight);
var sidebar=0;
    


function shows(){
    if(show){
        drawer.hide();
        show = false;
    }
    else{
        drawer.show();
        show = true;
    }
    // var sidebar=0;
    if(sidebar==0){
    document.getElementById("mainContent").style.width="100%";  
    document.getElementById("mainContent").style.marginLeft= "0px"; 
    // document.getElementById("sidebar").style.opacity= ""; 
    // document.getElementById("sidebar").style.transition = "all .1s";
    
    document.getElementById("mainContent").style.transition = "all .3s";
    
    
    
    
    
    
    sidebar=1;
    }
    else{
      document.getElementById("mainContent").style.width="calc(100% - 288px)";  
    document.getElementById("mainContent").style.marginLeft= "288px";  
    
    sidebar=0;
    }
    

}

if (screenWidth <= 1132){
    shows();

}
else{
drawer.show();
// sidebar=0;/
    
}





</script>
</body>
</html>