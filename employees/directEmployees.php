<?php

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


if (isset($_GET['employer'])) {
    $employer = $_GET['employer'];
  } else {
    $employer = "not found";
  }
  



if (isset($_POST['downloadEmployeesRecord'])) {
    
?>
    <script type="text/javascript">
        window.open('EmployeesRecord_xls.php?employer=<?php echo $employer;?>', '_blank');
        location.href='index.php?employer='+$employer;
    </script>
<?php
}



if (isset($_POST['addNewEmployeeManual'])) {
    $idNumber = $_POST['idNumber'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];

    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $address = $_POST['address'];
    $civilStatus = $_POST['civilStatus'];
    $employer = $_POST['employer'];
    $department = $_POST['department'];
    $section = $_POST['section'];
    $position = $_POST['position'];
    $level = $_POST['level'];
    $dateHired = $_POST['dateHired'];
    $building = $_POST['building'];


    $addEmployeeGpi = "INSERT INTO `employeespersonalinfo`(`idNumber`, `Name`, `email`, `birthday`,`age`, `sex`, `address`, `civilStatus`, `employer`,`building`, `department`, `section`, `position`, `level`, `dateHired`) VALUES ('$idNumber','$name', '$email','$birthday', '$age','$sex','$address','$civilStatus','$employer','$building','$department','$section','$position', '$level', '$dateHired')";
    $resultInfo = mysqli_query($con, $addEmployeeGpi);

    if ($resultInfo) {
        echo "<script>alert('Added New Employee') </script>";
        echo "<script> location.href='index.php'; </script>";
    }
}

if (isset($_POST['editEmployeeRecord'])) {
    // $idNumber = $_POST['editrfid'];

//     editidNumber
// editdateHired
    $empIdNumberDb = $_POST['empIdNumberDb'];

    $idNumber = $_POST['editidNumber'];
    $editemployer = $_POST['editemployer'];

    $name = $_POST['editname'];
    $email = $_POST['editemail'];
    $birthday = $_POST['editBirthday'];

    $age = $_POST['editage'];
    $sex = $_POST['editsex'];
    $address = $_POST['editaddress'];
    $civilStatus = $_POST['editcivilStatus'];
    $employer1 = $_POST['editemployer'];
    $department = $_POST['editdepartment'];
    $section = $_POST['editsection'];
    $position = $_POST['editposition'];
    $level = $_POST['editlevel'];
    $dateHired = $_POST['editdateHired'];
    $editbuilding = $_POST['editbuilding'];

    

    $editEmployeeGpi = "UPDATE `employeespersonalinfo` SET  `idNumber` = '$idNumber', `Name`= '$name', `email`='$email', `birthday`='$birthday',`age`= '$age', `sex`= '$sex', `address`= '$address', `civilStatus`= '$civilStatus', `employer`= '$employer1',`building`='$editbuilding', `department`= '$department', `section`= '$section', `position`= '$position', `level`= '$level', `dateHired` = '$dateHired' WHERE `id`= '$empIdNumberDb'";
    $resultInfo = mysqli_query($con, $editEmployeeGpi);

    if ($resultInfo) {
        echo "<script>alert('Record Updated Successfuly!') </script>";
        echo "<script> location.href='index.php?employer=$employer'; </script>";
    }
}

if (isset($_POST['addNewEmployeesImport'])) {


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
    // echo $fileName;
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowed_ext = ['xls', 'csv', 'xlsx'];
    if (in_array($file_ext, $allowed_ext)) {

        $count = 0;
        $count1 = 0;

        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();
        $highestRow = $spreadsheet->getActiveSheet()->getHighestRow();
        echo "<script> console.log('$highestRow') </script>";
    }
    foreach ($data as $row) {
      
        if ($count > 0) {
            $idNumber = $row['0'];
            $name = $row['1'];
            $email = $row['2'];
            $birthday = $row['3'];
            $birthdayObj = DateTime::createFromFormat('m/d/Y', $birthday);
    $birthdayFormatted = $birthdayObj ? $birthdayObj->format('Y-m-d') : $birthday;
            $age = $row['4'];
            $sex = $row['5'];
            $sexindex = array_search($sex, $sexformat1);
            $sexcorrespondingValue = $sexformat2[$sexindex] ?? null; // Use null if index doesn't exist in $format2

            $address = $row['6'];
            $civilStatus = $row['7'];
            $civilindex = array_search($civilStatus, $civilformat1);
            $civilcorrespondingValue = $civilformat2[$civilindex] ?? null;

            $employer = $row['8'];
            $building = $row['9'];
            $department = $row['10'];
            $index = array_search($department, $format1);
            $correspondingValue = $format2[$index] ?? null; // Use null if index doesn't exist in $format2
            $section = $row['11'];
            $position = $row['12'];
            $dateHired = $row['13'];
            $dateHiredObj = DateTime::createFromFormat('m/d/Y', $dateHired);
            $dateHiredFormatted = $dateHiredObj ? $dateHiredObj->format('Y-m-d') : $dateHired; // Fallback to original if parsing fails

            try {
                $addEmployeeGpi = "INSERT INTO `employeespersonalinfo`(`idNumber`, `Name`, `email`, `birthday`, `age`, `sex`, `address`, `civilStatus`, `employer`, `building`,`department`, `section`, `position`,`level`, `dateHired`) VALUES ('$idNumber','$name', '$email','$birthdayFormatted', '$age','$sexcorrespondingValue','$address','$civilcorrespondingValue','$employer','$building','$correspondingValue','$section','$position','employee', '$dateHiredFormatted')";
                $resultInfo = mysqli_query($con, $addEmployeeGpi);
    
            
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
                array_push($failedData, [$idNumber, $name,$email,$birthdayFormatted,$age,$sexcorrespondingValue,$address,$civilcorrespondingValue,$employer,$building,$correspondingValue,$section,$position,$dateHiredFormatted]);
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
    $unsuccessfullcount =  $highestRow - $count1 - 1;
    echo "<script>alert('There are $count1 successfully imported and $unsuccessfullcount unsuccessful!');</script>";
    $_SESSION['failedData'] = $failedData;
    echo "<script> location.href='failedDataFromImporting.php'; </script>";
    

}


if(isset($_POST['deactivateUser'])){
    $id = $_POST['idOfUser'];
    $separationDate = $_POST['separationDate'];

    

    $sql = "UPDATE `employeespersonalinfo` SET `activeStatus` = 0, `dateOfSeparation`='$separationDate' WHERE `id` = '$id'";
    $results = mysqli_query($con, $sql);
   
    if ($results) {
      echo "<script>alert('Deactivation successful.');</script>";
    } else {
      echo "<script>alert('There is a problem with deactivation. Please contact your administrator.');</script>";
    }
  }

  if(isset($_POST['deleteEmpRecord'])){
    $id = $_POST['empRecordId'];
   

    $sql = "DELETE FROM `employeespersonalinfo` WHERE `id` = '$id'";
    $results = mysqli_query($con, $sql);
   
    if ($results) {
      echo "<script>alert('Record Deleted.');</script>";
    } else {
      echo "<script>alert('There is a problem with deleting record. Please contact your administrator.');</script>";
    }
  }




  
  if(isset($_POST['activateUser'])){
    $id = $_POST['idOfUser'];
    $sql = "UPDATE `employeespersonalinfo` SET `activeStatus` = 1, `dateOfSeparation`='' WHERE `id` = '$id'";
    $results = mysqli_query($con, $sql);
   
    if ($results) {
      echo "<script>alert('Employee activated');</script>";
    } else {
      echo "<script>alert('There is a problem with activation. Please contact your administrator.');</script>";
    }
  }

  

?>
<div class="text-[9px] 2xl:text-lg mb-5">
    <div class="flex justify-between">
        <p class="mb-2 my-auto"><span class=" self-center text-md font-semibold whitespace-nowrap   text-[#193F9F]"><?php echo $employer ; ?> Employees</span></p>
        <div>
            <form action="" method="POST">
            <button type="submit" name="downloadEmployeesRecord"  class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 rounded-lg  px-5 py-2.5 text-center me-2 mb-2">Download Data</button>
            <button type="button" data-dropdown-toggle="options" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800  rounded-lg  px-5 py-2.5 text-center me-2 mb-2">Options</button>

            </form>

        </div>
        
        <div id="options" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
            <ul class="py-2  text-gray-700 dark:text-gray-200" aria-labelledby="options">
                <li>
                    <a type="button" data-modal-target="addDirectEmployees" data-modal-toggle="addDirectEmployees" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Add Employees</a>
                </li>
                <li>
                    <a type="button" data-modal-target="importDirectEmployees" data-modal-toggle="importDirectEmployees" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Import Data</a>
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
                <section class="mt-2 2xl:mt-10 overflow-auto relative">
                    <table id="queTable" class="display text-[9px] 2xl:text-sm  " style="width:100%;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>ID Number</th>

                                <th>Employer</th>
                                <th>Action</th>
                                <th>Status</th>
                                <th>Date of Separation</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $queNo = 1;
                            $sql = "SELECT * FROM `employeespersonalinfo` WHERE `employer` = '$employer' ORDER BY `Name` ASC; 
                    ";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {

                            ?> <tr>
                                    <td> <?php echo $queNo; ?> </td>
                                    <td> <?php echo $row['Name']; ?> </td>
                                    <td> <?php echo $row['idNumber']; ?> </td>

                                    <td><?php echo $row['employer']; ?> </td>
                                    <td class="flex justify-center">
                                        <div class="content-center flex flex-wrap justify-center gap-2">
                                            <input type="text" class="hidden" name="rfid<?php echo $queNo; ?>" value="<?php echo $row['idNumber']; ?>">
                                            <button id="dropdownMenuIconButton<?php echo $queNo; ?>" data-dropdown-toggle="dropdownDots<?php echo $queNo; ?>" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900  rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 bg-white dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                                    <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                                </svg>
                                            </button>
                                        </div>
                                        <!-- Dropdown menu -->
                                        <div id="dropdownDots<?php echo $queNo; ?>" class="dropdownoption z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                            <ul class="py-2 text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton<?php echo $queNo; ?>">
                                                <li>
                                                    <a type="button" onclick="openEditEmployee(this)" data-id="<?php echo $row['id'] ?>"  data-idnumber="<?php echo $row['idNumber'] ?>" data-name="<?php echo $row['Name'] ?>" data-email="<?php echo $row['email'] ?>" data-age="<?php echo $row['age'] ?>" data-birthday="<?php echo $row['birthday'] ?>"  data-sex="<?php echo $row['sex'] ?>" data-building="<?php echo $row['building'] ?>" data-address="<?php echo $row['address'] ?>" data-civilstatus="<?php echo $row['civilStatus'] ?>" data-employer="<?php echo $row['employer'] ?>" data-department="<?php echo $row['department'] ?>" data-section="<?php echo $row['section'] ?>" data-position="<?php echo $row['position'] ?>" data-level="<?php echo $row['level'] ?>" data-datehired="<?php echo $row['dateHired'] ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                                </li>
                                                <li>
                                                    <a href="../nurses/fitToWork.php?rf=<?php echo $row['idNumber']; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Fit To Work</a>
                                                </li>
                                                <li>
                                                    <a href="../nurses/consultation.php?rf=<?php echo $row['idNumber']; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Medical Consultation</a>
                                                </li>
                                                <!-- <li>
                                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dental Consultation</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Medicine Dispense</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Pregnancy Notification</a>
                                                </li> -->
                                                <li>
                                                    <a href="../nurses/medicalRecord.php?rf=<?php echo $row['idNumber']; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Medical Record</a>
                                                </li>
                                                
                                                <li>
                                                <a href="../nurses/vaccination.php?rf=<?php echo $row['idNumber'] ;?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Vaccination</a>
                                            </li>
                                            <li>
                                                    <a href="../preemployment_xls_individual.php?employeeid=<?php echo $row['idNumber']; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Download Pre-Emp</a>
                                                </li>
                                                <li>
                                                    <a href="../annualPe_xls_individual.php?employeeid=<?php echo $row['idNumber']; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Download APE</a>
                                                </li>
                                                <li>
                                                    <a type="button" onclick="deleteEmpRecord(<?php echo $row['id']; ?>)" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete Record</a>
                                                </li>
                                         
                                            </ul>

                                        </div>
                                        <?php if($row['activeStatus']){
                      ?> <button type="button" onclick="activateDeactivate(this)" data-activate="0" data-id="<?php echo $row['id'];?>" data-name="<?php echo $row['Name'];?>" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-[8px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2 mx-3 md:mx-2">Deactivate</button> <?php
                    }else{
                      ?>
                      <button type="button" onclick="activateDeactivate(this)" data-activate="1" data-id="<?php echo $row['id'];?>" data-name="<?php echo $row['Name'];?>" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-[8px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2 mx-3 md:mx-2">Activate</button>  <?php
                    } ?>
                                    </td>
                                    <td><?php if($row['activeStatus'] == 1){echo "Active";} else{ echo "Separated";};?></td>
                                    <td><?php echo $row['dateOfSeparation']; ?></td>

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



<div id="deleteRecord" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="deleteRecord">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <form action="" method="POST">
                <input type="text" name="empRecordId" id="empRecordId"class="hidden">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this record?</h3>
                <button type="submit" name="deleteEmpRecord" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                </button>
                <button data-modal-hide="deleteRecord" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>






<div id="activateDeactivate" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="activateDeactivate">
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
                    <div class="" id="separationDate">
                    <label class="block  my-auto font-semibold text-gray-900 ">Date of Separation: </label>
                    <input type="date" name="separationDate"  class="bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ">
                    </div>
                
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to <span id="activateDeactivateText"> </span> <span id="nameofUser" class="font-bold"> </span>?</h3>
                <input type="text" id="idOfUser" name="idOfUser" class="hidden">
                <button  type="submit" name="deactivateUser" id="deactivateUser" class="hidden text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                </button>
                
                <button  type="submit" name="activateUser" id="activateUser" class="hidden text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                </button>
                <button data-modal-hide="activateDeactivate" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                </form>
              
            </div>
        </div>
    </div>
</div>


<div id="addDirectEmployees" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-2 border-b rounded-t dark:border-gray-600">
                <h3 class=" font-semibold text-gray-900 dark:text-white">
                    Add New Direct Employee
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="addDirectEmployees">
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
                        <label for="name" class="block mb-1  text-gray-900 dark:text-white">Id Number</label>
                        <input type="text" name="idNumber" id="idNumber" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="name" class="block mb-1  text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Full Name" required="">
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
                            <option value="<?php echo $row['department']; ?> "><?php echo $row['department']; ?> </option>
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

                            <option value="head">Head</option>
                            <option value="hr">HR</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="dateHired" class="block mb-1  text-gray-900 dark:text-white">Date Hired</label>
                        <input type="date" name="dateHired" id="dateHired" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                    </div>
                </div>
                <button type="submit" name="addNewEmployeeManual" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Add New Employee
                </button>
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


<div id="importDirectEmployees" tabindex="-1" aria-hidden="true" class=" hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-2 border-b rounded-t dark:border-gray-600">
                <h3 class=" font-semibold text-gray-900 dark:text-white">
                    Import <?php echo $employer ; ?> Employees
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="importDirectEmployees">
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
                <button type="submit" id="addNewEmployeesImport" name="addNewEmployeesImport"  class="hidden text-white inline-flex items-center bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Import <?php echo $employer ; ?> Employees
                </button>
            </form>
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
                    Edit Employee Record
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
                    <input type="text" class="hidden" name="empIdNumberDb" id="empIdNumberDb">
                    <!-- <div class="col-span-2">
                        <label for="editrfid" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ID Number</label>
                        <input type="text" name="editrfid" id="editrfid" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                    </div> -->
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
                         <select id="editemployer" name="editemployer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="GPI">GLORY</option>
                         <option value="Maxim">MAXIM</option>
                            <option value="Nippi">NIPPI</option>
                            <option value="Natcorp">NATCORP</option>
                            <option value="Canteen">CANTEEN</option>
                            <option value="Alarm">ALARM</option>
                            <option value="Otrelo">OTRELO</option>
                            <option value="Mangreat">MANGREAT</option>
                        </select>
                        <!-- <input type="text" name="editemployer" id="editemployer" value="<?php echo $employer; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder=""> -->
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

                <button type="submit" name="editEmployeeRecord" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Update Record
                </button>
            </form>
        </div>
    </div>
</div>


<script>




const deleteRecord = document.getElementById('deleteRecord');

// options with default values
const deleteRecordModal = {

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



const modalDeleteEmpRecord = new Modal(deleteRecord, deleteRecordModal);

function deleteEmpRecord(id){
    document.getElementById("empRecordId").value=id;
    modalDeleteEmpRecord.toggle();
}






    const editEmployee = document.getElementById('editEmployee');

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

    // instance options object
    const instanceeditemployee = {
        id: 'modalEl',
        override: true
    };

    const modalEdit = new Modal(editEmployee, editemployees);

    function openEditEmployee(element) {
        modalEdit.toggle();
       // document.getElementById("editrfid").value = element.getAttribute("data-rfid");
       
        document.getElementById("empIdNumberDb").value = element.getAttribute("data-id");

        document.getElementById("editidNumber").value = element.getAttribute("data-idnumber");
        document.getElementById("editname").value = element.getAttribute("data-name");
        document.getElementById("editemail").value = element.getAttribute("data-email");
        document.getElementById("editage").value = element.getAttribute("data-age");
        document.getElementById("editsex").value = element.getAttribute("data-sex");
        document.getElementById("editaddress").value = element.getAttribute("data-address");
        document.getElementById("editbuilding").value = element.getAttribute("data-building");

        document.getElementById("editcivilStatus").value = element.getAttribute("data-civilstatus");
        document.getElementById("editemployer").value = element.getAttribute("data-employer");
        document.getElementById("editdepartment").value = element.getAttribute("data-department");
        document.getElementById("editsection").value = element.getAttribute("data-section");
        document.getElementById("editposition").value = element.getAttribute("data-position");
        document.getElementById("editlevel").value = element.getAttribute("data-level");
        document.getElementById("editdateHired").value = element.getAttribute("data-datehired");
        document.getElementById("editBirthday").value = element.getAttribute("data-birthday");

    }

    document.getElementById("employer").addEventListener("keydown", function(event) {
        event.preventDefault(); // Prevent typing into the input field
    });

    function exportTemplate() {
        var rows = [];

        column1 = 'Id Number';
            column2 = 'Name';
            column3 = 'Email';
            column4 = 'Birthday';
            column5 = 'Age';
            column6 = 'Sex';
            column7 = 'Address';
            column8 = 'Civil Status';
            column9 = 'Employer';
            column10 = 'Building';
            column11 = 'Department';
            column12 = 'Section';
            column13 = 'Position';
            column14 = 'Date Hired';

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
            ]
        );

        for (var i = 0, row; i < 1; i++) {
            column1 ='';
            column2 = '';
            column3 = '';
            column4 = 'yyyy-mm-dd';
            column5 = '';
            column6 = '';
            column7 = '';
            column8 = '';
            column9 = '<?php echo $employer; ?>';
            column10 = '1';
            column11 = '';
            column12 = '';
            column13 = '';
            column14 = 'yyyy-mm-dd';

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
        link.setAttribute("download", "<?php echo $employer; ?> Employees Template.csv");
        document.body.appendChild(link);
        /* download the data file named "Stock_Price_Report.csv" */
        link.click();




    }
</script>