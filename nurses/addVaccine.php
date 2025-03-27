<?php 
include ("../includes/connect.php");

    $addVaccine = $_POST['addedVaccine'];
    $addVaccine = str_replace("'", "&apos;", $addVaccine);
    $addVaccine = str_replace('"', '&quot;', $addVaccine);
    // $computername = $_POST['computername'];
    // echo $computername;

            
    // if($computername!=""){
      
    // $computername = implode(', ', $computername);
    // }


    $sqlUpdate = "INSERT INTO `vaccine`(`vaccineName`) VALUES ('$addVaccine')";
    $resultsUpdate = mysqli_query($con,$sqlUpdate);

    if ($resultsUpdate) {
        echo "<script>alert('Added succesfully!')</script>";
    } else {
        echo "<script>alert('There's a problem saving to database.')</script>";
    }
?>