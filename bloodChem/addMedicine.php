<?php 
include ("../includes/connect.php");

    $addedMedicine = $_POST['addedMedicine'];
    $addedMedicine = str_replace("'", "&apos;", $addedMedicine);
    $addedMedicine = str_replace('"', '&quot;', $addedMedicine);
    // $computername = $_POST['computername'];
    // echo $computername;

            
    // if($computername!=""){
      
    // $computername = implode(', ', $computername);
    // }


    $sqlUpdate = "INSERT INTO `medicine`(`medicineName`) VALUES ('$addedMedicine')";
    $resultsUpdate = mysqli_query($con,$sqlUpdate);

    if ($resultsUpdate) {
        echo "<script>alert('Added succesfully!')</script>";
    } else {
        echo "<script>alert('There's a problem saving to database.')</script>";
    }
?>