<?php

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;



// $sampleDate = "25-Oct-02";
// $sampleDate2 = "2/21/2025";



function detectDateFormat($dateString) {
    // Define possible formats
    $formats = [
        'd-M-y',  // Example: 25-Oct-02
        'm/d/Y',  // Example: 2/21/2025
        'Y-m-d',  // Example: 2025-03-24
        'd/m/Y',  // Example: 21/02/2025
        'm-d-Y',  // Example: 02-21-2025
    ];
 
    foreach ($formats as $format) {
        $date = DateTime::createFromFormat($format, $dateString);
        if ($date !== false) { // Ensure $date is not false
            $errors = date_get_last_errors();
            if (!$errors || ($errors['warning_count'] == 0 && $errors['error_count'] == 0)) {
                return $format;
            }
        }
    }
 
    return 'Unknown Format';
}
 
// Sample data
$sampleDate = "25-Oct-25";
// $sampleDate = "2/21/2025";

$finalDateFormat = detectDateFormat($sampleDate);
// echo $finalDateFormat;
$sampleDate2 = DateTime::createFromFormat(detectDateFormat($sampleDate), $sampleDate);
$sampleDate3 = $sampleDate2 ? $sampleDate2->format('Y-m-d') : $sampleDate;
// echo $sampleDate3;



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
        window.open('../preemployment_xls.php?month=<?php echo $_SESSION['month']; ?>&year=<?php echo $_SESSION['year']; ?>&employer=<?php echo $_SESSION['employer'];?>', '_blank');
        location.href='index.php?employer='+$employer;
    </script>
<?php
}

if (isset($_POST['addPreEmployment'])) {
    $date_received = $_POST['date_received'];
    $date_performed = $_POST['date_performed'];
    $name = $_POST['name'];

    $email = $_POST['email'];
    $birthday = $_POST['birthday'];

    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $address = $_POST['address'];
    $civilStatus = $_POST['civilStatus'];
    $employer = $_POST['employer'];
    $department = $_POST['department'];
    $building = $_POST['building'];
    $position = $_POST['position'];
    $level = $_POST['level'];
    $dateHired = $_POST['dateHired'];


    $idNumber = $_POST['rfid'];
    $section = $_POST['section'];
    $imc = $_POST['imc'];
    $oeh = $_POST['oeh'];
    $pe = $_POST['pe'];
    $cbc = $_POST['cbc'];
    $ua = $_POST['ua'];
    $fa = $_POST['fa'];
    $cxr = $_POST['cxr'];
    $va = $_POST['va'];
    $den = $_POST['den'];
    $dt = $_POST['dt'];
    $pt = $_POST['pt'];
    $others = $_POST['others'];
    $followupstatus = $_POST['followupstatus'];
    $status = $_POST['status'];
    $attendee = $_POST['attendee'];
    $confirmationdate = $_POST['confirmationdate'];
    if($status !="complied"){
        $confirmationdate="";
    }
    $fmc = $_POST['fmc'];

    $addPreEmploymentGpi = "INSERT INTO `preemployment`(`dateReceived`, `datePerformed`, `name`, `section`, `IMC`, `OEH`, `PE`, `CBC`, `U_A`, `FA`, `CXR`, `VA`, `DEN`, `DT`, `PT`, `otherTest`, `followUpStatus`, `status`, `attendee`, `confirmationDate`, `FMC`, `email`, `birthday`, `age`, `sex`, `address`, `civilStatus`, `employer`, `building`, `department`, `position`, `level`, `dateHired`) VALUES ('$date_received','$date_performed','$name','$section','$imc','$oeh','$pe','$cbc','$ua','$fa','$cxr','$va', '$den', '$dt', '$pt', '$others', '$followupstatus', '$status', '$attendee', '$confirmationdate', '$fmc','$email','$birthday', '$age','$sex','$address','$civilStatus','$employer','$building','$department','$position', '$level', '$dateHired')";
    $resultInfo = mysqli_query($con, $addPreEmploymentGpi);

    if ($resultInfo) {
        echo "<script>alert('Added Successfuly!') </script>";
        echo "<script> location.href='index.php?employer=$employer'; </script>";
    }
}

if (isset($_POST['hireEmployee'])) {
    $keyid = $_POST['keyid'];
    $idNumber = $_POST['editidNumber'];
    $name = $_POST['editname'];
    $email = $_POST['editemail'];
    $birthday = $_POST['editBirthday'];

    $age = $_POST['editage'];
    $sex = $_POST['editsex'];
    $address = $_POST['editaddress'];
    $civilStatus = $_POST['editcivilStatus'];
    $employer = $_POST['editemployer'];
    $department = $_POST['editdepartment'];
    $section = $_POST['editsection'];
    $position = $_POST['editposition'];
    $level = $_POST['editlevel'];
    $dateHired = $_POST['editdateHired'];
    $building = $_POST['editbuilding'];

    
    $query = "SELECT COUNT(*) AS count FROM employeespersonalinfo WHERE idNumber = '$idNumber' AND `employer` ='$employer'";
    $result = mysqli_query($con, $query);
    if ($result === false) {
        die("Query failed: " . mysqli_error($con));
    }
    $row = mysqli_fetch_assoc($result);
    $count = (int)$row['count'];

    if($count>0){
        echo "<script>alert('Id Number is already registered!') </script>";
    }
    else{
        $addEmployeeGpi = "INSERT INTO `employeespersonalinfo`(`idNumber`, `Name`, `email`, `birthday`,`age`, `sex`, `address`, `civilStatus`, `employer`,`building`, `department`, `section`, `position`, `level`, `dateHired`) VALUES ('$idNumber','$name', '$email','$birthday', '$age','$sex','$address','$civilStatus','$employer','$building','$department','$section','$position', '$level', '$dateHired')";
        $resultInfo = mysqli_query($con, $addEmployeeGpi);
    
        if ($resultInfo) {
    
            $editEmployeeGpi = "UPDATE `preemployment` SET  `idNumber` = '$idNumber', `name`= '$name', `email`='$email', `birthday`='$birthday',`age`= '$age', `sex`= '$sex', `address`= '$address', `civilStatus`= '$civilStatus', `employer`= '$employer', `department`= '$department', `section`= '$section', `position`= '$position', `level`= '$level', `dateHired` = '$dateHired' WHERE `id`= '$keyid';";
            $resultInfo1 = mysqli_query($con, $editEmployeeGpi);
            if ($resultInfo1) {
                echo "<script>alert('Record was updated and added successfully in employees record!') </script>";
                echo "<script> location.href='index.php?employer=$employer'; </script>";
            }
            
        }
    }

   
}


if (isset($_POST['editPreEmployment'])) {
    $date_received = $_POST['editDate_received'];
    $date_performed = $_POST['editDate_performed'];
    $name = $_POST['editName'];
    $idNumber = $_POST['editRfid'];
    $section = $_POST['editSection'];
    $imc = $_POST['editImc'];
    $oeh = $_POST['editOeh'];
    $pe = $_POST['editPe'];
    $cbc = $_POST['editCbc'];
    $fa = $_POST['editFa'];
    $ua = $_POST['editUa'];
    $cxr = $_POST['editCxr'];
    $va = $_POST['editVa'];
    $den = $_POST['editDen'];
    $dt = $_POST['editDt'];
    $pt = $_POST['editPt'];
    $others = $_POST['editOthers'];
    $followupstatus = $_POST['editFollowupstatus'];
    $status = $_POST['editStatus'];
   
    $attendee = $_POST['editAttendee'];
    $confirmationdate = $_POST['editConfirmationdate'];

    if($status !="complied"){
        $confirmationdate="";
    }
    
    $fmc = $_POST['editFmc'];

    $editPreEmploymentGpi = "UPDATE `preemployment` SET `idNumber`='$idNumber', `dateReceived`='$date_received' , `datePerformed` = '$date_performed', `name`= '$name', `section`= '$section', `IMC`= '$imc', `OEH`= '$oeh', `PE`= '$pe', `CBC`= '$cbc', `U_A`= '$ua', `FA`= '$fa', `CXR`= '$cxr', `VA`= '$va', `DEN`= '$den', `DT`= '$dt', `PT`= '$pt', `otherTest`= '$others', `followUpStatus`= '$followupstatus', `status`= '$status', `attendee` = '$attendee',`confirmationDate`= '$confirmationdate', `FMC`= '$fmc' WHERE `idNumber`='$idNumber'";
    $resultInfo = mysqli_query($con, $editPreEmploymentGpi);

    if ($resultInfo) {
        echo "<script>alert('Updated Successfuly!') </script>";
        echo "<script> location.href='index.php?employer=$employer'; </script>";
    }
}

// Function to check if Id Number exists in database and save non-existent ones in an array
function isidNumberExists($con, $idNumber,$employer)
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
function saveToDatabase($con, $data, $count,$employer,$format1,$format2,$sexformat1,$sexformat2,$civilformat1,$civilformat2)
{
    // Initialize an array to collect errors
    $errorLogs = [];
    $failedData = [];
    $count1 = 0;
    foreach ($data as $row) {
        if ($count > 0) {

    
            $name = $row['0'];
            $email = $row['1'];
            $birthday = $row['2'];
            $birthdayObj = DateTime::createFromFormat(detectDateFormat($birthday), $birthday);
    $birthdayFormatted = $birthdayObj ? $birthdayObj->format('Y-m-d') : $birthday;
            $age = $row['3'];
            $sex = $row['4'];
            $sexindex = array_search($sex, $sexformat1);
            $sexcorrespondingValue = $sexformat2[$sexindex] ?? null; // Use null if index doesn't exist in $format2

            $address = $row['5'];
            $civilStatus = $row['6'];
            $civilindex = array_search($civilStatus, $civilformat1);
            $civilcorrespondingValue = $civilformat2[$civilindex] ?? null;

            // $employer = $employer;
            $building = $row['8'];
            $department = $row['9'];
            $index = array_search($department, $format1);
            $correspondingValue = $format2[$index] ?? null; // Use null if index doesn't exist in $format2
            $section = $row['10'];
            $position = $row['11'];
            $dateHired = $row['12'];
            $dateHiredObj = DateTime::createFromFormat(detectDateFormat($dateHired), $dateHired);
$dateHiredFormatted = $dateHiredObj ? $dateHiredObj->format('Y-m-d') : $dateHired;

            $dateReceived = $row['13'];
            $dateReceivedObj = DateTime::createFromFormat(detectDateFormat($dateReceived), $dateReceived);
            $dateReceivedFormatted = $dateReceivedObj ? $dateReceivedObj->format('Y-m-d') : $dateReceived;
            
            $datePerformed = $row['14'];
            $datePerformedObj = DateTime::createFromFormat(detectDateFormat($datePerformed), $datePerformed);
            $datePerformedFormatted = $datePerformedObj ? $datePerformedObj->format('Y-m-d') : $datePerformed;

            // $idNumber = $row['2'];
     
// babalikan ko to
            $IMC = $row['15'];
            $OEH = $row['16'];
            $PE = $row['17'];
            $CBC = $row['18'];
            $U_A = $row['19'];
            $FA = $row['20'];
            $CXR = $row['21'];
            $VA = $row['22'];
            $DEN = $row['23'];
            $DT = $row['24'];
            $PT = $row['25'];
            $otherTest = $row['26'];
            $followUpStatus = $row['27'];
            $status = $row['28'];
            $attendee = $row['29'];
            $confirmationDate = $row['30'];
            $FMC = $row['31'];

            // Check if Id Number exists in db_table
            // if (!isidNumberExists($con, $idNumber, $employer)) {
            //     // Log error for non-existent Id Numbers
            //     $errorLogs[] = "$idNumber, ";
            //     array_push($failedData, [$dateReceivedFormatted, $datePerformedFormatted, $idNumber, $IMC, $OEH, $PE, $CBC, $U_A, $FA, $CXR, $VA, $DEN, $DT, $PT, $otherTest, $followUpStatus, $status, $attendee, $confirmationDate, $FMC]); 

            //     continue; // Skip saving this row
            // }

            // If validation passes, save to database
            // $result = mysqli_query($con, "SELECT `Name`, `section` FROM `employeespersonalinfo` WHERE `idNumber` = '$idNumber' AND `employer` ='$employer'");
            // while ($userRow = mysqli_fetch_assoc($result)) {
            //     $name = $userRow['Name'];
            //     $section = $userRow['section'];

            //     $result1 = mysqli_query($con, "SELECT * FROM `preemployment` WHERE `idNumber` = '$idNumber'");
            //     $numrows = mysqli_num_rows($result1);
            //     if ($numrows > 0) {
            //         $addPreEmploymentGpi = "UPDATE `preemployment` SET `dateReceived` = '$dateReceived', `datePerformed` = '$datePerformed', `name`='$name', `section`='$section', `IMC` = '$IMC', `OEH`='$OEH', `PE` = '$PE', `CBC` ='$CBC', `U_A` = '$U_A', `FA`='$FA', `CXR` ='$CXR', `VA`='$VA', `DEN`='$DEN', `DT`='$DT', `PT` = '$PT', `otherTest` = '$otherTest', `followUpStatus` = '$followUpStatus', `status`='$status', `attendee`='$attendee', `confirmationDate`='$confirmationDate', `FMC`='$FMC' WHERE `idNumber` = '$idNumber'";
            //         $resultInfo = mysqli_query($con, $addPreEmploymentGpi);
            //     } else {
            //         $addPreEmploymentGpi = "INSERT INTO `preemployment`(`dateReceived`, `datePerformed`, `idNumber`, `name`, `section`, `IMC`, `OEH`, `PE`, `CBC`, `U_A`, `FA`, `CXR`, `VA`, `DEN`, `DT`, `PT`, `otherTest`, `followUpStatus`, `status`, `attendee`,`confirmationDate`, `FMC`) VALUES ('$dateReceived','$datePerformed','$idNumber','$name','$section','$IMC','$OEH','$PE','$CBC','$U_A','$FA','$CXR', '$VA', '$DEN', '$DT', '$PT', ' $otherTest', ' $followUpStatus', '$status', '$attendee','$confirmationDate', '$FMC')";
            //         $resultInfo = mysqli_query($con, $addPreEmploymentGpi);
            //     }
            // }

           

            try {
                $addPreEmploymentGpi = "INSERT INTO `preemployment`(`dateReceived`, `datePerformed`, `name`, `section`, `IMC`, `OEH`, `PE`, `CBC`, `U_A`, `FA`, `CXR`, `VA`, `DEN`, `DT`, `PT`, `otherTest`, `followUpStatus`, `status`, `attendee`,`confirmationDate`, `FMC`, `email`, `birthday`, `age`, `sex`, `address`, `civilStatus`, `employer`, `building`, `department`, `position`, `level`, `dateHired`) VALUES ('$dateReceivedFormatted','$datePerformedFormatted','$name','$section','$IMC','$OEH','$PE','$CBC','$U_A','$FA','$CXR', '$VA', '$DEN', '$DT', '$PT', ' $otherTest', ' $followUpStatus', '$status', '$attendee','$confirmationDate', '$FMC','$email','$birthdayFormatted', '$age','$sexcorrespondingValue','$address','$civilcorrespondingValue','$employer','$building','$correspondingValue','$position','employee', '$dateHiredFormatted')";
                $resultInfo = mysqli_query($con, $addPreEmploymentGpi);
    
    
                // Check if query execution was successful
                // if ($resultInfo === false) {
                //     $errorLogs[] = "Failed to insert data for applicant '$name': " . mysqli_error($con);
                //     array_push($failedData, [$dateReceivedFormatted, $datePerformedFormatted, $IMC, $OEH, $PE, $CBC, $U_A, $FA, $CXR, $VA, $DEN, $DT, $PT, $otherTest, $followUpStatus, $status, $attendee, $confirmationDate, $FMC]); 
    
                // }
            
                if ($resultInfo) {
                    $count1++;
                    // Success message (optional)
                    // echo "<script>alert('Data imported and saved successfully!');</script>";
                }
            } catch (mysqli_sql_exception $e) {
                // Catch the exception and get the error message
                $error = $e->getMessage();
                // Display the error in an alert


                echo "<script>alert('Error: " . addslashes($error) . "');</script>";
                array_push($failedData, [$name,$email,$birthdayFormatted,$age,$sexcorrespondingValue,$address,$civilcorrespondingValue,$employer,$building,$correspondingValue,$section,$position,$dateHiredFormatted,$dateReceivedFormatted, $datePerformedFormatted, $IMC, $OEH, $PE, $CBC, $U_A, $FA, $CXR, $VA, $DEN, $DT, $PT, $otherTest, $followUpStatus, $status, $attendee, $confirmationDate, $FMC]);
                // $failedData .= "<tr>";
                // $failedData .= "\n<td>$idNumber</td>";
                // $failedData .= "\n<td>$name</td>";
                // $failedData .= "\n<td>$email</td>";
                // $failedData .= "\n<td>$birthday</td>";
                // $failedData .= "\n<td>$age</td>";
                // $failedData .= "\n<td>$sexcorrespondingValue</td>";
                // $failedData .= "\n<td>$address</td>";
                // $failedData .= "\n<td>$civilcorrespondingValue</td>";
                // $failedData .= "\n<td>$employer</td>";
                // $failedData .= "\n<td>$building</td>";
                // $failedData .= "\n<td>$correspondingValue</td>";
                // $failedData .= "\n<td>$section</td>";
                // $failedData .= "\n<td>$position</td>";
                // $failedData .= "\n<td>$dateHired</td>";
                // $failedData .= "</tr>";


                
            }
        }
        $count = 1;
    }

    // Return error logs array
    return [
        'count1' => $count1,
        'errorLogs' => $errorLogs,
        'failedData' => $failedData
    ];
}

// Main script to import Excel and process data
if (isset($_POST['addPreEmploymentImport'])) {

    $failedData  = [];


    $format1 = explode(',', $_POST['departmentFormat1']);
    $format2 = explode(',', $_POST['departmentFormat2']);
    $format2 = array_map('trim', $format2);

    $sexformat1 = explode(',', $_POST['sexFormat1']);
    $sexformat2 = explode(',', $_POST['sexFormat2']);
    $sexformat2 = array_map('trim', $sexformat2);

    $civilformat1 = explode(',', $_POST['civilFormat1']);
    $civilformat2 = explode(',', $_POST['civilFormat2']);
    $civilformat2 = array_map('trim', $civilformat2);


    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowed_ext = ['xls', 'csv', 'xlsx'];
    if (in_array($file_ext, $allowed_ext)) {
        $count = 0;
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();
        $highestRow = $spreadsheet->getActiveSheet()->getHighestRow();

        try {
            // Save data to database and collect error logs
            $result = saveToDatabase($con, $data, $count,$employer,$format1,$format2,$sexformat1,$sexformat2,$civilformat1,$civilformat2);
            $errorLogs = $result['errorLogs'];
            $failedData = $result['failedData'];
            $count1 = $result['count1'];

            $unsuccessfullcount =  $highestRow - $count1 - 1;
            echo "<script>alert('There are $count1 successfully imported and $unsuccessfullcount unsuccessful!');</script>";
    $_SESSION['failedData'] = $failedData;
    echo "<script> location.href='failedDataFromImportingPreEmp.php'; </script>";

            // Close database connection
            // mysqli_close($con);

            // Output success or error messages
            // $errorLogsMessage ='';
            // $error1 = '';
            // if (empty($errorLogs)) {
            //     echo "<script>alert('Data imported and saved successfully.!') </script>";
            // } else {
                
            //     // echo "Errors occurred during import:<br>";
                
            //     foreach ($errorLogs as $error) {
            //         // echo "$error";
            //         $error1 .= "$error";
            //         // echo "asdasd",$error1;

            //     }
            //     // echo $error1;
            //     echo "<script>alert ('Errors occurred during import: Id number/s $error1 not found in the employees list.')</script>";
            //     $_SESSION['failedData'] = $failedData;
            //     echo "<script> location.href='failedDataFromImportingPreEmp.php'; </script>";
            //     // echo "<script> location.href='index.php?employer=$employer'; </script>";

            // }
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
        <p class="mb-2 my-auto"><span class=" self-center text-md font-semibold whitespace-nowrap   text-[#193F9F]">Pre-employment Records - <?php echo $employer ; ?> Employees</span></p>
        <div class="flex items-center order-2">
        <button type="button" data-modal-target="exportPreEmp" data-modal-toggle="exportPreEmp" class="lg:block text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2 mx-3 md:mx-2">Export</button>

        <button type="button" data-dropdown-toggle="options"class="lg:block text-white bg-gradient-to-r from-[#00669B] to-[#9AC1CA] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300  font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2 ">Add</button>
        <div id="options" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
            <ul class="py-2  text-gray-700 dark:text-gray-200" aria-labelledby="options">
                <li>
                    <a type="button" data-modal-target="addPreEmpDirectEmployees" data-modal-toggle="addPreEmpDirectEmployees" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Add Pre-Employment</a>
                </li>
                <li>
                    <a type="button" data-modal-target="importPreEmployment" data-modal-toggle="importPreEmployment" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Import Data</a>
                </li>
                <li>
                    <a type="button" onclick="exportTemplate()" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Export Template</a>
                </li>

            </ul>

        </div>
        </div>
        <!-- <a href="ticketForm.php" type="button" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800  rounded-lg  px-5 py-2.5 text-center me-2 mb-2">Create a Ticket</a> -->
       
    </div>

    <div id="" class="">
        <div class=" p-4 rounded-lg  bg-gray-50 " id="headApproval" role="tabpanel" aria-labelledby="profile-tab">
            <form action="index.php" method="post">
                <section class="mt-2 2xl:mt-10">
                    <table id="queTable" class="display text-[9px] 2xl:text-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Action</th>
                                <th>Employment Status</th>
                                <th>Date received </th>
                                <th>Date performed </th>
                                <th>Name </th>
                                <th>Section </th>
                                <th>IMC</th>
                                <th>OEH</th>
                                <th>PE</th>
                                <th>CBC</th>
                                <th>UA</th>
                                <th>FA</th>
                                <th>CXR</th>
                                <th>VA</th>
                                <th>DEN</th>
                                <th>DT</th>
                                <th>PT</th>
                                <th>Others</th>
                                <th>Follow up Status</th>
                                <th>Status</th>
                                <th>Compliance Date</th>
                                <th>FMC</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $preEmpNo = 1;
                            $sql = "SELECT p.*, e.Name 
FROM preemployment p  
LEFT JOIN employeespersonalinfo e ON p.idNumber = e.idNumber 
WHERE (p.employer = '$employer')
ORDER BY p.id ASC;
";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $preEmpNo; ?></td>
                                    <!-- <td> <button type="button" onclick="openEditEmployee(this)" data-rfid="<?php echo $row['idNumber']; ?>" data-name="<?php echo $row['Name']; ?>" data-section="<?php echo $row['section']; ?>" data-date_received="<?php echo $row['dateReceived']; ?>" data-date_performed="<?php echo $row['datePerformed']; ?>" data-imc="<?php echo $row['IMC']; ?>" data-oeh="<?php echo $row['OEH']; ?>" data-pe="<?php echo $row['PE']; ?>" data-cbc="<?php echo $row['CBC']; ?>" data-ua="<?php echo $row['U_A']; ?>" data-fa="<?php echo $row['FA']; ?>" data-cxr="<?php echo $row['CXR']; ?>" data-va="<?php echo $row['VA']; ?>" data-den="<?php echo $row['DEN']; ?>" data-dt="<?php echo $row['DT']; ?>" data-pt="<?php echo $row['PT']; ?>" data-others="<?php echo $row['otherTest']; ?>" data-followupstatus="<?php echo $row['followUpStatus']; ?>" data-status="<?php echo $row['status']; ?>" data-attendee="<?php echo $row['attendee']; ?>" data-confirmationdate="<?php echo $row['confirmationDate']; ?>" data-fmc="<?php echo $row['FMC']; ?>" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</button></td> -->
                                    <td>
                                        <div class="content-center flex flex-wrap justify-center gap-2">
                                            <input type="text" class="hidden" name="rfid<?php echo $preEmpNo; ?>" value="<?php echo $row['id']; ?>">
                                            <button id="dropdownMenuIconButton<?php echo $preEmpNo; ?>" data-dropdown-toggle="dropdownDots<?php echo $preEmpNo; ?>" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900  rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 bg-white dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                                    <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                                </svg>
                                            </button>


                                        </div>
                                        <!-- Dropdown menu -->
                                        <div id="dropdownDots<?php echo $preEmpNo; ?>" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-2 text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton<?php echo $preEmpNo; ?>">
                                                <li>
                                                    <a type="button" onclick="openEditEmployee(this)" data-rfid="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-section="<?php echo $row['section']; ?>" data-date_received="<?php echo $row['dateReceived']; ?>" data-date_performed="<?php echo $row['datePerformed']; ?>" data-imc="<?php echo $row['IMC']; ?>" data-oeh="<?php echo $row['OEH']; ?>" data-pe="<?php echo $row['PE']; ?>" data-cbc="<?php echo $row['CBC']; ?>" data-ua="<?php echo $row['U_A']; ?>" data-fa="<?php echo $row['FA']; ?>" data-cxr="<?php echo $row['CXR']; ?>" data-va="<?php echo $row['VA']; ?>" data-den="<?php echo $row['DEN']; ?>" data-dt="<?php echo $row['DT']; ?>" data-pt="<?php echo $row['PT']; ?>" data-others="<?php echo $row['otherTest']; ?>" data-followupstatus="<?php echo $row['followUpStatus']; ?>" data-status="<?php echo $row['status']; ?>" data-attendee="<?php echo $row['attendee']; ?>" data-confirmationdate="<?php echo $row['confirmationDate']; ?>" data-fmc="<?php echo $row['FMC']; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit Pre-Employment Record</a>
                                                </li>
                                                <li> 
                                                    <a type="button" onclick="openHireEmployee(this)"
                                                    data-rfid="<?php echo $row['id']; ?>"
                                                    data-building="<?php echo $row['building'] ?>" 
                                                    data-name="<?php echo $row['name'] ?>" data-email="<?php echo $row['email'] ?>" data-age="<?php echo $row['age'] ?>" data-birthday="<?php echo $row['birthday'] ?>"  data-sex="<?php echo $row['sex'] ?>" data-address="<?php echo $row['address'] ?>" data-civilstatus="<?php echo $row['civilStatus'] ?>" data-employer="<?php echo $row['employer'] ?>" data-department="<?php echo $row['department'] ?>" data-section="<?php echo $row['section'] ?>" data-position="<?php echo $row['position'] ?>" data-level="<?php echo $row['level'] ?>" data-datehired="<?php echo $row['dateHired'] ?>" 
                                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                                    >Hire Employee</a>
                                                </li>

                                            </ul>

                                        </div>
                                    </td>
                                    <td><?php if($row['idNumber'] != null){echo "Hired";} ?></td>

                                    <td><?php echo $row['dateReceived'] ?></td>
                                    <td><?php echo $row['datePerformed'] ?></td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['section'] ?></td>
                                    <td><?php echo $row['IMC'] ?></td>
                                    <td><?php echo $row['OEH'] ?></td>
                                    <td><?php echo $row['PE'] ?></td>
                                    <td><?php echo $row['CBC'] ?></td>
                                    <td><?php echo $row['U_A'] ?></td>
                                    <td><?php echo $row['FA'] ?></td>
                                    <td><?php echo $row['CXR'] ?></td>
                                    <td><?php echo $row['VA'] ?></td>
                                    <td><?php echo $row['DEN'] ?></td>
                                    <td><?php echo $row['DT'] ?></td>
                                    <td><?php echo $row['PT'] ?></td>
                                    <td><?php echo $row['otherTest'] ?></td>
                                    <td><?php echo $row['followUpStatus'] ?></td>
                                    <td><?php echo $row['status'] ?></td>
                                    <td><?php echo $row['confirmationDate'] ?></td>
                                    <td><?php echo $row['FMC'] ?></td>
                                </tr>
                            <?php $preEmpNo++;
                            } ?>
                        </tbody>
                    </table>
                </section>
            </form>
        </div>
    </div>

</div>


<div id="addPreEmpDirectEmployees" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
<div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class=" font-semibold text-gray-900 dark:text-white">
                    Add Pre-Employment Record
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="addPreEmpDirectEmployees">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form method="POST">
            <div class="text-[9px] 2xl:text-lg  rounded-lg bg-white/50 grid grid-cols-4 gap-1 w-full w-full p-4 ">
                <div class="col-span-4 gap-4 mb-4">
                        <label for="name" class="block mb-1  text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " >
                        <!-- <select id="name" name="name" class="js-employees bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                            <option selected disabled>Search Name</option>
                            <?php
                            $sql1 = "SELECT * FROM employeespersonalinfo e WHERE e.employer = '$employer' AND e.idNumber NOT IN (SELECT p.idNumber FROM preemployment p);";
                            $result = mysqli_query($con, $sql1);
                            while ($list = mysqli_fetch_assoc($result)) {
                                $idNumber = $list["idNumber"];
                                $name = $list["Name"];
                                $section = $list["section"]; ?>
                                <option value="<?php echo  $name; ?>" data-rfid="<?php echo  $idNumber; ?>" data-section="<?php echo  $section; ?>"> <?php echo  $name; ?> </option> <?php
                                                                                                                                                                                } ?>
                        </select> -->
                    </div>
                    <div  class="content-center  col-span-2 hidden">
                        <label for="rfid" class="block mb-1  text-gray-900 dark:text-white">ID Number</label>
                        <input type="text" name="rfid" id="rfid" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " >
                    </div>
                    <div class="col-span-2">
                        <label for="email" class="block mb-1  text-gray-900 dark:text-white">Email</label>
                        <input type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="birthday" class="block mb-1  text-gray-900 dark:text-white">Birthday</label>
                        <input type="date" name="birthday" id="birthday" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="age" class="block mb-1  text-gray-900 dark:text-white">Age</label>
                        <input type="number" name="age" id="age" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="sex" class="block mb-1  text-gray-900 dark:text-white">Sex</label>
                        <select id="sex" name="sex" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected disabled>Select Sex</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="address" class="block mb-1  text-gray-900 dark:text-white">Address</label>
                        <input type="text" name="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                    </div>
                    <div class=" col-span-2 grid gap-2 grid-cols-3">
                    <div class="col-span-1 sm:col-span-1">
                        <label for="civilStatus" class="block mb-1  text-gray-900 dark:text-white">Civil Status</label>
                        <select id="civilStatus" name="civilStatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected disabled>Select Status</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="divorced">Divorced</option>
                            <option value="annulled">Annulled</option>
                            <option value="widowed">Widowed</option>

                        </select>
                    </div>
                    <div class="col-span-1 sm:col-span-1">
                        <label for="employer" class="block mb-1  text-gray-900 dark:text-white">Employer</label>
                        <input type="text" name="employer" value="<?php echo $employer; ?>" id="employer" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>
                    <div class="col-span-1 sm:col-span-1">
                        <label for="employer" class="block mb-1  text-gray-900 dark:text-white">Building</label>
                        <input type="text" name="building" value="" placeholder="1" id="building" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="department" class="block mb-1  text-gray-900 dark:text-white">Department</label>
                        <select id="department" name="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected disabled>Select Department</option>
                            <?php
                          
                            $sql = "SELECT * FROM `department` ORDER BY `department` ASC;";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {

                            ?>
                            <option value="<?php echo $row['department'];?>"><?php echo $row['department'];?> </option>
                            <?php }?>

                        </select>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="section" class="block mb-1  text-gray-900 dark:text-white">Section</label>
                        <input type="text" name="section" id="section" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="position" class="block mb-1  text-gray-900 dark:text-white">Position</label>
                        <input type="text" name="position" id="position" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="level" class="block mb-1  text-gray-900 dark:text-white">Level</label>
                        <select id="level" name="level" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected disabled>Select Level</option>
                            <option value="employee">Employee</option>

                            <option value="head">Head / Leader</option>
                            <option value="hr">HR</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="dateHired" class="block mb-1  text-gray-900 dark:text-white">Date Hired</label>
                        <input type="date" name="dateHired" id="dateHired" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                    </div>
                    <!-- <div  class="content-center  col-span-4">
                        <label for="section" class="block mb-1  text-gray-900 dark:text-white">Section</label>
                        <input type="text" name="section" id="section" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                    </div> -->
                    <div  class="content-center  col-span-2">
                        <label for="date_received" class="block mb-1  text-gray-900 dark:text-white">Date Received</label>
                        <input type="date" name="date_received" id="date_received" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg"placeholder="" required="">
                    </div>
                    <div  class="content-center  col-span-2">
                        <label for="date_performed" class="block mb-1  text-gray-900 dark:text-white">Date Performed</label>
                        <input type="date" name="date_performed" id="date_performed" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div  class="content-center  col-span-2">
                        <label for="imc" class="block mb-1  text-gray-900 dark:text-white">IMC</label>
                        <input type="text" name="imc" id="imc" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg"placeholder=" " required="">
                    </div>
                    <div  class="content-center  col-span-2">
                        <label for="oeh" class="block mb-1  text-gray-900 dark:text-white">OEH</label>
                        <input type="text" name="oeh" id="oeh" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div  class="content-center  col-span-2">
                        <label for="pe" class="block mb-1  text-gray-900 dark:text-white">PE</label>
                        <input type="text" name="pe" id="pe" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div  class="content-center  col-span-2">
                        <label for="cbc" class="block mb-1  text-gray-900 dark:text-white">CBC</label>
                        <input type="text" name="cbc" id="cbc" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div  class="content-center  col-span-2">
                        <label for="ua" class="block mb-1  text-gray-900 dark:text-white">U/A</label>
                        <input type="text" name="ua" id="ua" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div  class="content-center  col-span-2">
                        <label for="fa" class="block mb-1  text-gray-900 dark:text-white">FA</label>
                        <input type="text" name="fa" id="fa" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div  class="content-center  col-span-2">
                        <label for="cxr" class="block mb-1  text-gray-900 dark:text-white">CXR</label>
                        <input type="text" name="cxr" id="cxr" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div  class="content-center  col-span-2">
                        <label for="va" class="block mb-1  text-gray-900 dark:text-white">VA</label>
                        <input type="text" name="va" id="va" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div  class="content-center  col-span-2">
                        <label for="den" class="block mb-1  text-gray-900 dark:text-white">DEN</label>
                        <input type="text" name="den" id="den" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div  class="content-center  col-span-2">
                        <label for="dt" class="block mb-1  text-gray-900 dark:text-white">DT</label>
                        <input type="text" name="dt" id="dt" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div  class="content-center  col-span-2">
                        <label for="pt" class="block mb-1  text-gray-900 dark:text-white">PT</label>
                        <input type="text" name="pt" id="pt" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div  class="content-center  col-span-2">
                        <label for="others" class="block mb-1  text-gray-900 dark:text-white">Others</label>
                        <input type="text" name="others" id="others" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder="" >
                    </div>
                    <div class="col-span-4">
                        <label for="followupstatus" class="block mb-1  text-gray-900 dark:text-white">Follow up status</label>
                        <textarea name="followupstatus" id="followupstatus" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder="" ></textarea>
                    </div>
                    <div  class="content-center  col-span-4">
                        <label for="attendee" class="block mb-1  text-gray-900 dark:text-white">Attendee</label>
                        <input type="text" name="attendee" id="attendee" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder="Nurse/Doctor" >
                    </div>
                  
                    <div class="col-span-2">
                        <label for="status" class="block mb-1  text-gray-900 dark:text-white">Status</label>
                        <select name="status" id="status" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder="" >
                            <option  selected value="">Select status</option>
                            <option value="pending">Pending</option>
                            <option value="complied">Complied</option>
                        </select>

                    </div>
                    <div id="compliancediv" class="content-center  col-span-2">
                        <label for="confirmationdate" class="block mb-1  text-gray-900 dark:text-white">Compliance Date</label>
                        <input type="date" name="confirmationdate" id="confirmationdate" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder="" >
                    </div>
                    
                    <div class="col-span-4 gap-4">
                        <label for="fmc" class="block mb-1  text-gray-900 dark:text-white">FMC</label>
                        <input type="text" name="fmc" id="fmc" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder="" >
                    </div>
               
                <div class="col-span-4 justify-center flex gap-2">
                <button type="submit" name="addPreEmployment" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Add Pre Employment
                </button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="equivalentValues" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Choose Equivalent Values
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="equivalentValues">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
            <div class="grid grid-cols-2">
    <div class="flex justify-center border border-gray-300 font-bold">Your Format</div> 
    <div class="flex justify-center border border-gray-300 font-bold">Equivalent</div>
    <div class="flex border border-gray-300">Sex</div>    <div class="flex border border-gray-300">Sex</div>
    <div class="col-span-2 grid grid-cols-2" id="sexDiv">   </div>
    <div class="flex border border-gray-300">Civil Status</div>    <div class="flex border border-gray-300">Civil Status</div>
    <div class="col-span-2 grid grid-cols-2" id="civilDiv">   </div>
    <div class="flex border border-gray-300">Department</div> <div class="flex border border-gray-300">Department</div>
    <div class="col-span-2 grid grid-cols-2" id="departmentDiv">
    <!-- <div class="flex justify-center border border-gray-300">PI</div> <div class="flex justify-center border border-gray-300">Parts Inspection</div>
    <div class="flex justify-center border border-gray-300">Admin</div> <div class="flex justify-center border border-gray-300">Administration</div> -->
    </div>
    
</div>


            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button id="proceedButton" type="button"  data-modal-hide="equivalentValues" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Proceed</button>
            </div>
        </div>
    </div>
</div>



<div id="importPreEmployment" tabindex="-1" aria-hidden="true" class=" hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-2 border-b rounded-t dark:border-gray-600">
                <h3 class=" font-semibold text-gray-900 dark:text-white">
                    Import Pre-Employment Record
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="importPreEmployment">
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

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file (.CSV ONLY)</label>
                        <input type="file" accept=".csv" name="import_file" class="block w-full  text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input">

                        <input type="text" name="departmentFormat1" class="hidden" id="departmentFormat1">
                        <input type="text" name="departmentFormat2" class="hidden" id="departmentFormat2">

                        <input type="text" name="sexFormat1" class="hidden" id="sexFormat1">
                        <input type="text" name="sexFormat2" class="hidden" id="sexFormat2">

                        <input type="text" name="civilFormat1" class="hidden" id="civilFormat1">
                        <input type="text" name="civilFormat2" class="hidden" id="civilFormat2">

                    </div>


                </div>
                <button data-modal-target="equivalentValues" data-modal-toggle="equivalentValues" type="button" id="proceedImportButton" name="proceedImportButton"  class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Proceed
                    <svg class="me-1 -ms-1 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
</svg>
                </button>
                <button type="submit" id="addPreEmploymentImport" name="addPreEmploymentImport" class="hidden text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Import Data
                </button>
            </form>
        </div>
    </div>
</div>


<div id="editPreEmployment" tabindex="-1" aria-hidden="true" class="bg-[#615eae59] hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit Pre-Employment Record
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editPreEmployment">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form method="POST">
                <div class="text-[9px] 2xl:text-lg  rounded-lg bg-white/50 grid grid-cols-4 gap-1 w-full w-full p-4 ">
                    <div class="col-span-4 gap-4">
                        <label for="editName" class="block mb-1  text-gray-900 dark:text-white">Name</label>
                        <input id="editName" name="editName"  class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
                    </div>
                    <div  class="content-center  col-span-2 hidden">
                        <label for="editRfid" class="block mb-1  text-gray-900 dark:text-white">ID Number</label>
                        <input type="text" name="editRfid" id="editRfid" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                    </div>
                    <div class="content-center  col-span-4">
                        <label for="editSection" class="block mb-1  text-gray-900 dark:text-white">Section</label>
                        <input type="text" name="editSection" id="editSection" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editDate_received" class="block mb-1  text-gray-900 dark:text-white">Date Received</label>
                        <input type="date" name="editDate_received" id="editDate_received" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editDate_performed" class="block mb-1  text-gray-900 dark:text-white">Date Performed</label>
                        <input type="date" name="editDate_performed" id="editDate_performed" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" " >
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editImc" class="block mb-1  text-gray-900 dark:text-white">IMC</label>
                        <input type="text" name="editImc" id="editImc" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" " >
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editOeh" class="block mb-1  text-gray-900 dark:text-white">OEH</label>
                        <input type="text" name="editOeh" id="editOeh" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" " >
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editPe" class="block mb-1  text-gray-900 dark:text-white">PE</label>
                        <input type="text" name="editPe" id="editPe" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" " >
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editCbc" class="block mb-1  text-gray-900 dark:text-white">CBC</label>
                        <input type="text" name="editCbc" id="editCbc" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" " >
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editUa" class="block mb-1  text-gray-900 dark:text-white">U/A</label>
                        <input type="text" name="editUa" id="editUa" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" " >
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editFa" class="block mb-1  text-gray-900 dark:text-white">FA</label>
                        <input type="text" name="editFa" id="editFa" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" " >
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editCxr" class="block mb-1  text-gray-900 dark:text-white">CXR</label>
                        <input type="text" name="editCxr" id="editCxr" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" " >
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editVa" class="block mb-1  text-gray-900 dark:text-white">VA</label>
                        <input type="text" name="editVa" id="editVa" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" " >
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editDen" class="block mb-1  text-gray-900 dark:text-white">DEN</label>
                        <input type="text" name="editDen" id="editDen" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" " >
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editDt" class="block mb-1  text-gray-900 dark:text-white">DT</label>
                        <input type="text" name="editDt" id="editDt" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" " >
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editPt" class="block mb-1  text-gray-900 dark:text-white">PT</label>
                        <input type="text" name="editPt" id="editPt" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" " >
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editOthers" class="block mb-1  text-gray-900 dark:text-white">Others</label>
                        <input type="text" name="editOthers" id="editOthers" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="">
                    </div>
                    <div class="col-span-4">
                        <label for="editFollowupstatus" class="block mb-1  text-gray-900 dark:text-white">Follow up status</label>
                        <textarea name="editFollowupstatus" id="editFollowupstatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=""></textarea>
                    </div>
                    <div class="content-center  col-span-4">
                        <label for="editAttendee" class="block mb-1  text-gray-900 dark:text-white">Attendee</label>
                        <input type="text" name="editAttendee" id="editAttendee" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="Nurse/Doctor" >
                    </div>
                    <div  class="col-span-2">
                        <label for="editStatus" class="block mb-1  text-gray-900 dark:text-white">Status</label>
                        <select name="editStatus" id="editStatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="" >
                            <option disabled selected>Select status</option>
                            <option value="pending">Pending</option>
                            <option value="complied">Complied</option>
                        </select>

                    </div>
                   
           
                    <div  class="content-center  col-span-2" id="editComplianceDiv">
                        <label for="editConfirmationdate" class="block mb-1  text-gray-900 dark:text-white">Compliance Date</label>
                        <input type="date" name="editConfirmationdate" id="editConfirmationdate" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="" >
                    </div>
                    <div class="col-span-4 gap-4">
                        <label for="editFmc" class="block mb-1  text-gray-900 dark:text-white">FMC</label>
                        <input type="text" name="editFmc" id="editFmc" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="" >
                    </div>
               
                <div class="col-span-4 justify-center flex gap-2">
                        <button type="submit" name="editPreEmployment" class="w-64 text-white bg-gradient-to-r from-[#00669B]  to-[#9AC1CA] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300  shadow-lg shadow-teal-500/50  font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2">Update Record</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="exportPreEmp" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" data-modal-toggle="exportPreEmp" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Export Pre-Employment</h3>
                <form class="space-y-6" action="" method="POST">
                    <div>
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
                    
                    <button type="submit" name="excelReport" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Generate Excel
                    </button>


                </form>
            </div>
        </div>
    </div>
</div>



<div id="editEmployee" tabindex="-1" aria-hidden="true" class="bg-[#615eae59] hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Hire this employee
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editEmployee">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->

            <form method="POST" class="px-4 md:px-5 py-2 text-[8pt]">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <!-- <div class="col-span-2">
                        <label for="editrfid" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Number</label>
                        <input type="text" name="editrfid" id="editrfid" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                    </div> -->
                    <input type="text" id="keyid" name="keyid" class="hidden">
                    <div class="col-span-2">
                        <label for="editidNumber" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Id Number</label>
                        <input type="text" name="editidNumber" id="editidNumber" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                    </div>
                    <div class="col-span-2">
                        <label for="editname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="editname" id="editname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                    </div>
                    <div class="col-span-2">
                        <label for="editemail" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="text" name="editemail" id="editemail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                    </div>
                    <div class="col-span-2">
                        <label for="editBirthday" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthday</label>
                        <input type="date" name="editBirthday" id="editBirthday" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="editage" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Age</label>
                        <input type="number" name="editage" id="editage" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="editsex" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sex</label>
                        <select id="editsex" name="editsex" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="editaddress" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                        <input type="text" name="editaddress" id="editaddress" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                    </div>
   
                    <div class="gap-2 col-span-2 grid grid-cols-3 ">
                    <div class="col-span-1 sm:col-span-1">
                        <label for="editcivilStatus" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Civil Status</label>
                        <select id="editcivilStatus" name="editcivilStatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="divorced">Divorced</option>
                            <option value="annulled">Annulled</option>
                            <option value="widowed">Widowed</option>
                        </select>
                    </div>
                    <div class="col-span-1 sm:col-span-1">
                        <label for="editemployer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Employer</label>
                        <input type="text" name="editemployer" id="editemployer" value="<?php echo $employer; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" readonly>
                    </div>
                    <div class="col-span-1 sm:col-span-1">
                        <label for="editbuilding" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Building</label>
                        <input type="text" name="editbuilding"  id="editbuilding" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="editdepartment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
                        <select id="editdepartment" name="editdepartment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="Accounting">Accounting</option>
                            <option value="Administration">Administration</option>
                            <option value="ICT">ICT</option>
                            <option value="Direct Operation Kaizen">Direct Operation Kaizen</option>
                            <option value="Parts Inspection">Parts Inspection</option>
                            <option value="Parts Production">Parts Production</option>
                            <option value="PPIC">PPIC</option>
                            <option value="Production 1">Production 1</option>
                            <option value="Production 2">Production 2</option>
                            <option value="Production Support">Production Support</option>
                            <option value="Production Technolog">Production Technology</option>
                            <option value="Purchasing">Purchasing</option>
                            <option value="Quality Assurance">Quality Assurance</option>
                            <option value="Quality Control">Quality Control</option>

                        </select>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="editsection" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Section</label>
                        <input type="text" name="editsection" id="editsection" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="editposition" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Position</label>
                        <input type="text" name="editposition" id="editposition" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="editlevel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Level</label>
                        <select id="editlevel" name="editlevel" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option value="employee">Employee</option>    
                        <option value="head">Head</option>
                            <option value="hr">HR</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="editdateHired" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Hired</label>
                        <input type="date" name="editdateHired" id="editdateHired" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                    </div>
                </div>

                <button type="submit" name="hireEmployee" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Update and Hire
                </button>
            </form>
        </div>
    </div>
</div>


<script src="../node_modules/jquery/dist/jquery.min.js"></script>
<script>


const editEmployee1 = document.getElementById('editEmployee');

    // options with default values
    const editemployees1 = {

        backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 relative inset-0 z-40',
        closable: true,
        onHide: () => {
            console.log('modal is hidden');
        },
        onShow: () => {
            console.log('modal is shown');
        },
        onToggle: () => {
            console.log('modal has been toggled');
        },
    };

    // instance options object
    const instanceeditemployee = {
        id: 'modalEl',
        override: true
    };

    const modalEdit1 = new Modal(editEmployee1, editemployees1);

    function openHireEmployee(element) {
        modalEdit1.toggle();
       document.getElementById("keyid").value = element.getAttribute("data-rfid");
        // document.getElementById("editidNumber").value = element.getAttribute("data-idnumber");
        document.getElementById("editname").value = element.getAttribute("data-name");
        document.getElementById("editemail").value = element.getAttribute("data-email");
        document.getElementById("editage").value = element.getAttribute("data-age");
        document.getElementById("editsex").value = element.getAttribute("data-sex");
        document.getElementById("editaddress").value = element.getAttribute("data-address");
        document.getElementById("editcivilStatus").value = element.getAttribute("data-civilstatus");
        document.getElementById("editemployer").value = element.getAttribute("data-employer");
        document.getElementById("editdepartment").value = element.getAttribute("data-department");
        document.getElementById("editbuilding").value = element.getAttribute("data-building");
        document.getElementById("editsection").value = element.getAttribute("data-section");
        document.getElementById("editposition").value = element.getAttribute("data-position");
        document.getElementById("editlevel").value = element.getAttribute("data-level");
        document.getElementById("editdateHired").value = element.getAttribute("data-datehired");
        document.getElementById("editBirthday").value = element.getAttribute("data-birthday");

    }


    $(document).ready(function() {
        $('#name').change(function() {
            var selectedRfid = $(this).find('option:selected').data('rfid');
            $('#rfid').val(selectedRfid);
            var selectedSection = $(this).find('option:selected').data('section');
            $('#section').val(selectedSection);
            console.log(selectedRfid);
            console.log(selectedSection);
        });
    });


    const editEmployee = document.getElementById('editPreEmployment');

    // options with default values
    const editemployees = {

        backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 relative inset-0 z-40',
        closable: true,
        onHide: () => {
            console.log('modal is hidden');
        },
        onShow: () => {
            console.log('modal is shown');
        },
        onToggle: () => {
            console.log('modal has been toggled');
        },
    };

    const modalEdit = new Modal(editEmployee, editemployees);

    function openEditEmployee(element) {
        modalEdit.toggle();
        // document.getElementById("editRfid").value = element.getAttribute("data-rfid");
        document.getElementById("editName").value = element.getAttribute("data-name");
        document.getElementById("editSection").value = element.getAttribute("data-section");
        document.getElementById("editDate_received").value = element.getAttribute("data-date_received");
        document.getElementById("editDate_performed").value = element.getAttribute("data-date_performed");
        document.getElementById("editImc").value = element.getAttribute("data-imc");
        document.getElementById("editOeh").value = element.getAttribute("data-oeh");
        document.getElementById("editPe").value = element.getAttribute("data-pe");
        document.getElementById("editCbc").value = element.getAttribute("data-cbc");
        document.getElementById("editUa").value = element.getAttribute("data-ua");
        document.getElementById("editPe").value = element.getAttribute("data-pe");
        document.getElementById("editFa").value = element.getAttribute("data-fa");
        document.getElementById("editCxr").value = element.getAttribute("data-cxr");
        document.getElementById("editVa").value = element.getAttribute("data-va");
        document.getElementById("editDen").value = element.getAttribute("data-den");
        document.getElementById("editDt").value = element.getAttribute("data-dt");
        document.getElementById("editPt").value = element.getAttribute("data-pt");
        document.getElementById("editOthers").value = element.getAttribute("data-others");
        document.getElementById("editFollowupstatus").value = element.getAttribute("data-followupstatus");
        document.getElementById("editStatus").value = element.getAttribute("data-status");
        document.getElementById("editAttendee").value = element.getAttribute("data-attendee");
        document.getElementById("editConfirmationdate").value = element.getAttribute("data-confirmationdate");
        document.getElementById("editFmc").value = element.getAttribute("data-fmc");

        if ($("#editStatus").val() == "complied") {
    $("#editComplianceDiv").removeClass("hidden");
    editconfirmationdate.required = true;
  }else{
    $("#editComplianceDiv").addClass("hidden");
    editconfirmationdate.removeAttribute('required');

  }
    }

    document.getElementById("employer").addEventListener("keydown", function(event) {
        event.preventDefault(); // Prevent typing into the input field
    });

    function exportTemplate() {

        var rows = [];
         column1 = 'Name';
         column2 = 'Email';
         column3 = 'Birthday';
         column4 = 'Age';
         column5 = 'Sex';
         column6 = 'Address';
         column7 = 'Civil Status';
         column8 = 'Employer';
         column9 = 'Building';
         column10 = 'Department';
         column11 = 'Section';
         column12 = 'Position';
         column13 = 'Date Hired';
         column14 = 'Date Received';
         column15 = 'Date Performed';
         column17 = 'IMC';
         column18 = 'OEH';
         column19 = 'PE';
         column20 = 'CBC';
         column21 = 'U/A';
         column22 = 'FA';
         column23 = 'CXR';
         column24 = 'VA';
         column25 = 'DEN';
         column26 = 'DT';
         column27 = 'PT';
         column28 = 'Other Test';
         column29 = 'Follow Up Status';
         column30 = 'Status';
         column31 = 'Attendee';
         column32 = 'Compliance Date';
         column33 = 'FMC';

        rows.push(
            [
            column1,
            column2,
            column3,
            column4,
            column5,
            column6,
            column7,
            column8,
            column9,
            column10,
            column11,
            column12,
            column13,
            column14,
            column15,
            column17,
            column18,
            column19,
            column20,
            column21,
            column22,
            column23,
            column24,
            column25,
            column26,
            column27,
            column28,
            column29,
            column30,
            column31,
            column32,
            column33,
         
            ]
        );

        for (var i = 0, row; i < 1; i++) {
            column1 = '';
            column2 = '';
            column3 = "";
            column4 = '';
            column5 = '';
            column6 = '';
            column7 = '';
            column8 = '';
            column9 = '';
            column10 = '';
            column11 = '';
            column12 = '';
            column13 = '';
            column14 = '';
            column15 = '';
            column17 = '';
            column18 = '';
            column19 = '';
            column20 = '';
            column21 = '';
            column22 = '';
            column23 = '';
            column24 = '';
            column25 = '';
            column26 = '';
            column27 = '';
            column28 = '';
            column29 = '';
            column30 = '';
            column31 = '';
            column32 = '';
            column33 = '';

            rows.push(
                [
                    column1,
                    column2,
                    column3,
                    column4,
                    column5,
                    column6,
                    column7,
                    column8,
                    column9,
                    column10,
                    column11,
                    column12,
                    column13,
                    column14,
                    column15,
                    column17,
                    column18,
                    column19,
                    column20,
                    column21,
                    column22,
                    column23,
                    column24,
                    column25,
                    column26,
                    column27,
                    column28,
                    column29,
                    column30,
                    column31,
                    column32,
                    column33,
                ]
            );

        }
        csvContent = "data:text/csv;charset=utf-8,";
        /* add the column delimiter as comma(,) and each row splitted by new line character (\n) */
        rows.forEach(function(rowArray) {
            row = rowArray.join('","');
            row = '"' + row + '"';
            csvContent += row + "\r\n";
        });

        /* create a hidden <a> DOM node and set its download attribute */
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "<?php echo $employer;?> Pre-Employment Template.csv");
        document.body.appendChild(link);
        /* download the data file named "Stock_Price_Report.csv" */
        link.click();
    }
</script>