<?php
session_start();
include ("includes/connect.php");

if(isset( $_SESSION['connected'])){

  header("location: nurses");
  
    }

    if(isset($_POST['login'])){
      $username = $_POST['username'];
      $password = $_POST['password'];

      $sql1 = "Select * FROM `users` WHERE `userName`='$username'";
      $result = mysqli_query($con, $sql1);
      $numrows = mysqli_num_rows($result);

      while($userRow = mysqli_fetch_assoc($result)){
        $userpass = $userRow['password'];
        $level = $userRow['type'];
        if($password == $userpass){
          $_SESSION['userID'] = $userRow['idNumber'];
          $_SESSION['name'] = $userRow['name'];
          $_SESSION['rfid'] = "";
          $_SESSION['department'] = $userRow['department'];
          $_SESSION['lastQue'] = '';

          $_SESSION['ftwDate']="";
          $_SESSION['ftwTime']="";
          $_SESSION['ftwCategories']="";
          $_SESSION['ftwBuilding']="";
          $_SESSION['ftwConfinement']="";
          $_SESSION['ftwMedCategory']="";
          $_SESSION['ftwSLDateFrom']="";
          $_SESSION['ftwSLDateTo']="";
          $_SESSION['ftwDays'] = "";
          $_SESSION['ftwAbsenceReason']="";
          $_SESSION['ftwDiagnosis']="";
          $_SESSION['ftwBloodChem']="";
          $_SESSION['ftwCbc']="";
          $_SESSION['ftwUrinalysis']="";
          $_SESSION['ftwFecalysis']="";
          $_SESSION['ftwXray']="";
          $_SESSION['ftwOthersLab']="";
          $_SESSION['ftwBp']="";
          $_SESSION['ftwTemp']="";
          $_SESSION['ftw02Sat']="";
          $_SESSION['ftwPr']="";
          $_SESSION['ftwRr']="";
          $_SESSION['ftwRemarks']="";
          $_SESSION['ftwOthersRemarks']="";
          $_SESSION['ftwCompleted']="";
          $_SESSION['ftwWithPendingLab']="";
          $_SESSION['immediateEmail']="";
          $_SESSION['immediateHead']="";

          $_SESSION['connected']=true;

          if($level =='nurse'){
            header("location:nurses");
          }
          else if($level =='head'){
            header("location:depthead");
          }
          else if($level =='hr'){
            header("location:hr");
          }
          else if($level =='doctor'){
            header("location:doctor");
          }
        }
      }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>GPI Clinic</title>
<script src="tailwindcss.js"></script>
<script src="src/cdn_tailwindcss.js"></script>

<script src="node_modules/flowbite/dist/flowbite.min.js"></script>
<link rel="stylesheet" href="styles.css">
</head>

<body class="overflow-x-hidden bg-cover bg-no-repeat bg-[url('src/Background2.png')] bg-blend-multiply h-screen">

<section class="static h-full ">
  <nav class="z-20 relative">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="homepageclinic.php" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="src/Logo 1.png" class="h-8" alt="Clinic Logo" />
        <span class="self-center text-2xl font-semibold whitespace-nowrap  text-[#193F9F]">GPI Clinic</span>
    </a>
    <p class="self-center text-2xl font-semibold whitespace-nowrap  text-[#193F9F]">Welcome to GPI Clinic </p>
  </div>
  </nav>


  <div class="absolute top-0 left-[-50px]  animate-spin-slow">
  <img class="opacity-25 h-auto max-w-lg ms-auto" src="src/Logo 2.png" alt="image description">
</div>

  <div class="absolute bottom-0 left-[-50px]">
  <img class=" h-5/6 w-5/6 ms-auto" src="src/Clinic.png" alt="image description">
  </div>

<div class="flex justify-center relative flex-wrap h-full g-6 text-gray-800" style="
    z-index: 100000;">
      <div class="2xl:p-40 w-1/2 md:w-8/12 lg:w-6/12 sm:mb-12 md:mb-0">
        
      </div>
      <div class=" pt-20 px-28 2xl:pt-40 2xl:px-40 w-full md:w-8/12 lg:w-6/12 mb-12 md:mb-0">


        <form method="post" action="login.php">

        <h1 class="text-[#193F9F] text-xl font-bold text-center mb-10 uppercase ">Sign in here</h1>
        <!-- <h1 class="text-gray-400 text-xl font-bold text-center mb-10">Welcome to Helpdesk System</h1> -->

          <!-- password input -->
            <div class="mb-4">
            <input
              type="text"
              name="username"
              autocomplete="off"
              class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              placeholder="User Name"
            />
          </div>

          <!-- Password input -->
          <div class="mb-4">
            <input type="password" name="password" class=" w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="Password">
          </div>



          <!-- Submit button -->
          <button type="submit" name="login" class="mb-2 inline-block px-7 py-3 bg-[#2F5A8D] text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out w-full" data-mdb-ripple="true" data-mdb-ripple-color="light">
            Proceed
          </button>
          <div class="justify-center flex">
          <a href="signup.php" class="text-[#193F9F] m-auto text-xs font-bold text-center mb-10 uppercase ">Not register Yet? <span class="underline">Signup here!</span></a>

          </div>
  
        </form>

      </div>

</div>

</section>



<script src="tailwind.config.js"></script>
</body>
</html>