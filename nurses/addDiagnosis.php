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

    if ($resultsUpdate) {
        echo "<script>alert('Added succesfully!')</script>";
    } else {
        echo "<script>alert('There's a problem saving to database.')</script>";
    }
?>