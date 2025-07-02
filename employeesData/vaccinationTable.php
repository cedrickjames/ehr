<?php

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
$provider1 = $_SESSION['name'];

if (isset($_POST['excelReport'])) {
    $_SESSION['month'] = $_POST['month'];
    $_SESSION['year'] = $_POST['year'];
    $_SESSION['vax'] = $_POST['vax'];
  
?>
    <script type="text/javascript">
       
        window.open('../vaccination_xls.php?month=<?php echo $_SESSION['month']; ?>&year=<?php echo $_SESSION['year']; ?>&vax=<?php echo $_SESSION['vax']; ?>', '_blank');
        location.href='../nurses/vaccination.php';
    </script>
<?php
exit;
}


if(isset($_POST['deleteVaccinationRecord'])){
    $id = $_POST['vaccineidtodelete'];
    $sql = "DELETE FROM `vaccination` WHERE `id` = '$id'";
    $results = mysqli_query($con, $sql);
   
    if ($results) {
      echo "<script>alert('Delete successful.');</script>";
    } else {
      echo "<script>alert('There is a problem with deleting record. Please contact your administrator.');</script>";
    }
  }




if (isset($_POST['addVaccinationImport'])) {
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
                echo "<script> location.href='vaccination.php'; </script>";

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


function isidNumberExists($con, $idNumber)
{
    // Escape the Id Number to prevent SQL injection (assuming $con is your mysqli connection)
    $idNumber = mysqli_real_escape_string($con, $idNumber);

    // Query to check if Id Number exists
    $query = "SELECT COUNT(*) AS count FROM employeespersonalinfo WHERE idNumber = '$idNumber'";
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
            $idNumber = $row['0'];
            $vaccineType = $row['1'];
            $vaccineBrand = $row['2'];
            $firstDose = $row['3'];

            $firstDoseDate = DateTime::createFromFormat('m/d/Y', $firstDose);
            $firstDoseDateFormated = $firstDoseDate ? $firstDoseDate->format('Y-m-d') : $firstDoseDate;


            $provider1 = $row['4'];
            $secondDose = $row['5'];

            $secondDoseDate = DateTime::createFromFormat('m/d/Y', $secondDose);
            $secondDoseDateFormated = $secondDoseDate ? $secondDoseDate->format('Y-m-d') : $secondDose;

            $provider2 = $row['6'];
            $thirdDose = $row['7'];

            $thirdDoseDate = DateTime::createFromFormat('m/d/Y', $thirdDose);
            $thirdDoseDateFormated = $thirdDoseDate ? $thirdDoseDate->format('Y-m-d') : $thirdDose;

            $provider3 = $row['8'];
            $remarks = $row['9'];
            

            // Check if Id Number exists in db_table
            if (!isidNumberExists($con, $idNumber)) {
                // Log error for non-existent Id Numbers
                $errorLogs[] = "Id Number '$idNumber' not found in Employee List";
                continue; // Skip saving this row
            }

            // If validation passes, save to database
            $result = mysqli_query($con, "SELECT `Name` FROM `employeespersonalinfo` WHERE `idNumber` = '$idNumber'");
            while ($userRow = mysqli_fetch_assoc($result)) {
                $name = $userRow['Name'];

        
                    $addPreEmploymentGpi = "INSERT INTO `vaccination`(`idNumber`, `vaccineType`, `vaccineBrand`, `firstDose`, `provider1`,`secondDose`, `provider2`, `thirdDose`,`provider3`, `remarks`) VALUES ('$idNumber','$vaccineType','$vaccineBrand','$firstDoseDateFormated','$provider1','$secondDoseDateFormated','$provider2','$thirdDoseDateFormated','$provider3','$remarks')";
                    $resultInfo = mysqli_query($con, $addPreEmploymentGpi);
                
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







if (isset($_POST['addVax'])) {
    $idNumber = $_POST['idNumber'];
    $vaxType = $_POST['vaxType'];
    $vaxBrand = $_POST['vaxBrand'];
    $firstDose = $_POST['firstDose'];
    $provider1 = $_POST['provider1'];
    $secondDose = $_POST['secondDose'];
    $provider2 = $_POST['provider2'];
    $thirdDose = $_POST['thirdDose'];
    $provider3 = $_POST['provider3'];
    $remarks = $_POST['remarks'];
   
if($vaxType=="" || $vaxType==NULL){
    echo "<script>alert('You have to add Vaccine Type!')</script>";

} else{
    $sql = "INSERT INTO `vaccination`( `idNumber`, `vaccineType`, `vaccineBrand`, `firstDose`, `provider1`,`secondDose`, `provider2`, `thirdDose`,`provider3`, `remarks`) VALUES ('$idNumber','$vaxType','$vaxBrand','$firstDose','$provider1','$secondDose','$provider2','$thirdDose','$provider3','$remarks')";
    $results = mysqli_query($con, $sql);
    if ($results) {
      echo "<script>alert('Record added succesfully!')</script>";
    //   echo "type: ",$vaxType;
    //   echo "<script> location.href='../nurses/vaccination.php?rf=$idNumber'; </script>";
    } else {
      echo "<script>alert('There's a problem saving to database.')</script>";
    }
}

 
  }



if (isset($_POST['updateVax'])) {
    $vcn = $_POST['vcnId'];
    $vaxType = $_POST['vaxType'];
    $vaxBrand = $_POST['vaxBrand'];
    $firstDose = $_POST['firstDose'];
    $provider1 = $_POST['provider1'];
    $secondDose = $_POST['secondDose'];
    $provider2 = $_POST['provider2'];
    $thirdDose = $_POST['thirdDose'];
    $provider3 = $_POST['provider3'];
    $remarks = $_POST['remarks'];
  
    $sql = "UPDATE `vaccination` SET  `vaccineType` = '$vaxType', `vaccineBrand`='$vaxBrand', `firstDose`='$firstDose', `provider1`='$provider1',`secondDose`='$secondDose', `provider2`='$provider2', `thirdDose`='$thirdDose',`provider3`='$provider3', `remarks`='$remarks' WHERE `id`= '$vcn';";
    $results = mysqli_query($con, $sql);
    if ($results) {
      echo "<script>alert('Record updated succesfully!')</script>";
    //   echo "<script> location.href='vaccination.php?rfid=$idNumber'; </script>";
    } else {
      echo "<script>alert('There's a problem updating.')</script>";
    }
  }
  

?>


<div class="text-[9px] 2xl:text-lg mb-5">
    <div class="flex justify-between">
        <p class="mb-2 my-auto"><span class=" self-center text-md font-semibold whitespace-nowrap   text-[#193F9F]">Vaccination Record</span></p>
        <div class="flex items-center order-2">
        <button type="button" data-modal-target="exportVax" data-modal-toggle="exportVax" class="lg:block text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2 mx-3 md:mx-2">Export</button>
        <button type="button" data-dropdown-toggle="options" class="lg:block text-white bg-gradient-to-r from-[#00669B] to-[#9AC1CA] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300  font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2 ">Add</button>
            <div id="options" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-2  text-gray-700 dark:text-gray-200" aria-labelledby="options">
                    <li>
                        <a type="button" data-modal-target="addVaccination" data-modal-toggle="addVaccination" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Add Vaccination</a>
                    </li>
                    <li>
                        <a type="button" data-modal-target="importVaccination" data-modal-toggle="importVaccination" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Import Data</a>
                    </li>
                    <li>
                        <a type="button" onclick="exportTemplate()" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Export Template</a>
                    </li>

                </ul>

            </div>
        </div>
    </div>


    




    <div id="" class="">
        <div class=" p-4 rounded-lg  bg-gray-50 " id="" role="tabpanel" aria-labelledby="profile-tab">
            <section class="mt-2 2xl:mt-10">
            <table id="vaccinationRecord" class="display text-[9px] 2xl:text-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Action</th>
                            <th>Employee</th>
                            <th>Type of Vaccine</th>
                            <th>Brand</th>
                            <th>1st Dose</th>
                            <th>Provider</th>
                            <th>2nd Dose</th>
                            <th>Provider</th>
                            <th>3rd Dose</th>
                            <th>Provider</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                         $vcnNo = 1;
                         $sql = "SELECT v.*, e.Name FROM `vaccination` v LEFT JOIN `employeespersonalinfo` e ON e.idNumber = v.idNumber";
                        $result = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {

                            if($row['secondDose']== '0000-00-00'){
                                $secondDose = "-";
                            }else{
                                $secondDose = $row['secondDose'];
                            }
                            if($row['thirdDose']== '0000-00-00'){
                                $thirdDose = "-";
                            }else{
                                $thirdDose = $row['thirdDose'];
                            }
                           

                        ?>
                            <tr>
                            <td> <?php echo $vcnNo; ?> </td>
                                <td>
                                    <button type="button" onclick="showEditModal(this)"
                                    data-id="<?php echo $row['id']; ?>" 
                                    data-name="<?php echo $row['Name']; ?>"
                                    data-vaccinetype="<?php echo $row['vaccineType']; ?>"
                                    data-vaccinebrand="<?php echo $row['vaccineBrand']; ?>"
                                    data-firstdose="<?php echo $row['firstDose']; ?>"
                                    data-provider1="<?php echo $row['provider1']; ?>"
                                    data-seconddose="<?php echo $row['secondDose']; ?>"
                                    data-provider2="<?php echo $row['provider2']; ?>"
                                    data-thirddose="<?php echo $row['thirdDose']; ?>"
                                    data-provider3="<?php echo $row['provider3']; ?>" 
                                    data-remarks="<?php echo $row['remarks']; ?>"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</button>

                                <button type="button"  onclick="askdelete(<?php echo $row['id']; ?>)"  class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-[8px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2 mx-3 md:mx-2">Delete</button>

                                    
                                </td>
                                <td><?php echo $row['Name'] ?></td>
                                <td><?php echo $row['vaccineType'] ?></td>
                                <td><?php echo $row['vaccineBrand'] ?></td>
                                <td><?php echo $row['firstDose'] ?></td>
                                <td><?php echo $row['provider1'] ?></td>
                                <td><?php echo $secondDose ?></td>
                                <td><?php echo $row['provider2'] ?></td>
                                <td><?php echo $thirdDose ?></td>
                                <td><?php echo $row['provider3'] ?></td>
                                <td><?php echo $row['remarks'] ?></td>
                            </tr>
                        <?php $vcnNo++;} ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>

</div>




<div id="exportVax" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" data-modal-toggle="exportVax" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Export Vaccination Record</h3>
                <form id="excelReport" class="space-y-6" action="" method="POST">
                <div>
                        <label for="vax" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                        <select id="vax" name="vax" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        <option selected disabled value="">Select Type</option>
          <?php
          $sql1 = "SELECT * FROM vaccine";
          $result = mysqli_query($con, $sql1);
          while ($list = mysqli_fetch_assoc($result)) {
              $vaccineName = $list["vaccineName"];
              echo "<option  value='$vaccineName'>$vaccineName</option>";
          ?>
         
<?php

          }
          ?>
                            </select>
                    </div>
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

                    <button type="submit" type="button" onclick="generateVaccinationExcel()" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Generate Excel
                    </button>


                </form>
            </div>
        </div>
    </div>
</div>


<div id="editVaccination" tabindex="-1" aria-hidden="true" class="bg-[#615eae59] hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit Vaccination Record
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editVaccination">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->

            <form method="POST" action="">
            <div class="text-[9px] 2xl:text-lg  rounded-lg bg-white/50 grid grid-cols-4 gap-1 w-full w-full p-4 ">
            <input type="text" name="vcnId" id="vcnId" class="hidden">
            <div class="col-span-4">
            <label class="block my-auto  font-semibold text-gray-900 ">Name: </label>
            <input id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " readonly>

      </div>
      <div class="content-center  col-span-2">
        <label class="block  my-auto font-semibold text-gray-900 ">Vaccine Type: </label>
        <select required id="vaxType" name="vaxType"  class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
          <option disabled selected value="">Select Type</option>
          <option value="addVaccineType">Add Vaccine</option>
          <?php
          $sql2 = "SELECT * FROM vaccine";
          $result = mysqli_query($con, $sql2);
          while ($list = mysqli_fetch_assoc($result)) {
              $vaccineName = $list["vaccineName"];
              echo "<option  value='$vaccineName'>$vaccineName</option>";

          }
          ?>
        </select>

      </div>
      <div class="content-center  col-span-2">
        <label class="block my-auto  font-semibold text-gray-900 ">Vaccine Brand: </label>
        <input type="text" id="vaxBrand" name="vaxBrand" value="<?php echo $vaccineBrand; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
      </div>

      <div class="content-center  col-span-2">

        <label class="block my-auto  font-semibold text-gray-900 ">First Dose: </label>
         <input type="date" id="firstDose" name="firstDose" value="<?php echo $firstDose; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

      </div>
        <div class="content-center  col-span-2">

        <label class="block my-auto  font-semibold text-gray-900 ">Provider's Name: </label>
         <input type="text" id="provider1" name="provider1" value="<?php echo $provider1; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

      </div>
      <div class="content-center  col-span-2">

        <label class="block my-auto  font-semibold text-gray-900 ">Second Dose: </label>
        <input type="date" id="secondDose" name="secondDose" value="<?php echo $secondDose; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

        </div>
        <div class="content-center  col-span-2">

        <label class="block my-auto  font-semibold text-gray-900 ">Provider's Name: </label>
        <input type="text" id="provider2" name="provider2" value="<?php echo $provider2; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

        </div>
        <div class="content-center  col-span-2">

        <label class="block my-auto  font-semibold text-gray-900 ">Third Dose: </label>
        <input type="date" id="thirdDose" name="thirdDose" value="<?php echo $thirdDose; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

        </div>
        <div class="content-center  col-span-2">

        <label class="block my-auto  font-semibold text-gray-900 ">Provider's Name: </label>
        <input type="text" id="provider3" name="provider3" value="<?php echo $provider3; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

        </div>
        <div class="col-span-4">
      <label class="block my-auto  font-semibold text-gray-900 ">Remarks: </label>
      <textarea id="remarks" name="remarks" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder=""><?php echo $remarks; ?></textarea>

      </div>

      <div class="col-span-4 justify-center flex gap-2">
          <button type="submit" name="updateVax"  class="w-64 text-white bg-gradient-to-r from-[#00669B]  to-[#9AC1CA] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300  shadow-lg shadow-teal-500/50  font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2">Update Record</button>
      </div>
    </div>
            </form>
        </div>
    </div>
</div>


<div id="addVaccination" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class=" font-semibold text-gray-900 dark:text-white">
                    Add Vaccination
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="addVaccination">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form method="POST" action="" class="m-4">
    <input type="text" id="" name="" value="" class="hidden">

    <div class="text-[9px] 2xl:text-lg  rounded-lg bg-white/50 grid grid-cols-4 gap-1 w-full w-full p-4 ">
    <div class="col-span-4 gap-4 mb-4">
                        <label for="name" class="block mb-1  text-gray-900 dark:text-white">Name</label>
                        <select id="empname" name="empname" class="js-employees bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                            <option selected disabled>Search Name</option>
                            <?php
                            $sql1 = "SELECT * FROM employeespersonalinfo";
                            $result = mysqli_query($con, $sql1);
                            while ($list = mysqli_fetch_assoc($result)) {
                                $idNumber = $list["idNumber"];
                                $name = $list["Name"];
                                $section = $list["section"];

                                 ?>
                                
                                <option value="<?php echo  $name; ?>" data-rfid="<?php echo  $idNumber; ?>" data-section="<?php echo  $section; ?>"> <?php echo  $name; ?> </option> <?php
                                                                                                                                                                                } ?>
                        </select>
                    </div>
                    <div class="content-center  col-span-4">
        <label class="block my-auto  font-semibold text-gray-900 ">Id Number: </label>
        <input type="text" id="idNumber" name="idNumber" value="" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
      </div>
      <div class="content-center  col-span-2">
        <label class="block  my-auto font-semibold text-gray-900 ">Vaccine Type: </label>
        <select required id="vaxType2" name="vaxType" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
          <option selected disabled value="">Select Type</option>
          <option value="addVaccineType">Add Vaccine</option>

          <?php
          $sql1 = "SELECT * FROM vaccine";
          $result = mysqli_query($con, $sql1);
          while ($list = mysqli_fetch_assoc($result)) {
              $vaccineName = $list["vaccineName"];
              echo "<option  value='$vaccineName'>$vaccineName</option>";
          ?>
         
<?php

          }
          ?>
        </select>

      </div>
      <div class="content-center  col-span-2">
        <label class="block my-auto  font-semibold text-gray-900 ">Vaccine Brand: </label>
        <input type="text" id="vaxBrand" name="vaxBrand" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
      </div>

      <div class="content-center  col-span-2">

        <label class="block my-auto  font-semibold text-gray-900 ">First Dose: </label>
         <input type="date" id="firstDose" name="firstDose" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

      </div>
        <div class="content-center  col-span-2">

        <label class="block my-auto  font-semibold text-gray-900 ">Provider's Name: </label>
         <input type="text" id="provider1" name="provider1" value="<?php echo $provider1; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

      </div>
      <div class="content-center  col-span-2">

        <label class="block my-auto  font-semibold text-gray-900 ">Second Dose: </label>
        <input type="date" id="secondDose" name="secondDose" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

        </div>
        <div class="content-center  col-span-2">

        <label class="block my-auto  font-semibold text-gray-900 ">Provider's Name: </label>
        <input type="text" id="provider2" name="provider2" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

        </div>
        <div class="content-center  col-span-2">

        <label class="block my-auto  font-semibold text-gray-900 ">Third Dose: </label>
        <input type="date" id="thirdDose" name="thirdDose" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

        </div>
        <div class="content-center  col-span-2">

        <label class="block my-auto  font-semibold text-gray-900 ">Provider's Name: </label>
        <input type="text" id="provider3" name="provider3" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

        </div>
        <div class="col-span-4">
      <label class="block my-auto  font-semibold text-gray-900 ">Remarks: </label>
      <textarea id="remarks" name="remarks" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="">

      </textarea>

      </div>

      <div class="col-span-4 justify-center flex gap-2">
        <?php
        if (!isset($_GET['vcn'])) { ?>
          <button type="submit" name="addVax" class="w-64 text-white bg-gradient-to-r from-[#00669B]  to-[#9AC1CA] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300  shadow-lg shadow-teal-500/50  font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2">Add Record</button>
        <?php
        } else {
        ?>
          <button type="submit" name="updateVax" class="w-64 text-white bg-gradient-to-r from-[#9b0066]  to-[#ca9ac1] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300  shadow-lg shadow-pink-500/50  font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2">Update Record</button>
        <?php
        }
        ?>

      </div>
    </div>
  </form>
        </div>
    </div>
</div>

<div id="importVaccination" tabindex="-1" aria-hidden="true" class=" hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-2 border-b rounded-t dark:border-gray-600">
                <h3 class=" font-semibold text-gray-900 dark:text-white">
                    Import Vaccination Data
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
                <button type="submit" name="addVaccinationImport" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Import Data
                </button>
            </form>
        </div>
    </div>
</div>


<div id="addVaccine" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
          <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <label class="block text-xl font-semibold text-gray-900 dark:text-white">
                  Add Vaccine
                </label>
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="addVaccine">
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
                    <input type="text" name="vaccine" id="vaccine" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                  </div>
                  <button type="button" onclick="addVaccine()" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add</button>
                </form>
              </div>
            </div>
          </div>
        </div>




        
<div id="deleteVaccineRecord" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="deleteVaccineRecord">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <form action="" method="POST">
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this record?</h3>
                <input type="text" id="vaccineidtodelete" name="vaccineidtodelete" class="hidden">
                <button  type="submit" name="deleteVaccinationRecord" id="deleteVaccineRecord" class=" text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                </button>
               
                <button data-modal-hide="deleteVaccineRecord" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                </form>
              
            </div>
        </div>
    </div>
</div>


<script>
function generateVaccinationExcel() {
    const month = document.getElementById('month').value;
    const year = document.getElementById('year').value;
    const vax = document.getElementById('vax').value;

    // Open the Excel report in a new tab
    window.open('../vaccination_xls.php?month=' + encodeURIComponent(month) +
                '&year=' + encodeURIComponent(year) +
                '&vax=' + encodeURIComponent(vax), '_blank');

    // Redirect the current page
    window.location.href = '../nurses/vaccination.php';
}
</script>



<script>


   
    const editVaccination = document.getElementById('editVaccination');
    const VaccinationModal = {
        backdropClasses: 'bg-gray-900/50 dark:bg-gray-900/80 relative inset-0 z-40',
        closable: true,
        onHide: () => {},
        onShow: () => {},
        onToggle: () => {},
    };

    const modalEdit = new Modal(editVaccination, VaccinationModal);

    function showEditModal(element) {

        modalEdit.toggle();
        document.getElementById("vcnId").value = element.getAttribute("data-id");
        document.getElementById("name").value = element.getAttribute("data-name");
        document.getElementById("vaxType").value = element.getAttribute("data-vaccinetype");
        document.getElementById("vaxBrand").value = element.getAttribute("data-vaccinebrand");
        document.getElementById("firstDose").value = element.getAttribute("data-firstdose");
        document.getElementById("provider1").value = element.getAttribute("data-provider1");
        document.getElementById("secondDose").value = element.getAttribute("data-seconddose");
        document.getElementById("provider2").value = element.getAttribute("data-provider2");
        document.getElementById("thirdDose").value = element.getAttribute("data-thirddose");
        document.getElementById("provider3").value = element.getAttribute("data-provider3");
        document.getElementById("remarks").value = element.getAttribute("data-remarks");

    }

    
    function exportTemplate() {
        var rows = [];

        column1 = 'Id Number';
        column3 = 'Vaccine Type';
        column4 = 'Brand';
        column5 = '1st Dose';
        column6 = 'Provider';
        column7 = '2nd Dose';
        column8 = 'Provider';
        column9 = '3rd Dose';
        column10 = 'Provider';
        column11 = 'Remarks';


        rows.push(
            [
                column1,
                column3,
                column4,
                column5,
                column6,
                column7,
                column8,
                column9,
                column10,
                column11,
          
            ]
        );

        for (var i = 0, row; i < 1; i++) {
            column1 ='';
            column3 = '';
            column4 = '';
            column5 = 'yyyy-mm-dd';
            column6 = '';
            column7 = 'yyyy-mm-dd';
            column8 = '';
            column9 = 'yyyy-mm-dd';
            column10 = '';
            column11 = '';
 

            rows.push(
                [
                    column1,
                    column3,
                    column4,
                    column5,
                    column6,
                    column7,
                    column8,
                    column9,
                    column10,
                    column11,
  
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
        link.setAttribute("download", "Vaccination Template.csv");
        document.body.appendChild(link);
        /* download the data file named "Stock_Price_Report.csv" */
        link.click();




    }

    const $targetDeactivateUser = document.getElementById('deleteVaccineRecord');
  const deactivateModal = {
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
  const modaldeactivate = new Modal($targetDeactivateUser, deactivateModal);






    function askdelete(id){

document.getElementById("vaccineidtodelete").value = id;
modaldeactivate.toggle();
}



</script>
