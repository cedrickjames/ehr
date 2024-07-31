<?php

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


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
    $rfid = $_POST['rfid'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $type = $_POST['type'];
    $building = $_POST['building_transaction'];
    $diagnosis = $_POST['diagnosis'];
    $intervention = $_POST['intervention'];
    $Meds = $_POST['ftwMeds'];
    $followupdate = $_POST['followupdate'];
    $remarks = $_POST['remarks'];
    $fbs = $_POST['fbs'];
    $cholesterol = $_POST['cholesterol'];
    $triglycerides = $_POST['triglycerides'];
    $hdl = $_POST['hdl'];
    $ldl = $_POST['ldl'];
    $bun = $_POST['bun'];
    $bua = $_POST['bua'];
    $sgpt = $_POST['sgpt'];
    $sgdt = $_POST['sgdt'];
    $hbaic = $_POST['hbaic'];
    $others = $_POST['others'];

    if ($Meds != "") {
        $Meds = implode(', ', $Meds);
    }

    $addBloodChem = "INSERT INTO `bloodchem`(`rfid`, `date`, `time`, `building`, `type`, `diagnosis`, `intervention`, `medications`, `followupdate`, `FBS`, `cholesterol`, `triglycerides`, `HDL`, `LDL`, `BUN`, `BUA`, `SGPT`, `SGDT`, `HBA1C`, `others`, `remarks`) VALUES ('$rfid','$date','$time','$type','$building','$diagnosis','$intervention','$Meds','$followupdate','$remarks','$fbs','$cholesterol','$triglycerides', '$hdl', '$ldl', '$bun', '$bua', '$sgpt', '$sgdt', '$hbaic', '$others')";
    $resultInfo = mysqli_query($con, $addBloodChem);

    if ($resultInfo) {
        echo "<script>alert('Added Successfuly!') </script>";
        echo "<script> location.href='index.php'; </script>";
    }
}

if (isset($_POST['editBloodChem'])) {
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


    $editPreEmploymentGpi = "UPDATE `bloodchem`SET `dateReceived`='$date_received' , `datePerformed` = '$date_performed', `name`= '$name', `section`= '$section', `IMC`= '$imc', `OEH`= '$oeh', `PE`= '$pe', `CBC`= '$cbc', `U_A`= '$ua', `FA`= '$fa', `CXR`= '$cxr', `VA`= '$va', `DEN`= '$den', `DT`= '$dt', `PT`= '$pt', `otherTest`= '$others', `followUpStatus`= '$followupstatus', `status`= '$status', `attendee` = '$attendee',`confirmationDate`= '$confirmationdate', `FMC`= '$fmc' WHERE `rfidNumber`='$rfid'";
    $resultInfo = mysqli_query($con, $editPreEmploymentGpi);

    if ($resultInfo) {
        echo "<script>alert('Updated Successfuly!') </script>";
        echo "<script> location.href='index.php'; </script>";
    }
}

// Function to check if RFID number exists in database and save non-existent ones in an array
function isRfidNumberExists($con, $rfidNumber)
{
    // Escape the RFID number to prevent SQL injection (assuming $con is your mysqli connection)
    $rfidNumber = mysqli_real_escape_string($con, $rfidNumber);

    // Query to check if RFID number exists
    $query = "SELECT COUNT(*) AS count FROM employeespersonalinfo WHERE rfidNumber = '$rfidNumber' AND `employer` ='GPI'";
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
            $result = mysqli_query($con, "SELECT `Name`, `section` FROM `employeespersonalinfo` WHERE `rfidNumber` = '$rfidNumber' AND `employer` ='GPI'");
            while ($userRow = mysqli_fetch_assoc($result)) {
                $name = $userRow['Name'];
                $section = $userRow['section'];

                $result1 = mysqli_query($con, "SELECT * FROM `bloodchem` WHERE `rfidNumber` = '$rfidNumber'");
                $numrows = mysqli_num_rows($result1);
                if ($numrows > 0) {
                    $addBloodChem = "UPDATE `bloodchem` SET `dateReceived` = '$dateReceived', `datePerformed` = '$datePerformed', `name`='$name', `section`='$section', `IMC` = '$IMC', `OEH`='$OEH', `PE` = '$PE', `CBC` ='$CBC', `U_A` = '$U_A', `FA`='$FA', `CXR` ='$CXR', `VA`='$VA', `DEN`='$DEN', `DT`='$DT', `PT` = '$PT', `otherTest` = '$otherTest', `followUpStatus` = '$followUpStatus', `status`='$status', `attendee`='$attendee', `confirmationDate`='$confirmationDate', `FMC`='$FMC' WHERE `rfidNumber` = '$rfidNumber'";
                    $resultInfo = mysqli_query($con, $addBloodChem);
                } else {
                    $addBloodChem = "INSERT INTO `bloodchem`(`dateReceived`, `datePerformed`, `rfidNumber`, `name`, `section`, `IMC`, `OEH`, `PE`, `CBC`, `U_A`, `FA`, `CXR`, `VA`, `DEN`, `DT`, `PT`, `otherTest`, `followUpStatus`, `status`, `attendee`,`confirmationDate`, `FMC`) VALUES ('$dateReceived','$datePerformed','$rfidNumber','$name','$section','$IMC','$OEH','$PE','$CBC','$U_A','$FA','$CXR', '$VA', '$DEN', '$DT', '$PT', ' $otherTest', ' $followUpStatus', '$status', '$attendee','$confirmationDate', '$FMC')";
                    $resultInfo = mysqli_query($con, $addBloodChem);
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
        <p class="mb-2 my-auto"><span class=" self-center text-md font-semibold whitespace-nowrap   text-[#193F9F]">HLP Records - Direct Employees</span></p>
        <div class="flex items-center order-2">
            <button type="button" data-modal-target="exportBloodChem" data-modal-toggle="exportBloodChem" class="lg:block text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2 mx-3 md:mx-2">Export</button>

            <button type="button" data-dropdown-toggle="options" class="lg:block text-white bg-gradient-to-r from-[#00669B] to-[#9AC1CA] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300  font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2 ">Add</button>
            <div id="options" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-2  text-gray-700 dark:text-gray-200" aria-labelledby="options">
                    <li>
                        <a type="button" data-modal-target="addBloodChem" data-modal-toggle="addBloodChem" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Add HLP </a>
                    </li>
                    <li>
                        <a type="button" data-modal-target="importAnnualPe" data-modal-toggle="importAnnualPe" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Import Data</a>
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
                                <th>Date</th>
                                <th>Time</th>
                                <th>Building Transaction</th>
                                <th>Name</th>
                                <th>Section </th>
                                <th>Department</th>
                                <th>Building</th>
                                <th>Employer</th>
                                <th>Gender</th>
                                <th>Type</th>
                                <th>Diagnosis</th>
                                <th>Intervention</th>
                                <th>Medicine</th>
                                <th>Follow-up Date</th>
                                <th>Remarks</th>
                                <th>Laboratory</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ApeNo = 1;
                            $sql = "SELECT p.*, e.employer, e.Name, e.section, e.department,e.building, e.rfidNumber , e.sex, p.building AS bldg_transaction FROM bloodchem p 
                                    JOIN employeespersonalinfo e ON e.rfidNumber = p.rfid WHERE e.employer = 'GPI' ORDER BY `id` ASC";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $ApeNo; ?></td>
                                    <td>
                                        <div class="content-center flex flex-wrap justify-center gap-2">
                                            <input type="text" class="hidden" name="rfid<?php echo $ApeNo; ?>" value="<?php echo $row['rfidNumber']; ?>">
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
                                                    <a type="button" onclick="openEditEmployee(this)" data-rfid="<?php echo $row['rfidNumber']; ?>" data-name="<?php echo $row['Name']; ?>" data-section="<?php echo $row['section']; ?>" data-date="<?php echo $row['date']; ?>" data-time="<?php echo $row['time']; ?>" data-building_transaction="<?php echo $row['bldg_transaction']; ?>" data-type="<?php echo $row['type']; ?>" data-diagnosis="<?php echo $row['diagnosis']; ?>" data-intervention="<?php echo $row['intervention']; ?>" data-medications="<?php echo $row['medications']; ?>" data-followupdate="<?php echo $row['followupdate']; ?>" data-FBS="<?php echo $row['FBS']; ?>" data-cholesterol="<?php echo $row['cholesterol']; ?>" data-triglycerides="<?php echo $row['triglycerides']; ?>" data-HDL="<?php echo $row['HDL']; ?>" data-LDL="<?php echo $row['LDL']; ?>" data-BUN="<?php echo $row['BUN']; ?>" data-BUA="<?php echo $row['BUA']; ?>" data-SGPT="<?php echo $row['SGPT']; ?>" data-SGDT="<?php echo $row['SGDT']; ?>" data-HBA1C="<?php echo $row['HBA1C']; ?>" data-others="<?php echo $row['others']; ?>" data-remarks="<?php echo $row['remarks']; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit HLP Record</a>
                                                </li>

                                            </ul>

                                        </div>
                                    </td>
                                    <td><?php echo $row['date'] ?></td>
                                    <td><?php echo $row['time'] ?></td>
                                    <td><?php echo $row['bldg_transaction'] ?></td>
                                    <td><?php echo $row['Name'] ?></td>
                                    <td><?php echo $row['section'] ?></td>
                                    <td><?php echo $row['department'] ?></td>
                                    <td><?php echo $row['building'] ?></td>
                                    <td><?php echo $row['employer'] ?></td>
                                    <td><?php echo $row['sex'] ?></td>
                                    <td><?php echo $row['type'] ?></td>
                                    <td><?php echo $row['diagnosis'] ?></td>
                                    <td><?php echo $row['intervention'] ?></td>
                                    <td><?php echo $row['medications'] ?></td>
                                    <td><?php echo $row['followupdate'] ?></td>
                                    <td><?php echo $row['remarks'] ?></td>
                                    <td> <?php

                                            if ($row['FBS'] != "") {
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
                                            if ($row['BUA'] != "") {
                                                echo "BUA: " . $row['BUA'] . " ";
                                            }
                                            if ($row['SGPT'] != "") {
                                                echo "SGPT: " . $row['SGPT'] . " ";
                                            }
                                            if ($row['SGDT'] != "") {
                                                echo "SGDT: " . $row['SGDT'] . " ";
                                            }
                                            if ($row['HBA1C'] != "") {
                                                echo "HBA1C: " . $row['HBA1C'] . " ";
                                            }
                                            if ($row['others'] != "") {
                                                echo "others: " . $row['others'] . " ";
                                            }
                                            ?> </td>

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

<div id="addBloodChem" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class=" font-semibold text-gray-900 dark:text-white">
                    Add HLP Record
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="addBloodChem">
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
                        <label for="name" class="block mb-1 font-semibold text-gray-900 dark:text-white">Name</label>
                        <select id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                            <option selected disabled>Search Name</option>
                            <?php
                            $sql1 = "SELECT * FROM employeespersonalinfo e WHERE e.employer = 'GPI' AND e.rfidNumber NOT IN (SELECT p.rfid FROM bloodchem p);";
                            $result = mysqli_query($con, $sql1);
                            while ($list = mysqli_fetch_assoc($result)) {
                                $rfid = $list["rfidNumber"];
                                $name = $list["Name"];
                                $section = $list["section"]; ?>
                                <option value="<?php echo  $name; ?>" data-rfid="<?php echo  $rfid; ?>" data-section="<?php echo  $section; ?>"> <?php echo  $name; ?> </option> <?php
                                                                                                                                                                                } ?>
                        </select>
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="rfid" class="block mb-1 font-semibold text-gray-900 dark:text-white">RFID</label>
                        <input type="text" name="rfid" id="rfid" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="section" class="block mb-1 font-semibold text-gray-900 dark:text-white">Section</label>
                        <input type="text" name="section" id="section" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="date" class="block mb-1 font-semibold text-gray-900 dark:text-white">Date</label>
                        <input type="date" name="date" id="date" value="<?php echo date('Y-m-d'); ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="time" class="block mb-1 font-semibold text-gray-900 dark:text-white">Time</label>
                        <input type="text" name="time" id="time" value="<?php echo date('h:i A'); ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" ">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="type" class="block mb-1 font-semibold text-gray-900 dark:text-white">Type</label>
                        <select name="type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                            <option value="Initial">Initial</option>
                            <option value="Follow up">Follow up</option>
                        </select>

                    </div>
                    <div class="content-center  col-span-2">
                        <label for="building_transaction" class="block mb-1 font-semibold text-gray-900 dark:text-white">Building</label>
                        <select name="building_transaction" id="building_transaction" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                            <option value="Gpi 1">GPI 1</option>
                            <option value="Gpi 4">GPI 4</option>
                            <option value="Gpi 5">GPI 5</option>
                        </select>

                    </div>
                    <div class="content-center  col-span-2">
                        <label for="diagnosis" class="block  my-auto  font-semibold text-gray-900 ">Diagnosis: </label>
                        <select id="diagnosis" name="diagnosis" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

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
                        <label for="intervention" class="block  my-auto  font-semibold text-gray-900 ">Intervention</label>

                        <select id="intervention" name="intervention" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                            <option selected value="Medication Only">Medication only</option>
                            <option value="Medical Consultation">Medical Consultation</option>
                            <option value="Medication and Medical Consultation">Medication and Medical Consultation</option>
                            <option value="Medication, Clinic Rest and Medical Consultation">Medication, Clinic Rest and Medical Consultation</option>
                            <option value="Clinic Rest Only">Clinic Rest Only</option>



                        </select>
                    </div>
                    <div class="grid grid-cols-4 col-span-4" id="medicineDivs">
                        <div class="col-span-4">

                            <label class="block  my-auto font-semibold text-gray-900 ">Medicine (Add medicine below): </label>
                            <select name="ftwMeds[]" id="ftwMeds" multiple="multiple" class="form-control js-meds w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">

                                <!-- <option></option> -->
                            </select>

                        </div>
                        <div id="medicineDiv" class="grid grid-cols-4 gap-1 col-span-4 mt-2">
                            <div id="medicineDiv1" class="grid grid-cols-4 gap-1 col-span-4">
                                <div id="medsdiv" class="col-span-2">
                                    <label class="block  my-auto font-semibold text-gray-900 ">What's your medicine? </label>

                                    <input type="text" id="nameOfMedicine" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">

                                </div>

                                <div id="medsqtydiv" class=" col-span-2">
                                    <div class="w-full">
                                        <label class="block  my-auto font-semibold text-gray-900 ">Choose quantity:</label>
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
                        <label for="followupdate" class="block mb-1 font-semibold text-gray-900 dark:text-white">Follow-up Date</label>
                        <input type="date" name="followupdate" id="followupdate" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="remarks" class="block mb-1 font-semibold text-gray-900 dark:text-white">Remarks</label>
                        <input type="text" name="remarks" id="remarks" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" ">
                    </div>

                    <div class="col-span-4">
                        <h3 class=" my-auto w-full font-semibold text-gray-900 ">Laboratory: </h3>
                    </div>
                    <div class="ml-4 grid grid-cols-4  col-span-4 gap-1">
                        <div class="col-span-2">
                            <label for="fbs" class="block my-auto  font-semibold text-gray-900 ">FBS: </label>
                            <input type="text" value="" name="fbs" id="fbs" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>

                        <div class="col-span-2">
                            <label for="cholesterol" class="block my-auto  font-semibold text-gray-900 ">Cholesterol: </label>
                            <input type="text" name="cholesterol" id="cholesterol" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>

                        <div class="col-span-2">
                            <label for="triglycerides" class="block my-auto  font-semibold text-gray-900 ">Triglycerides: </label>
                            <input type="text" name="triglycerides" id="triglycerides" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>

                        <div class="col-span-2">
                            <label for="hdl" class="block my-auto  font-semibold text-gray-900 ">HDL: </label>
                            <input type="text" name="hdl" id="hdl" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label for="ldl" class="block my-auto  font-semibold text-gray-900 ">LDL: </label>
                            <input type="text" name="ldl" id="ldl" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label for="bun" class="block my-auto  font-semibold text-gray-900 ">BUN: </label>
                            <input type="text" name="bun" id="bun" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label for="bua" class="block my-auto  font-semibold text-gray-900 ">BUA: </label>
                            <input type="text" name="bua" id="bua" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label for="sgpt" class="block my-auto  font-semibold text-gray-900 ">SGPT: </label>
                            <input type="text" name="sgpt" id="sgpt" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label class="block my-auto  font-semibold text-gray-900 ">SGDT: </label>
                            <input type="text" name="sgdt" id="sgdt" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label for="hbaic" class="block my-auto  font-semibold text-gray-900 ">HBAIC: </label>
                            <input type="text" name="hbaic" id="hbaic" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label for="others" class="block my-auto  font-semibold text-gray-900 ">Others: </label>
                            <input type="text" name="others" id="others" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>


                        <div class="col-span-4 justify-center flex gap-2">
                            <button type="submit" name="addBloodChem" class="w-64 text-white bg-gradient-to-r from-[#00669B]  to-[#9AC1CA] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300  shadow-lg shadow-teal-500/50  font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2">Add Record</button>

                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>



<div id="importAnnualPe" tabindex="-1" aria-hidden="true" class=" hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-2 border-b rounded-t dark:border-gray-600">
                <h3 class=" font-semibold text-gray-900 dark:text-white">
                    Import HLP Record
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="importAnnualPe">
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
                    <div class="col-span-4 gap-4">
                        <label for="name1" class="block mb-1 font-semibold text-gray-900 dark:text-white">Name</label>

                        <input id="name1" name="name1" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="rfid1" class="block mb-1 font-semibold text-gray-900 dark:text-white">RFID</label>
                        <input type="text" name="rfid1" id="rfid1" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="section1" class="block mb-1 font-semibold text-gray-900 dark:text-white">Section</label>
                        <input type="text" name="section1" id="section1" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="date1" class="block mb-1 font-semibold text-gray-900 dark:text-white">Date</label>
                        <input type="date1" name="date" id="date1" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="time1" class="block mb-1 font-semibold text-gray-900 dark:text-white">Time</label>
                        <input type="text" name="time1" id="time1" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" ">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="type1" class="block mb-1 font-semibold text-gray-900 dark:text-white">Type</label>
                        <select name="type1" id="type1" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                            <option value="Initial">Initial</option>
                            <option value="Follow up">Follow up</option>
                        </select>

                    </div>
                    <div class="content-center  col-span-2">
                        <label for="building_transaction1" class="block mb-1 font-semibold text-gray-900 dark:text-white">Building</label>
                        <select name="building_transaction1" id="building_transaction1" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                            <option value="Gpi 1">GPI 1</option>
                            <option value="Gpi 4">GPI 4</option>
                            <option value="Gpi 5">GPI 5</option>
                        </select>

                    </div>
                    <div class="content-center  col-span-2">
                        <label for="diagnosis1" class="block  my-auto  font-semibold text-gray-900 ">Diagnosis: </label>
                        <select id="diagnosis1" name="diagnosis1" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

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
                        <label for="intervention1" class="block  my-auto  font-semibold text-gray-900 ">Intervention</label>

                        <select id="intervention1" name="intervention1" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                            <option selected value="Medication Only">Medication only</option>
                            <option value="Medical Consultation">Medical Consultation</option>
                            <option value="Medication and Medical Consultation">Medication and Medical Consultation</option>
                            <option value="Medication, Clinic Rest and Medical Consultation">Medication, Clinic Rest and Medical Consultation</option>
                            <option value="Clinic Rest Only">Clinic Rest Only</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-4 col-span-4" id="medicineDivs">
                        <div class="col-span-4">

                            <label class="block  my-auto font-semibold text-gray-900 ">Medicine (Add medicine below): </label>
                            <select name="ftwMeds1[]" id="ftwMeds1" multiple="multiple" class="form-control js-meds w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">






                            </select>

                        </div>

                        <div id="medicineDiv" class="grid grid-cols-4 gap-1 col-span-4 mt-2">
                            <div id="medicineDiv1" class="grid grid-cols-4 gap-1 col-span-4">
                                <div id="medsdiv" class="col-span-2">
                                    <label class="block  my-auto font-semibold text-gray-900 ">What's your medicine? </label>

                                    <input type="text" id="nameOfMedicine" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">

                                </div>

                                <div id="medsqtydiv" class=" col-span-2">
                                    <div class="w-full">
                                        <label class="block  my-auto font-semibold text-gray-900 ">Choose quantity:</label>
                                        <div class="flex relative ">
                                            <div class="relative flex items-center max-w-[8rem]">
                                                <button type="button" id="decrement-button" data-input-counter-decrement="quantityMeds" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-9 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                    </svg>
                                                </button>
                                                <input type="text" name="cnsltnMedsQuantity" id="quantityMeds" data-input-counter data-input-counter-min="1" data-input-counter-max="50" aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-9 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="999" value="1" required />
                                                <button type="button" id="increment-button" data-input-counter-increment="quantityMeds" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-9 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                                    </svg>
                                                </button>

                                            </div>

                                            <button type="button" id="addmedsbtn" onclick="addSelectedValue1(document.getElementById('nameOfMedicine').value, document.getElementById('quantityMeds').value)" class="ml-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg  p-2 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> Add to list
                                            </button>
                                        </div>


                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="followupdate1" class="block mb-1 font-semibold text-gray-900 dark:text-white">Follow-up Date</label>
                        <input type="date" name="followupdate1" id="followupdate1" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="remarks1" class="block mb-1 font-semibold text-gray-900 dark:text-white">Remarks</label>
                        <input type="text" name="remarks1" id="remarks1" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" ">
                    </div>

                    <div class="col-span-4">
                        <h3 class=" my-auto w-full font-semibold text-gray-900 ">Laboratory: </h3>
                    </div>
                    <div class="ml-4 grid grid-cols-4  col-span-4 gap-1">
                        <div class="col-span-2">
                            <label for="FBS1" class="block my-auto  font-semibold text-gray-900 ">FBS: </label>
                            <input type="text" value="" name="FBS1" id="FBS1" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>

                        <div class="col-span-2">
                            <label for="cholesterol1" class="block my-auto  font-semibold text-gray-900 ">Cholesterol: </label>
                            <input type="text" name="cholesterol1" id="cholesterol1" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>

                        <div class="col-span-2">
                            <label for="triglycerides1" class="block my-auto  font-semibold text-gray-900 ">Triglycerides: </label>
                            <input type="text" name="triglycerides1" id="triglycerides1" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>

                        <div class="col-span-2">
                            <label for="HDL1" class="block my-auto  font-semibold text-gray-900 ">HDL: </label>
                            <input type="text" name="HDL1" id="HDL1" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label for="LDL1" class="block my-auto  font-semibold text-gray-900 ">LDL: </label>
                            <input type="text" name="LDL1" id="LDL1" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label for="BUN1" class="block my-auto  font-semibold text-gray-900 ">BUN: </label>
                            <input type="text" name="BUN1" id="BUN1" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label for="BUA1" class="block my-auto  font-semibold text-gray-900 ">BUA: </label>
                            <input type="text" name="BUA1" id="BUA1" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label for="SGPT1" class="block my-auto  font-semibold text-gray-900 ">SGPT: </label>
                            <input type="text" name="SGPT1" id="SGPT1" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label class="block my-auto  font-semibold text-gray-900 ">SGDT: </label>
                            <input type="text" name="SGDT1" id="SGDT1" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label for="HBAIC1" class="block my-auto  font-semibold text-gray-900 ">HBAIC: </label>
                            <input type="text" name="HBAIC1" id="HBAIC1" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label for="others1" class="block my-auto  font-semibold text-gray-900 ">Others: </label>
                            <input type="text" name="others1" id="others1" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>


                        <div class="col-span-4 justify-center flex gap-2">
                            <button type="submit" name="editBloodChem" class="w-64 text-white bg-gradient-to-r from-[#00669B]  to-[#9AC1CA] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300  shadow-lg shadow-teal-500/50  font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2">Update Record</button>

                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
<div id="exportBloodChem" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" data-modal-toggle="exportBloodChem" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Export HLP </h3>
                <form class="space-y-6" action="" method="POST">
                    <div>
                        <label for="exportemployer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Employer</label>

                        <select id="exportemployer" name="exportemployer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
                        <label for="exportmonth" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Month</label>

                        <select id="exportmonth" name="exportmonth" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

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
                        <label for="exportyear" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year</label>
                        <input type="number" value="<?php $dateNow2 = new DateTime();
                                                    $year = $dateNow2->format('Y');
                                                    echo $year; ?>" name="exportyear" id="exportyear" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>

                    <button type="submit" name="excelReport" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Generate Excel
                    </button>


                </form>
            </div>
        </div>
    </div>
</div>
<script src="../node_modules/jquery/dist/jquery.min.js"></script>
<!-- <script src="../node_modules/select2/dist/js/select2.min.js"></script> -->
<script>
    $(document).ready(function() {
        $('#name').change(function() {
            var selectedRfid = $(this).find('option:selected').data('rfid');
            $('#rfid').val(selectedRfid);
            console.log(selectedRfid);
            var selectedSection = $(this).find('option:selected').data('section');
            $('#section').val(selectedSection);
            console.log(selectedSection);

        });
    });
    // $(".js-meds1").select2({
    //     tags: true
    // });

    function addSelectedValue(value, qty) {
        console.log(value);
        $('#ftwMeds').append($('<option>', {
            value: value + "(" + qty + ")",
            text: value + "(" + qty + ")",
            selected: true
        }));
    }
    const editEmployee = document.getElementById('editBloodChem');

    // options with default values
    const editemployees = {

        backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 relative inset-0 z-40',
        closable: true,
        onHide: () => {

        },
        onShow: () => {

        },
        onToggle: () => {

        },
    };

    const modalEdit = new Modal(editEmployee, editemployees);

    function openEditEmployee(element) {
        modalEdit.toggle();

        str = element.getAttribute("data-medications");
        medicine = str.split(',');
        $('#ftwMeds1').empty();
        if (medicine != "") {
            function addSelectedValue1(value) {
                $('#ftwMeds1').append($('<option>', {
                    value: value,
                    text: value,
                    selected: true
                }));
            }
            medicine.forEach(function(value) {
                addSelectedValue1(value);
            });
        }

        document.getElementById("rfid1").value = element.getAttribute("data-rfid");
        document.getElementById("name1").value = element.getAttribute("data-name");
        document.getElementById("section1").value = element.getAttribute("data-section");
        document.getElementById("date1").value = element.getAttribute("data-date");
        document.getElementById("time1").value = element.getAttribute("data-time");
        document.getElementById("building_transaction1").value = element.getAttribute("data-building_transaction");
        document.getElementById("type1").value = element.getAttribute("data-type");
        document.getElementById("diagnosis1").value = element.getAttribute("data-diagnosis");
        document.getElementById("intervention1").value = element.getAttribute("data-intervention");
        // document.getElementById("medications1").value = element.getAttribute("data-medications");
        document.getElementById("followupdate1").value = element.getAttribute("data-followupdate");
        document.getElementById("FBS1").value = element.getAttribute("data-FBS");
        document.getElementById("cholesterol1").value = element.getAttribute("data-cholesterol");
        document.getElementById("triglycerides1").value = element.getAttribute("data-triglycerides");
        document.getElementById("HDL1").value = element.getAttribute("data-HDL");
        document.getElementById("LDL1").value = element.getAttribute("data-LDL");
        document.getElementById("BUN1").value = element.getAttribute("data-BUN");
        document.getElementById("BUA1").value = element.getAttribute("data-BUA");
        document.getElementById("SGPT1").value = element.getAttribute("data-SGPT");
        document.getElementById("SGDT1").value = element.getAttribute("data-SGDT");
        document.getElementById("HBAIC1").value = element.getAttribute("data-HBA1C");
        document.getElementById("others1").value = element.getAttribute("data-others");
        document.getElementById("remarks1").value = element.getAttribute("data-remarks");
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
        link.setAttribute("download", "GPI HLP  Template.csv");
        document.body.appendChild(link);
        /* download the data file named "Stock_Price_Report.csv" */
        link.click();
    }
</script>