<?php 
include ("../includes/connect.php");

    $addedDiagnosis = $_POST['addedDiagnosis'];
    $addedDiagnosis = str_replace("'", "&apos;", $addedDiagnosis);
    $addedDiagnosis = str_replace('"', '&quot;', $addedDiagnosis);
    // $computername = $_POST['computername'];
    // echo $computername;

            
    // if($computername!=""){
      
    // $computername = implode(', ', $computername);
    // }


    $sqlUpdate = "INSERT INTO `diagnosis`(`diagnosisName`) VALUES ('$addedDiagnosis')";
    $resultsUpdate = mysqli_query($con,$sqlUpdate);


    if ($resultsUpdate) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => mysqli_error($con)]);
    }

    // if ($resultsUpdate) {
    //     echo $resultsUpdate;
    // } else {
    //     echo "<script>alert('There's a problem saving to database.')</script>";
    // }
?>