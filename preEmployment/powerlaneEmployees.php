
<?php

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



if(isset($_POST['addNewEmployeeManual'])){
    $rfid = $_POST['rfid'];
    $idNumber = $_POST['idNumber'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $address = $_POST['address'];
    $civilStatus = $_POST['civilStatus'];
    $employer = $_POST['employer'];
    $department = $_POST['department'];
    $section = $_POST['section'];
    $position = $_POST['position'];
    $dateHired = $_POST['dateHired'];




    $addEmployeeGpi = "INSERT INTO `employeespersonalinfo`(`rfidNumber`, `idNumber`, `Name`, `age`, `sex`, `address`, `civilStatus`, `employer`, `department`, `secDept`, `position`, `dateHired`) VALUES ('$rfid','$idNumber','$name','$age','$sex','$address','$civilStatus','$employer','$department','$section','$position','$dateHired')";
    $resultInfo = mysqli_query($con, $addEmployeeGpi);

    if($resultInfo){
        echo "<script>alert('Successfull') </script>";
        echo "<script> location.href='index.php'; </script>";
      
       }




}

if(isset($_POST['addNewEmployeesImport'])){


    $fileName = $_FILES['import_file']['name'];
    // echo $fileName;
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowed_ext = ['xls','csv','xlsx'];
    if(in_array($file_ext, $allowed_ext))
      {

        $count = 0;
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();
        $highestRow =$spreadsheet->getActiveSheet()->getHighestRow();
        echo "<script> console.log('$highestRow') </script>";
      }
      foreach($data as $row)
      {
        if($count > 0)
            {
$rfid = $row['0'];
$idNumber = $row['1'];
$name = $row['2'];
$age = $row['3'];
$sex = $row['4'];
$address = $row['5'];
$civilStatus = $row['6'];
$employer = $row['7'];
$department = $row['8'];
$section = $row['9'];
$position = $row['10'];
$dateHired = $row['11'];
$addEmployeeGpi = "INSERT INTO `employeespersonalinfo`(`rfidNumber`, `idNumber`, `Name`, `age`, `sex`, `address`, `civilStatus`, `employer`, `department`, `secDept`, `position`, `dateHired`) VALUES ('$rfid','$idNumber','$name','$age','$sex','$address','$civilStatus','$employer','$department','$section','$position','$dateHired')";
$resultInfo = mysqli_query($con, $addEmployeeGpi);

if($resultInfo){
    echo "<script>alert('Successfull') </script>";
    echo "<script> location.href='index.php'; </script>";
  
   }

            }
            $count = 1;
          
      }
    
}
?>
<div class="text-[9px] 2xl:text-lg mb-5">
  <div class="flex justify-between">
  <p class="mb-2 my-auto"><span class=" self-center text-md font-semibold whitespace-nowrap   text-[#193F9F]">Powerlane Employees</span></p>

  <button type="button" data-dropdown-toggle="options"  class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800  rounded-lg  px-5 py-2.5 text-center me-2 mb-2">Options</button>
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
        <div class=" p-4 rounded-lg  bg-gray-50 " id="headApproval" role="tabpanel"
            aria-labelledby="profile-tab">
            <form action="index.php" method = "post">
            <section class="mt-2 2xl:mt-10">
                <table id="queTable" class="display text-[9px] 2xl:text-sm" style="width:100%">
                <thead>
                        <tr>
                            <th >No.</th>
                            <th >Name</th>
                            <th >Employer</th>
                            <th >Action</th>
                            

                           
                            
                            <!-- <th>Days Late</th> -->
                            <!-- <th>Assigned to</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $queNo = 1;
                        $sql="SELECT * FROM `employeespersonalinfo` WHERE `employer` = 'Powerlane' ORDER BY `Name` ASC; 
                    ";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_assoc($result)){
          
                ?> <tr> 
                    <td> <?php echo $queNo;?> </td>
                    <td> <?php echo $row['Name'];?> </td>
                    <td><?php echo $row['employer'];?> </td>
                    <td> <div class="content-center flex flex-wrap justify-center gap-2">
                    <input type="text" class="hidden" name="rfid<?php echo $queNo;?>" value="<?php echo $row['rfidNumber'];?>">
                    <button  id="dropdownMenuIconButton<?php echo $queNo;?>" data-dropdown-toggle="dropdownDots<?php echo $queNo;?>" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900  rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 bg-white dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
<path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
</svg>
</button>



                    </div>
<!-- Dropdown menu -->
<div id="dropdownDots<?php echo $queNo;?>" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
    <ul class="py-2 text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton<?php echo $queNo;?>">
      <li>
        <a href="../nurses/fitToWork.php?rf=<?php echo $row['rfidNumber']; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Fit To Work</a>
      </li>
      <li>
        <a href="../nurses/consultation.php?rf=<?php echo $row['rfidNumber'] ;?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Medical Consultation</a>
      </li>
      <li>
        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dental Consultation</a>
      </li>
      <li>
        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Medicine Dispence</a>
      </li>
      <li>
        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Pregnancy Notification</a>
      </li>
      <li>
        <a href="../nurses/medicalRecord.php?rf=<?php echo $row['rfidNumber'] ;?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Medical Record</a>
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





        <div id="addDirectEmployees" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-2 border-b rounded-t dark:border-gray-600">
                <h3 class=" font-semibold text-gray-900 dark:text-white">
                    Add New Powerlane Employee
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="addDirectEmployees">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form method="POST" class="px-4 md:px-5 py-2 text-[8pt]">
                <div class="grid gap-2 mb-4 grid-cols-2">
                <div class="col-span-2">
                        <label for="rfid" class="block mb-1  text-gray-900 dark:text-white">RFID</label>
                        <input type="text" name="rfid" id="rfid" placeholder="Please Tap the ID" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                    </div>
                <div class="col-span-2">
                        <label for="name" class="block mb-1  text-gray-900 dark:text-white">Id Number</label>
                        <input type="text" name="idNumber" id="idNumber" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                    </div>
                    <div class="col-span-2">
                        <label for="name" class="block mb-1  text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Full Name" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="age" class="block mb-1  text-gray-900 dark:text-white">Age</label>
                        <input type="number" name="age" id="age" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="sex" class="block mb-1  text-gray-900 dark:text-white">Sex</label>
                        <select id="sex" name="sex" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected disabled>Select Sex</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <!-- <option value="female">Ano yun?</option>
                            <option value="female">Saan?</option>
                            <option value="female">Chocolate</option> -->




                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="address" class="block mb-1  text-gray-900 dark:text-white">Address</label>
                        <input type="text" name="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
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
                    <div class="col-span-2 sm:col-span-1">
                    <label for="employer" class="block mb-1  text-gray-900 dark:text-white">Employer</label>
                        <input  type="text" name="employer"  value="Powerlane" id="employer" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  >
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="department" class="block mb-1  text-gray-900 dark:text-white">Department</label>
                        <select id="department" name="department" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected disabled>Select Department</option>
                            <option value="Accounting">Accounting</option>
                            <option value="Administration">Administration</option>
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
                    <label for="section" class="block mb-1  text-gray-900 dark:text-white">Section</label>
                        <input  type="text" name="section"   id="section" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  >
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                    <label for="Position" class="block mb-1  text-gray-900 dark:text-white">Position</label>
                        <input  type="text" name="position"   id="Position" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  >
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                    <label for="dateHired" class="block mb-1  text-gray-900 dark:text-white">Date Hired</label>
                        <input  type="date" name="dateHired"   id="dateHired" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"  >
                    </div>
                 
                </div>
                <button type="submit" name="addNewEmployeeManual"class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Add New Employee
                </button>
            </form>
        </div>
    </div>
</div> 





<div id="importDirectEmployees" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-2 border-b rounded-t dark:border-gray-600">
                <h3 class=" font-semibold text-gray-900 dark:text-white">
                    Import Powerlane Employees
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="importDirectEmployees">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form method="POST" class="px-4 md:px-5 py-2 text-[8pt]" enctype="multipart/form-data">
                <div class="grid gap-2 mb-4 grid-cols-2">
                <div class="col-span-2">
                        
<label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
<input type="file" name="import_file" class="block w-full  text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" >

                    </div>
                
                 
                </div>
                <button type="submit" name="addNewEmployeesImport"class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  rounded-lg  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Import Powerlane Employees
                </button>
            </form>
        </div>
    </div>
</div> 





<script>

document.getElementById("employer").addEventListener("keydown", function(event) {
    event.preventDefault(); // Prevent typing into the input field
});


function exportTemplate (){

  var rows =[];

           column1 = 'rfidNumber';
           column2 = 'idNumber';
           column3 = 'Name';
           column4 = 'age';
           column5 = 'sex';
           column6 = 'address';
           column7 = 'civilStatus';
           column8 = 'employer';
           column9 = 'department';
           column10 = 'secDept';
           column11 = 'position';
           column12 = 'dateHired';

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
               ]
           );
           
  for(var i=0,row; i < 1;i++){
           column1 = "Change format to 'Text'";
           column2 = '';
           column3 = '';

           column4 = '';
           column5 = '';
           column6 = '';
           column7 = '';
           column8 = 'Powerlane';
           column9 = '';
           column10 = '';
           column11 = '';
           column12 = '';




           
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


           
               ]
           );

  }
  csvContent = "data:text/csv;charset=utf-8,";
        /* add the column delimiter as comma(,) and each row splitted by new line character (\n) */
        rows.forEach(function(rowArray){
          row = rowArray.join('","');
          row = '"' + row + '"';
          csvContent += row + "\r\n";
      });
 
       /* create a hidden <a> DOM node and set its download attribute */
       var encodedUri = encodeURI(csvContent);
       var link = document.createElement("a");
       link.setAttribute("href", encodedUri);
       link.setAttribute("download", "Powerlane Employees Template.csv");
       document.body.appendChild(link);
        /* download the data file named "Stock_Price_Report.csv" */
       link.click();


    

}

</script>
