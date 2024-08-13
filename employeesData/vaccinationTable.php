<?php

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
      echo "<script> location.href='vaccination.php?rfid=$rfid'; </script>";
    } else {
      echo "<script>alert('There's a problem updating.')</script>";
    }
  }
  

?>


<div class="text-[9px] 2xl:text-lg mb-5">
    <div class="flex justify-between">
        <p class="mb-2 my-auto"><span class=" self-center text-md font-semibold whitespace-nowrap   text-[#193F9F]">Vaccination Record</span></p>
       
        <button type="button" data-modal-target="exportVax" data-modal-toggle="exportVax" class="lg:block text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2 mx-3 md:mx-2">Export</button>
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
                         $sql = "SELECT v.*, e.Name FROM `vaccination` v LEFT JOIN `employeespersonalinfo` e ON e.rfidNumber = v.rfid";
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

                        <option selected value="All">All</option> 
                        <option  value="Flu">Flu</option> 
                        <option  value="Cervical">Cervical</option> 
                        <option  value="Hepa B">Hepa B</option> 
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

                    <button type="submit" name="excelReport" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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
        <select id="vaxType" name="vaxType" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
          <option selected>Select Type</option>
          <option value="flu">Flu</option>
          <option value="hepa b">Hepa B</option>
          <option value="cervical">Cervical</option>
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
</script>
