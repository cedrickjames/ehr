<?php 
include ("../includes/connect.php");




    $rfid = $_POST['rfValue'];
    $dcnsltn = $_POST['dcnsltnValue'];
    $medcertdate = $_POST['medcertdate'];
    $treatedOn = $_POST['treatedOn'];
    $dueTo = $_POST['dueTo'];
    $diagnosis = $_POST['diagnosis'];
    $remarksMed = $_POST['remarksMed'];


    // $computername = $_POST['computername'];
    // echo $computername;

            
    // if($computername!=""){
      
    // $computername = implode(', ', $computername);
    // }


    // $sqlUpdate = "INSERT INTO `diagnosis`(`diagnosisName`) VALUES ('$addedDiagnosis')";
    // $resultsUpdate = mysqli_query($con,$sqlUpdate);


    // $medcertdate = $_POST['medcertdate'];
    // $treatedOn = $_POST['treatedOn'];
    // $dueTo = $_POST['dueTo'];
    // $diagnosis = $_POST['diagnosis'];
    $remarksMed = $_POST['remarksMed'];
  
    $sql = "INSERT INTO `medicalcertificate`(`rfid`, `consultationId`, `date`, `treatedOn`, `dueTo`, `diagnosis`, `remarks`) VALUES ('$rfid','$dcnsltn','$medcertdate','$treatedOn','$dueTo','$diagnosis','$remarksMed')";
    $results = mysqli_query($con,$sql);

    $sql1 = "UPDATE `consultation` SET `havemedCert`='1' WHERE `id` = '$dcnsltn'";
    $results1 = mysqli_query($con,$sql1);
    
    

?>