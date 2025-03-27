<?php 
include ("../includes/connect.php");




    $idNumber = $_POST['rfValue'];
    $dcnsltn = $_POST['dcnsltnValue'];
    $dcnsltn = str_replace("'", "&apos;", $dcnsltn);
    $dcnsltn = str_replace('"', '&quot;', $dcnsltn);
    
    $medcertdate = $_POST['medcertdate'];

    $treatedOn = $_POST['treatedOn'];
    $treatedOn = str_replace("'", "&apos;", $treatedOn);
    $treatedOn = str_replace('"', '&quot;', $treatedOn);

    $dueTo = $_POST['dueTo'];
    $dueTo = str_replace("'", "&apos;", $dueTo);
    $dueTo = str_replace('"', '&quot;', $dueTo);

    $diagnosis = $_POST['diagnosis'];
    $diagnosis = str_replace("'", "&apos;", $diagnosis);
    $diagnosis = str_replace('"', '&quot;', $diagnosis);

    $remarksMed = $_POST['remarksMed'];
    $remarksMed = str_replace("'", "&apos;", $remarksMed);
    $remarksMed = str_replace('"', '&quot;', $remarksMed);

    

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
  
    $sql = "INSERT INTO `medicalcertificate`(`idNumber`, `consultationId`, `date`, `treatedOn`, `dueTo`, `diagnosis`, `remarks`) VALUES ('$idNumber','$dcnsltn','$medcertdate','$treatedOn','$dueTo','$diagnosis','$remarksMed')";
    $results = mysqli_query($con,$sql);

    $sql1 = "UPDATE `consultation` SET `havemedCert`='1' WHERE `id` = '$dcnsltn'";
    $results1 = mysqli_query($con,$sql1);
    
    

?>