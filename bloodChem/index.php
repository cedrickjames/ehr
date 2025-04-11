<?php
session_start();

include("../includes/connect.php");
if (!isset($_SESSION['connected'])) {
  header("location: ../logout.php");
}

?>


<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HLP</title>
<link rel="shortcut icon" href="../src/Logo 2.png">

  <script src="../src/cdn_tailwindcss.js"></script>

  <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>

  <link rel="stylesheet" href="../fontawesome-free-6.2.0-web/css/all.min.css">
  <link rel="stylesheet" href="../node_modules/DataTables/datatables.min.css">
  <link href="../node_modules/select2/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="../node_modules/DataTables/Responsive-2.3.0/css/responsive.dataTables.min.css" />
  <link rel="stylesheet" type="text/css" href="../styles.css" />

</head>

<body class="bg-no-repeat bg-cover bg-[url('../src/Background.png')]">
  <?php require_once 'navbar.php'; ?>

  <div style=" background: linear-gradient(-45deg, #a6d0ff, rgba(255, 255, 255, 0.63), rgba(255, 255, 255, 0));" class=" m-auto ml-56 2xl:ml-[22rem] flex   left-10 right-5  flex-col  px-2   pt-2 2xl:pt-6 pb-14 z-50 ">
    <div class="m-2">

      <?php require_once 'directEmployees.php'; ?>



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

  </div>

  <script src="../node_modules/jquery/dist/jquery.min.js"></script>

  <script type="text/javascript" src="../node_modules/DataTables/datatables.min.js"></script>
  <script type="text/javascript" src="../node_modules/DataTables/Responsive-2.3.0/js/dataTables.responsive.min.js"></script>

  <script src="../node_modules/select2/dist/js/select2.min.js"></script>
  <script type="text/javascript" src="index.js"></script>
  <script>


$(".js-diagnosis").select2({
    tags: true
  });
  $(".js-meds").select2({
    tags: true
  });

const $tagertDiagnosisModal = document.getElementById('addDiagnosis');
  const optionsDiagnosisModal = {
    placement: 'center-center',
    backdrop: 'static',
    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
    closable: true,
    onHide: () => {
    },
    onShow: () => {

    },
    onToggle: () => {
    }
  };
  const modalDiagnosis = new Modal($tagertDiagnosisModal, optionsDiagnosisModal);
  $(document).ready(function() {
    // Attach change event handler to remarksSelect
    $("#ftwDiagnosiOption").change(function() {
      // Check if the selected option is the one you want
      if ($(this).val() === "addDiagnosisButton") {
        // Remove the "hidden" class from the input with id "medLab"
        console.log("ced")
        modalDiagnosis.toggle();
      }
    });
  });

  function addDiagnosis() {
    var diagnosis = document.getElementById("diagnosis").value;
    var addDiagnosis = new XMLHttpRequest();
    addDiagnosis.open("POST", "addDiagnosis.php", true);
    addDiagnosis.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    addDiagnosis.onreadystatechange = function() {
      if (addDiagnosis.readyState === XMLHttpRequest.DONE) {
        if (addDiagnosis.status === 200) {
          // Update was successful
          try {
                    var response = JSON.parse(addDiagnosis.responseText);
                    if (response.success) {
                        // Update was successful
                        modalDiagnosis.toggle();
                        alert("Diagnosis added successfully!");
                    } else {
                        // Display the SQL error
                        console.log("Error: " + response.error);
                        alert("Error: " + response.error);
                    }
                } catch (e) {
                    console.log("Error parsing JSON response: " + e.message);
                    alert("Error parsing response from server.");
                }
        } else {
          console.log("Error: " + addDiagnosis.status);
        }
      }
    };

    // Construct the data to be updated
    var data = "addedDiagnosis=" + encodeURIComponent(diagnosis);
    var optionValue = $("#diagnosis").val();

    $("#ftwDiagnosiOption").append($('<option>', {
      value: optionValue,
      text: optionValue
    }));
    // data += "&computername="+ encodeURIComponent(result);

    // Add any other parameters needed for the update
    addDiagnosis.send(data);
  }




  
  const $tagertMedicineModal = document.getElementById('addMedicine');

const optionsMedicineModal = {
placement: 'center-center',
backdrop: 'static',
backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
closable: true,
onHide: () => {
console.log('modal is hidden');
},
onShow: () => {
console.log('modal is shown');

},
onToggle: () => {
console.log('modal has been toggled');

}
};
const modalMedicine = new Modal($tagertMedicineModal, optionsMedicineModal);


function addMedicine(){
var medicine = document.getElementById("medicine").value;
console.log(medicine);

var addMedicine = new XMLHttpRequest();
addMedicine.open("POST", "addMedicine.php", true);
addMedicine.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
addMedicine.onreadystatechange = function() {
  if (addMedicine.readyState === XMLHttpRequest.DONE) {
      if (addMedicine.status === 200) {
          // Update was successful
          console.log(addMedicine);

      
      } else {
          console.log("Error: " + addMedicine.status);
      }
  }
};

// Construct the data to be updated
var data = "addedMedicine=" + encodeURIComponent(medicine);

var optionValue = $("#medicine").val();

$("#nameOfMedicine").append($('<option>', {
                  value: optionValue,
                  text: optionValue
              }));
// data += "&computername="+ encodeURIComponent(result);

// Add any other parameters needed for the update

addMedicine.send(data);
modalMedicine.toggle();

}


$("#nameOfMedicine").change(function() {


// Check if the selected option is the one you want
if ($(this).val() === "addMedicineButton") {
  // Remove the "hidden" class from the input with id "medLab"
  modalMedicine.toggle();
  // console.log("kasjhdkas");

} 
});







$(".js-employees").select2({
      tags: true
    });


    
     <?php
    $sidebar1;

    if($employer=="GPI"){
      $sidebar1 ="#gpiside_1";
    }
    else if($employer=="Maxim"){
      $sidebar1 ="#maximside_1";

    }
    else if($employer=="Nippi"){
      $sidebar1 ="#nippiside_1";

    }
    else if($employer=="Powerlane"){
      $sidebar1 ="#powerlaneside_1";

    }
    else if($employer=="Otrelo"){
      $sidebar1 ="#otreloside_1";

    }
    else if($employer=="Alarm"){
      $sidebar1 ="#alarmside_1";

    }
    else if($employer=="Mangreat"){
      $sidebar1 ="#mangreatside_1";

    }
    else if($employer=="Canteen"){
      $sidebar1 ="#canteenside_1";

    }
    ?>

    $("<?php echo $sidebar1; ?>").addClass("bg-[#82c7cc]");
    $("#bloodchemSide").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");


    $("#sidehistory").removeClass("bg-gray-200");
    $("#sideMyRequest").removeClass("bg-gray-200");
    $("#sidepms").removeClass("bg-gray-200");

    $("#preempside1").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");
    $("#sidehistory1").removeClass("bg-gray-200");
    $("#sideMyRequest1").removeClass("bg-gray-200");
    $("#sidepms1").removeClass("bg-gray-200");
    // $(".preempIcon").attr("fill", "#FFFFFF");
    // $(".homeIcon").attr("fill", "#4d4d4d");

    $(".js-meds").select2({
      tags: true
    });
    $(".js-meds1").select2({
      tags: true
    });

    function addSelectedValue(value, qty) {
      console.log(value);
      $('#hlpftwMeds').append($('<option>', {
        value: value + "(" + qty + ")",
        text: value + "(" + qty + ")",
        selected: true
      }));
    }

    function addSelectedValue1(value, qty) {
      console.log(value);
      $('#editftwMeds').append($('<option>', {
        value: value + "(" + qty + ")",
        text: value + "(" + qty + ")",
        selected: true
      }));
    }


    const $targetEl = document.getElementById('sidebar');

    const options = {
      placement: 'left',
      backdrop: false,
      bodyScrolling: true,
      edge: false,
      edgeOffset: '',
      backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-30',
      onHide: () => {
        console.log('drawer is hidden');
      },
      onShow: () => {
        console.log('drawer is shown');
      },
      onToggle: () => {
        console.log('drawer has been toggled');
      }
    };

    const drawer = new Drawer($targetEl, options);
    drawer.show();
    var show = true;


    var screenWidth = window.screen.width; // Screen width in pixels
    var screenHeight = window.screen.height; // Screen height in pixels

    console.log("Screen width: " + screenWidth);
    console.log("Screen height: " + screenHeight);
    var sidebar = 0;



    function shows() {
      if (show) {
        drawer.hide();
        show = false;
      } else {
        drawer.show();
        show = true;
      }
      // var sidebar=0;
      if (sidebar == 0) {
        document.getElementById("mainContent").style.width = "100%";
        document.getElementById("mainContent").style.marginLeft = "0px";
        // document.getElementById("sidebar").style.opacity= ""; 
        // document.getElementById("sidebar").style.transition = "all .1s";

        document.getElementById("mainContent").style.transition = "all .3s";






        sidebar = 1;
      } else {
        document.getElementById("mainContent").style.width = "calc(100% - 288px)";
        document.getElementById("mainContent").style.marginLeft = "288px";

        sidebar = 0;
      }


    }

    if (screenWidth <= 1132) {
      shows();

    } else {
      drawer.show();
      // sidebar=0;/

    }
  </script>

<script>





$("#interventionSelect").change(function() {

if ($(this).val() === "Clinic Rest Only" || $(this).val() === "Medication, Clinic Rest and Medical Consultation") {

  if($(this).val() === "Clinic Rest Only"){
    $("#clinicRestLabel").removeClass("hidden");
  $("#clinicRestTime").removeClass("hidden");

  $("#medsqtydiv").addClass("hidden");
  $("#medicineDiv").addClass("hidden");

  $("#medsdiv").addClass("hidden");
  


  

  }else{
    $("#clinicRestLabel").removeClass("hidden");
  $("#clinicRestTime").removeClass("hidden");
  $("#medsqtydiv").removeClass("hidden");
  $("#medicineDiv").removeClass("hidden");

  $("#medsdiv").removeClass("hidden");
  }

    // Remove the "hidden" class from the input with id "medLab"


}
else{
  $("#clinicRestLabel").addClass("hidden");
  $("#clinicRestTime").addClass("hidden");
  $("#medsqtydiv").removeClass("hidden");
  $("#medicineDiv").removeClass("hidden");

  $("#medsdiv").removeClass("hidden");
} 
});


const exportBloodChem = document.getElementById('exportModal');

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


const $targetPromptModal = document.getElementById('askFirst');
  const optionsPromptModal = {
    placement: 'center-center',
    backdrop: 'static',
    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
    closable: true,
    onHide: () => {
    },
    onShow: () => {

    },
    onToggle: () => {
    }
  };
  const modalPrompt = new Modal($targetPromptModal, optionsPromptModal);

  $("#proceedButton").click(function() {

    modalPrompt.toggle();

    });


    

    $(document).ready(function() {
        const hlpfbsmin = parseFloat(document.getElementById('hlpfbsmin').value);
        const hlpfbsmax = parseFloat(document.getElementById('hlpfbsmax').value);

        const hlpcholesterolmin = parseFloat(document.getElementById('hlpcholesterolmin').value);
        const hlpcholesterolmax = parseFloat(document.getElementById('hlpcholesterolmax').value);

        const hlptriglyceridesmin = parseFloat(document.getElementById('hlptriglyceridesmin').value);
        const hlptriglyceridesmax = parseFloat(document.getElementById('hlptriglyceridesmax').value);

        const hlphdlmin = parseFloat(document.getElementById('hlphdlmin').value);
        const hlphdlmax = parseFloat(document.getElementById('hlphdlmax').value);

        const hlpldlmin = parseFloat(document.getElementById('hlpldlmin').value);
        const hlpldlmax = parseFloat(document.getElementById('hlpldlmax').value);

        const hlpbunmin = parseFloat(document.getElementById('hlpbunmin').value);
        const hlpbunmax = parseFloat(document.getElementById('hlpbunmax').value);

        const hlpcreatininemin = parseFloat(document.getElementById('hlpcreatininemin').value);
        const hlpcreatininemax = parseFloat(document.getElementById('hlpcreatininemax').value);

        const hlpbuamin = parseFloat(document.getElementById('hlpbuamin').value);
        const hlpbuamax = parseFloat(document.getElementById('hlpbuamax').value);

        const hlpsgdtmin = parseFloat(document.getElementById('hlpsgdtmin').value);
        const hlpsgdtmax = parseFloat(document.getElementById('hlpsgdtmax').value);

        const hlpsgptmin = parseFloat(document.getElementById('hlpsgptmin').value);
        const hlpsgptmax = parseFloat(document.getElementById('hlpsgptmax').value);

        const hlphbaicmin = parseFloat(document.getElementById('hlphbaicmin').value);
        const hlphbaicmax = parseFloat(document.getElementById('hlphbaicmax').value);

        const hlpKmin = parseFloat(document.getElementById('hlpKmin').value);
        const hlpKmax = parseFloat(document.getElementById('hlpKmax').value);

        const hlpNamin = parseFloat(document.getElementById('hlpNamin').value);
        const hlpNamax = parseFloat(document.getElementById('hlpNamax').value);

        const FT3min = parseFloat(document.getElementById('FT3min').value);
        const FT3max = parseFloat(document.getElementById('FT3max').value);

        const FT4min = parseFloat(document.getElementById('FT4min').value);
        const FT4max = parseFloat(document.getElementById('FT4max').value);

        const TSHmin = parseFloat(document.getElementById('TSHmin').value);
        const TSHmax = parseFloat(document.getElementById('TSHmax').value);


   
        var findings = ['','','','','','','','','','','','','','','',''];

        
const $targetFitToworkModal = document.getElementById('proceedToConsultationModal');
  const optionsFitToWorkModal = {
    placement: 'center-center',
    backdrop: 'static',
    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
    closable: true,
    onHide: () => {
    },
    onShow: () => {

    },
    onToggle: () => {
    }
  };
  const proceedToConsultationModal = new Modal($targetFitToworkModal, optionsFitToWorkModal);
  $("#proceedToConsultation").click(function() {

    $('#cnsltnBloodChem').val(findings);
    var filteredFindings = findings.filter(function(element) {
    return element !== '';
}).join(' ');

$('#cnsltnBloodChem').val(filteredFindings);

    // modalPrompt.toggle();
    proceedToConsultationModal.toggle();

});



        $('#hlpfbs').on('input', function() {
            const value = $(this).val();
            const valueWithFindings = "FBS: "+value;
            if(value != ""){
                if (value < hlpfbsmin || value > hlpfbsmax) {

                    findings.splice(0, 1, valueWithFindings);

                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                    findings.splice(0, 1, '');
                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(0, 1, '');
             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });

        
        $('#hlpcholesterol').on('input', function() {
            const value = $(this).val();
            const valueWithFindings1 = "Cholesterol: "+value;
            if(value != ""){
                if (value < hlpcholesterolmin || value > hlpcholesterolmax) {
                    findings.splice(1, 1, valueWithFindings1);
                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                    findings.splice(1, 1, '');
                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(1, 1, '');
             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#hlptriglycerides').on('input', function() {
            const value = $(this).val();
            const valueWithFindings2 = "Triglycerides: "+value;
            if(value != ""){
                if (value < hlptriglyceridesmin || value > hlptriglyceridesmax) {
                    findings.splice(2, 1, valueWithFindings2);
                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                    findings.splice(2, 1, '');
                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(2, 1, '');
             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#hlphdl').on('input', function() {
            const value = $(this).val();
            const valueWithFindings3 = "HDL: "+value;
            if(value != ""){
                if (value < hlphdlmin || value > hlphdlmax) {
                    findings.splice(3, 1, valueWithFindings3);
                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                    findings.splice(3, 1, '');
                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(3, 1, '');
             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#hlpldl').on('input', function() {
            const value = $(this).val();
            const valueWithFindings4 = "LDL: "+value;
            if(value != ""){
                if (value < hlpldlmin || value > hlpldlmax) {
                    findings.splice(4, 1, valueWithFindings4);
                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                    findings.splice(4, 1, '');
                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(4, 1, '');

             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#hlpbun').on('input', function() {
            const value = $(this).val();
            const valueWithFindings5 = "BUN: "+value;
            if(value != ""){
                if (value < hlpbunmin || value > hlpbunmax) {
                    findings.splice(5, 1, valueWithFindings5);
                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                    findings.splice(5, 1, '');

                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(5, 1, '');

             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#hlpcreatinine').on('input', function() {
            const value = $(this).val();
            const valueWithFindings6 = "Creatinine: "+value;
            if(value != ""){
                if (value < hlpcreatininemin || value > hlpcreatininemax) {
                    findings.splice(6, 1, valueWithFindings6);

                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                    findings.splice(6, 1, '');
                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(6, 1, '');
             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#hlpbua').on('input', function() {
            const value = $(this).val();
            const valueWithFindings7 = "BUA: "+value;

            if(value != ""){
                if (value < hlpbuamin || value > hlpbuamax) {
                    findings.splice(7, 1, valueWithFindings7);
                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                    findings.splice(7, 1, '');
                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(7, 1, '');
             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#hlpsgdt').on('input', function() {
            const value = $(this).val();
            const valueWithFindings8 = "SGOT: "+value;

            if(value != ""){
                if (value < hlpsgdtmin || value > hlpsgdtmax) {
                    findings.splice(8, 1, valueWithFindings8);

                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                findings.splice(8, 1, '');

                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(8, 1, '');

             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#hlpsgpt').on('input', function() {
            const value = $(this).val();
            const valueWithFindings9 = "SGPT: "+value;

            if(value != ""){
                if (value < hlpsgptmin || value > hlpsgptmax) {
                    findings.splice(9, 1, valueWithFindings9);

                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                findings.splice(9, 1, '');

                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(9, 1, '');

             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#hlphbaic').on('input', function() {
            const value = $(this).val();
            const valueWithFindings10 = "HBA1C: "+value;

            if(value != ""){
                if (value < hlphbaicmin || value > hlphbaicmax) {
                    findings.splice(10, 1, valueWithFindings10);

                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                findings.splice(10, 1, '');

                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(10, 1, '');

             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#hlpK').on('input', function() {
            const value = $(this).val();
            const valueWithFindings11 = "Potassium: "+value;

            if(value != ""){
                if (value < hlpKmin || value > hlpKmax) {
                    findings.splice(11, 1, valueWithFindings11);

                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                findings.splice(11, 1, '');

                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(11, 1, '');

             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#hlpNa').on('input', function() {
            const value = $(this).val();
            const valueWithFindings12 = "Sodium: "+value;

            if(value != ""){
                if (value < hlpNamin || value > hlpNamax) {
                    findings.splice(12, 1, valueWithFindings12);

                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                findings.splice(12, 1, '');

                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(12, 1, '');

             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#FT3').on('input', function() {
            const value = $(this).val();
            const valueWithFindings13 = "FT3: "+value;

            if(value != ""){
                if (value < FT3min || value > FT3max) {
                    findings.splice(13, 1, valueWithFindings13);

                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                findings.splice(13, 1, '');

                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(13, 1, '');

             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#FT4').on('input', function() {
            const value = $(this).val();
            const valueWithFindings14 = "FT4: "+value;

            if(value != ""){
                if (value < FT4min || value > FT4max) {
                    findings.splice(14, 1, valueWithFindings14);

                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                findings.splice(14, 1, '');

                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(14, 1, '');

             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });
        
        $('#TSH').on('input', function() {
            const value = $(this).val();
            const valueWithFindings15 = "TSH: "+value;

            if(value != ""){
                if (value < TSHmin || value > TSHmax) {
                    findings.splice(15, 1, valueWithFindings15);

                $(this).addClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                } else {
                findings.splice(15, 1, '');

                $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
                }
            }
            else{
                findings.splice(15, 1, '');

             $(this).removeClass('bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500');
            }
        });






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
        document.getElementById("editcreatinine").value = element.getAttribute("data-creatinine");

        document.getElementById("editbua").value = element.getAttribute("data-BUA");
        document.getElementById("editsgpt").value = element.getAttribute("data-SGPT");
        document.getElementById("editsgdt").value = element.getAttribute("data-SGDT");
        document.getElementById("edithbaic").value = element.getAttribute("data-HBA1C");
        document.getElementById("editothers").value = element.getAttribute("data-others");
        document.getElementById("editremarks").value = element.getAttribute("data-remarks");

        document.getElementById("editK").value = element.getAttribute("data-potassium");
        document.getElementById("editNa").value = element.getAttribute("data-sodium");
        document.getElementById("editFT3").value = element.getAttribute("data-FT3");
        document.getElementById("editFT4").value = element.getAttribute("data-FT4");
        document.getElementById("editTSH").value = element.getAttribute("data-TSH");


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



    const addBloodChemModal = document.getElementById('addBloodChemModal');

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

    const modalAdd = new Modal(addBloodChemModal, addBloodChems);

    function openAddModal(element) {
        modalAdd.toggle();

    };

    function exportTemplate() {

        var rows = [];

        column1 = 'Date';
        column2 = 'Time';
        column3 = 'Building Transaction';
        column4 = 'ID Number';
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
            column4 = "";
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
        link.setAttribute("download", "<?php echo $employer; ?> HLP Template.csv");
        document.body.appendChild(link);
        /* download the data file named "Stock_Price_Report.csv" */
        link.click();
    }
</script>

</body>

</html>