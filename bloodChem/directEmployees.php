<?php

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


$nurseId = $_SESSION['userID'];



if (isset($_GET['employer'])) {
    $employer = $_GET['employer'];
  } else {
    $employer = "not found";
  }


if (isset($_POST['excelReport'])) {
    $_SESSION['month'] = $_POST['month'];
    $_SESSION['year'] = $_POST['year'];
    $_SESSION['employer'] = $_POST['employer'];
?>
    <script type="text/javascript">
        window.open('../bloodchem_xls.php?month=<?php echo $_SESSION['month']; ?>&year=<?php echo $_SESSION['year']; ?>&employer=<?php echo $_SESSION['employer']; ?>', '_blank');
        location.href = 'index.php';
    </script>
<?php
}

if (isset($_POST['addBloodChem'])) {
    $idNumber = $_POST['hlprfid'];
    $date = $_POST['hlpdate'];
    $time = $_POST['hlptime'];
    $building = $_POST['hlpbuilding_transaction'];
    $type = $_POST['hlptype'];


    if (isset($_POST['hlpdiagnosis']) && !empty($_POST['hlpdiagnosis'])) {
    $diagnosis = $_POST['hlpdiagnosis'];
    $diagnosis = str_replace("'", "&apos;", $diagnosis);
    $diagnosis = str_replace('"', '&quot;', $diagnosis);
    }
    else{

    $diagnosis = "";

    }
      

    if (isset($_POST['hlpintervention']) && !empty($_POST['hlpintervention'])) {
    $intervention = $_POST['hlpintervention'];

    }
    else{

    $intervention = "";

    }

    if (isset($_POST['hlpftwMeds']) && !empty($_POST['hlpftwMeds'])) {
    $Meds = $_POST['hlpftwMeds'];
    $Meds = implode(', ', $Meds);
    $Meds = str_replace("'", "&apos;", $Meds);
    $Meds = str_replace('"', '&quot;', $Meds);
    }
    else{

    $Meds = "";

    }

    
    $followupdate = $_POST['hlpfollowupdate'];
    $fbs = $_POST['hlpfbs'];
    $cholesterol = $_POST['hlpcholesterol'];
    $triglycerides = $_POST['hlptriglycerides'];
    $hdl = $_POST['hlphdl'];
    $ldl = $_POST['hlpldl'];
    $bun = $_POST['hlpbun'];
    $hlpcreatinine = $_POST['hlpcreatinine'];

    $bua = $_POST['hlpbua'];
    $sgpt = $_POST['hlpsgpt'];
    $sgdt = $_POST['hlpsgdt'];
    $hbaic = $_POST['hlphbaic'];
    $hlpK = $_POST['hlpK'];
    $hlpNa = $_POST['hlpNa'];
    $FT3 = $_POST['FT3'];
    $FT4 = $_POST['FT4'];
    $TSH = $_POST['TSH'];

    $others = $_POST['hlpothers'];
    $remarks = $_POST['hlpremarks'];




    if ($Meds != "") {

        $Meds = implode(', ', $Meds);
    }

    $addBloodChem = "INSERT INTO `bloodchem`(`idNumber`, `date`, `time` ,`building`, `type`, `diagnosis`, `intervention`, `medications`, `followupdate`, `FBS`, `cholesterol`, `triglycerides`, `HDL`, `LDL`, `BUN`, `creatinine`, `BUA`, `SGPT`, `SGDT`, `HBA1C`, `potassium`, `sodium`, `FT3`, `FT4`, `TSH`, `others` ,`remarks`) VALUES ('$idNumber','$date','$time','$building','$type','$diagnosis','$intervention','$Meds','$followupdate','$fbs','$cholesterol','$triglycerides', '$hdl', '$ldl', '$bun','$hlpcreatinine', '$bua', '$sgpt', '$sgdt', '$hbaic', '$hlpK', '$hlpNa', '$FT3', '$FT4', '$TSH', '$others', '$remarks')";
    $resultInfo = mysqli_query($con, $addBloodChem);

    if ($resultInfo) {
        echo "<script>alert('Added Successfuly!') </script>";
        echo "<script> location.href='index.php?employer=$employer'; </script>";
    }
}




if (isset($_POST['proceedToConsultation'])) {


    $idNumber = $_POST['hlprfid'];
    $date = $_POST['hlpdate'];
    $time = $_POST['hlptime'];
    $building = $_POST['hlpbuilding_transaction'];
    $type = $_POST['hlptype'];


    if (isset($_POST['hlpdiagnosis']) && !empty($_POST['hlpdiagnosis'])) {
    $diagnosis = $_POST['hlpdiagnosis'];
    $diagnosis = str_replace("'", "&apos;", $diagnosis);
    $diagnosis = str_replace('"', '&quot;', $diagnosis);
    }
    else{

    $diagnosis = "";

    }
      

    if (isset($_POST['hlpintervention']) && !empty($_POST['hlpintervention'])) {
    $intervention = $_POST['hlpintervention'];

    }
    else{

    $intervention = "";

    }

    if (isset($_POST['hlpftwMeds']) && !empty($_POST['hlpftwMeds'])) {
    $Meds = $_POST['hlpftwMeds'];
    $Meds = implode(', ', $Meds);
    $Meds = str_replace("'", "&apos;", $Meds);
    $Meds = str_replace('"', '&quot;', $Meds);
    }
    else{

    $Meds = "";

    }

    
    $followupdate = $_POST['hlpfollowupdate'];
    $fbs = $_POST['hlpfbs'];
    $cholesterol = $_POST['hlpcholesterol'];
    $triglycerides = $_POST['hlptriglycerides'];
    $hdl = $_POST['hlphdl'];
    $ldl = $_POST['hlpldl'];
    $bun = $_POST['hlpbun'];
    $hlpcreatinine = $_POST['hlpcreatinine'];

    $bua = $_POST['hlpbua'];
    $sgpt = $_POST['hlpsgpt'];
    $sgdt = $_POST['hlpsgdt'];
    $hbaic = $_POST['hlphbaic'];
    $hlpK = $_POST['hlpK'];
    $hlpNa = $_POST['hlpNa'];
    $FT3 = $_POST['FT3'];
    $FT4 = $_POST['FT4'];
    $TSH = $_POST['TSH'];

    $others = $_POST['hlpothers'];
    $remarks = $_POST['hlpremarks'];




    // if ($Meds != "") {

    //     $Meds = implode(', ', $Meds);
    // }

    $addBloodChem = "INSERT INTO `bloodchem`(`idNumber`, `date`, `time` ,`building`, `type`, `diagnosis`, `intervention`, `medications`, `followupdate`, `FBS`, `cholesterol`, `triglycerides`, `HDL`, `LDL`, `BUN`, `creatinine`, `BUA`, `SGPT`, `SGDT`, `HBA1C`, `potassium`, `sodium`, `FT3`, `FT4`, `TSH`, `others` ,`remarks`) VALUES ('$idNumber','$date','$time','$building','$type','$diagnosis','$intervention','$Meds','$followupdate','$fbs','$cholesterol','$triglycerides', '$hdl', '$ldl', '$bun','$hlpcreatinine', '$bua', '$sgpt', '$sgdt', '$hbaic', '$hlpK', '$hlpNa', '$FT3', '$FT4', '$TSH', '$others', '$remarks')";
    $resultInfo = mysqli_query($con, $addBloodChem);

    // if ($resultInfo) {
    //     echo "<script>alert('Added Successfuly!') </script>";
    //     echo "<script> location.href='index.php?employer=$employer'; </script>";
    // }


    $cnsltnDate = $_POST['hlpdate'];
    $cnsltnTime = $_POST['hlptime'];
    $cnsltnType = $_POST['hlptype'];
  
  
  
    $cnsltnCategories = $_POST['cnsltnCategories'];
    $cnsltnBuilding = $_POST['hlpbuilding_transaction'];
    $cnsltnChiefComplaint = $_POST['cnsltnChiefComplaint'];

    
    if (isset($_POST['hlpdiagnosis']) && !empty($_POST['hlpdiagnosis'])) {
        $cnsltnDiagnosis = $_POST['hlpdiagnosis'];
        $cnsltnDiagnosis = str_replace("'", "&apos;", $cnsltnDiagnosis);
        $cnsltnDiagnosis = str_replace('"', '&quot;', $cnsltnDiagnosis);
        }
        else{
    
        $cnsltnDiagnosis = "";
    
        }



    if (isset($_POST['hlpintervention']) && !empty($_POST['hlpintervention'])) {
        $cnsltnIntervention = $_POST['hlpintervention'];
    
        }
        else{
    
        $cnsltnIntervention = "";
    
        }


    $cnsltnClinicRestFrom = $_POST['cnsltnClinicRestFrom'];
    $cnsltnClinicRestTo = $_POST['cnsltnClinicRestTo'];

    
    if (isset($_POST['hlpftwMeds']) && !empty($_POST['hlpftwMeds'])) {
      $cnsltnMeds = $_POST['hlpftwMeds'];
      $cnsltnMeds = implode(', ', $cnsltnMeds);
  
    }
    else{
  
    $cnsltnMeds = "";
  
    }
  
    $cnsltnMedsQuantity = $_POST['cnsltnMedsQuantity'];
  
    $cnsltnBloodChem = $_POST['cnsltnBloodChem'];
    $cnsltnCbc = $_POST['cnsltnCbc'];
    $cnsltnUrinalysis = $_POST['cnsltnUrinalysis'];
    $cnsltnFecalysis = $_POST['cnsltnFecalysis'];
    $cnsltnXray = $_POST['cnsltnXray'];
    $cnsltnOthersLab = $_POST['cnsltnOthersLab'];
    $cnsltnBp = $_POST['cnsltnBp'];
    $cnsltnTemp = $_POST['cnsltnTemp'];
    $cnsltn02Sat = $_POST['cnsltn02Sat'];
    $cnsltnPr = $_POST['cnsltnPr'];
    $cnsltnRr = $_POST['cnsltnRr'];
    // $cnsltnRemarks = $_POST['cnsltnRemarks'];
    $cnsltnOthersRemarks = $_POST['hlpremarks'];
    $cnsltnCompleted = "0";
    $cnsltnWithPendingLab = "";
  
    
    $pendingLabDueDate = "";
    
  
    if($cnsltnCompleted == 1){
  $status = 'done';
  $cnsltnWithPendingLab='';
  $pendingLabDueDate = '';
    }
    else{
  $status = 'doc';
  
    }
    if($cnsltnIntervention == "Dental Consultation" || $cnsltnIntervention == "Medication and Dental Consultation" || $cnsltnIntervention == "Dental Services (Oral Prophylaxis)" || $cnsltnIntervention == "Dental Services (Light Cure)" || $cnsltnIntervention == "Medication and Dental Services (Tooth Extraction)"){
      $status = 'done';
      // $cnsltnCompleted=1;
    }
  
    // echo $smoking;
    $sql = "INSERT INTO `consultation`(`idNumber`, `status`, `nurseAssisting`, `date`, `time`, `type`, `categories`, `building`, `chiefComplaint`, `diagnosis`, `intervention`, `clinicRestFrom`, `clinicRestTo`, `meds`,`medsQty`, `bloodChemistry`, `cbc`, `urinalysis`, `fecalysis`, `xray`, `others`, `bp`, `temp`, `02sat`, `pr`, `rr`, `otherRemarks`,`statusComplete`,`withPendingLab`,`pendingLabDueDate`,`medicalLab`,`seenByDoc`) VALUES ('$idNumber','doc','$nurseId','$cnsltnDate', '$cnsltnTime', '$cnsltnType', '$cnsltnCategories', '$cnsltnBuilding', '$cnsltnChiefComplaint', '$cnsltnDiagnosis', '$cnsltnIntervention', '$cnsltnClinicRestFrom', '$cnsltnClinicRestTo', '$cnsltnMeds','$cnsltnMedsQuantity', '$cnsltnBloodChem', '$cnsltnCbc', '$cnsltnUrinalysis', '$cnsltnFecalysis', '$cnsltnXray', '$cnsltnOthersLab', '$cnsltnBp', '$cnsltnTemp', '$cnsltn02Sat', '$cnsltnPr', '$cnsltnRr', '$cnsltnOthersRemarks','$cnsltnCompleted','$cnsltnWithPendingLab','$pendingLabDueDate','$cnsltnWithPendingLab',0)";
    $results = mysqli_query($con, $sql);
  
    if ($results) {
      echo "<script>alert('Successfully proceeded to consultation') </script>";
    //   echo "<script> location.href='index.php?employer=$employer'; </script>";
    }
  }



if (isset($_POST['editBloodChem'])) {
    $id = $_POST['editid'];
    $idNumber = $_POST['editrfid'];
    $name = $_POST['editname'];
    $section = $_POST['editsection'];
    $date = $_POST['editdate'];
    $time = $_POST['edittime'];
    $building = $_POST['editbuilding_transaction'];
    $type = $_POST['edittype'];
    // $diagnosis = $_POST['editdiagnosis'];

    if (isset($_POST['editdiagnosis']) && !empty($_POST['editdiagnosis'])) {
        $diagnosis = $_POST['editdiagnosis'];
        $diagnosis = str_replace("'", "&apos;", $diagnosis);
        $diagnosis = str_replace('"', '&quot;', $diagnosis);
        }
        else{
    
        $diagnosis = "";
    
        }


 
    if (isset($_POST['editintervention']) && !empty($_POST['editintervention'])) {
        $intervention = $_POST['editintervention'];
    
        }
        else{
    
        $intervention = "";
    
        }


    $followupdate = $_POST['editfollowupdate'];
    $fbs = $_POST['editfbs'];
    $cholesterol = $_POST['editcholesterol'];
    $triglycerides = $_POST['edittriglycerides'];
    $hdl = $_POST['edithdl'];
    $ldl = $_POST['editldl'];
    $bun = $_POST['editbun'];
    $editcreatinine = $_POST['editcreatinine'];

    $bua = $_POST['editbua'];
    $sgpt = $_POST['editsgpt'];
    $sgdt = $_POST['editsgdt'];
    $hbaic = $_POST['edithbaic'];

    $editK = $_POST['editK'];
    $editNa = $_POST['editNa'];
    $editFT3 = $_POST['editFT3'];
    $editFT4 = $_POST['editFT4'];
    $editTSH = $_POST['editTSH'];


    $others = $_POST['editothers'];
    $remarks = $_POST['editremarks'];

    // $Meds = $_POST['editftwMeds'];


    // if ($Meds != "") {

    //     $Meds = implode(', ', $Meds);
    // }


    if (isset($_POST['editftwMeds']) && !empty($_POST['editftwMeds'])) {
        $Meds = $_POST['editftwMeds'];
        $Meds = implode(', ', $Meds);
        $Meds = str_replace("'", "&apos;", $Meds);
        $Meds = str_replace('"', '&quot;', $Meds);
        }
        else{
    
        $Meds = "";
    
        }
    


    $editBloodChem = "UPDATE `bloodchem` SET `date`='$date' , `time` = '$time', `building`= '$building', `type`= '$type', `diagnosis`= '$diagnosis', `intervention`= '$intervention', `medications`= '$Meds', `followupdate`= '$followupdate', `FBS`= '$fbs', `cholesterol`= '$cholesterol', `triglycerides`= '$triglycerides', `HDL`= '$hdl', `LDL`= '$ldl', `BUN`= '$bun',`creatinine`= '$editcreatinine', `BUA`= '$bua', `SGPT`= '$sgpt', `SGDT`= '$sgdt', `HBA1C`= '$hbaic',`potassium`='$editK',`sodium`='$editNa',`FT3`='$editFT3',`FT4`='$editFT4',`TSH`='$editTSH', `others` = '$others',`remarks`= '$remarks' WHERE `id`='$id'";
    $resultInfo = mysqli_query($con, $editBloodChem);

    if ($resultInfo) {
        echo "<script>alert('Updated Successfuly!') </script>";
        echo "<script> location.href='index.php?employer=$employer'; </script>";
    }
}

// Function to check if Id Number exists in database and save non-existent ones in an array
function isidNumberExists($con, $idNumber)
{
    // Escape the Id Number to prevent SQL injection (assuming $con is your mysqli connection)
    $idNumber = mysqli_real_escape_string($con, $idNumber);

    // Query to check if Id Number exists
    $query = "SELECT COUNT(*) AS count FROM employeespersonalinfo WHERE idNumber = '$idNumber' AND `employer` ='$employer'";
    $result = mysqli_query($con, $query);

    // Check if query execution was successful
    if ($result === false) {
        die("Query failed: " . mysqli_error($con));
    }

    // Fetch the count from the result
    $row = mysqli_fetch_assoc($result);
    $count = (int)$row['count'];

    // Free result set
    mysqli_free_result($result);

    // Return true if count > 0 (ID Number exists), false otherwise
    return $count > 0;
}

// Function to save data to database
function saveToDatabase($con, $data, $count)
{
    // Initialize an array to collect errors
    $errorLogs = [];

    foreach ($data as $row) {
        if ($count > 0) {
            $date = $row['0'];
            $time = $row['1'];
            $building = $row['2'];
            $idNumber = $row['3'];
            $type = $row['4'];
            $diagnosis = $row['5'];
            $intervention = $row['6'];
            $Meds = $row['7'];
            $followupdate = $row['8'];
            $fbs = $row['9'];
            $cholesterol = $row['10'];
            $triglycerides = $row['11'];
            $hdl = $row['12'];
            $ldl = $row['13'];
            $bun = $row['14'];
            $bua = $row['15'];
            $sgpt = $row['16'];
            $sgdt = $row['17'];
            $hbaic = $row['18'];
            $others = $row['19'];
            $remarks = $row['20'];

            // Check if Id Number exists in db_table
            if (!isidNumberExists($con, $idNumber)) {
                // Log error for non-existent Id Numbers
                $errorLogs[] = "Id Number '$idNumber' not found in Employee List";
                continue; // Skip saving this row
            }

            // If validation passes, save to database
            $result = mysqli_query($con, "SELECT `Name`, `section` FROM `employeespersonalinfo` WHERE `idNumber` = '$idNumber' AND `employer` ='$employer'");
            while ($userRow = mysqli_fetch_assoc($result)) {
                $name = $userRow['Name'];
                $section = $userRow['section'];

                $result1 = mysqli_query($con, "SELECT * FROM `bloodchem` WHERE `idNumber` = '$idNumber'");
                $numrows = mysqli_num_rows($result1);
                if ($numrows > 0) {
                    $addHlp = "UPDATE `bloodchem` SET `date`='$date' , `time` = '$time', `building`= '$building', `type`= '$type', `diagnosis`= '$diagnosis', `intervention`= '$intervention', `medications`= '$Meds', `followupdate`= '$followupdate', `FBS`= '$fbs', `cholesterol`= '$cholesterol', `triglycerides`= '$triglycerides', `HDL`= '$hdl', `LDL`= '$ldl', `BUN`= '$bun', `BUA`= '$bua', `SGPT`= '$sgpt', `SGDT`= '$sgdt', `HBA1C`= '$hbaic', `others` = '$others',`remarks`= '$remarks' WHERE `idNumber`='$idNumber'";
                    $resultInfo = mysqli_query($con, $addHlp);
                } else {
                    $addHlp = "INSERT INTO `bloodchem`(`idNumber`, `date`, `time` ,`building`, `type`, `diagnosis`, `intervention`, `medications`, `followupdate`, `FBS`, `cholesterol`, `triglycerides`, `HDL`, `LDL`, `BUN`, `BUA`, `SGPT`, `SGDT`, `HBA1C`, `others` ,`remarks`) VALUES ('$idNumber','$date','$time','$building','$type','$diagnosis','$intervention','$Meds','$followupdate','$fbs','$cholesterol','$triglycerides', '$hdl', '$ldl', '$bun', '$bua', '$sgpt', '$sgdt', '$hbaic', '$others', '$remarks')";
                    $resultInfo = mysqli_query($con, $addHlp);
                }
            }

            // Check if query execution was successful
            if ($resultInfo === false) {
                $errorLogs[] = "Failed to insert data for Id Number '$idNumber': " . mysqli_error($con);
            }
        }
        $count = 1;
    }

    // Return error logs array
    return $errorLogs;
}

// Main script to import Excel and process data
if (isset($_POST['addBloodChemImport'])) {
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowed_ext = ['xls', 'csv', 'xlsx'];
    if (in_array($file_ext, $allowed_ext)) {
        $count = 0;
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        try {
            // Save data to database and collect error logs
            $errorLogs = saveToDatabase($con, $data, $count);

            // Close database connection
            mysqli_close($con);

            // Output success or error messages
            if (empty($errorLogs)) {
                echo "<script>alert('Data imported and saved successfully.!') </script>";
                echo "<script> location.href='index.php'; </script>";
            } else {
                echo "Errors occurred during import:<br>";
                foreach ($errorLogs as $error) {
                    echo "$error<br>";
                }
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo "<script>alert('Invalid file format. Allowed formats: xls, csv, xlsx');</script>";
    }
}


?>
<div class="text-[9px] 2xl:text-lg mb-5">
    <div class="flex justify-between">
        <p class="mb-2 my-auto"><span class=" self-center text-md font-semibold whitespace-nowrap   text-[#193F9F]">HLP Records - <?php echo $employer ; ?> Employees</span></p>
        <div class="flex items-center order-2">
            <button type="button" onclick="openExportModal()" class="lg:block text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2 mx-3 md:mx-2">Export</button>

            <button type="button" data-dropdown-toggle="options" class="lg:block text-white bg-gradient-to-r from-[#00669B] to-[#9AC1CA] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300  font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2 ">Add</button>
            <div id="options" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-2  text-gray-700 dark:text-gray-200" aria-labelledby="options">
                    <!-- <li>
                        <a type="button" onclick="openExportModal()" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Export</a>
                    </li> -->
                    <li>
                        <a type="button" onclick="openAddModal()" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Add HLP</a>
                    </li>
                    <li>
                        <a type="button" onclick="openImportModal()" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Import Data</a>
                    </li>
                    <li>
                        <a type="button" onclick="exportTemplate()" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Export Template</a>
                    </li>

                </ul>

            </div>
        </div>

    </div>

    <div id="" class="">
        <div class=" p-4 rounded-lg  bg-gray-50 " id="headApproval" role="tabpanel" aria-labelledby="profile-tab">
            <form action="index.php" method="post">
                <section class="mt-2 2xl:mt-10">
                    <table id="bloodChemTable" class="display text-[9px] 2xl:text-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Action</th>
                                <th>Date </th>
                                <th>Time </th>
                                <th>Building Transaction </th>
                                <th>Name </th>
                                <th>Section </th>
                                <th>Type</th>
                                <th>Diagnosis</th>
                                <th>Intervention</th>
                                <th>Medicine</th>
                                <th>Follow-up Date</th>
                                <th>Laboratory</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ApeNo = 1;
                            $sql = "SELECT p.*, e.employer, e.Name, e.section, e.idNumber FROM bloodchem p 
                                    JOIN employeespersonalinfo e ON e.idNumber = p.idNumber WHERE e.employer = '$employer' ORDER BY `id` ASC";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $ApeNo; ?></td>

                                    <td>
                                        <div class="content-center flex flex-wrap justify-center gap-2">
                                            <input type="text" class="hidden" name="rfid<?php echo $ApeNo; ?>" value="<?php echo $row['idNumber']; ?>">
                                            <button id="dropdownMenuIconButton<?php echo $ApeNo; ?>" data-dropdown-toggle="dropdownDots<?php echo $ApeNo; ?>" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900  rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 bg-white dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                                    <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                                </svg>
                                            </button>


                                        </div>
                                        <!-- Dropdown menu -->
                                        <div id="dropdownDots<?php echo $ApeNo; ?>" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-2 text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton<?php echo $ApeNo; ?>">
                                                <li>
                                                    <a type="button" onclick="openEditEmployee(this)" data-id="<?php echo $row['id'] ?>" data-rfid="<?php echo $row['idNumber']; ?>" data-name="<?php echo $row['Name']; ?>" data-section="<?php echo $row['section']; ?>" data-date="<?php echo $row['date']; ?>" data-time="<?php echo $row['time']; ?>" data-building="<?php echo $row['building']; ?>" data-type="<?php echo $row['type']; ?>" data-diagnosis="<?php echo $row['diagnosis']; ?>" data-intervention="<?php echo $row['intervention']; ?>" data-medications="<?php echo $row['medications']; ?>" data-followupdate="<?php echo $row['followupdate']; ?>" data-FBS="<?php echo $row['FBS']; ?>" data-cholesterol="<?php echo $row['cholesterol']; ?>" data-triglycerides="<?php echo $row['triglycerides']; ?>" data-HDL="<?php echo $row['HDL']; ?>" data-LDL="<?php echo $row['LDL']; ?>" data-BUN="<?php echo $row['BUN']; ?>" data-creatinine="<?php echo $row['creatinine']; ?>" data-BUA="<?php echo $row['BUA']; ?>" data-SGPT="<?php echo $row['SGPT']; ?>" data-SGDT="<?php echo $row['SGDT']; ?>" data-HBA1C="<?php echo $row['HBA1C']; ?>" data-potassium="<?php echo $row['potassium']; ?>" data-sodium="<?php echo $row['sodium']; ?>" data-FT3="<?php echo $row['FT3']; ?>" data-FT4="<?php echo $row['FT4']; ?>" data-TSH="<?php echo $row['TSH']; ?>"  data-others="<?php echo $row['others']; ?>" data-remarks="<?php echo $row['remarks']; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit HLP Record</a>
                                                </li>

                                            </ul>

                                        </div>
                                    </td>
                                    <td><?php echo $row['date'] ?></td>
                                    <td><?php echo $row['time'] ?></td>
                                    <td><?php echo $row['building'] ?></td>
                                    <td><?php echo $row['Name'] ?></td>
                                    <td><?php echo $row['section'] ?></td>
                                    <td><?php echo $row['type'] ?></td>
                                    <td><?php echo $row['diagnosis'] ?></td>
                                    <td><?php echo $row['intervention'] ?></td>
                                    <td><?php echo $row['medications'] ?></td>
                                    <td><?php echo $row['followupdate'] ?></td>
                                    <td><?php if ($row['FBS'] != "") {
                                            echo "FBS: " . $row['FBS'] . " ";
                                        }
                                        if ($row['cholesterol'] != "") {
                                            echo "cholesterol: " . $row['cholesterol'] . " ";
                                        }
                                        if ($row['triglycerides'] != "") {
                                            echo "triglycerides: " . $row['triglycerides'] . " ";
                                        }
                                        if ($row['HDL'] != "") {
                                            echo "HDL: " . $row['HDL'] . " ";
                                        }
                                        if ($row['LDL'] != "") {
                                            echo "LDL: " . $row['LDL'] . " ";
                                        }
                                        if ($row['BUN'] != "") {
                                            echo "BUN: " . $row['BUN'] . " ";
                                        }
                                        if ($row['creatinine'] != "") {
                                            echo "Crea: " . $row['creatinine'] . " ";
                                        }
                                        if ($row['BUA'] != "") {
                                            echo "BUA: " . $row['BUA'] . " ";
                                        }
                                        if ($row['SGPT'] != "") {
                                            echo "SGPT: " . $row['SGPT'] . " ";
                                        }
                                        if ($row['SGDT'] != "") {
                                            echo "SGOT: " . $row['SGDT'] . " ";
                                        }
                                        if ($row['HBA1C'] != "") {
                                            echo "HBA1C: " . $row['HBA1C'] . " ";
                                        }
                                        if ($row['potassium'] != "") {
                                            echo "K: " . $row['potassium'] . " ";
                                        }
                                        if ($row['sodium'] != "") {
                                            echo "Na: " . $row['sodium'] . " ";
                                        }
                                        if ($row['FT3'] != "") {
                                            echo "FT3: " . $row['FT3'] . " ";
                                        }
                                        if ($row['FT4'] != "") {
                                            echo "FT4: " . $row['FT4'] . " ";
                                        }
                                        if ($row['TSH'] != "") {
                                            echo "TSH: " . $row['TSH'] . " ";
                                        }
                                        if ($row['others'] != "") {
                                            echo "others: " . $row['others'] . " ";
                                        }
                                        ?></td>
                                    <td><?php echo $row['remarks'] ?></td>

                                </tr>
                            <?php $ApeNo++;
                            } ?>
                        </tbody>
                    </table>
                </section>
            </form>
        </div>
    </div>

</div>







<div id="exportModal" tabindex="-1" aria-hidden="true" class=" hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class=" font-semibold text-gray-900 dark:text-white">
                    Export HLP Record
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="exportModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form method="POST" class="px-4 md:px-5 py-2 text-[8pt]" enctype="multipart/form-data">
                <div class="grid gap-2 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="employer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Employer</label>

                        <select id="employer" name="employer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            <option selected value="GPI">GPI</option>
                            <option value="All">All</option>
                            <option value="Maxim">Maxim</option>
                            <option value="Powerlane">Powerlane</option>
                            <option value="Nippi">Nippi</option>
                            <option value="Mangreat">Mangreat</option>
                            <option value="Otrelo">Otrelo</option>
                            <option value="Canteen">Canteen</option>
                            <option value="Alarm">Alarm</option>

                        </select>
                        <label for="month" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Month</label>

                        <select id="month" name="month" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            <?php
                            $date = new DateTime('01-01-2023');
                            $dateNow = new DateTime();
                            $monthNow = $dateNow->format('F');

                            for ($i = 1; $i <= 12; $i++) {
                                $month = $date->format('F');
                            ?> <option <?php if ($monthNow == $month) {
                                            echo "selected";
                                        } ?> value="<?php echo $month; ?>"><?php echo $month; ?></option> <?php
                                                                                                            $date->modify('next month');
                                                                                                        }
                                                                                                            ?>
                        </select>
                        <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year</label>
                        <input type="number" value="<?php $dateNow2 = new DateTime();
                                                    $year = $dateNow2->format('Y');
                                                    echo $year; ?>" name="year" id="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>


                </div>

                <button type="submit" name="excelReport" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Generate Excel
                </button>
            </form>
        </div>
    </div>
</div>


<div id="editBloodChem" tabindex="-1" aria-hidden="true" class="bg-[#615eae59] hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit HLP Record
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editBloodChem">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form method="POST">
                <div class="text-[9px] 2xl:text-lg  rounded-lg bg-white/50 grid grid-cols-4 gap-1 w-full w-full p-4 ">
                    <input type="text" name="editid" id="editid" class="hidden">
                    <div class="col-span-4 gap-4">
                        <label for="editname" class="block mb-1 font-semibold  text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="editname" id="editname" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editrfid" class="block mb-1 font-semibold  text-gray-900 dark:text-white">ID Number</label>
                        <input type="text" name="editrfid" id="editrfid" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editsection" class="block mb-1 font-semibold  text-gray-900 dark:text-white">Section</label>
                        <input type="text" name="editsection" id="editsection" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editdate" class="block mb-1 font-semibold text-gray-900 dark:text-white">Date</label>
                        <input type="date" name="editdate" id="editdate" value="<?php echo date('Y-m-d'); ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="edittime" class="block mb-1 font-semibold text-gray-900 dark:text-white">Time</label>
                        <input type="text" name="edittime" id="edittime" value="<?php echo date('h:i A'); ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" ">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="edittype" class="block mb-1 font-semibold text-gray-900 dark:text-white">Type</label>
                        <select name="edittype" id="edittype" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        <option selected value="">Select Type</option>

                            <option value="Initial">Initial</option>
                            <option value="Follow up">Follow up</option>
                        </select>

                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editbuilding_transaction" class="block mb-1 font-semibold text-gray-900 dark:text-white">Building</label>
                        <select name="editbuilding_transaction" id="editbuilding_transaction" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        <option selected value="">Select Building</option>
                            <option value="Gpi 1">GPI 1</option>
                            <option value="Gpi 4">GPI 4</option>
                            <option value="Gpi 5">GPI 5</option>
                        </select>

                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editdiagnosis" class="block  my-auto  font-semibold text-gray-900 ">Diagnosis: </label>
                        <select id="editdiagnosis" name="editdiagnosis" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

                            <?php
                            $sql1 = "Select * FROM `diagnosis`";
                            $result = mysqli_query($con, $sql1);
                            while ($list = mysqli_fetch_assoc($result)) {
                                $diagnosis = $list["diagnosisName"];
                            ?>
                                <option><?php echo $diagnosis; ?></option>
                            <?php

                            }
                            ?>
                        </select>
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editintervention" class="block  my-auto  font-semibold text-gray-900 ">Intervention</label>

                        <select id="editintervention" name="editintervention" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option    value="Medication Only">Medication only</option>
                                <option  value="Medical Consultation">Medical Consultation</option>
                                <option  value="Medication and Medical Consultation">Medication and Medical Consultation</option>
                                <option  value="Medication, Clinic Rest and Medical Consultation">Medication, Clinic Rest and Medical Consultation</option>
                                <option  value="Clinic Rest Only">Clinic Rest Only</option>
                                <option  value="Dental Consultation">Dental Consultation</option>
                                <option  value="Medication and Dental Consultation">Medication and Dental Consultation</option>
                                <option  value="Dental Services (Oral Prophylaxis)">Dental Services (Oral Prophylaxis)</option>
                                <option  value="Dental Services (Light Cure)">Dental Services (Light Cure)</option>
                                <option  value="Medication and Dental Services (Tooth Extraction)">Medication and Dental Services (Tooth Extraction)</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-4 col-span-4" id="medicineDivs">
                        <div class="col-span-4">

                            <label for="editftwMeds" class="block  my-auto font-semibold text-gray-900 ">Medicine (Add medicine below): </label>
                            <select name="editftwMeds[]" id="editftwMeds" multiple="multiple" class="form-control js-meds w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">


                            </select>

                        </div>
                        <div id="medicineDiv" class="grid grid-cols-4 gap-1 col-span-4 mt-2">
                            <div id="medicineDiv1" class="grid grid-cols-4 gap-1 col-span-4">
                                <div id="medsdiv" class="col-span-2">
                                    <label for="nameOfMedicine1" class="block  my-auto font-semibold text-gray-900 ">What's your medicine? </label>

                                    <!-- <input type="text" id="nameOfMedicine1" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 "> -->
                                    <select id="nameOfMedicine1" class="js-meds bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
          <option selected disabled>Select Medicine</option>
          <option value="addMedicineButton">Add Medicine</option>
          <?php
          $sql1 = "Select * FROM `medicine`";
          $result = mysqli_query($con, $sql1);
          while ($list = mysqli_fetch_assoc($result)) {
            $medicine = $list["medicineName"];
          ?>
            <option  value=<?php echo $medicine; ?>><?php echo $medicine; ?></option>
          <?php

            //  echo "<option value='$diagnosis' >$diagnosis</option>";

          }
          ?>

        </select>

                                </div>

                                <div id="medsqtydiv" class=" col-span-2">
                                    <div class="w-full">
                                        <label class="block  my-auto font-semibold text-gray-900 ">Choose quantity:</label>
                                        <div class="flex relative ">
                                            <div class="relative flex items-center max-w-[8rem]">
                                                <button type="button" id="decrement-button-edit" data-input-counter-decrement="quantityMeds1" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-9 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                    </svg>
                                                </button>
                                                <input type="text" name="cnsltnMedsQuantity" id="quantityMeds1" data-input-counter data-input-counter-min="1" data-input-counter-max="50" aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-9 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="999" value="1" />
                                                <button type="button" id="increment-button-edit" data-input-counter-increment="quantityMeds1" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-9 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                                    </svg>
                                                </button>

                                            </div>

                                            <button type="button" id="editaddmedsbtn" onclick="addSelectedValue1(document.getElementById('nameOfMedicine1').value, document.getElementById('quantityMeds1').value)" class="ml-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg  p-2 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> Add to list
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editfollowupdate" class="block mb-1 font-semibold text-gray-900 dark:text-white">Follow-up Date</label>
                        <input type="date" name="editfollowupdate" id="editfollowupdate" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editremarks" class="block mb-1 font-semibold text-gray-900 dark:text-white">Remarks</label>
                        <input type="text" name="editremarks" id="editremarks" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" ">
                    </div>
                    <div class="col-span-4">
                        <h3 class=" my-auto w-full font-semibold text-gray-900 ">Laboratory: </h3>
                    </div>
                    <div class="ml-4 grid grid-cols-4  col-span-4 gap-1">
                        <div class="col-span-2">
                            <label for="editfbs" class="block my-auto  font-semibold text-gray-900 ">FBS: </label>
                            <input type="text" value="" name="editfbs" id="editfbs" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>

                        <div class="col-span-2">
                            <label for="editcholesterol" class="block my-auto  font-semibold text-gray-900 ">Cholesterol: </label>
                            <input type="text" name="editcholesterol" id="editcholesterol" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>

                        <div class="col-span-2">
                            <label for="edittriglycerides" class="block my-auto  font-semibold text-gray-900 ">Triglycerides: </label>
                            <input type="text" name="edittriglycerides" id="edittriglycerides" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>

                        <div class="col-span-2">
                            <label for="edithdl" class="block my-auto  font-semibold text-gray-900 ">HDL: </label>
                            <input type="text" name="edithdl" id="edithdl" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label for="editldl" class="block my-auto  font-semibold text-gray-900 ">LDL: </label>
                            <input type="text" name="editldl" id="editldl" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label for="editbun" class="block my-auto  font-semibold text-gray-900 ">BUN: </label>
                            <input type="text" name="editbun" id="editbun" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label for="editcreatinine" class="block my-auto   text-gray-900 ">Creatinine: </label>
                            <input type="text" name="editcreatinine" id="editcreatinine" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>
                        <div class="col-span-2">
                            <label for="editbua" class="block my-auto  font-semibold text-gray-900 ">BUA: </label>
                            <input type="text" name="editbua" id="editbua" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                      
                        <div class="col-span-2">
                            <label for="editsgdt" class="block my-auto  font-semibold text-gray-900 ">SGOT: </label>
                            <input type="text" name="editsgdt" id="editsgdt" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label for="editsgpt" class="block my-auto  font-semibold text-gray-900 ">SGPT: </label>
                            <input type="text" name="editsgpt" id="editsgpt" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label for="edithbaic" class="block my-auto  font-semibold text-gray-900 ">HBA1C: </label>
                            <input type="text" name="edithbaic" id="edithbaic" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label for="editK" class="block my-auto  font-semibold text-gray-900 ">Potassium (K): </label>
                            <input type="text" name="editK" id="editK" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label for="editNa" class="block my-auto  font-semibold text-gray-900 ">Sodium (Na): </label>
                            <input type="text" name="editNa" id="editNa" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div> <div class="col-span-2">
                            <label for="editFT3" class="block my-auto  font-semibold text-gray-900 ">FT3: </label>
                            <input type="text" name="editFT3" id="editFT3" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div> <div class="col-span-2">
                            <label for="editFT4" class="block my-auto  font-semibold text-gray-900 ">FT4: </label>
                            <input type="text" name="editFT4" id="editFT4" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div> <div class="col-span-2">
                            <label for="editTSH" class="block my-auto  font-semibold text-gray-900 ">TSH: </label>
                            <input type="text" name="editTSH" id="editTSH" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div> <div class="col-span-2">
                            <label for="editothers" class="block my-auto  font-semibold text-gray-900 ">Others: </label>
                            <input type="text" name="editothers" id="editothers" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-4 justify-center flex gap-2">
                            <button type="submit" name="editBloodChem" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

                                Update Record
                            </button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
        </div>

        
<div id="addBloodChemModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full  bg-gray-900/50 dark:bg-gray-900/80 ">
    <div class="relative p-4 w-full max-w-6xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class=" font-semibold text-gray-900 dark:text-white">
                    Add HLP Record
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="addBloodChemModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form method="POST">
                <div class="grid grid-cols-2 gap-2 p-2">
                <div class="text-[9px] 2xl:text-lg  border border-gray-300 rounded-lg bg-white/50 grid grid-cols-4 gap-1 w-full w-full p-4 border-">
                <div class="col-span-4 gap-4 mb-4">
                        <label for="hlpname" class="block mb-1  text-gray-900 dark:text-white">Name</label>
                        <select id="hlpname" name="hlpname" class="js-employees bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                            <option selected disabled>Search Name</option>
                            <?php
                            $sql1 = "SELECT * FROM employeespersonalinfo e WHERE e.employer = '$employer';";
                            $result = mysqli_query($con, $sql1);
                            while ($list = mysqli_fetch_assoc($result)) {
                                $idNumber = $list["idNumber"];
                                $name = $list["Name"];
                                $section = $list["section"]; ?>
                                <option value="<?php echo  $name; ?>" data-hlprfid="<?php echo  $idNumber; ?>" data-hlpsection="<?php echo  $section; ?>"> <?php echo  $name; ?> </option> <?php
                                                                                                                                                                                    } ?>
                        </select>
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="hlprfid" class="block mb-1  text-gray-900 dark:text-white">ID Number</label>
                        <input type="text" name="hlprfid" id="hlprfid" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " required="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="hlpsection" class="block mb-1  text-gray-900 dark:text-white">Section</label>
                        <input type="text" name="hlpsection" id="hlpsection" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " required="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="hlpdate" class="block mb-1  text-gray-900 dark:text-white">Date</label>
                        <input type="date" name="hlpdate" id="hlpdate" value="<?php echo date('Y-m-d'); ?>" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder="" required="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="hlptime" class="block mb-1  text-gray-900 dark:text-white">Time</label>
                        <input type="text" name="hlptime" id="hlptime" value="<?php echo date('h:i A'); ?>" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="hlptype" class="block mb-1  text-gray-900 dark:text-white">Type</label>
                        <select name="hlptype" id="hlptype" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                            <option selected value="">Select Type</option>
                            <option value="Initial">Initial</option>
                            <option value="Follow up">Follow up</option>
                        </select>

                    </div>
                    <div class="content-center  col-span-2">
                        <label for="hlpbuilding_transaction" class="block mb-1 text-gray-900 dark:text-white">Building</label>
                        <select name="hlpbuilding_transaction" id="hlpbuilding_transaction" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                            <option selected value="">Select Building</option>
                            <option value="Gpi 1">GPI 1</option>
                            <option value="Gpi 4">GPI 4</option>
                            <option value="Gpi 5">GPI 5</option>
                        </select>

                    </div>








                    <div id="diagnosisDiv"  class="relative gap-4 col-span-2">
        <label  class="block  my-auto  font-semibold text-gray-900 ">Diagnosis: </label>
        <!-- <input type="text"  name="ftwDiagnosis" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 "> -->
        <select  required oninvalid="modalPrompt.hide();" id="ftwDiagnosiOption" name="hlpdiagnosis" class="js-diagnosis bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
          <option selected disabled value="">Select Diagnosis</option>
          <option value="addDiagnosisButton">Add Diagnosis</option>
          <?php
          $sql1 = "Select * FROM `diagnosis`";
          $result = mysqli_query($con, $sql1);
          while ($list = mysqli_fetch_assoc($result)) {
            $diagnosis = $list["diagnosisName"];
          ?>
            <option  value="<?php echo $diagnosis; ?>"><?php echo $diagnosis; ?></option>
          <?php

            //  echo "<option value='$diagnosis' >$diagnosis</option>";

          }
          ?>
        </select>
 




        <div id="addDiagnosis" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
          <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <label class="block text-xl font-semibold text-gray-900 dark:text-white">
                  Add Diagnosis
                </label>
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="addDiagnosis">
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                  </svg>
                  <span class="sr-only">Close modal</span>
                </button>
              </div>
              <!-- Modal body -->
              <div class="p-4 md:p-5">
                <form class="space-y-4" action="#">
                  <div>
                    <input type="text" name="diagnosis" id="diagnosis" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                  </div>
                  <button type="button" onclick="addDiagnosis()" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add</button>
                </form>
              </div>
            </div>
          </div>
        </div>

  



      </div>


                    <div class="content-center  col-span-2">
                        <label for="hlpintervention" class="block  my-auto  text-gray-900 ">Intervention</label>

                        <select id="interventionSelect" name="hlpintervention" value="" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        <option    value="Medication Only">Medication only</option>
                                <option  value="Medical Consultation">Medical Consultation</option>
                                <option  value="Medication and Medical Consultation">Medication and Medical Consultation</option>
                                <option  value="Medication, Clinic Rest and Medical Consultation">Medication, Clinic Rest and Medical Consultation</option>
                                <option  value="Clinic Rest Only">Clinic Rest Only</option>
                                <option  value="Dental Consultation">Dental Consultation</option>
                                <option  value="Medication and Dental Consultation">Medication and Dental Consultation</option>
                                <option  value="Dental Services (Oral Prophylaxis)">Dental Services (Oral Prophylaxis)</option>
                                <option  value="Dental Services (Light Cure)">Dental Services (Light Cure)</option>
                                <option  value="Medication and Dental Services (Tooth Extraction)">Medication and Dental Services (Tooth Extraction)</option>



                        </select>
                    </div>
                    
                    <div id="clinicRestTime" class="hidden col-span-4">
        <label class="block  my-auto font-semibold text-gray-900 ">Clinic Rest: </label>
        <div class=" content-center flex gap-4 col-span-2">

          <div class="relative w-1/2">
            <input type="time" value="" name="cnsltnClinicRestFrom" id="fromDate" class="bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ">
            <label for="fromDate" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]  px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">From</label>
          </div>

          <div class="relative w-1/2">

            <input type="time" value="" name="cnsltnClinicRestTo" id="toDate" class="bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ">
            <label for="toDate" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]  px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">To</label>
          </div>

        </div>
      </div>
                    <div class="grid grid-cols-4 col-span-4" id="medicineDivs">
          
                        <div id="medicineDiv" class="grid grid-cols-4 gap-1 col-span-4 mt-2">
                        <div class="col-span-4">

<label for="hlpftwMeds" class="block  my-auto  text-gray-900 ">Medicine (Add medicine below): </label>
<select name="hlpftwMeds[]" id="hlpftwMeds" multiple="multiple" class="p-2 js-meds border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">


</select>

</div>
                            <div id="medicineDiv1" class="grid grid-cols-4 gap-1 col-span-4">
                                <div id="medsdiv" class="col-span-2">
                                    <label for="nameOfMedicine" class="block  my-auto text-gray-900 ">What's your medicine? </label>
                                    <select id="nameOfMedicine" class="js-meds bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
          <option selected disabled>Select Medicine</option>
          <option value="addMedicineButton">Add Medicine</option>
          <?php
          $sql1 = "Select * FROM `medicine`";
          $result = mysqli_query($con, $sql1);
          while ($list = mysqli_fetch_assoc($result)) {
            $medicine = $list["medicineName"];
          ?>
            <option  value=<?php echo $medicine; ?>><?php echo $medicine; ?></option>
          <?php

            //  echo "<option value='$diagnosis' >$diagnosis</option>";

          }
          ?>

        </select>

        <div id="addMedicine" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
          <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                  Add Medicine
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="addMedicine">
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                  </svg>
                  <span class="sr-only">Close modal</span>
                </button>
              </div>
              <!-- Modal body -->
              <div class="p-4 md:p-5">
                <form class="space-y-4" action="#">
                  <div>

                    <input type="text" name="medicine" id="medicine" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                  </div>


                  <button type="button" onclick="addMedicine()" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add</button>

                </form>
              </div>
            </div>
          </div>
        </div>

                                    <!-- <input type="text" id="nameOfMedicine" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg"> -->

                                </div>

                                <div id="medsqtydiv" class=" col-span-2">
                                    <div class="w-full">
                                        <label class="block  my-auto  text-gray-900 ">Choose quantity:</label>
                                        <div class="flex relative ">
                                            <div class="relative flex items-center max-w-[8rem]">
                                                <button type="button" id="decrement-button" data-input-counter-decrement="quantityMeds" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-9 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                    </svg>
                                                </button>
                                                <input type="text" name="cnsltnMedsQuantity" id="quantityMeds" data-input-counter data-input-counter-min="1" data-input-counter-max="50" aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-9 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="999" value="1" />
                                                <button type="button" id="increment-button" data-input-counter-increment="quantityMeds" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-9 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                                    </svg>
                                                </button>

                                            </div>

                                            <button type="button" id="addmedsbtn" onclick="addSelectedValue(document.getElementById('nameOfMedicine').value, document.getElementById('quantityMeds').value)" class="ml-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg  p-2 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> Add to list
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="content-center  col-span-2">
                        <label for="hlpfollowupdate" class="block mb-1  text-gray-900 dark:text-white">Follow-up Date</label>
                        <input type="date" name="hlpfollowupdate" id="hlpfollowupdate" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="hlpremarks" class="block mb-1  text-gray-900 dark:text-white">Remarks</label>
                        <input type="text" name="hlpremarks" id="hlpremarks" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" ">
                    </div> 
            </div>
                

               
                <div class="text-[9px] 2xl:text-lg border border-gray-300 rounded-lg bg-white/50 grid grid-cols-4 gap-1 w-full w-full p-4 ">
                    
                    <div class="col-span-4">
                        <h3 class="block my-auto w-full  text-gray-900 ">Laboratory: </h3>
                    </div>
                    <?php
                    
                        $sql = "SELECT * FROM `hlpreference`;";
                       $result = mysqli_query($con,$sql);

                       $testReference=[];
                            while($row = mysqli_fetch_assoc($result)){
                                $testName = $row['test'];
                                $unit = $row['unit'];
                                $minimum = $row['referenceMinimum'];
                                $maximum = $row['referenceMaximum'];

                                $testReference[] = [
                                    'testName' => $testName,'unit' => $unit,'minimum' => $minimum,'maximum' => $maximum
                                ];

                            }
                       
                       
                    ?>
                    <div class="ml-4 grid grid-cols-4  col-span-4 gap-1">
                    <input type="text" class="hidden" id="hlpfbsmin" value="<?php if (isset($testReference[0])) { $test = $testReference[0];     echo $test['minimum'];} ?>">
                    <input type="text" class="hidden" id="hlpcholesterolmin" value="<?php if (isset($testReference[1])) { $test = $testReference[1];     echo $test['minimum'];} ?>">
                    <input type="text" class="hidden" id="hlptriglyceridesmin" value="<?php if (isset($testReference[2])) { $test = $testReference[2];     echo $test['minimum'];} ?>">
                    <input type="text" class="hidden" id="hlphdlmin" value="<?php if (isset($testReference[3])) { $test = $testReference[3];     echo $test['minimum'];} ?>">
                    <input type="text" class="hidden" id="hlpldlmin" value="<?php if (isset($testReference[4])) { $test = $testReference[4];     echo $test['minimum'];} ?>">
                    <input type="text" class="hidden" id="hlpbunmin" value="<?php if (isset($testReference[5])) { $test = $testReference[5];     echo $test['minimum'];} ?>">
                    <input type="text" class="hidden" id="hlpcreatininemin" value="<?php if (isset($testReference[6])) { $test = $testReference[6];     echo $test['minimum'];} ?>">
                    <input type="text" class="hidden" id="hlpbuamin" value="<?php if (isset($testReference[7])) { $test = $testReference[7];     echo $test['minimum'];} ?>">
                    <input type="text" class="hidden" id="hlpsgdtmin" value="<?php if (isset($testReference[8])) { $test = $testReference[8];     echo $test['minimum'];} ?>">
                    <input type="text" class="hidden" id="hlpsgptmin" value="<?php if (isset($testReference[9])) { $test = $testReference[9];     echo $test['minimum'];} ?>">
                    <input type="text" class="hidden" id="hlphbaicmin" value="<?php if (isset($testReference[10])) { $test = $testReference[10];     echo $test['minimum'];} ?>">
                    <input type="text" class="hidden" id="hlpKmin" value="<?php if (isset($testReference[11])) { $test = $testReference[11];     echo $test['minimum'];} ?>">
                    <input type="text" class="hidden" id="hlpNamin" value="<?php if (isset($testReference[12])) { $test = $testReference[12];     echo $test['minimum'];} ?>">
                    <input type="text" class="hidden" id="FT3min" value="<?php if (isset($testReference[13])) { $test = $testReference[13];     echo $test['minimum'];} ?>">
                    <input type="text" class="hidden" id="FT4min" value="<?php if (isset($testReference[14])) { $test = $testReference[14];     echo $test['minimum'];} ?>">
                    <input type="text" class="hidden" id="TSHmin" value="<?php if (isset($testReference[15])) { $test = $testReference[15];     echo $test['minimum'];} ?>">


                    <input type="text" class="hidden" id="hlpfbsmax" value="<?php if (isset($testReference[0])) { $test = $testReference[0];  echo $test['maximum'];} ?>">
                    <input type="text" class="hidden" id="hlpcholesterolmax" value="<?php if (isset($testReference[1])) { $test = $testReference[1];     echo $test['maximum'];} ?>">
                    <input type="text" class="hidden" id="hlptriglyceridesmax" value="<?php if (isset($testReference[2])) { $test = $testReference[2];     echo $test['maximum'];} ?>">
                    <input type="text" class="hidden" id="hlphdlmax" value="<?php if (isset($testReference[3])) { $test = $testReference[3];     echo $test['maximum'];} ?>">
                    <input type="text" class="hidden" id="hlpldlmax" value="<?php if (isset($testReference[4])) { $test = $testReference[4];     echo $test['maximum'];} ?>">
                    <input type="text" class="hidden" id="hlpbunmax" value="<?php if (isset($testReference[5])) { $test = $testReference[5];     echo $test['maximum'];} ?>">
                    <input type="text" class="hidden" id="hlpcreatininemax" value="<?php if (isset($testReference[6])) { $test = $testReference[6];     echo $test['maximum'];} ?>">
                    <input type="text" class="hidden" id="hlpbuamax" value="<?php if (isset($testReference[7])) { $test = $testReference[7];     echo $test['maximum'];} ?>">
                    <input type="text" class="hidden" id="hlpsgdtmax" value="<?php if (isset($testReference[8])) { $test = $testReference[8];     echo $test['maximum'];} ?>">
                    <input type="text" class="hidden" id="hlpsgptmax" value="<?php if (isset($testReference[9])) { $test = $testReference[9];     echo $test['maximum'];} ?>">
                    <input type="text" class="hidden" id="hlphbaicmax" value="<?php if (isset($testReference[10])) { $test = $testReference[10];     echo $test['maximum'];} ?>">
                    <input type="text" class="hidden" id="hlpKmax" value="<?php if (isset($testReference[11])) { $test = $testReference[11];     echo $test['maximum'];} ?>">
                    <input type="text" class="hidden" id="hlpNamax" value="<?php if (isset($testReference[12])) { $test = $testReference[12];     echo $test['maximum'];} ?>">
                    <input type="text" class="hidden" id="FT3max" value="<?php if (isset($testReference[13])) { $test = $testReference[13];     echo $test['maximum'];} ?>">
                    <input type="text" class="hidden" id="FT4max" value="<?php if (isset($testReference[14])) { $test = $testReference[14];     echo $test['maximum'];} ?>">
                    <input type="text" class="hidden" id="TSHmax" value="<?php if (isset($testReference[15])) { $test = $testReference[15];     echo $test['maximum'];} ?>">
                    
                        <div class="col-span-2">
                            <label for="hlpfbs" class="block my-auto   text-gray-900 ">FBS: <span class="text-gray-400 text-sm"><?php if (isset($testReference[0])) { $test = $testReference[0];     echo $test['minimum'] . "-";    echo $test['maximum'];} ?> </span>   
                            </label>
                            
                            <input type="text" value="" name="hlpfbs" id="hlpfbs" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>

                        <div class="col-span-2">
                            <label for="hlpcholesterol" class="block my-auto   text-gray-900 ">Cholesterol: <span class="text-gray-400 text-sm"><?php if (isset($testReference[1])) { $test = $testReference[1];     echo $test['minimum'] . "-";    echo $test['maximum'];} ?></span></label>
                            <input type="text" name="hlpcholesterol" id="hlpcholesterol" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>

                        <div class="col-span-2">
                            <label for="hlptriglycerides" class="block my-auto   text-gray-900 ">Triglycerides: <span class="text-gray-400 text-sm"><?php if (isset($testReference[2])) { $test = $testReference[2];     echo $test['minimum'] . "-";    echo $test['maximum'];} ?></span></label>
                            <input type="text" name="hlptriglycerides" id="hlptriglycerides" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>

                        <div class="col-span-2">
                            <label for="hlphdl" class="block my-auto   text-gray-900 ">HDL: <span class="text-gray-400 text-sm"><?php if (isset($testReference[3])) { $test = $testReference[3];     echo $test['minimum'] . "-";    echo $test['maximum'];} ?></span></label>
                            <input type="text" name="hlphdl" id="hlphdl" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>
                        <div class="col-span-2">
                            <label for="hlpldl" class="block my-auto   text-gray-900 ">LDL: <span class="text-gray-400 text-sm"><?php if (isset($testReference[4])) { $test = $testReference[4];     echo $test['minimum'] . "-";    echo $test['maximum'];} ?></span></label>
                            <input type="text" name="hlpldl" id="hlpldl" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>
                        <div class="col-span-2">
                            <label for="hlpbun" class="block my-auto   text-gray-900 ">BUN: <span class="text-gray-400 text-sm"><?php if (isset($testReference[5])) { $test = $testReference[5];     echo $test['minimum'] . "-";    echo $test['maximum'];} ?></span></label>
                            <input type="text" name="hlpbun" id="hlpbun" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>
                        <div class="col-span-2">
                            <label for="hlpcreatinine" class="block my-auto   text-gray-900 ">Creatinine: <span class="text-gray-400 text-sm"><?php if (isset($testReference[6])) { $test = $testReference[6];     echo $test['minimum'] . "-";    echo $test['maximum'];} ?></span></label>
                            <input type="text" name="hlpcreatinine" id="hlpcreatinine" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>
                        <div class="col-span-2">
                            <label for="hlpbua" class="block my-auto   text-gray-900 ">BUA: <span class="text-gray-400 text-sm"><?php if (isset($testReference[7])) { $test = $testReference[7];     echo $test['minimum'] . "-";    echo $test['maximum'];} ?></span></label>
                            <input type="text" name="hlpbua" id="hlpbua" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>
                   
                        <div class="col-span-2">
                            <label for="hlpsgdt" class="block my-auto   text-gray-900 ">SGOT: <span class="text-gray-400 text-sm"><?php if (isset($testReference[8])) { $test = $testReference[8];     echo $test['minimum'] . "-";    echo $test['maximum'];} ?></span></label>
                            <input type="text" name="hlpsgdt" id="hlpsgdt" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>
                        <div class="col-span-2">
                            <label for="hlpsgpt" class="block my-auto  text-gray-900 ">SGPT: <span class="text-gray-400 text-sm"><?php if (isset($testReference[9])) { $test = $testReference[9];     echo $test['minimum'] . "-";    echo $test['maximum'];} ?></span></label>
                            <input type="text" name="hlpsgpt" id="hlpsgpt" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>
                        <div class="col-span-2">
                            <label for="hlphbaic" class="block my-auto   text-gray-900 ">HBA1C: <span class="text-gray-400 text-sm"><?php if (isset($testReference[10])) { $test = $testReference[10];     echo $test['minimum'] . "-";    echo $test['maximum'];} ?></span></label>
                            <input type="text" name="hlphbaic" id="hlphbaic" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>
                        <div class="col-span-2">
                            <label for="hlpK" class="block my-auto  text-gray-900 ">Potassium (K): <span class="text-gray-400 text-sm"><?php if (isset($testReference[11])) { $test = $testReference[11];     echo $test['minimum'] . "-";    echo $test['maximum'];} ?></span></label>
                            <input type="text" name="hlpK" id="hlpK" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>
                        <div class="col-span-2">
                            <label for="hlpNa" class="block my-auto  text-gray-900 ">Sodium (Na): <span class="text-gray-400 text-sm"><?php if (isset($testReference[12])) { $test = $testReference[12];     echo $test['minimum'] . "-";    echo $test['maximum'];} ?></span></label>
                            <input type="text" name="hlpNa" id="hlpNa" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>
                        <div class="col-span-2">
                            <label for="FT3" class="block my-auto  text-gray-900 ">FT3: <span class="text-gray-400 text-sm"><?php if (isset($testReference[13])) { $test = $testReference[13];     echo $test['minimum'] . "-";    echo $test['maximum'];} ?></span></label>
                            <input type="text" name="FT3" id="FT3" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>
                        <div class="col-span-2">
                            <label for="FT4" class="block my-auto  text-gray-900 ">FT4: <span class="text-gray-400 text-sm"><?php if (isset($testReference[14])) { $test = $testReference[14];     echo $test['minimum'] . "-";    echo $test['maximum'];} ?></span></label>
                            <input type="text" name="FT4" id="FT4" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>
                        <div class="col-span-2">
                            <label for="TSH" class="block my-auto  text-gray-900 ">TSH: <span class="text-gray-400 text-sm"><?php if (isset($testReference[15])) { $test = $testReference[15];     echo $test['minimum'] . "-";    echo $test['maximum'];} ?></span></label>
                            <input type="text" name="TSH" id="TSH" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>
                        <div class="col-span-2">
                            <label for="hlpothers" class="block my-auto  text-gray-900 ">Others: </label>
                            <input type="text" name="hlpothers" id="hlpothers" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>
                    </div>
                    <div class="col-span-4 justify-center flex gap-2">

          <button type="button"  name="proceedButton" id="proceedButton" class="w-full text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Proceed</button>

                        <!-- <button type="submit" name="addBloodChem" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Add HLP
                        </button>
                        <button type="submit" name="addBloodChem" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Proceed to Consultation
                        </button> -->
                    </div>
                </div>

                <div id="askFirst" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="askFirst">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Record or Proceed to consultation?</h3>
              <div class="col-span-4 justify-center flex gap-2">
              <button type="submit" id="addBloodChem" name="addBloodChem" class="w-64 text-white bg-gradient-to-r from-[#00669B]  to-[#9AC1CA] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300  shadow-lg shadow-teal-500/50  font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2">Record</button>
              <button type="button"  id="proceedToConsultation" class="w-64 text-white bg-gradient-to-r from-[#9b0066]  to-[#ca9ac1] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300  shadow-lg shadow-pink-500/50  font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2">Proceed to Consultation</button>
              </div>
                 
            </div>
        </div>
    </div>
</div>




<div id="proceedToConsultationModal" tabindex="-1" aria-hidden="true" class=" hidden fixed overflow-y-auto overflow-x-hidden  top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-50 dark:bg-opacity-80">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Proceed to Consultation
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="proceedToConsultationModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            
                <div class="text-[9px] 2xl:text-lg  rounded-lg bg-white/50 grid grid-cols-4 gap-1 w-full p-4 ">

                <div class="col-span-4">
        <label class="block  my-auto font-semibold text-gray-900 ">Medical Category: </label>

        <select id="categoriesSelect" name="cnsltnCategories" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
          <option selected value="common">Common</option>
          <option  value="Long Term">Long Term</option>
          <option  value="Maternity">Maternity</option>
          <option  value="Work Related">Work Related</option>
        </select>

      </div>
      
      <div class="col-span-2">

        <label class="block  my-auto font-semibold text-gray-900 ">Chief Compliant: </label>

        <input type="text" value="Findings in Blood Chem" name="cnsltnChiefComplaint" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
      </div>

                <div class="col-span-4">
        <h3 class=" my-auto w-full font-semibold text-gray-900 ">Laboratory: </h3>
      </div>
      <div class="ml-4 grid grid-cols-4 col-span-4 gap-1">

        <div class="col-span-2">
          <label class="block  my-auto font-semibold text-gray-900 ">Blood Chemistry: </label>
          <!-- <h3 class="w-1/4 my-auto  font-semibold text-gray-900 ">Blood Chemistry: </h3> -->
          <input type="text" value="" name="cnsltnBloodChem" id="cnsltnBloodChem" class=" w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
        </div>

        <div class=" col-span-2">
          <label class="block  my-auto font-semibold text-gray-900 ">CBC: </label>
          <input type="text" value="" name="cnsltnCbc" class=" w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
        </div>

        <div class=" col-span-2">
          <!-- <h3 class="w-1/4 my-auto  font-semibold text-gray-900 ">Urinalysis: </h3> -->
          <label class="block  my-auto font-semibold text-gray-900 ">Urinalysis: </label>
          <input type="text" value="" name="cnsltnUrinalysis" class=" w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
        </div>

        <div class=" col-span-2">
          <!-- <h3 class="w-1/4 my-auto  font-semibold text-gray-900 ">Fecalysis: </h3> -->
          <label class="block  my-auto font-semibold text-gray-900 ">Fecalysis: </label>
          <input type="text" value="" name="cnsltnFecalysis" class=" w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
        </div>

        <div class=" col-span-2">
          <!-- <h3 class="w-1/4 my-auto  font-semibold text-gray-900 ">X-ray: </h3> -->
          <label class="block  my-auto font-semibold text-gray-900 ">X-ray: </label>
          <input type="text" value="" name="cnsltnXray" class=" w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
        </div>

        <div class=" col-span-2">
          <!-- <h3 class="w-1/4 my-auto  font-semibold text-gray-900 ">Others: </h3> -->
          <label class="block  my-auto font-semibold text-gray-900 ">Others: </label>
          <input type="text" value="" name="cnsltnOthersLab" class=" w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
        </div>

        <div class="col-span-4">
          <h3 class=" my-auto w-full font-semibold text-gray-900 ">Vital Signs: </h3>
        </div>
        <div class=" col-span-4">

          <div class="grid grid-cols-3 gap-1">
            <div class="">
              <!-- <h3 class=" my-auto  font-semibold text-gray-900 ">BP: </h3> -->
              <label class="block  my-auto font-semibold text-gray-900 ">BP: </label>
              <input type="text" value="" name="cnsltnBp" class="  bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
            </div>
            <div class="">
              <!-- <h3 class=" my-auto  font-semibold text-gray-900 ">Temp: </h3> -->
              <label class="block  my-auto font-semibold text-gray-900 ">Temp: </label>
              <input type="text" value="" name="cnsltnTemp" class="  bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
            </div>
            <div class="">
              <!-- <h3 class=" my-auto  font-semibold text-gray-900 ">02 Sat: </h3> -->
              <label class="block  my-auto font-semibold text-gray-900 ">02 Sat: </label>
              <input type="text" value="" name="cnsltn02Sat" class="  bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
            </div>
            <div class="">
              <!-- <h3 class=" my-auto  font-semibold text-gray-900 ">PR: </h3> -->
              <label class="block  my-auto font-semibold text-gray-900 ">PR: </label>
              <input type="text" value="" name="cnsltnPr" class="  bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
            </div>
            <div class="">
              <!-- <h3 class=" my-auto  font-semibold text-gray-900 ">RR: </h3> -->
              <label class="block  my-auto font-semibold text-gray-900 ">RR: </label>
              <input type="text" value="" name="cnsltnRr" class="  bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
            </div>

          </div>


        </div>

      </div>
                </div>
                <button type="submit"  name="proceedToConsultation" id="proceedToConsultation1" class="w-full text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Proceed</button>
             
                
            </div>
            </div>
            </div>

            

                </div>


   





            </form>
        </div>
    </div>
</div>



