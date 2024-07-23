<?php

if (isset($_POST['excelReport'])) {
    $_SESSION['month'] = $_POST['month'];
    $_SESSION['year'] = $_POST['year'];
?>
    <script type="text/javascript">
        window.open('../fittowork_xls.php?month=<?php echo $_SESSION['month']; ?>&year=<?php echo $_SESSION['year']; ?>', '_blank');
    </script>
<?php
}


if (isset($_POST['updateFTW2'])) {
    $ftw = $_POST['ftwId'];
    $ftwDate = $_POST['ftwDate'];
    $ftwTime = $_POST['ftwTime'];
    $ftwCategories = $_POST['ftwCategories'];
    $ftwBuilding = $_POST['ftwBuilding'];
    $ftwConfinement = $_POST['ftwConfinement'];
    $ftwMedCategory = $_POST['ftwMedCategory'];
    $ftwSLDateFrom = $_POST['ftwSLDateFrom'];
    $ftwSLDateTo = $_POST['ftwSLDateTo'];
    $ftwDays = $_POST['ftwDays'];
    $ftwAbsenceReason = $_POST['ftwAbsenceReason'];
    $ftwDiagnosis = $_POST['ftwDiagnosis'];
    $ftwBloodChem = $_POST['ftwBloodChem'];
    $ftwCbc = $_POST['ftwCbc'];
    $ftwUrinalysis = $_POST['ftwUrinalysis'];
    $ftwFecalysis = $_POST['ftwFecalysis'];
    $ftwXray = $_POST['ftwXray'];
    $ftwOthersLab = $_POST['ftwOthersLab'];
    $ftwBp = $_POST['ftwBp'];
    $ftwTemp = $_POST['ftwTemp'];
    $ftw02Sat = $_POST['ftw02Sat'];
    $ftwPr = $_POST['ftwPr'];
    $ftwRr = $_POST['ftwRr'];
    $ftwRemarks = $_POST['ftwRemarks'];
    $ftwOthersRemarks = $_POST['ftwOthersRemarks'];
    $ftwCompleted = $_POST['ftwCompleted'];
    $ftwWithPendingLab = $_POST['ftwWithPendingLab'];

    if ($ftwCompleted == "on") {
        $status = 1;
    } else {
        $status = 0;
    }

    $ftwMeds = $_POST['ftwMeds'];

    if ($ftwMeds != "") {
        $ftwMeds = implode(', ', $ftwMeds);
    }

    $sql = "UPDATE `fittowork` SET `date`='$ftwDate',`time`='$ftwTime',`categories`='$ftwCategories',`building`='$ftwBuilding',`confinementType`='$ftwConfinement',`medicalCategory`='$ftwMedCategory',`medicine`='$ftwMeds',`fromDateOfSickLeave`='$ftwSLDateFrom',`toDateOfSickLeave`='$ftwSLDateTo',`days`='$ftwDays',`reasonOfAbsence`='$ftwAbsenceReason',`diagnosis`='$ftwDiagnosis',`bloodChemistry`='$ftwBloodChem',`cbc`='$ftwCbc',`urinalysis`='$ftwUrinalysis',`fecalysis`='$ftwFecalysis',`xray`='$ftwXray',`others`='$ftwOthersLab',`bp`='$ftwBp',`temp`='$ftwTemp',`02sat`='$ftw02Sat',`pr`='$ftwPr',`rr`='$ftwRr',`remarks`='$ftwRemarks',`otherRemarks`='$ftwOthersRemarks',`statusComplete`='$status',`withPendingLab`='$ftwWithPendingLab' WHERE `id`= '$ftw';";
    $results = mysqli_query($con, $sql);
    if ($results) {
        echo "<script>alert('Record updated succesfully!')</script>";
    } else {
        echo "<script>alert('There's a problem updating.')</script>";
    }
}

?>


<div class="text-[9px] 2xl:text-lg mb-5">
    <div class="flex justify-between">
        <p class="mb-2 my-auto"><span class=" self-center text-md font-semibold whitespace-nowrap   text-[#193F9F]">Fit To Work</span></p>
        <button type="button" data-modal-target="exportFTW" data-modal-toggle="exportFTW" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800  rounded-lg  px-5 py-2.5 text-center me-2 mb-2">Export</button>
    </div>
    <div id="" class="">
        <div class=" p-4 rounded-lg  bg-gray-50 " id="" role="tabpanel" aria-labelledby="profile-tab">
            <section class="mt-2 2xl:mt-10">
                <table id="clinicVisits" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Action</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Bldg Transaction</th>
                            <th>Name</th>
                            <th>Reason of Absence</th>
                            <th>Diagnosis</th>
                            <th>Medical Category</th>
                            <th>Confinement Type</th>
                            <th>Date of Absence From</th>
                            <th>Date of Absence To</th>
                            <th>Laboratory</th>
                            <th>Vital Signs</th>
                            <th>Remarks</th>
                            <th>Other Remarks</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ftwNo = 1;
                        $sql = "SELECT f.*, e.Name FROM `fittowork`f LEFT JOIN `employeespersonalinfo` e ON e.rfidNumber = f.rfid ORDER BY `id` ASC; 
                    ";
                        $result = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {


                            if ($row['statusComplete'] == true || $row['statusComplete'] == 1) {
                                $status = "Completed";
                            } elseif ($row['withPendingLab'] != NULL || $row['withPendingLab'] != "") {
                                $status = "With pending laboratory: " . $row['withPendingLab'];
                            }
                        ?>

                            <tr>
                                <td> <?php echo $ftwNo; ?> </td>
                                <td>
                                    <button type="button" onclick="showEditModal(this)" data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['Name']; ?>" data-date="<?php echo $row['date']; ?>" data-time="<?php echo $row['time']; ?>" data-category="<?php echo $row['categories']; ?>" data-building="<?php echo $row['building']; ?>" data-reasonofabsence="<?php echo $row['reasonOfAbsence']; ?>" data-diagnosis="<?php echo $row['diagnosis']; ?>" data-medicalcategory="<?php echo $row['medicalCategory']; ?>" data-medicine="<?php echo $row['medicine']; ?>" data-confinementtype="<?php echo $row['confinementType']; ?>" data-fromdateofsickleave="<?php echo $row['fromDateOfSickLeave']; ?>" data-todateofsickleave="<?php echo $row['toDateOfSickLeave']; ?>" data-sldays="<?php echo $row['days']; ?>" data-bloodchemistry="<?php echo $row['bloodChemistry']; ?>" data-cbc="<?php echo $row['cbc']; ?>" data-urinalysis="<?php echo $row['urinalysis']; ?>" data-fecalysis="<?php echo $row['fecalysis']; ?>" data-xray="<?php echo $row['xray']; ?>" data-others="<?php echo $row['others']; ?>" data-bp="<?php echo $row['bp']; ?>" data-temp="<?php echo $row['temp']; ?>" data-02sat="<?php echo $row['02sat']; ?>" data-pr="<?php echo $row['pr']; ?>" data-rr="<?php echo $row['rr']; ?>" data-othersremarks="<?php echo $row['otherRemarks']; ?>" data-remarks="<?php echo $row['remarks']; ?>" data-statuscomplete="<?php echo $row['statusComplete']; ?>" data-withpendinglab="<?php echo $row['withPendingLab']; ?>" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</button>
                                </td>
                                <td> <?php echo $row['date']; ?> </td>
                                <td> <?php echo $row['time']; ?> </td>
                                <td> <?php echo $row['building']; ?> </td>
                                <td> <?php echo $row['Name']; ?> </td>
                                <td> <?php echo $row['reasonOfAbsence']; ?> </td>
                                <td> <?php echo $row['diagnosis']; ?> </td>
                                <td> <?php echo $row['medicalCategory']; ?> </td>
                                <td> <?php echo $row['confinementType']; ?> </td>
                                <td> <?php echo $row['fromDateOfSickLeave']; ?> </td>
                                <td> <?php echo $row['toDateOfSickLeave']; ?> </td>
                                <td> <?php

                                        if ($row['bloodChemistry'] != "") {
                                            echo "bloodchem: " . $row['bloodChemistry'] . " ";
                                        }
                                        if ($row['cbc'] != "") {
                                            echo "cbc: " . $row['cbc'] . " ";
                                        }
                                        if ($row['urinalysis'] != "") {
                                            echo "urinalysis: " . $row['urinalysis'] . " ";
                                        }
                                        if ($row['fecalysis'] != "") {
                                            echo "fecalysis: " . $row['fecalysis'] . " ";
                                        }
                                        if ($row['xray'] != "") {
                                            echo "xray: " . $row['xray'] . " ";
                                        }
                                        if ($row['others'] != "") {
                                            echo "others: " . $row['others'] . " ";
                                        }
                                        ?> </td>
                                <td> <?php

                                        if ($row['bp'] != "") {
                                            echo "bp: " . $row['bp'] . " ";
                                        }
                                        if ($row['temp'] != "") {
                                            echo "temp: " . $row['temp'] . " ";
                                        }
                                        if ($row['02sat'] != "") {
                                            echo "02sat: " . $row['02sat'] . " ";
                                        }
                                        if ($row['pr'] != "") {
                                            echo "pr: " . $row['pr'] . " ";
                                        }
                                        if ($row['rr'] != "") {
                                            echo "rr: " . $row['rr'] . " ";
                                        }
                                        ?> </td>
                                <td> <?php echo $row['remarks']; ?> </td>
                                <td> <?php echo $row['otherRemarks']; ?> </td>
                                <td> <?php echo $status ?> </td>
                            </tr>


                        <?php

                            $ftwNo++;
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>

</div>
<div id="exportFTW" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" data-modal-toggle="exportFTW" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Export Fit to work</h3>
                <form class="space-y-6" action="" method="POST">
                    <div>

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

                    </div>
                    <div>
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


<div id="editFittowork" tabindex="-1" aria-hidden="true" class="bg-[#615eae59] hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit Fit To Work Record
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editFittowork">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->

            <form method="POST" action="">
                <div class="text-[9px] 2xl:text-lg  rounded-lg bg-white/50 grid grid-cols-4 gap-1 w-full w-full p-4 ">
                    <input type="text" name="ftwId" id="ftwId" class="hidden">
                    <div class="col-span-4 gap-4">
                        <label class="block  my-auto  font-semibold text-gray-900 ">Name: </label>
                        <input type="text" name="ftwName" id="ftwName" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
                    </div>
                    <div class="content-center  col-span-2">
                        <label class="block  my-auto font-semibold text-gray-900 ">Date: </label>
                        <input type="date" name="ftwDate" id="ftwDate" class="bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ">

                    </div>
                    <div class=" col-span-2">
                        <label class="block my-auto  font-semibold text-gray-900 ">Time: </label>
                        <input type="text" id="ftwTime" name="ftwTime" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500">
                    </div>
                    <div class="  col-span-2">

                        <label class="block my-auto  font-semibold text-gray-900 ">Categories: </label>
                        <select id="ftwCategories" name="ftwCategories" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                            <option value="counted">Counted</option>
                            <option value="not counted">Not Counted</option>
                        </select>

                    </div>
                    <div class="  col-span-2">

                        <label class="block my-auto  font-semibold text-gray-900 ">Building:</label>
                        <select id="ftwBuilding" name="ftwBuilding" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                            <option value="GPI 1">GPI 1</option>
                            <option value="GPI 5">GPI 5</option>
                            <option value="GPI 7">GPI 7</option>
                            <option value="GPI 8">GPI 8</option>
                        </select>

                    </div>

                    <div class="  col-span-2">

                        <label class="block my-auto  font-semibold text-gray-900 ">Confinement Type: </label>
                        <select id="ftwConfinement" name="ftwConfinement" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                            <option value="Hospital Confinement">Hospital Confinement</option>
                            <option value="Home Confinement">Home Confinement</option>

                        </select>

                    </div>
                    <div class="  col-span-2">

                        <label class="block my-auto  font-semibold text-gray-900 ">Medical Category:</label>
                        <select id="ftwMedCategory" name="ftwMedCategory" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                            <option value="Common">Common</option>
                            <option value="Long Term">Long Term</option>
                            <option value="Maternity">Maternity</option>
                            <option value="Work Related">Work Related</option>
                        </select>

                    </div>
                    <div class="content-center  col-span-2">
                        <label class="block w-full my-auto font-semibold text-gray-900 ">Sick Leave</label>
                        <div class="flex gap-2 w-full">
                            <div class="relative w-1/2">
                                <input type="date" name="ftwSLDateFrom" id="ftwSLDateFrom" class="bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ">
                                <label for="ftwSLDateFrom" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]  px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">From</label>

                            </div>
                            <div class="relative w-1/2">
                                <input type="date" name="ftwSLDateTo" id="ftwSLDateTo" class="bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ">
                                <label for="ftwSLDateTo" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]  px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">To</label>
                            </div>
                        </div>
                    </div>


                    <div class="content-center col-span-2">



                        <label class=" block my-auto font-semibold text-gray-900 ">Days</label>
                        <input type="number" name="ftwDays" id="ftwDays" class="w-full bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">

                    </div>

                    <div class=" gap-4 col-span-2">
                        <label for="ftwAbsenceReason" class="block  my-auto w-full font-semibold text-gray-900 ">Reason of Absence: </label>
                        <input type="text" name="ftwAbsenceReason" id="ftwAbsenceReason" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                    </div>
                    <div class=" gap-4 col-span-2">
                        <label class="block  my-auto  font-semibold text-gray-900 ">Diagnosis: </label>
                        <select id="ftwDiagnosis" name="ftwDiagnosis" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

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
                                    <!-- <input type="number"  name="cnsltnMedsQuantity" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 "> -->


                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-span-4">
                        <h3 class=" my-auto w-full font-semibold text-gray-900 ">Laboratory: </h3>
                    </div>
                    <div class="ml-4 grid grid-cols-4  col-span-4 gap-1">
                        <div class="col-span-2">
                            <label class="block my-auto  font-semibold text-gray-900 ">Blood Chemistry: </label>
                            <input type="text" name="ftwBloodChem" id="ftwBloodChem" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>

                        <div class="col-span-2">
                            <label class="block my-auto  font-semibold text-gray-900 ">CBC: </label>
                            <input type="text" name="ftwCbc" id="ftwCbc" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>

                        <div class="col-span-2">
                            <label class="block my-auto  font-semibold text-gray-900 ">Urinalysis: </label>
                            <input type="text" name="ftwUrinalysis" id="ftwUrinalysis" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>

                        <div class="col-span-2">
                            <label class="block my-auto  font-semibold text-gray-900 ">Fecalysis: </label>
                            <input type="text" name="ftwFecalysis" id="ftwFecalysis" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>

                        <div class="col-span-2">
                            <label class="block my-auto  font-semibold text-gray-900 ">X-ray: </label>
                            <input type="text" name="ftwXray" id="ftwXray" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>

                        <div class="col-span-2">
                            <label class="block my-auto  font-semibold text-gray-900 ">Others: </label>
                            <input type="text" name="ftwOthersLab" id="ftwOthersLab" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                        </div>
                        <div class="col-span-4">
                            <h3 class=" my-auto w-full font-semibold text-gray-900 ">Vital Signs: </h3>
                        </div>

                        <div class=" flex col-span-3">

                            <div class="grid grid-cols-3 gap-1">
                                <div class="">
                                    <label class="block  my-auto  font-semibold text-gray-900 ">BP: </label>
                                    <input type="text" name="ftwBp" id="ftwBp" class="  bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                                </div>
                                <div class="">
                                    <label class="block  my-auto  font-semibold text-gray-900 ">Temp: </label>
                                    <input type="text" name="ftwTemp" id="ftwTemp" class="  bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                                </div>
                                <div class="">
                                    <label class="block  my-auto  font-semibold text-gray-900 ">02 Sat: </label>
                                    <input type="text" name="ftw02Sat" id="ftw02Sat" class="  bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                                </div>
                                <div class="">
                                    <label class="block  my-auto  font-semibold text-gray-900 ">PR: </label>
                                    <input type="text" name="ftwPr" id="ftwPr" class="  bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                                </div>
                                <div class="">
                                    <label class="block  my-auto  font-semibold text-gray-900 ">RR: </label>
                                    <input type="text" name="ftwRr" id="ftwRr" class="  bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                                </div>

                            </div>


                        </div>
                    </div>
                    <div class="col-span-4 ">
                        <label class="block  my-auto  font-semibold text-gray-900 ">Remarks: </label>
                        <select id="ftwRemarks" name="ftwRemarks" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                            <option value="Fit to Work">Fit To Work</option>
                            <option value="Late FTW">Late FTW</option>
                            <option value="No Medical Certificate">No Medical Certificate</option>
                            <option value="Others">Others</option>



                        </select>
                    </div>
                    <div class="col-span-4 gap-4">
                        <label class="block  my-auto  font-semibold text-gray-900 ">Others: </label>
                        <input type="text" name="ftwOthersRemarks" id="ftwOthersRemarks" class="  bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                    </div>

                    <div class="col-span-4 gap-4">

                        <label class="block my-auto  font-semibold text-gray-900 ">Status</label>
                        <ul class="col-span-2 items-center w-full  text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex  ">
                            <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                                <div class="gap-2 flex items-center ps-3">
                                    <input id="ftwCompleted" type="checkbox" name="ftwCompleted" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
                                    <label for="ftwCompleted" class="w-full py-3 ms-2  text-gray-900 ">Completed</label>
                                </div>
                            </li>

                            <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                                <div class="gap-2 flex items-center ps-3">
                                    <input name="ftwWithPendingLabStatus" id="ftwWithPendingLabStatus" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
                                    <label for="vue-checkbox-list" class=" py-3 ms-2  text-gray-900 ">With Pending Lab</label>
                                    <div class="relative z-0 group">
                                        <input type="text" name="ftwWithPendingLab" id="ftwWithPendingLab" class="block py-2.5 px-0  text-[12px] 2xl:text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none    focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />

                                    </div>
                                </div>

                            </li>

                        </ul>

                    </div>

                    <div class="col-span-4 justify-center flex gap-2">
                        <button type="submit" name="updateFTW2" class="w-64 text-white bg-gradient-to-r from-[#00669B]  to-[#9AC1CA] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300  shadow-lg shadow-teal-500/50  font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2">Update Record</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    const editFittowork = document.getElementById('editFittowork');
    const FittoworkModal = {
        backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 relative inset-0 z-40',
        closable: true,
        onHide: () => {},
        onShow: () => {},
        onToggle: () => {},
    };

    const modalEdit = new Modal(editFittowork, FittoworkModal);

    function showEditModal(element) {

        modalEdit.toggle();
        // console.log("id: " + element.getAttribute("data-id"));
        // console.log("name: " + element.getAttribute("data-name"));
        // console.log("date: " + element.getAttribute("data-date"));
        // console.log("time: " + element.getAttribute("data-time"));
        // console.log("category: " + element.getAttribute("data-category"));
        // console.log("building: " + element.getAttribute("data-building"));
        // console.log("reasonofabsence: " + element.getAttribute("data-reasonofabsence"));
        // console.log("diagnosis: " + element.getAttribute("data-diagnosis"));
        // console.log("medicalcategory: " + element.getAttribute("data-medicalcategory"));
        // console.log("confinementtype: " + element.getAttribute("data-confinementtype"));
        // console.log("fromdateofsickleave: " + element.getAttribute("data-fromdateofsickleave"));
        // console.log("todateofsickleave: " + element.getAttribute("data-todateofsickleave"));
        // console.log("sldays: " + element.getAttribute("data-sldays"));
        // console.log("bloodchemistry: " + element.getAttribute("data-bloodchemistry"));
        // console.log("cbc: " + element.getAttribute("data-cbc"));
        // console.log("urinalysis: " + element.getAttribute("data-urinalysis"));
        // console.log("fecalysis: " + element.getAttribute("data-fecalysis"));
        // console.log("xray: " + element.getAttribute("data-xray"));
        // console.log("others: " + element.getAttribute("data-others"));
        // console.log("bp: " + element.getAttribute("data-bp"));
        // console.log("temp: " + element.getAttribute("data-temp"));
        // console.log("02sat: " + element.getAttribute("data-02sat"));
        // console.log("pr: " + element.getAttribute("data-pr"));
        // console.log("rr: " + element.getAttribute("data-rr"));
        // console.log("othersremarks: " + element.getAttribute("data-othersremarks"));
        // console.log("remarks: " + element.getAttribute("data-remarks"));
        // console.log("statuscomplete: " + element.getAttribute("data-statuscomplete"));
        // console.log("withpendinglab: " + element.getAttribute("data-withpendinglab"));

        if (element.getAttribute("data-statuscomplete") == 1) {
            document.getElementById("ftwCompleted").checked = true;

        } else {
            document.getElementById("ftwCompleted").checked = false;

        }
        if (element.getAttribute("data-withpendinglab") != "") {
            document.getElementById("ftwWithPendingLabStatus").checked = true;
        }

        str = element.getAttribute("data-medicine");
        medicine = str.split(',');
        $('#ftwMeds').empty();
        if (medicine != "") {
            function addSelectedValue(value) {
                $('#ftwMeds').append($('<option>', {
                    value: value,
                    text: value,
                    selected: true
                }));
            }
            medicine.forEach(function(value) {
                addSelectedValue(value);
            });
        }

        // console.log("medicine: " + medicine);
        document.getElementById("ftwId").value = element.getAttribute("data-id");
        document.getElementById("ftwName").value = element.getAttribute("data-name");
        document.getElementById("ftwDate").value = element.getAttribute("data-date");
        document.getElementById("ftwTime").value = element.getAttribute("data-time");
        document.getElementById("ftwCategories").value = element.getAttribute("data-category");
        document.getElementById("ftwBuilding").value = element.getAttribute("data-building");
        document.getElementById("ftwAbsenceReason").value = element.getAttribute("data-reasonofabsence");
        document.getElementById("ftwDiagnosis").value = element.getAttribute("data-diagnosis");
        document.getElementById("ftwMedCategory").value = element.getAttribute("data-medicalcategory");
        document.getElementById("ftwConfinement").value = element.getAttribute("data-confinementtype");
        document.getElementById("ftwSLDateFrom").value = element.getAttribute("data-fromdateofsickleave");
        document.getElementById("ftwSLDateTo").value = element.getAttribute("data-todateofsickleave");
        document.getElementById("ftwDays").value = element.getAttribute("data-sldays");
        document.getElementById("ftwBloodChem").value = element.getAttribute("data-bloodchemistry");
        document.getElementById("ftwCbc").value = element.getAttribute("data-cbc");
        document.getElementById("ftwUrinalysis").value = element.getAttribute("data-urinalysis");
        document.getElementById("ftwFecalysis").value = element.getAttribute("data-fecalysis");
        document.getElementById("ftwXray").value = element.getAttribute("data-xray");
        document.getElementById("ftwOthersLab").value = element.getAttribute("data-others");
        document.getElementById("ftwBp").value = element.getAttribute("data-bp");
        document.getElementById("ftwTemp").value = element.getAttribute("data-temp");
        document.getElementById("ftw02Sat").value = element.getAttribute("data-02sat");
        document.getElementById("ftwPr").value = element.getAttribute("data-pr");
        document.getElementById("ftwRr").value = element.getAttribute("data-rr");
        document.getElementById("ftwOthersRemarks").value = element.getAttribute("data-othersremarks");
        document.getElementById("ftwRemarks").value = element.getAttribute("data-remarks");
        document.getElementById("ftwWithPendingLab").value = element.getAttribute("data-withpendinglab");
    }
</script>
<script>
    function showData(element) {
        var id = element.getAttribute("data-id");
        var rf = element.getAttribute("data-rfid");
        var currentUrl = window.location.href; // Get the current URL
        var url = new URL(currentUrl);
        var rfParam = url.searchParams.get('rf');
        if (rfParam) {
            // Construct the new URL by appending the consultId

            window.location.href = "fitToWork.php?rf=" + rf + '&ftw=' + id; // Navigate to the new URL
        } else {
            console.error('The "rf" parameter is not present in the current URL.');
        }

    }
</script>