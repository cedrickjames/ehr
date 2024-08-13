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
        window.open('../annualPe_xls.php?month=<?php echo $_SESSION['month']; ?>&year=<?php echo $_SESSION['year']; ?>&employer=<?php echo $_SESSION['employer']; ?>', '_blank');
        location.href = 'index.php';
    </script>
<?php
}

if (isset($_POST['addAnnualPe'])) {
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

    $addPreEmploymentGpi = "INSERT INTO `annualphysicalexam`(`dateReceived`, `datePerformed`, `rfidNumber`, `name`, `section`, `IMC`, `OEH`, `PE`, `CBC`, `U_A`, `FA`, `CXR`, `VA`, `DEN`, `DT`, `PT`, `otherTest`, `followUpStatus`, `status`, `attendee`, `confirmationDate`, `FMC`) VALUES ('$date_received','$date_performed','$rfid','$name','$section','$imc','$oeh','$pe','$cbc','$ua','$fa','$cxr','$va', '$den', '$dt', '$pt', '$others', '$followupstatus', '$status', '$attendee', '$confirmationdate', '$fmc')";
    $resultInfo = mysqli_query($con, $addPreEmploymentGpi);

    if ($resultInfo) {
        echo "<script>alert('Added Successfuly!') </script>";
        echo "<script> location.href='index.php'; </script>";
    }
}

if (isset($_POST['editAnnualPe'])) {
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

    $editPreEmploymentGpi = "UPDATE `annualphysicalexam`SET `dateReceived`='$date_received' , `datePerformed` = '$date_performed', `name`= '$name', `section`= '$section', `IMC`= '$imc', `OEH`= '$oeh', `PE`= '$pe', `CBC`= '$cbc', `U_A`= '$ua', `FA`= '$fa', `CXR`= '$cxr', `VA`= '$va', `DEN`= '$den', `DT`= '$dt', `PT`= '$pt', `otherTest`= '$others', `followUpStatus`= '$followupstatus', `status`= '$status', `attendee` = '$attendee',`confirmationDate`= '$confirmationdate', `FMC`= '$fmc' WHERE `rfidNumber`='$rfid'";
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

                $result1 = mysqli_query($con, "SELECT * FROM `annualphysicalexam` WHERE `rfidNumber` = '$rfidNumber'");
                $numrows = mysqli_num_rows($result1);
                if ($numrows > 0) {
                    $addPreEmploymentGpi = "UPDATE `annualphysicalexam` SET `dateReceived` = '$dateReceived', `datePerformed` = '$datePerformed', `name`='$name', `section`='$section', `IMC` = '$IMC', `OEH`='$OEH', `PE` = '$PE', `CBC` ='$CBC', `U_A` = '$U_A', `FA`='$FA', `CXR` ='$CXR', `VA`='$VA', `DEN`='$DEN', `DT`='$DT', `PT` = '$PT', `otherTest` = '$otherTest', `followUpStatus` = '$followUpStatus', `status`='$status', `attendee`='$attendee', `confirmationDate`='$confirmationDate', `FMC`='$FMC' WHERE `rfidNumber` = '$rfidNumber'";
                    $resultInfo = mysqli_query($con, $addPreEmploymentGpi);
                } else {
                    $addPreEmploymentGpi = "INSERT INTO `annualphysicalexam`(`dateReceived`, `datePerformed`, `rfidNumber`, `name`, `section`, `IMC`, `OEH`, `PE`, `CBC`, `U_A`, `FA`, `CXR`, `VA`, `DEN`, `DT`, `PT`, `otherTest`, `followUpStatus`, `status`, `attendee`,`confirmationDate`, `FMC`) VALUES ('$dateReceived','$datePerformed','$rfidNumber','$name','$section','$IMC','$OEH','$PE','$CBC','$U_A','$FA','$CXR', '$VA', '$DEN', '$DT', '$PT', ' $otherTest', ' $followUpStatus', '$status', '$attendee','$confirmationDate', '$FMC')";
                    $resultInfo = mysqli_query($con, $addPreEmploymentGpi);
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
        <p class="mb-2 my-auto"><span class=" self-center text-md font-semibold whitespace-nowrap   text-[#193F9F]">Annual P.E. Records - Direct Employees</span></p>
        <div class="flex items-center order-2">
            <button type="button" data-modal-target="exportAnnualPe" data-modal-toggle="exportAnnualPe" class="lg:block text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2 mx-3 md:mx-2">Export</button>

            <button type="button" data-dropdown-toggle="options" class="lg:block text-white bg-gradient-to-r from-[#00669B] to-[#9AC1CA] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300  font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2 ">Add</button>
            <div id="options" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-2  text-gray-700 dark:text-gray-200" aria-labelledby="options">
                    <li>
                        <a type="button" data-modal-target="addPreEmpDirectEmployees" data-modal-toggle="addPreEmpDirectEmployees" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Add Annual P.E.</a>
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
                                <th>FMC</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ApeNo = 1;
                            $sql = "SELECT p.*, e.employer, e.Name, e.section, e.rfidNumber FROM annualphysicalexam p 
                                    JOIN employeespersonalinfo e ON e.rfidNumber = p.rfidNumber WHERE e.employer = 'GPI' ORDER BY `id` ASC";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $ApeNo; ?></td>
                                    <!-- <td> <button type="button" onclick="openEditEmployee(this)" data-rfid="<?php echo $row['rfidNumber']; ?>" data-name="<?php echo $row['Name']; ?>" data-section="<?php echo $row['section']; ?>" data-date_received="<?php echo $row['dateReceived']; ?>" data-date_performed="<?php echo $row['datePerformed']; ?>" data-imc="<?php echo $row['IMC']; ?>" data-oeh="<?php echo $row['OEH']; ?>" data-pe="<?php echo $row['PE']; ?>" data-cbc="<?php echo $row['CBC']; ?>" data-ua="<?php echo $row['U_A']; ?>" data-fa="<?php echo $row['FA']; ?>" data-cxr="<?php echo $row['CXR']; ?>" data-va="<?php echo $row['VA']; ?>" data-den="<?php echo $row['DEN']; ?>" data-dt="<?php echo $row['DT']; ?>" data-pt="<?php echo $row['PT']; ?>" data-others="<?php echo $row['otherTest']; ?>" data-followupstatus="<?php echo $row['followUpStatus']; ?>" data-status="<?php echo $row['status']; ?>" data-attendee="<?php echo $row['attendee']; ?>" data-confirmationdate="<?php echo $row['confirmationDate']; ?>" data-fmc="<?php echo $row['FMC']; ?>" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</button></td> -->
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
                                                    <a type="button" onclick="openEditEmployee(this)" data-rfid="<?php echo $row['rfidNumber']; ?>" data-name="<?php echo $row['Name']; ?>" data-section="<?php echo $row['section']; ?>" data-date_received="<?php echo $row['dateReceived']; ?>" data-date_performed="<?php echo $row['datePerformed']; ?>" data-imc="<?php echo $row['IMC']; ?>" data-oeh="<?php echo $row['OEH']; ?>" data-pe="<?php echo $row['PE']; ?>" data-cbc="<?php echo $row['CBC']; ?>" data-ua="<?php echo $row['U_A']; ?>" data-fa="<?php echo $row['FA']; ?>" data-cxr="<?php echo $row['CXR']; ?>" data-va="<?php echo $row['VA']; ?>" data-den="<?php echo $row['DEN']; ?>" data-dt="<?php echo $row['DT']; ?>" data-pt="<?php echo $row['PT']; ?>" data-others="<?php echo $row['otherTest']; ?>" data-followupstatus="<?php echo $row['followUpStatus']; ?>" data-status="<?php echo $row['status']; ?>" data-attendee="<?php echo $row['attendee']; ?>" data-confirmationdate="<?php echo $row['confirmationDate']; ?>" data-fmc="<?php echo $row['FMC']; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit Annual P.E. Record</a>
                                                </li>

                                            </ul>

                                        </div>
                                    </td>
                                    <td><?php echo $row['dateReceived'] ?></td>
                                    <td><?php echo $row['datePerformed'] ?></td>
                                    <td><?php echo $row['Name'] ?></td>
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
                                    <td><?php echo $row['FMC'] ?></td>
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


<div id="addPreEmpDirectEmployees" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class=" font-semibold text-gray-900 dark:text-white">
                    Add Annual P.E. Record
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
                    <div class="col-span-4 gap-4">
                        <label for="name" class="block mb-1  text-gray-900 dark:text-white">Name</label>
                        <select id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                            <option selected disabled>Search Name</option>
                            <?php
                            $sql1 = "SELECT * FROM employeespersonalinfo e WHERE e.employer = 'GPI' AND e.rfidNumber NOT IN (SELECT p.rfidNumber FROM annualphysicalexam p);";
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
                        <label for="rfid" class="block mb-1  text-gray-900 dark:text-white">RFID</label>
                        <input type="text" name="rfid" id="rfid" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " required="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="section" class="block mb-1  text-gray-900 dark:text-white">Section</label>
                        <input type="text" name="section" id="section" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " required="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="date_received" class="block mb-1  text-gray-900 dark:text-white">Date Received</label>
                        <input type="date" name="date_received" id="date_received" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder="" required="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="date_performed" class="block mb-1  text-gray-900 dark:text-white">Date Performed</label>
                        <input type="date" name="date_performed" id="date_performed" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="imc" class="block mb-1  text-gray-900 dark:text-white">IMC</label>
                        <input type="text" name="imc" id="imc" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="oeh" class="block mb-1  text-gray-900 dark:text-white">OEH</label>
                        <input type="text" name="oeh" id="oeh" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="pe" class="block mb-1  text-gray-900 dark:text-white">PE</label>
                        <input type="text" name="pe" id="pe" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="cbc" class="block mb-1  text-gray-900 dark:text-white">CBC</label>
                        <input type="text" name="cbc" id="cbc" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="ua" class="block mb-1  text-gray-900 dark:text-white">U/A</label>
                        <input type="text" name="ua" id="ua" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="fa" class="block mb-1  text-gray-900 dark:text-white">FA</label>
                        <input type="text" name="fa" id="fa" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="cxr" class="block mb-1  text-gray-900 dark:text-white">CXR</label>
                        <input type="text" name="cxr" id="cxr" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="va" class="block mb-1  text-gray-900 dark:text-white">VA</label>
                        <input type="text" name="va" id="va" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="den" class="block mb-1  text-gray-900 dark:text-white">DEN</label>
                        <input type="text" name="den" id="den" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="dt" class="block mb-1  text-gray-900 dark:text-white">DT</label>
                        <input type="text" name="dt" id="dt" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="pt" class="block mb-1  text-gray-900 dark:text-white">PT</label>
                        <input type="text" name="pt" id="pt" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder=" " required="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="others" class="block mb-1  text-gray-900 dark:text-white">Others</label>
                        <input type="text" name="others" id="others" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder="" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="followupstatus" class="block mb-1  text-gray-900 dark:text-white">Follow up status</label>
                        <input type="text" name="followupstatus" id="followupstatus" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder="" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="status" class="block mb-1  text-gray-900 dark:text-white">Status</label>
                        <select name="status" id="status" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder="" required="">
                            <option disabled selected>Select status</option>
                            <option value="pending">Pending</option>
                            <option value="complied">Complied</option>
                        </select>

                    </div>
                    <div class="content-center  col-span-2">
                        <label for="attendee" class="block mb-1  text-gray-900 dark:text-white">Attendee</label>
                        <input type="text" name="attendee" id="attendee" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder="Nurse/Doctor" required="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="confirmationdate" class="block mb-1  text-gray-900 dark:text-white">Confirmation Date</label>
                        <input type="date" name="confirmationdate" id="confirmationdate" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder="" required="">
                    </div>
                    <div class="col-span-4 gap-4">
                        <label for="fmc" class="block mb-1  text-gray-900 dark:text-white">FMC</label>
                        <input type="text" name="fmc" id="fmc" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg" placeholder="" required="">
                    </div>

                    <div class="col-span-4 justify-center flex gap-2">
                        <button type="submit" name="addAnnualPe" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Add Annual P.E.
                        </button>
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
                    Import Annual P.E. Record
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


<div id="editAnnualPe" tabindex="-1" aria-hidden="true" class="bg-[#615eae59] hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit Annual P.E. Record
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editAnnualPe">
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
                        <input id="editName" name="editName" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editRfid" class="block mb-1  text-gray-900 dark:text-white">RFID</label>
                        <input type="text" name="editRfid" id="editRfid" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editSection" class="block mb-1  text-gray-900 dark:text-white">Section</label>
                        <input type="text" name="editSection" id="editSection" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editDate_received" class="block mb-1  text-gray-900 dark:text-white">Date Received</label>
                        <input type="date" name="editDate_received" id="editDate_received" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editDate_performed" class="block mb-1  text-gray-900 dark:text-white">Date Performed</label>
                        <input type="date" name="editDate_performed" id="editDate_performed" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" ">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editImc" class="block mb-1  text-gray-900 dark:text-white">IMC</label>
                        <input type="text" name="editImc" id="editImc" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" ">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editOeh" class="block mb-1  text-gray-900 dark:text-white">OEH</label>
                        <input type="text" name="editOeh" id="editOeh" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" ">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editPe" class="block mb-1  text-gray-900 dark:text-white">PE</label>
                        <input type="text" name="editPe" id="editPe" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" ">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editCbc" class="block mb-1  text-gray-900 dark:text-white">CBC</label>
                        <input type="text" name="editCbc" id="editCbc" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" ">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editUa" class="block mb-1  text-gray-900 dark:text-white">U/A</label>
                        <input type="text" name="editUa" id="editUa" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" ">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editFa" class="block mb-1  text-gray-900 dark:text-white">FA</label>
                        <input type="text" name="editFa" id="editFa" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" ">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editCxr" class="block mb-1  text-gray-900 dark:text-white">CXR</label>
                        <input type="text" name="editCxr" id="editCxr" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" ">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editVa" class="block mb-1  text-gray-900 dark:text-white">VA</label>
                        <input type="text" name="editVa" id="editVa" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" ">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editDen" class="block mb-1  text-gray-900 dark:text-white">DEN</label>
                        <input type="text" name="editDen" id="editDen" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" ">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editDt" class="block mb-1  text-gray-900 dark:text-white">DT</label>
                        <input type="text" name="editDt" id="editDt" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" ">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editPt" class="block mb-1  text-gray-900 dark:text-white">PT</label>
                        <input type="text" name="editPt" id="editPt" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder=" ">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editOthers" class="block mb-1  text-gray-900 dark:text-white">Others</label>
                        <input type="text" name="editOthers" id="editOthers" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="">
                    </div>
                    <div class="col-span-2">
                        <label for="editFollowupstatus" class="block mb-1  text-gray-900 dark:text-white">Follow up status</label>
                        <input type="text" name="editFollowupstatus" id="editFollowupstatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="">
                    </div>
                    <div class="col-span-2">
                        <label for="editStatus" class="block mb-1  text-gray-900 dark:text-white">Status</label>
                        <select name="editStatus" id="editStatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="">
                            <option disabled selected>Select status</option>
                            <option value="pending">Pending</option>
                            <option value="complied">Complied</option>
                        </select>

                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editAttendee" class="block mb-1  text-gray-900 dark:text-white">Attendee</label>
                        <input type="text" name="editAttendee" id="editAttendee" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="Nurse/Doctor">
                    </div>

                    <div class="content-center  col-span-2">
                        <label for="editConfirmationdate" class="block mb-1  text-gray-900 dark:text-white">Confirmation Date</label>
                        <input type="date" name="editConfirmationdate" id="editConfirmationdate" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="">
                    </div>
                    <div class="col-span-4 gap-4">
                        <label for="editFmc" class="block mb-1  text-gray-900 dark:text-white">FMC</label>
                        <input type="text" name="editFmc" id="editFmc" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " placeholder="">
                    </div>

                    <div class="col-span-4 justify-center flex gap-2">
                        <button type="submit" name="editAnnualPe" class="w-64 text-white bg-gradient-to-r from-[#00669B]  to-[#9AC1CA] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300  shadow-lg shadow-teal-500/50  font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2">Update Record</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="exportAnnualPe" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" data-modal-toggle="exportAnnualPe" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Export Annual P.E.</h3>
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


    const editEmployee = document.getElementById('editAnnualPe');

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
        link.setAttribute("download", "GPI Annual P.E. Template.csv");
        document.body.appendChild(link);
        /* download the data file named "Stock_Price_Report.csv" */
        link.click();
    }
</script>