<?php
session_start();
include ("../includes/connect.php");
$userID = $_SESSION['userID'];


if(isset($_POST['addQue'])){
    $cardNumber = $_POST['cardNumber'];
    $_SESSION['lastQue']=$cardNumber;

// echo $cardNumber;
$checkRFID = "SELECT * FROM `employeespersonalinfo` WHERE `idNumber` = '$cardNumber'";
$resultCheck = mysqli_query($con, $checkRFID);

$num_rows = mysqli_num_rows($resultCheck);
if($num_rows >=1){

    $checkQue = "SELECT * FROM `queing` WHERE `idNumber` = '$cardNumber' and `status` = 'processing'";
$resultCheckQue = mysqli_query($con, $checkQue);
$num_rowsQue = mysqli_num_rows($resultCheckQue);
// echo "asasd", $num_rowsQue;
if($num_rowsQue ==0){
  $currentDate = date('Y-m-d');

    $addQue = "INSERT INTO `queing`(`idNumber`, `status`,`date`) VALUES ('$cardNumber','waiting','$currentDate')";
    $resultInfo = mysqli_query($con, $addQue);

}

   
}
else{
  $checkRFID = "SELECT * FROM `employeespersonalinfo` WHERE `idNumber` = '$cardNumber'";
$resultCheck = mysqli_query($con, $checkRFID);

$num_rows = mysqli_num_rows($resultCheck);
if($num_rows >=1){

    $checkQue = "SELECT * FROM `queing` WHERE `idNumber` = '$cardNumber' and `status` = 'processing'";
$resultCheckQue = mysqli_query($con, $checkQue);
$num_rowsQue = mysqli_num_rows($resultCheckQue);
// echo "asasd", $num_rowsQue;
if($num_rowsQue ==0){
  while($row=mysqli_fetch_assoc($resultCheck)){
    $cardNumber = $row['idNumber'];
    $currentDate = date('Y-m-d');
    $addQue = "INSERT INTO `queing`(`idNumber`, `status`,`date`) VALUES ('$cardNumber','waiting','$currentDate')";
    $resultInfo = mysqli_query($con, $addQue);
  }


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
<script src="../src/cdn_tailwindcss.js"></script>

<script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
<link rel="stylesheet" href="../styles.css">
</head>

<body class="overflow-x-hidden bg-cover bg-no-repeat bg-[url('../src/Background2.png')] bg-blend-multiply h-screen">

<section class="static h-full ">
  <nav class="z-20 relative">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="../nurses" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="../src/Logo 1.png" class="h-8" alt="Clinic Logo" />
        <span class="self-center text-2xl font-semibold whitespace-nowrap  text-[#193F9F]">GPI Clinic</span>
    </a>
    <p class="self-center text-2xl font-semibold whitespace-nowrap  text-[#193F9F]">Welcome to GPI Clinic </p>
  </div>
  </nav>


  <div class="absolute top-0 right-[-50px] animate-spin-slow">
  <img class="opacity-25 h-auto max-w-lg ms-auto" src="../src/Logo 2.png" alt="image description">
</div>

  <div class="absolute h-5/6 w-full bottom-0 right-0 ">
  <img class="absolute right-0 h-full bottom-0" src="../src/Clinic3.png" alt="image description">
  </div>

<div class=" flex justify-center relative flex-wrap h-full g-6 text-gray-800" style="
    z-index: 100000;">
  
      <div class=" pt-10 px-28 2xl:pt-40 2xl:px-40 w-full md:w-8/12 lg:w-6/12 mb-12 md:mb-0">

        <form method="post" action="">
            <div class="w-20 h-20 m-auto">

        <img class="w-full h-full" src="../src/tapCard.png" alt="image description">

            </div>

        <h1 class="text-[#193F9F] text-xl font-bold text-center mb-2 uppercase ">Please Tap your ID Card!</h1>
        <!-- <h1 class="text-gray-400 text-xl font-bold text-center mb-10">Welcome to Helpdesk System</h1> -->

          <!-- password input -->
            <div class="mb-4">
            <input
              type="text"
              name="cardNumber"
              id="cardNumber"
              autocomplete="off"
              class="rounded-full focus form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
              placeholder="Tap Here"
            />
            <button class="hidden" type="submit" name="addQue"></button>
        <h1 class="text-[#193F9F] text-sm font-bold text-center mt-2 mb-2 uppercase "><?php 
  // echo $_SESSION['lastQue'];
        if($_SESSION['lastQue']!= ''){
          $cardNumberSession = $_SESSION['lastQue'];
          $sqlCheckQue = "SELECT * from `employeespersonalinfo` WHERE `idNumber` = '$cardNumberSession' OR `idNumber` = '$cardNumberSession';";
  // echo $sqlCheckQue;
          $resultlast = mysqli_query($con,$sqlCheckQue);
          if($resultlast){
            $num_rows1 = mysqli_num_rows($resultlast);
            if($num_rows1 >=1){
                while($row=mysqli_fetch_assoc($resultlast)){
                    ?> You're now added to the que <span class="text-green-900"> <?php
                    echo $row['Name'];
                }
            }
            else{
                ?> <span class="text-red-900"> You are not registered! <?php
            }
          }

        }
        

      
        ?></span> </h1>
        
                <div class="overflow-y-auto m-auto  h-72 w-72">
                <ol class="list-decimal">
                <?php
                        $sql="SELECT 
                        queing.*, 
                        employeespersonalinfo.idNumber, 
                        employeespersonalinfo.*, 
                        COALESCE(users.name, '') AS nurse_assisting_name
                    FROM 
                        queing  
                    INNER JOIN 
                        employeespersonalinfo 
                    ON 
                        employeespersonalinfo.idNumber = queing.idNumber
                    LEFT JOIN
                        users
                    ON
                        queing.nurseAssisting = users.idNumber where queing.status = 'processing' OR queing.status = 'waiting' ORDER BY
    queing.id desc; 
                    ";
        $result = mysqli_query($con,$sql);
        $num_rows = mysqli_num_rows($result);
        while($row=mysqli_fetch_assoc($result)){
?>
  <li class="text-[#193F9F] text-sm font-bold text-center mt-2 mb-2 uppercase "><?php echo $num_rows.'. ',$row['Name']; ?></li>
<?php
$num_rows--;
        }
        ?>
  <!-- ... -->
</ol>
                </div>   
          </div>

    
        </form>

      </div>
      <div class="2xl:p-40 w-1/2 md:w-8/12 lg:w-6/12 sm:mb-12 md:mb-0">
        
        </div>
</div>

</section>



<script src="tailwind.config.js"></script>
<script>

const cardNumber = document.getElementById('cardNumber');

// Focus on the input element
cardNumber.focus();
</script>
</body>
</html>