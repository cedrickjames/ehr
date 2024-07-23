<?php

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


if (isset($_POST['addPreEmployment'])) {
    $date_received = $_POST['date_received'];
    $date_performed = $_POST['date_performed'];
    $name = $_POST['name'];
    $rfid = $_POST['rfid'];
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
    $fmc = $_POST['fmc'];

    $addPreEmploymentAlarm = "INSERT INTO `preemployment`(`dateReceived`, `datePerformed`, `rfidNumber`, `name`, `section`, `IMC`, `OEH`, `PE`, `CBC`, `U_A`, `FA`, `CXR`, `VA`, `DEN`, `DT`, `PT`, `otherTest`, `followUpStatus`, `status`, `attendee`, `confirmationDate`, `FMC`) VALUES ('$date_received','$date_performed','$rfid','$name','$section','$imc','$oeh','$pe','$cbc','$ua','$fa','$cxr','$va', '$den', '$dt', '$pt', '$others', '$followupstatus', '$status', '$attendee','$confirmationdate', '$fmc')";
    $resultInfo = mysqli_query($con, $addPreEmploymentAlarm);

    if ($resultInfo) {
        echo "<script>alert('Added Successfuly!') </script>";
        echo "<script> location.href='alarm.php'; </script>";
    }
}

if (isset($_POST['editPreEmployment'])) {
    $date_received = $_POST['editDate_received'];
    $date_performed = $_POST['editDate_performed'];
    $name = $_POST['editName'];
    $rfid = $_POST['editRfid'];
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
    $fmc = $_POST['editFmc'];

    $editPreEmploymentAlarm = "UPDATE `preemployment`SET `dateReceived`='$date_received' , `datePerformed` = '$date_performed', `name`= '$name', `section`= '$section', `IMC`= '$imc', `OEH`= '$oeh', `PE`= '$pe', `CBC`= '$cbc', `U_A`= '$ua', `FA`= '$fa', `CXR`= '$cxr', `VA`= '$va', `DEN`= '$den', `DT`= '$dt', `PT`= '$pt', `otherTest`= '$others', `followUpStatus`= '$followupstatus', `status`= '$status', `attendee` = '$attendee',`confirmationDate`= '$confirmationdate', `FMC`= '$fmc' WHERE `rfidNumber`='$rfid'";
    $resultInfo = mysqli_query($con, $editPreEmploymentAlarm);

    if ($resultInfo) {
        echo "<script>alert('Updated Successfuly!') </script>";
        echo "<script> location.href='alarm.php'; </script>";
    }
}

// Function to check if RFID number exists in database and save non-existent ones in an array
function isRfidNumberExists($con, $rfidNumber)
{
    // Escape the RFID number to prevent SQL injection (assuming $con is your mysqli connection)
    $rfidNumber = mysqli_real_escape_string($con, $rfidNumber);

    // Query to check if RFID number exists
    $query = "SELECT COUNT(*) AS count FROM employeespersonalinfo WHERE rfidNumber = '$rfidNumber' AND `employer` ='Alarm'";
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

    // Return true if count > 0 (RFID exists), false otherwise
    return $count > 0;
}

// Function to save data to database
function saveToDatabase($con, $data, $count)
{
    // Initialize an array to collect errors
    $errorLogs = [];

    foreach ($data as $row) {
        if ($count > 0) {
            $dateReceived = $row['0'];
            $datePerformed = $row['1'];
            $rfidNumber = $row['2'];
            $IMC = $row['3'];
            $OEH = $row['4'];
            $PE = $row['5'];
            $CBC = $row['6'];
            $U_A = $row['7'];
            $FA = $row['8'];
            $CXR = $row['9'];
            $VA = $row['10'];
            $DEN = $row['11'];
            $DT = $row['12'];
            $PT = $row['13'];
            $otherTest = $row['14'];
            $followUpStatus = $row['15'];
            $status = $row['16'];
            $attendee = $row['17'];
            $confirmationDate = $row['18'];
            $FMC = $row['19'];

            // Check if RFID number exists in db_table
            if (!isRfidNumberExists($con, $rfidNumber)) {
                // Log error for non-existent RFID numbers
                $errorLogs[] = "RFID number '$rfidNumber' not found in Employee List";
                continue; // Skip saving this row
            }

            // If validation passes, save to database
            $result = mysqli_query($con, "SELECT `Name`, `section` FROM `employeespersonalinfo` WHERE `rfidNumber` = '$rfidNumber' AND `employer` ='Alarm'");
            while ($userRow = mysqli_fetch_assoc($result)) {
                $name = $userRow['Name'];
                $section = $userRow['section'];

                $result1 = mysqli_query($con, "SELECT * FROM `preemployment` WHERE `rfidNumber` = '$rfidNumber'");
                $numrows = mysqli_num_rows($result1);
                if ($numrows > 0) {
                    $addPreEmploymentAlarm = "UPDATE `preemployment` SET `dateReceived` = '$dateReceived', `datePerformed` = '$datePerformed', `name`='$name', `section`='$section', `IMC` = '$IMC', `OEH`='$OEH', `PE` = '$PE', `CBC` ='$CBC', `U_A` = '$U_A', `FA`='$FA', `CXR` ='$CXR', `VA`='$VA', `DEN`='$DEN', `DT`='$DT', `PT` = '$PT', `otherTest` = '$otherTest', `followUpStatus` = '$followUpStatus', `status`='$status', `attendee`='$attendee', `confirmationDate`='$confirmationDate', `FMC`='$FMC' WHERE `rfidNumber` = '$rfidNumber'";
                    $resultInfo = mysqli_query($con, $addPreEmploymentAlarm);
                } else {
                    $addPreEmploymentAlarm = "INSERT INTO `preemployment`(`dateReceived`, `datePerformed`, `rfidNumber`, `name`, `section`, `IMC`, `OEH`, `PE`, `CBC`, `U_A`, `FA`, `CXR`, `VA`, `DEN`, `DT`, `PT`, `otherTest`, `followUpStatus`, `status`, `attendee`,`confirmationDate`, `FMC`) VALUES ('$dateReceived','$datePerformed','$rfidNumber','$name','$section','$IMC','$OEH','$PE','$CBC','$U_A','$FA','$CXR', '$VA', '$DEN', '$DT', '$PT', ' $otherTest', ' $followUpStatus', '$status', '$attendee','$confirmationDate', '$FMC')";
                    $resultInfo = mysqli_query($con, $addPreEmploymentAlarm);
                }
            }

            // Check if query execution was successful
            if ($resultInfo === false) {
                $errorLogs[] = "Failed to insert data for RFID number '$rfidNumber': " . mysqli_error($con);
            }
        }
        $count = 1;
    }

    // Return error logs array
    return $errorLogs;
}

// Main script to import Excel and process data
if (isset($_POST['addPreEmploymentImport'])) {
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
        <p class="mb-2 my-auto"><span class=" self-center text-md font-semibold whitespace-nowrap   text-[#193F9F]">Pre-employment Records - Alarm Employees</span></p>

        <button type="button" data-dropdown-toggle="options" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800  rounded-lg  px-5 py-2.5 text-center me-2 mb-2">Options</button>
        <div id="options" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
            <ul class="py-2  text-gray-700 dark:text-gray-200" aria-labelledby="options">
                <li>
                    <a type="button" data-modal-target="addPreEmpAlarmEmployees" data-modal-toggle="addPreEmpAlarmEmployees" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Add Pre-Employment</a>
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

    <div id="" class="">
        <div class=" p-4 rounded-lg  bg-gray-50 " id="headApproval" role="tabpanel" aria-labelledby="profile-tab">
            <form action="index.php" method="post">
                <section class="mt-2 2xl:mt-10">
                    <table id="queTable" class="display text-[9px] 2xl:text-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Employer</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $queNo = 1;
                            $sql = "SELECT p.*, e.employer, e.Name, e.section, e.rfidNumber FROM employeespersonalinfo e JOIN preemployment p ON e.rfidNumber = p.rfidNumber WHERE e.employer = 'Alarm'";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {

                            ?> <tr>
                                    <td> <?php echo $queNo; ?> </td>
                                    <td> <?php echo $row['Name']; ?> </td>
                                    <td><?php echo $row['employer']; ?> </td>
                                    <td>
                                        <div class="content-center flex flex-wrap justify-center gap-2">
                                            <input type="text" class="hidden" name="rfid<?php echo $queNo; ?>" value="<?php echo $row['rfidNumber']; ?>">
                                            <button id="dropdownMenuIconButton<?php echo $queNo; ?>" data-dropdown-toggle="dropdownDots<?php echo $queNo; ?>" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900  rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 bg-white dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                                    <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                                </svg>
                                            </button>


                                        </div>
                                        <!-- Dropdown menu -->
                                        <div id="dropdownDots<?php echo $queNo; ?>" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-2 text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton<?php echo $queNo; ?>">
                                                <li>
                                                    <a type="button" onclick="openEditEmployee(this)" data-rfid="<?php echo $row['rfidNumber']; ?>" data-name="<?php echo $row['Name']; ?>" data-section="<?php echo $row['section']; ?>" data-date_received="<?php echo $row['dateReceived']; ?>" data-date_performed="<?php echo $row['datePerformed']; ?>" data-imc="<?php echo $row['IMC']; ?>" data-oeh="<?php echo $row['OEH']; ?>" data-pe="<?php echo $row['PE']; ?>" data-cbc="<?php echo $row['CBC']; ?>" data-ua="<?php echo $row['U_A']; ?>" data-fa="<?php echo $row['FA']; ?>" data-cxr="<?php echo $row['CXR']; ?>" data-va="<?php echo $row['VA']; ?>" data-den="<?php echo $row['DEN']; ?>" data-dt="<?php echo $row['DT']; ?>" data-pt="<?php echo $row['PT']; ?>" data-others="<?php echo $row['otherTest']; ?>" data-followupstatus="<?php echo $row['followUpStatus']; ?>" data-status="<?php echo $row['status']; ?>" data-attendee="<?php echo $row['attendee']; ?>" data-confirmationdate="<?php echo $row['confirmationDate']; ?>" data-fmc="<?php echo $row['FMC']; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit Pre-Employment Record</a>
                                                </li>

                                            </ul>

                                        </div>
                                    </td>

                                </tr> <?php

                                        $queNo++;
                                    }
                                        ?>

                        </tbody>
                    </table>
                </section>
            </form>
        </div>
    </div>

</div>


<div id="addPreEmpAlarmEmployees" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-2 border-b rounded-t dark:border-gray-600">
                <h3 class=" font-semibold text-gray-900 dark:text-white">
                    Add Pre-Employment Record
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="addPreEmpAlarmEmployees">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form method="POST" class="px-4 md:px-5 py-2 text-[8pt]">
                <div class="grid gap-2 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block mb-1  text-gray-900 dark:text-white">Name</label>
                        <select id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected disabled>Search Name</option>
                            <?php
                            $sql1 = "SELECT * FROM employeespersonalinfo e WHERE e.employer = 'Alarm' AND e.rfidNumber NOT IN (SELECT p.rfidNumber FROM preemployment p);";
                            $result = mysqli_query($con, $sql1);
                            while ($list = mysqli_fetch_assoc($result)) {
                                $rfid = $list["rfidNumber"];
                                $name = $list["Name"];
                                $section = $list["section"]; ?>
                                <option value="<?php echo  $name; ?>" data-rfid="<?php echo  $rfid; ?>" data-section="<?php echo  $section; ?>"> <?php echo  $name; ?> </option> <?php
                                                                                                                                                                                } ?>
                        </select>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="rfid" class="block mb-1  text-gray-900 dark:text-white">RFID</label>
                        <input type="text" name="rfid" id="rfid" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="section" class="block mb-1  text-gray-900 dark:text-white">Section</label>
                        <input type="text" name="section" id="section" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="date_received" class="block mb-1  text-gray-900 dark:text-white">Date Received</label>
                        <input type="date" name="date_received" id="date_received" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="date_performed" class="block mb-1  text-gray-900 dark:text-white">Date Performed</label>
                        <input type="date" name="date_performed" id="date_performed" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2">
                        <label for="imc" class="block mb-1  text-gray-900 dark:text-white">IMC</label>
                        <input type="text" name="imc" id="imc" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="oeh" class="block mb-1  text-gray-900 dark:text-white">OEH</label>
                        <input type="text" name="oeh" id="oeh" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="pe" class="block mb-1  text-gray-900 dark:text-white">PE</label>
                        <input type="text" name="pe" id="pe" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="cbc" class="block mb-1  text-gray-900 dark:text-white">CBC</label>
                        <input type="text" name="cbc" id="cbc" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="ua" class="block mb-1  text-gray-900 dark:text-white">U/A</label>
                        <input type="text" name="ua" id="ua" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="fa" class="block mb-1  text-gray-900 dark:text-white">FA</label>
                        <input type="text" name="fa" id="fa" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="cxr" class="block mb-1  text-gray-900 dark:text-white">CXR</label>
                        <input type="text" name="cxr" id="cxr" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="va" class="block mb-1  text-gray-900 dark:text-white">VA</label>
                        <input type="text" name="va" id="va" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="den" class="block mb-1  text-gray-900 dark:text-white">DEN</label>
                        <input type="text" name="den" id="den" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="dt" class="block mb-1  text-gray-900 dark:text-white">DT</label>
                        <input type="text" name="dt" id="dt" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="pt" class="block mb-1  text-gray-900 dark:text-white">PT</label>
                        <input type="text" name="pt" id="pt" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2">
                        <label for="others" class="block mb-1  text-gray-900 dark:text-white">Others</label>
                        <input type="text" name="others" id="others" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="followupstatus" class="block mb-1  text-gray-900 dark:text-white">Follow up status</label>
                        <input type="text" name="followupstatus" id="followupstatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="status" class="block mb-1  text-gray-900 dark:text-white">Status</label>
                        <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                            <option disabled selected>Select status</option>
                            <option value="pending">Pending</option>
                            <option value="complied">Complied</option>
                        </select>

                    </div>
                    <div class="col-span-2">
                        <label for="attendee" class="block mb-1  text-gray-900 dark:text-white">Attendee</label>
                        <input type="text" name="attendee" id="attendee" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nurse/Doctor" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="confirmationdate" class="block mb-1  text-gray-900 dark:text-white">Confirmation Date</label>
                        <input type="date" name="confirmationdate" id="confirmationdate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="fmc" class="block mb-1  text-gray-900 dark:text-white">FMC</label>
                        <input type="text" name="fmc" id="fmc" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                    </div>
                </div>
                <button type="submit" name="addPreEmployment" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Add Pre Employment
                </button>
            </form>
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

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
                        <input type="file" name="import_file" class="block w-full  text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input">

                    </div>


                </div>
                <button type="submit" name="addPreEmploymentImport" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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
    <div class="relative p-4 w-full max-w-md max-h-full">
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
            <form method="POST" class="px-4 md:px-5 py-2 text-[8pt]">
                <div class="grid gap-2 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="editName" class="block mb-1  text-gray-900 dark:text-white">Name</label>
                        <input id="editName" name="editName" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" readonly>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="editRfid" class="block mb-1  text-gray-900 dark:text-white">RFID</label>
                        <input type="text" name="editRfid" id="editRfid" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" readonly>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="editSection" class="block mb-1  text-gray-900 dark:text-white">Section</label>
                        <input type="text" name="editSection" id="editSection" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" readonly>
                    </div>
                    <div class="col-span-2">
                        <label for="editDate_received" class="block mb-1  text-gray-900 dark:text-white">Date Received</label>
                        <input type="date" name="editDate_received" id="editDate_received" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="editDate_performed" class="block mb-1  text-gray-900 dark:text-white">Date Performed</label>
                        <input type="date" name="editDate_performed" id="editDate_performed" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2">
                        <label for="editImc" class="block mb-1  text-gray-900 dark:text-white">IMC</label>
                        <input type="text" name="editImc" id="editImc" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="editOeh" class="block mb-1  text-gray-900 dark:text-white">OEH</label>
                        <input type="text" name="editOeh" id="editOeh" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="editPe" class="block mb-1  text-gray-900 dark:text-white">PE</label>
                        <input type="text" name="editPe" id="editPe" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="editCbc" class="block mb-1  text-gray-900 dark:text-white">CBC</label>
                        <input type="text" name="editCbc" id="editCbc" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="editUa" class="block mb-1  text-gray-900 dark:text-white">U/A</label>
                        <input type="text" name="editUa" id="editUa" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="editFa" class="block mb-1  text-gray-900 dark:text-white">FA</label>
                        <input type="text" name="editFa" id="editFa" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="editCxr" class="block mb-1  text-gray-900 dark:text-white">CXR</label>
                        <input type="text" name="editCxr" id="editCxr" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="editVa" class="block mb-1  text-gray-900 dark:text-white">VA</label>
                        <input type="text" name="editVa" id="editVa" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="editDen" class="block mb-1  text-gray-900 dark:text-white">DEN</label>
                        <input type="text" name="editDen" id="editDen" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="editDt" class="block mb-1  text-gray-900 dark:text-white">DT</label>
                        <input type="text" name="editDt" id="editDt" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="editPt" class="block mb-1  text-gray-900 dark:text-white">PT</label>
                        <input type="text" name="editPt" id="editPt" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=" " required="">
                    </div>
                    <div class="col-span-2">
                        <label for="editOthers" class="block mb-1  text-gray-900 dark:text-white">Others</label>
                        <input type="text" name="editOthers" id="editOthers" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="editFollowupstatus" class="block mb-1  text-gray-900 dark:text-white">Follow up status</label>
                        <input type="text" name="editFollowupstatus" id="editFollowupstatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="editStatus" class="block mb-1  text-gray-900 dark:text-white">Status</label>
                        <select name="editStatus" id="editStatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                            <option disabled selected>Select status</option>
                            <option value="pending">Pending</option>
                            <option value="complied">Complied</option>
                        </select>

                    </div>
                    <div class="col-span-2">
                        <label for="editAttendee" class="block mb-1  text-gray-900 dark:text-white">Attendee</label>
                        <input type="text" name="editAttendee" id="editAttendee" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nurse/Doctor" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="editConfirmationdate" class="block mb-1  text-gray-900 dark:text-white">Confirmation Date</label>
                        <input type="date" name="editConfirmationdate" id="editConfirmationdate" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="editFmc" class="block mb-1  text-gray-900 dark:text-white">FMC</label>
                        <input type="text" name="editFmc" id="editFmc" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                    </div>
                </div>
                <button type="submit" name="editPreEmployment" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Update Pre Employment
                </button>
            </form>
        </div>
    </div>
</div>

<script src="../node_modules/jquery/dist/jquery.min.js"></script>
<script>
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
        document.getElementById("editRfid").value = element.getAttribute("data-rfid");
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
    }

    document.getElementById("employer").addEventListener("keydown", function(event) {
        event.preventDefault(); // Prevent typing into the input field
    });

    function exportTemplate() {

        var rows = [];

        column1 = 'Date Received';
        column2 = 'Date Performed';
        column3 = 'RFID Number';
        column4 = 'IMC';
        column5 = 'OEH';
        column6 = 'PE';
        column7 = 'CBC';
        column8 = 'U/A';
        column9 = 'FA';
        column10 = 'CXR';
        column11 = 'VA';
        column12 = 'DEN';
        column13 = 'DT';
        column14 = 'PT';
        column15 = 'Other Test';
        column16 = 'Follow Up Status';
        column17 = 'Status';
        column18 = 'Attendee';
        column19 = 'Confirmation Date';
        column20 = 'FMC';

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
                column16,
                column17,
                column18,
                column19,
                column20,
            ]
        );

        for (var i = 0, row; i < 1; i++) {
            column1 = '';
            column2 = '';
            column3 = "Change format to 'Text'";
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
            column16 = '';
            column17 = '';
            column18 = '';
            column19 = '';
            column20 = '';
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
                    column16,
                    column17,
                    column18,
                    column19,
                    column20,
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
        link.setAttribute("download", "Alarm Pre-Employment Template.csv");
        document.body.appendChild(link);
        /* download the data file named "Stock_Price_Report.csv" */
        link.click();
    }
</script>