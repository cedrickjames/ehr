<?php 
include ("../includes/connect.php");

    $addedDiagnosis = $_POST['addedDiagnosis'];

    // $computername = $_POST['computername'];
    // echo $computername;

            
    // if($computername!=""){
      
    // $computername = implode(', ', $computername);
    // }


    $sqlUpdate = "INSERT INTO `diagnosis`(`diagnosisName`) VALUES ('$addedDiagnosis')";
    $resultsUpdate = mysqli_query($con,$sqlUpdate);


?>