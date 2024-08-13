<?php
session_start();
include ("includes/connect.php");

// if(isset( $_SESSION['connected'])){

//   header("location: nurses");
  
//     }

    if (isset($_POST['register'])) {
      $idnumber = $_POST['idnumber'];
      $name = $_POST['name'];
      $email = $_POST['email'];
      $userDepartment = $_POST['userDepartment'];
      $userType = $_POST['userType'];
      $password = $_POST['password'];
      $password = password_hash($password, PASSWORD_DEFAULT);
      $userName = strpos($name, " ");
      $userName = substr($name, 0, $userName);

      $sql = "INSERT INTO `users`(`idNumber`, `name`, `userName`, `password`, `type`, `department`,`email`, `status`) VALUES ('$idnumber','$name','$userName','$password','$userType','$userDepartment', '$email', 0)";
      $results = mysqli_query($con, $sql);

      if ($result)
      {
        
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


        <form method="post" action="signup.php">

        <h1 class="text-[#193F9F] text-xl font-bold text-center mb-10 uppercase ">Sign up here</h1>
        <!-- <h1 class="text-gray-400 text-xl font-bold text-center mb-10">Welcome to Helpdesk System</h1> -->

          <!-- Id Number -->
            <div class="mb-4">
            <input
              type="text"
              name="idnumber"
              autocomplete="off"
              class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              placeholder="Employee Number"
            />
          </div>
            <!-- Name -->
            <div class="mb-4">
            <input
              type="text"
              name="name"
              autocomplete="off"
              class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              placeholder="Name"
            />
          </div>
        <!-- Email -->
          <div class="mb-4">
            <input
              type="text"
              name="email"
              autocomplete="off"
              class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              placeholder="Email"
            />
          </div>
          <!-- User Type -->
            <div class="mb-4">
            <select id="userType" name="userType" class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                <option value="" disabled selected>User Type</option>
                <option value="doctor">Doctor</option>
                <option value="head">Head</option>
                <option value="nurse">Nurse</option>
                <option value="hr">HR</option>
              </select>
            </div>
    <!-- Department -->
     <div class="mb-4">            
      <select id="userDepartment" name="userDepartment" class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
      <option value="" disabled selected>Department</option>
        <?php
        $sql = "SELECT DISTINCT TRIM(department) AS department FROM users";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
        ?> <option value="<?php echo $row['department']; ?>"><?php echo $row['department']; ?></option> <?php } ?>
        </select>
      </div>

          <!-- Password input -->
          <div class="mb-4">
            <input type="password" name="password" class=" w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="Password">
          </div>
          <!-- <div class="mb-4">
            <input type="password" name="password" class=" w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="Password">
          </div> -->


          <!-- Submit button -->
          <button type="submit" name="register" class="mb-2 inline-block px-7 py-3 bg-[#2F5A8D] text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out w-full" data-mdb-ripple="true" data-mdb-ripple-color="light">
            Register
          </button>
          <div class="justify-center flex">
          <a href="login.php" class="text-[#193F9F] m-auto text-xs font-bold text-center mb-10 uppercase ">Already have an account? <span class="underline">Sign in here!</span></a>

          </div>
  
        </form>

      </div>

</div>

</section>



<script src="tailwind.config.js"></script>
</body>
</html>