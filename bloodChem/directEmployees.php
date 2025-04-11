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










