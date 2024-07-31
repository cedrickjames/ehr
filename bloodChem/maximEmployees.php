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
        location.href = 'maxim.php';
    </script>
<?php
}

if (isset($_POST['addBloodChem'])) {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $rfid = $_POST['rfid'];
    $type = $_POST['type'];
    $building_transaction = $_POST['building_transaction'];
    $diagnosis = $_POST['diagnosis'];
    $intervention = $_POST['intervention'];
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
    $ftwMeds = $_POST['ftwMeds'];

    echo $rfid . "<br>";
    echo $date . "<br>";
    echo $time . "<br>";
    echo $type . "<br>";
    echo $building_transaction . "<br>";
    echo $diagnosis . "<br>";
    echo $intervention . "<br>";
    echo $followupdate . "<br>";
    echo $remarks . "<br>";
    echo $fbs . "<br>";
    echo $cholesterol . "<br>";
    echo $triglycerides . "<br>";
    echo $hdl . "<br>";
    echo $ldl . "<br>";
    echo $bun . "<br>";
    echo $bua . "<br>";
    echo $sgpt . "<br>";
    echo $sgdt . "<br>";
    echo $hbaic . "<br>";
    echo $others . "<br>";

    if ($ftwMeds != "") {

        $ftwMeds = implode(', ', $ftwMeds);
    }
    echo $ftwMeds . "<br>";
    $addBloodChem = "INSERT INTO `bloodchem`(`rfid`, `date`, `time`, `building`, `type`, `diagnosis`, `intervention`, `medications`, `followupdate`, `remarks`, `FBS`, `cholesterol`, `triglycerides`, `HDL`, `LDL`, `BUN`, `BUA`, `SGPT`, `SGDT`, `HBA1C`, `others`) VALUES ('$rfid','$date','$time','$building_transaction','$type','$diagnosis','$intervention', '$ftwMeds', '$followupdate','$remarks','$fbs','$cholesterol','$triglycerides','$hdl', '$ldl', '$bun', '$bua', '$sgpt', '$sgdt', '$hbaic', '$others')";
    $resultInfo = mysqli_query($con, $addBloodChem);

    if ($resultInfo) {
        echo "<script>alert('Added Successfuly!') </script>";
        echo "<script> location.href='maxim.php'; </script>";
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

    $editBloodChem = "UPDATE `annualphysicalexam`SET `dateReceived`='$date_received' , `datePerformed` = '$date_performed', `name`= '$name', `section`= '$section', `IMC`= '$imc', `OEH`= '$oeh', `PE`= '$pe', `CBC`= '$cbc', `U_A`= '$ua', `FA`= '$fa', `CXR`= '$cxr', `VA`= '$va', `DEN`= '$den', `DT`= '$dt', `PT`= '$pt', `otherTest`= '$others', `followUpStatus`= '$followupstatus', `status`= '$status', `attendee` = '$attendee',`confirmationDate`= '$confirmationdate', `FMC`= '$fmc' WHERE `rfidNumber`='$rfid'";
    $resultInfo = mysqli_query($con, $editBloodChem);

    if ($resultInfo) {
        echo "<script>alert('Updated Successfuly!') </script>";
        echo "<script> location.href='maxim.php'; </script>";
    }
}

?>
<div class="text-[9px] 2xl:text-lg mb-5">
    <div class="flex justify-between">
        <p class="mb-2 my-auto"><span class=" self-center text-md font-semibold whitespace-nowrap   text-[#193F9F]">HLP Records - Maxim Employees</span></p>
        <div class="flex items-center order-2">
            <button type="button" data-modal-target="exportBloodChem" data-modal-toggle="exportBloodChem" class="lg:block text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2 mx-3 md:mx-2">Export</button>

            <button type="button" data-dropdown-toggle="options" class="lg:block text-white bg-gradient-to-r from-[#00669B] to-[#9AC1CA] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300  font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2 ">Add</button>
            <div id="options" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-2  text-gray-700 dark:text-gray-200" aria-labelledby="options">
                    <li>
                        <a type="button" data-modal-target="addBloodChem" data-modal-toggle="addBloodChem" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Add HLP</a>
                    </li>

                </ul>

            </div>
        </div>

    </div>

    <div id="" class="">
        <div class=" p-4 rounded-lg  bg-gray-50 " id="headApproval" role="tabpanel" aria-labelledby="profile-tab">
            <form action="maxim.php" method="post">
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
                            $HlpNo = 1;
                            $sql = "SELECT p.*, e.employer, e.Name, e.section, e.rfidNumber FROM bloodchem p 
                                    JOIN employeespersonalinfo e ON e.rfidNumber = p.rfid WHERE e.employer = 'Maxim' ORDER BY `id` ASC";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $HlpNo; ?></td>

                                    <td>
                                        <div class="content-center flex flex-wrap justify-center gap-2">
                                            <button id="dropdownMenuIconButton<?php echo $HlpNo; ?>" data-dropdown-toggle="dropdownDots<?php echo $HlpNo; ?>" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900  rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 bg-white dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                                    <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                                </svg>
                                            </button>


                                        </div>
                                        <!-- Dropdown menu -->
                                        <div id="dropdownDots<?php echo $HlpNo; ?>" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-2 text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton<?php echo $HlpNo; ?>">
                                                <li>
                                                    <a type="button" onclick="openEditModal(this)" data-rfid="<?php echo $row['rfidNumber']; ?>" data-name="<?php echo $row['Name']; ?>" data-section="<?php echo $row['section']; ?>" data-date="<?php echo $row['date']; ?>" data-time="<?php echo $row['time']; ?>" data-building="<?php echo $row['building']; ?>" data-type="<?php echo $row['type']; ?>" data-diagnosis="<?php echo $row['diagnosis']; ?>" data-intervention="<?php echo $row['intervention']; ?>" data-medications="<?php echo $row['medications']; ?>" data-followupdate="<?php echo $row['followupdate']; ?>" data-FBS="<?php echo $row['FBS']; ?>" data-cholesterol="<?php echo $row['cholesterol']; ?>" data-triglycerides="<?php echo $row['triglycerides']; ?>" data-HDL="<?php echo $row['HDL']; ?>" data-LDL="<?php echo $row['LDL']; ?>" data-BUN="<?php echo $row['BUN']; ?>" data-BUA="<?php echo $row['BUA']; ?>" data-SGPT="<?php echo $row['SGPT']; ?>" data-SGDT="<?php echo $row['SGDT']; ?>" data-HBA1C="<?php echo $row['HBA1C']; ?>" data-others="<?php echo $row['others']; ?>" data-remarks="<?php echo $row['remarks']; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit HLP Record</a>
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
                            <?php $HlpNo++;
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
                        <label for="name" class="block mb-1 font-semibold  text-gray-900 dark:text-white">Name</label>
                        <select id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                            <option selected disabled>Search Name</option>
                            <?php
                            $sql1 = "SELECT * FROM employeespersonalinfo e WHERE e.employer = 'Maxim' AND e.rfidNumber NOT IN (SELECT p.rfid FROM bloodchem p);";
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
                        <label for="rfid" class="block mb-1 font-semibold  text-gray-900 dark:text-white">RFID</label>
                        <input type="text" name="rfid" id="rfid" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " required="">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="section" class="block mb-1 font-semibold  text-gray-900 dark:text-white">Section</label>
                        <input type="text" name="section" id="section" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " required="">
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

<div id="editBloodChem1" tabindex="-1" aria-hidden="true" class="bg-[#615eae59] hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit HLP Record
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editBloodChem1">
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
                        <label for="editname" class="block mb-1 font-semibold  text-gray-900 dark:text-white">Name</label>
                        <select id="editname" name="editname" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                            <option selected disabled>Search Name</option>
                            <?php
                            $sql1 = "SELECT * FROM employeespersonalinfo e WHERE e.employer = 'Maxim' AND e.rfidNumber NOT IN (SELECT p.rfid FROM bloodchem p);";
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
                        <label for="editrfid" class="block mb-1 font-semibold  text-gray-900 dark:text-white">RFID</label>
                        <input type="text" name="editrfid" id="editrfid" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                    </div>
                    <div class="content-center  col-span-2">
                        <label for="editsection" class="block mb-1 font-semibold  text-gray-900 dark:text-white">Section</label>
                        <input type="text" name="editsection" id="editsection" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
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
                    <!-- <div class="grid grid-cols-4 col-span-4" id="medicineDivs">
                        <div class="col-span-4">

                            <label for="editftwMeds" class="block  my-auto font-semibold text-gray-900 ">Medicine (Add medicine below): </label>
                            <select name="editftwMeds[]" id="editftwMeds" multiple="multiple" class="form-control js-meds w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
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

                    </div> -->
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

                            <option selected value="Maxim">Maxim</option>

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


    const editBloodChem = document.getElementById('editBloodChem1');

    const editbloodchem = {

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

    const modalEdit = new Modal(editBloodChem, editbloodchem);

    function openEditModal(element) {
        modalEdit.toggle();
        console.log("rfid: " + element.getAttribute("data-rfid"));
        console.log("name: " + element.getAttribute("data-name"));
        console.log("date: " + element.getAttribute("data-date"));
        console.log("time: " + element.getAttribute("data-time"));
        console.log("section: " + element.getAttribute("data-section"));
        console.log("building: " + element.getAttribute("data-building"));
        console.log("type: " + element.getAttribute("data-type"));
        console.log("diagnosis: " + element.getAttribute("data-diagnosis"));
        console.log("intervention: " + element.getAttribute("data-intervention"));
        console.log("followupdate: " + element.getAttribute("data-followupdate"));
        console.log("FBS: " + element.getAttribute("data-FBS"));
        console.log("cholesterol: " + element.getAttribute("data-cholesterol"));
        console.log("triglycerides: " + element.getAttribute("data-triglycerides"));
        console.log("HDL: " + element.getAttribute("data-HDL"));
        console.log("LDL: " + element.getAttribute("data-LDL"));
        console.log("BUN: " + element.getAttribute("data-BUN"));
        console.log("BUA: " + element.getAttribute("data-BUA"));
        console.log("SGPT: " + element.getAttribute("data-SGPT"));
        console.log("SGDT: " + element.getAttribute("data-SGDT"));
        console.log("HBA1C: " + element.getAttribute("data-HBA1C"));
        console.log("others: " + element.getAttribute("data-others"));
        console.log("remarks: " + element.getAttribute("data-remarks"));


        // document.getElementById("editid").value = element.getAttribute("data-id");
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
</script>