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
    $rfid = $_POST['hlprfid'];
    $date = $_POST['hlpdate'];
    $time = $_POST['hlptime'];
    $building = $_POST['hlpbuilding_transaction'];
    $type = $_POST['hlptype'];
    $diagnosis = $_POST['hlpdiagnosis'];
    $intervention = $_POST['hlpintervention'];
    $followupdate = $_POST['hlpfollowupdate'];
    $fbs = $_POST['hlpfbs'];
    $cholesterol = $_POST['hlpcholesterol'];
    $triglycerides = $_POST['hlptriglycerides'];
    $hdl = $_POST['hlphdl'];
    $ldl = $_POST['hlpldl'];
    $bun = $_POST['hlpbun'];
    $bua = $_POST['hlpbua'];
    $sgpt = $_POST['hlpsgpt'];
    $sgdt = $_POST['hlpsgdt'];
    $hbaic = $_POST['hlphbaic'];
    $others = $_POST['hlpothers'];
    $remarks = $_POST['hlpremarks'];

    $Meds = $_POST['hlpftwMeds'];


    if ($Meds != "") {

        $Meds = implode(', ', $Meds);
    }

    $addBloodChem = "INSERT INTO `bloodchem`(`rfid`, `date`, `time` ,`building`, `type`, `diagnosis`, `intervention`, `medications`, `followupdate`, `FBS`, `cholesterol`, `triglycerides`, `HDL`, `LDL`, `BUN`, `BUA`, `SGPT`, `SGDT`, `HBA1C`, `others` ,`remarks`) VALUES ('$rfid','$date','$time','$building','$type','$diagnosis','$intervention','$Meds','$followupdate','$fbs','$cholesterol','$triglycerides', '$hdl', '$ldl', '$bun', '$bua', '$sgpt', '$sgdt', '$hbaic', '$others', '$remarks')";
    $resultInfo = mysqli_query($con, $addBloodChem);

    if ($resultInfo) {
        echo "<script>alert('Added Successfuly!') </script>";
        echo "<script> location.href='index.php'; </script>";
    }
}

if (isset($_POST['editBloodChem'])) {
    $id = $_POST['editid'];
    $rfid = $_POST['editrfid'];
    $name = $_POST['editname'];
    $section = $_POST['editsection'];
    $date = $_POST['editdate'];
    $time = $_POST['edittime'];
    $building = $_POST['editbuilding_transaction'];
    $type = $_POST['edittype'];
    $diagnosis = $_POST['editdiagnosis'];
    $intervention = $_POST['editintervention'];
    $followupdate = $_POST['editfollowupdate'];
    $fbs = $_POST['editfbs'];
    $cholesterol = $_POST['editcholesterol'];
    $triglycerides = $_POST['edittriglycerides'];
    $hdl = $_POST['edithdl'];
    $ldl = $_POST['editldl'];
    $bun = $_POST['editbun'];
    $bua = $_POST['editbua'];
    $sgpt = $_POST['editsgpt'];
    $sgdt = $_POST['editsgdt'];
    $hbaic = $_POST['edithbaic'];
    $others = $_POST['editothers'];
    $remarks = $_POST['editremarks'];

    $Meds = $_POST['editftwMeds'];


    if ($Meds != "") {

        $Meds = implode(', ', $Meds);
    }

    $editBloodChem = "UPDATE `bloodchem` SET `date`='$date' , `time` = '$time', `building`= '$building', `type`= '$type', `diagnosis`= '$diagnosis', `intervention`= '$intervention', `medications`= '$Meds', `followupdate`= '$followupdate', `FBS`= '$fbs', `cholesterol`= '$cholesterol', `triglycerides`= '$triglycerides', `HDL`= '$hdl', `LDL`= '$ldl', `BUN`= '$bun', `BUA`= '$bua', `SGPT`= '$sgpt', `SGDT`= '$sgdt', `HBA1C`= '$hbaic', `others` = '$others',`remarks`= '$remarks' WHERE `id`='$id'";
    $resultInfo = mysqli_query($con, $editBloodChem);

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
            $date = $row['0'];
            $time = $row['1'];
            $building = $row['2'];
            $rfidNumber = $row['3'];
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

                $result1 = mysqli_query($con, "SELECT * FROM `bloodchem` WHERE `rfid` = '$rfidNumber'");
                $numrows = mysqli_num_rows($result1);
                if ($numrows > 0) {
                    $addHlp = "UPDATE `bloodchem` SET `date`='$date' , `time` = '$time', `building`= '$building', `type`= '$type', `diagnosis`= '$diagnosis', `intervention`= '$intervention', `medications`= '$Meds', `followupdate`= '$followupdate', `FBS`= '$fbs', `cholesterol`= '$cholesterol', `triglycerides`= '$triglycerides', `HDL`= '$hdl', `LDL`= '$ldl', `BUN`= '$bun', `BUA`= '$bua', `SGPT`= '$sgpt', `SGDT`= '$sgdt', `HBA1C`= '$hbaic', `others` = '$others',`remarks`= '$remarks' WHERE `rfid`='$rfidNumber'";
                    $resultInfo = mysqli_query($con, $addHlp);
                } else {
                    $addHlp = "INSERT INTO `bloodchem`(`rfid`, `date`, `time` ,`building`, `type`, `diagnosis`, `intervention`, `medications`, `followupdate`, `FBS`, `cholesterol`, `triglycerides`, `HDL`, `LDL`, `BUN`, `BUA`, `SGPT`, `SGDT`, `HBA1C`, `others` ,`remarks`) VALUES ('$rfidNumber','$date','$time','$building','$type','$diagnosis','$intervention','$Meds','$followupdate','$fbs','$cholesterol','$triglycerides', '$hdl', '$ldl', '$bun', '$bua', '$sgpt', '$sgdt', '$hbaic', '$others', '$remarks')";
                    $resultInfo = mysqli_query($con, $addHlp);
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
        <p class="mb-2 my-auto"><span class=" self-center text-md font-semibold whitespace-nowrap   text-[#193F9F]">HLP Records - Direct Employees</span></p>
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
                    <table id="queTable" class="display text-[9px] 2xl:text-sm" style="width:100%">
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
                            $sql = "SELECT p.*, e.employer, e.Name, e.section, e.rfidNumber FROM bloodchem p 
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
                                                    <a type="button" onclick="openEditEmployee(this)" data-id="<?php echo $row['id'] ?>" data-rfid="<?php echo $row['rfidNumber']; ?>" data-name="<?php echo $row['Name']; ?>" data-section="<?php echo $row['section']; ?>" data-date="<?php echo $row['date']; ?>" data-time="<?php echo $row['time']; ?>" data-building="<?php echo $row['building']; ?>" data-type="<?php echo $row['type']; ?>" data-diagnosis="<?php echo $row['diagnosis']; ?>" data-intervention="<?php echo $row['intervention']; ?>" data-medications="<?php echo $row['medications']; ?>" data-followupdate="<?php echo $row['followupdate']; ?>" data-FBS="<?php echo $row['FBS']; ?>" data-cholesterol="<?php echo $row['cholesterol']; ?>" data-triglycerides="<?php echo $row['triglycerides']; ?>" data-HDL="<?php echo $row['HDL']; ?>" data-LDL="<?php echo $row['LDL']; ?>" data-BUN="<?php echo $row['BUN']; ?>" data-BUA="<?php echo $row['BUA']; ?>" data-SGPT="<?php echo $row['SGPT']; ?>" data-SGDT="<?php echo $row['SGDT']; ?>" data-HBA1C="<?php echo $row['HBA1C']; ?>" data-others="<?php echo $row['others']; ?>" data-remarks="<?php echo $row['remarks']; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit HLP Record</a>
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


<div id="addBloodChem" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class=" font-semibold text-gray-900 dark:text-white">
                    Add HLP Record
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="addBloodChem">
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
                        <label for="hlpname" class="block mb-1  text-gray-900 dark:text-white">Name</label>
                        <select id="hlpname" name="hlpname" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                            <option selected disabled>Search Name</option>
                            <?php
                            $sql1 = "SELECT * FROM employeespersonalinfo e WHERE e.employer = 'GPI' AND e.rfidNumber NOT IN (SELECT p.rfid FROM bloodchem p);";
                            $result = mysqli_query($con, $sql1);
                            while ($list = mysqli_fetch_assoc($result)) {
                                $rfid = $list["rfidNumber"];
                                $name = $list["Name"];
                                $section = $list["section"]; ?>
                                <option value="<?php echo  $name; ?>" data-hlprfid="<?php echo  $rfid; ?>" data-hlpsection="<?php echo  $section; ?>"> <?php echo  $name; ?> </option> <?php
                                                                                                                                                                                    } ?>
                        </select>
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="hlprfid" class="block mb-1  text-gray-900 dark:text-white">RFID</label>
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
                    <div class="content-center  col-span-2">
                        <label for="editdiagnosis" class="block  my-auto   text-gray-900 ">Diagnosis: </label>
                        <select id="editdiagnosis" name="editdiagnosis" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                            <option selected>Select Diagnosis</option>
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
                        <label for="editintervention" class="block  my-auto  text-gray-900 ">Intervention</label>

                        <select id="editintervention" name="editintervention" value="" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                            <option selected value="">Select Intervention</option>
                            <option value="Medication Only">Medication only</option>
                            <option value="Medical Consultation">Medical Consultation</option>
                            <option value="Medication and Medical Consultation">Medication and Medical Consultation</option>
                            <option value="Medication, Clinic Rest and Medical Consultation">Medication, Clinic Rest and Medical Consultation</option>
                            <option value="Clinic Rest Only">Clinic Rest Only</option>



                        </select>
                    </div>
                    <div class="grid grid-cols-4 col-span-4" id="medicineDivs">
                        <div class="col-span-4">

                            <label for="hlpftwMeds" class="block  my-auto  text-gray-900 ">Medicine (Add medicine below): </label>
                            <select name="hlpftwMeds[]" id="hlpftwMeds" multiple="multiple" class="p-2 js-meds border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">


                            </select>

                        </div>
                        <div id="medicineDiv" class="grid grid-cols-4 gap-1 col-span-4 mt-2">
                            <div id="medicineDiv1" class="grid grid-cols-4 gap-1 col-span-4">
                                <div id="medsdiv" class="col-span-2">
                                    <label for="nameOfMedicine" class="block  my-auto text-gray-900 ">What's your medicine? </label>

                                    <input type="text" id="nameOfMedicine" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">

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
                    <div class="col-span-4">
                        <h3 class="block my-auto w-full  text-gray-900 ">Laboratory: </h3>
                    </div>
                    <div class="ml-4 grid grid-cols-4  col-span-4 gap-1">
                        <div class="col-span-2">
                            <label for="hlpfbs" class="block my-auto   text-gray-900 ">FBS: </label>
                            <input type="text" value="" name="hlpfbs" id="hlpfbs" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>

                        <div class="col-span-2">
                            <label for="hlpcholesterol" class="block my-auto   text-gray-900 ">Cholesterol: </label>
                            <input type="text" name="hlpcholesterol" id="hlpcholesterol" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>

                        <div class="col-span-2">
                            <label for="hlptriglycerides" class="block my-auto   text-gray-900 ">Triglycerides: </label>
                            <input type="text" name="hlptriglycerides" id="hlptriglycerides" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>

                        <div class="col-span-2">
                            <label for="hlphdl" class="block my-auto   text-gray-900 ">HDL: </label>
                            <input type="text" name="hlphdl" id="hlphdl" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>
                        <div class="col-span-2">
                            <label for="hlpldl" class="block my-auto   text-gray-900 ">LDL: </label>
                            <input type="text" name="hlpldl" id="hlpldl" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>
                        <div class="col-span-2">
                            <label for="hlpbun" class="block my-auto   text-gray-900 ">BUN: </label>
                            <input type="text" name="hlpbun" id="hlpbun" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>
                        <div class="col-span-2">
                            <label for="hlpbua" class="block my-auto   text-gray-900 ">BUA: </label>
                            <input type="text" name="hlpbua" id="hlpbua" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>
                        <div class="col-span-2">
                            <label for="hlpsgpt" class="block my-auto  text-gray-900 ">SGPT: </label>
                            <input type="text" name="hlpsgpt" id="hlpsgpt" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>
                        <div class="col-span-2">
                            <label for="hlpsgdt" class="block my-auto   text-gray-900 ">SGDT: </label>
                            <input type="text" name="hlpsgdt" id="hlpsgdt" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>
                        <div class="col-span-2">
                            <label for="hlphbaic" class="block my-auto   text-gray-900 ">HBAIC: </label>
                            <input type="text" name="hlphbaic" id="hlphbaic" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>
                        <div class="col-span-2">
                            <label for="hlpothers" class="block my-auto  text-gray-900 ">Others: </label>
                            <input type="text" name="hlpothers" id="hlpothers" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg">
                        </div>
                    </div>
                    <div class="col-span-4 justify-center flex gap-2">
                        <button type="submit" name="addBloodChem" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Add HLP
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="importBloodChem" tabindex="-1" aria-hidden="true" class=" hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-2 border-b rounded-t dark:border-gray-600">
                <h3 class=" font-semibold text-gray-900 dark:text-white">
                    Import HLP Record
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="importBloodChem">
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
                <button type="submit" name="addBloodChemImport" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Import Data
                </button>
            </form>
        </div>
    </div>
</div>
<div id="export" tabindex="-1" aria-hidden="true" class=" hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class=" font-semibold text-gray-900 dark:text-white">
                    Export HLP Record
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="export">
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
                        <label for="editrfid" class="block mb-1 font-semibold  text-gray-900 dark:text-white">RFID</label>
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
                            <option value="Initial">Initial</option>
                            <option value="Follow up">Follow up</option>
                        </select>

                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editbuilding_transaction" class="block mb-1 font-semibold text-gray-900 dark:text-white">Building</label>
                        <select name="editbuilding_transaction" id="editbuilding_transaction" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
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
                            <option selected value="Medication Only">Medication only</option>
                            <option value="Medical Consultation">Medical Consultation</option>
                            <option value="Medication and Medical Consultation">Medication and Medical Consultation</option>
                            <option value="Medication, Clinic Rest and Medical Consultation">Medication, Clinic Rest and Medical Consultation</option>
                            <option value="Clinic Rest Only">Clinic Rest Only</option>



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

                                    <input type="text" id="nameOfMedicine1" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">

                                </div>

                                <div id="medsqtydiv" class=" col-span-2">
                                    <div class="w-full">
                                        <label class="block  my-auto font-semibold text-gray-900 ">Choose quantity:</label>
                                        <div class="flex relative ">
                                            <div class="relative flex items-center max-w-[8rem]">
                                                <button type="button" id="decrement-button" data-input-counter-decrement="quantityMeds1" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-9 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                    </svg>
                                                </button>
                                                <input type="text" name="cnsltnMedsQuantity" id="quantityMeds1" data-input-counter data-input-counter-min="1" data-input-counter-max="50" aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-9 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="999" value="1" />
                                                <button type="button" id="increment-button" data-input-counter-increment="quantityMeds1" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-9 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                                    </svg>
                                                </button>

                                            </div>

                                            <button type="button" id="addmedsbtn" onclick="addSelectedValue1(document.getElementById('nameOfMedicine1').value, document.getElementById('quantityMeds1').value)" class="ml-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg  p-2 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> Add to list
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
                            <label for="editbua" class="block my-auto  font-semibold text-gray-900 ">BUA: </label>
                            <input type="text" name="editbua" id="editbua" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label for="editsgpt" class="block my-auto  font-semibold text-gray-900 ">SGPT: </label>
                            <input type="text" name="editsgpt" id="editsgpt" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label for="editsgdt" class="block my-auto  font-semibold text-gray-900 ">SGDT: </label>
                            <input type="text" name="editsgdt" id="editsgdt" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
                            <label for="edithbaic" class="block my-auto  font-semibold text-gray-900 ">HBAIC: </label>
                            <input type="text" name="edithbaic" id="edithbaic" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-2">
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
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Export HLP</h3>
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

                    <button type="submit" name="" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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
        $('#hlpname').change(function() {
            var selectedRfid = $(this).find('option:selected').data('hlprfid');
            $('#hlprfid').val(selectedRfid);
            var selectedSection = $(this).find('option:selected').data('hlpsection');
            $('#hlpsection').val(selectedSection);
            console.log(selectedRfid);
            console.log(selectedSection);
        });
    });

    const editEmployee = document.getElementById('editBloodChem');

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
        str = element.getAttribute("data-medications");
        medicine = str.split(',');
        $('#editftwMeds').empty();
        if (medicine != "") {
            function addSelectedValue(value) {
                $('#editftwMeds').append($('<option>', {
                    value: value,
                    text: value,
                    selected: true
                }));
            }
            medicine.forEach(function(value) {
                addSelectedValue(value);
            });
        }
        document.getElementById("editid").value = element.getAttribute("data-id");
        document.getElementById("editrfid").value = element.getAttribute("data-rfid");
        document.getElementById("editname").value = element.getAttribute("data-name");
        document.getElementById("editsection").value = element.getAttribute("data-section");
        document.getElementById("editdate").value = element.getAttribute("data-date");
        document.getElementById("edittime").value = element.getAttribute("data-time");
        document.getElementById("editbuilding_transaction").value = element.getAttribute("data-building");
        document.getElementById("edittype").value = element.getAttribute("data-type");
        document.getElementById("editdiagnosis").value = element.getAttribute("data-diagnosis");
        document.getElementById("editintervention").value = element.getAttribute("data-intervention");
        // document.getElementById("editftwMeds").value = element.getAttribute("data-medications");
        document.getElementById("editfollowupdate").value = element.getAttribute("data-followupdate");
        document.getElementById("editfbs").value = element.getAttribute("data-FBS");
        document.getElementById("editcholesterol").value = element.getAttribute("data-cholesterol");
        document.getElementById("edittriglycerides").value = element.getAttribute("data-triglycerides");
        document.getElementById("edithdl").value = element.getAttribute("data-HDL");
        document.getElementById("editldl").value = element.getAttribute("data-LDL");
        document.getElementById("editbun").value = element.getAttribute("data-BUN");
        document.getElementById("editbua").value = element.getAttribute("data-BUA");
        document.getElementById("editsgpt").value = element.getAttribute("data-SGPT");
        document.getElementById("editsgdt").value = element.getAttribute("data-SGDT");
        document.getElementById("edithbaic").value = element.getAttribute("data-HBA1C");
        document.getElementById("editothers").value = element.getAttribute("data-others");
        document.getElementById("editremarks").value = element.getAttribute("data-remarks");
    }

    document.getElementById("employer").addEventListener("keydown", function(event) {
        event.preventDefault(); // Prevent typing into the input field
    });

    const importBloodChem = document.getElementById('importBloodChem');

    // options with default values
    const importBloodChems = {

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

    const modalImport = new Modal(importBloodChem, importBloodChems);

    function openImportModal(element) {
        modalImport.toggle();

    };
    const exportBloodChem = document.getElementById('export');

    // options with default values
    const exportBloodChems = {

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

    const modalExport = new Modal(exportBloodChem, exportBloodChems);

    function openExportModal(element) {
        modalExport.toggle();

    };


    const addBloodChem = document.getElementById('addBloodChem');

    // options with default values
    const addBloodChems = {

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

    const modalAdd = new Modal(addBloodChem, addBloodChems);

    function openAddModal(element) {
        modalAdd.toggle();

    };

    function exportTemplate() {

        var rows = [];

        column1 = 'Date';
        column2 = 'Time';
        column3 = 'Building Transaction';
        column4 = 'RFID';
        column5 = 'Type';
        column6 = 'Diagnosis';
        column7 = 'Intervention';
        column8 = 'Medications';
        column9 = 'Follow Up Date';
        column10 = 'FBS';
        column11 = 'Cholesterol';
        column12 = 'Triglycerides';
        column13 = 'HDL';
        column14 = 'LDL';
        column15 = 'BUN';
        column16 = 'BUA';
        column17 = 'SGPT';
        column18 = 'SGDT';
        column19 = 'HBA1C';
        column20 = 'Others';
        column21 = 'Remarks';

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
                column21,
            ]
        );

        for (var i = 0, row; i < 1; i++) {
            column1 = '';
            column2 = '';
            column3 = '';
            column4 = "Change format to 'Text'";
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
            column21 = '';
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
                    column21,
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
        link.setAttribute("download", "GPI HLP Template.csv");
        document.body.appendChild(link);
        /* download the data file named "Stock_Price_Report.csv" */
        link.click();
    }
</script>