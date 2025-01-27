<?php 
session_start();

include ("../includes/connect.php");
if(!isset($_SESSION['connected'])){
  header("location: ../logout.php");
}

$userID = $_SESSION['userID'];


if (isset($_POST['registerUser'])) {
  $idnumber = $_POST['userEmployeeId'];
  $name = $_POST['userFullName'];
  $email = $_POST['userEmail'];
  $userDepartment = $_POST['userDepartment'];
  $userType = $_POST['userType'];
  $password = '12345'; // default password
  // $password = password_hash($password, PASSWORD_DEFAULT);
  $password = password_hash($idnumber, PASSWORD_DEFAULT);

  $userName = strpos($name, " ");
  $userName = substr($name, 0, $userName);
  $userName = strtolower($userName);
  $company = $_POST['company'];

  //change default udername and password to employee id

  $sql = "INSERT INTO `users`(`idNumber`, `name`, `userName`, `password`, `type`, `department`,`company`,`email`, `status`) VALUES ('$idnumber','$name','$idnumber','$password','$userType','$userDepartment','$company', '$email', 1)";
  $results = mysqli_query($con, $sql);

  if ($results) {
    echo "<script>alert('Registration successful.');</script>";
  } else {
    echo "<script>alert('There is a problem with registration. Please contact your administrator.');</script>";
  }
}

if(isset($_POST['deactivateUser'])){
  $id = $_POST['idOfUser'];
  $sql = "UPDATE `users` SET `status` = 0 WHERE `id` = '$id'";
  $results = mysqli_query($con, $sql);
 
  if ($results) {
    echo "<script>alert('Deactivation successful.');</script>";
  } else {
    echo "<script>alert('There is a problem with deactivation. Please contact your administrator.');</script>";
  }
}
if(isset($_POST['activateUser'])){
  $id = $_POST['idOfUser'];
  $sql = "UPDATE `users` SET `status` = 1 WHERE `id` = '$id'";
  $results = mysqli_query($con, $sql);
 
  if ($results) {
    echo "<script>alert('Account activated');</script>";
  } else {
    echo "<script>alert('There is a problem with deactivation. Please contact your administrator.');</script>";
  }
}



if (isset($_POST['updateUser'])) {
  $id = $_POST['sqlid'];
  $idnumber = $_POST['userEmployeeId'];

  $name = $_POST['userFullName'];
  $email = $_POST['userEmail'];
  $userDepartment = $_POST['userDepartment'];
  $userType = $_POST['userType'];

  $company = $_POST['company'];

  //change default udername and password to employee id

  $sql = "UPDATE `users` SET `idNumber`='$idnumber',`name`='$name',`type`='$userType',`department`='$userDepartment',`company`='$company',`email`='$email' WHERE `id` = '$id'";
  $results = mysqli_query($con, $sql);

  if ($results) {
    echo "<script>alert('Update successful.');</script>";
  } else {
    echo "<script>alert('There is a problem with updating the use. Please contact your administrator.');</script>";
  }
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
<link rel="stylesheet" type="text/css" href="../node_modules/DataTables/Responsive-2.3.0/css/responsive.dataTables.min.css"/>
</head>
<body  class="h-screen bg-no-repeat bg-cover bg-[url('../src/Background.png')]">
<?php require_once 'navbar.php';?>

<div style= " background: linear-gradient(-45deg, #05458cba, rgba(255, 255, 255, 0.63), rgba(255, 255, 255, 0));"class="h-full ml-56 2xl:ml-80 flex   left-10 right-5  flex-col  px-2   pt-2 2xl:pt-6 pb-14 z-50 ">
  <div class="m-4 ">

  <div class="text-[9px] 2xl:text-lg mb-5">
  <div class="flex justify-between">
        <p class="mb-2 my-auto"><span class=" self-center text-md font-semibold whitespace-nowrap   text-[#193F9F]">Users Management</span></p>
       
        <button type="button" onclick="addUser()" class="lg:block text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-[8px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2 mx-3 md:mx-2">Add User</button>
    </div>
        <div id="" class="">
        <div class=" p-4 rounded-lg  bg-gray-50 " id="headApproval" role="tabpanel"
            aria-labelledby="profile-tab">
            <form action="index.php" method = "post">
            <section class="mt-2 2xl:mt-10">
                <table id="usersTable" class="display text-[9px] 2xl:text-sm" style="width:100%">
                <thead>
                        <tr>
                            <th >No.</th>
                            <th >Name</th>
                            <th >ID Number</th>
                            <th >User Type</th>
                            <th >Company</th>
                            <th >Action</th>

                           
                            
                            <!-- <th>Days Late</th> -->
                            <!-- <th>Assigned to</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $queNo = 1;
                        $sql="SELECT * from users;";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_assoc($result)){
          
                ?> <tr> 
                    <td> <?php echo $queNo;?> </td>
                    <td> <?php echo $row['name']?> </td>
                    <td> <?php echo $row['idNumber'];?> </td>
                    <td><?php echo $row['type'];?> </td>
                    <td><?php echo $row['company'];?> </td>
                    
                    <td> <button type="button" onclick="editUser(this);" data-id="<?php echo $row['id'];?>" data-idnumber="<?php echo $row['idNumber'];?>" data-name="<?php echo $row['name'];?>"  data-type="<?php echo $row['type'];?>" data-department="<?php echo $row['department'];?>" data-company="<?php echo $row['company'];?>" data-email="<?php echo $row['email']?>"  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-[8px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2 mx-3 md:mx-2">Edit</button> 
                    <?php if($row['status']){
                      ?> <button type="button" onclick="activateDeactivate(this)" data-activate="0" data-id="<?php echo $row['id'];?>" data-name="<?php echo $row['name'];?>" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-[8px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2 mx-3 md:mx-2">Deactivate</button> <?php
                    }else{
                      ?>
                      <button type="button" onclick="activateDeactivate(this)" data-activate="1" data-id="<?php echo $row['id'];?>" data-name="<?php echo $row['name'];?>" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-[8px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2 mx-3 md:mx-2">Activate</button>  <?php
                    } ?>
                    </td>
                </tr> <?php

                $queNo++;
        }
                        ?>

                    </tbody>
                    </table>
                    </section>
                    </form>
                    </div>
                    </div>

        </div>
      
 
    
  </div>

</div>




<div id="registerModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative w-full max-w-xl max-h-full">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700" >
      <button type="button" data-modal-toggle="registerModal" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close modal</span>
      </button>
      <div class="px-6 py-6 lg:px-8">
        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Register</h3>
        <form class="space-y-6" action="" method="POST">
          <div class="grid grid-cols-2 gap-2">
            <div class="col-span-1">
              <input type="text" name="sqlid" class="hidden" id="sqlid" 
              2>
              <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Employee ID</label>
              <input type="text" name="userEmployeeId" id="userEmployeeId" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
            </div>
            <div class="col-span-1">

              <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
              <input type="text" name="userFullName" id="fullName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
            </div>
            <div class="col-span-1">
              <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User Name</label>
              <input type="text" readonly disabled id="username" class=" cursor-not-allowed bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
            </div>
            <div class="col-span-1">

              <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Default Password</label>
              <input type="text" readonly disabled id="defaultpassword" class="cursor-not-allowed bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
            </div>
            <div class="col-span-1">
              <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
              <input type="email" name="userEmail" id="userEmail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
            </div>
            <div>
            <label for="userDepartment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>

            <select id="userDepartment" name="userDepartment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

              <?php

              $sql = "SELECT DISTINCT TRIM(department) AS department FROM users;";
              $result = mysqli_query($con, $sql);

              while ($row = mysqli_fetch_assoc($result)) {
              ?> <option value="<?php echo $row['department']; ?>"><?php echo $row['department']; ?></option> <?php
                                                                                                            }

                                                                                                              ?>
            </select>
            </div>
            <div>
            <label for="month" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company</label>

<select id="company" name="company" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
  <option selected value="GPI">GPI</option>
  <option value="Maxim">Maxim</option>
  <option value="Nippi">Nippi</option>
  <option value="Powerlane">Powerlane</option>



</select>
            </div>

<div>

<label for="month" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User Type</label>

            <select id="userType" name="userType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
              <option selected value="nurse">Nurse</option>
              <option value="head">Department Head</option>
              <option value="hr">HR</option>
              <option value="coordinator">Coordinator</option>
              <option value="doctor">Doctor</option>



            </select>
</div>
   
            

          </div>


          <button type="submit"  id="registerUser"  name="registerUser" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Register
          </button>
          <button type="submit" name="updateUser" id="updateUser" class="hidden w-full text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Update
          </button>
        </form>
      </div>
    </div>
  </div>
</div>



<div id="activateDeactivate" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="activateDeactivate">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <form action="" method="POST">
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to <span id="activateDeactivate"> <span id="nameofUser" class="font-bold"> </span>?</h3>
                <input type="text" id="idOfUser" name="idOfUser" class="hidden">
                <button  type="submit" name="deactivateUser" id="deactivateUser" class="hidden text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                </button>
                <button  type="submit" name="activateUser" id="activateUser" class="hidden text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                </button>
                <button data-modal-hide="activateDeactivate" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                </form>
              
            </div>
        </div>
    </div>
</div>




<script src="../node_modules/jquery/dist/jquery.min.js"></script>

<script type="text/javascript" src="../node_modules/DataTables/datatables.min.js"></script>
    <script type="text/javascript" src="../node_modules/DataTables/Responsive-2.3.0/js/dataTables.responsive.min.js"></script>
    
    <script src="../node_modules/select2/dist/js/select2.min.js"></script>
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



$('#userEmployeeId').on('input', function () {
  // console.log("asd");
  const inputVal = $(this).val(); // Get the value from the first input
      $('#username').val(inputVal); // Set the value in the "username" input
      $('#defaultpassword').val(inputVal); // Set the value in the "defaultpassword" input

})


const $targetAddUserModal = document.getElementById('registerModal');
  const registerModal = {
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
  const modalRegister = new Modal($targetAddUserModal, registerModal);



  function activateDeactivate(element){
    if(element.getAttribute("data-activate")== "1"){
      $("#deactivateUser").addClass("hidden");
      $("#activateUser").removeClass("hidden");
    }
    else{
      $("#activateUser").addClass("hidden");
      $("#deactivateUser").removeClass("hidden");
    }
  document.getElementById("idOfUser").value = element.getAttribute("data-id");
    $('#nameofUser').text(element.getAttribute("data-name"));
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


function editUser(element){
  document.getElementById("fullName").value = element.getAttribute("data-name");
  document.getElementById("userEmployeeId").value = element.getAttribute("data-idnumber");
  document.getElementById("userEmail").value = element.getAttribute("data-email");
  document.getElementById("sqlid").value = element.getAttribute("data-id");
  
  $('#userDepartment').val( element.getAttribute("data-department"));
  $('#company').val( element.getAttribute("data-company"));
  $('#userType').val( element.getAttribute("data-type"));


  $("#updateUser").removeClass("hidden");
  $("#registerUser").addClass("hidden");


  modalRegister.toggle();

}
function addUser(){
  document.getElementById("fullName").value = "";
  document.getElementById("userEmployeeId").value = "";
  document.getElementById("userEmail").value = "";
  document.getElementById("sqlid").value = "";

  $("#registerUser").removeClass("hidden");
  $("#updateUser").addClass("hidden");
  modalRegister.toggle();

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