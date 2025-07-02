<?php

if (isset($_GET['rf'])) {
    $idNumber = $_GET['rf'];
} else {
    $idNumber = "not found";
}

if(isset($_POST['deleteFitToWorkRecord'])){
    $id = $_POST['ftwidtodelete'];
    $sql = "DELETE FROM `fittowork` WHERE `id` = '$id'";
    $results = mysqli_query($con, $sql);
   
    if ($results) {
      echo "<script>alert('Delete successful.');</script>";
    } else {
      echo "<script>alert('There is a problem with deleting record. Please contact your administrator.');</script>";
    }
  }

  
if (isset($_POST['exportIndividualFitToWork'])) {

  
?>
    <script type="text/javascript">
       
        window.open('../fittowork_xls_individual.php?employeeid=<?php echo $idNumber; ?>', '_blank');
        location.href='../nurses/fitToWork.php?rf=<?php echo $idNumber; ?>';
    </script>
<?php
exit;
}




?>
<div class="text-[9px] 2xl:text-lg mb-5">
<div class="flex justify-between">
<form id="excelReport" class="flex justify-between w-full" action="" method="POST">
        <input type="hidden" id="employeeid" name="employeeid" value="<?php echo $idNumber; ?>">
<p class="mb-2 my-auto"><span class=" self-center text-md font-semibold whitespace-nowrap   text-[#193F9F]">Fit To Work History</span></p>
        <button type="button" onclick="exportIndividualFitToWork()"   class="lg:block text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-[8px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2 mx-3 md:mx-2">Export</button>
</form>
        
    </div>
    <div id="" class="">
        <div class=" p-4 rounded-lg  bg-gray-50 " id="headApproval" role="tabpanel" aria-labelledby="profile-tab">
            <section class="mt-2 2xl:mt-10">
                <table id="clinicVisits" class="display" style="width:100%">
                    <thead>
                        <tr>

                            <th>No.</th>
                            <th>Action</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Bldg Transaction</th>
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



                            <!-- <th>Days Late</th> -->
                            <!-- <th>Assigned to</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ftwNo = 1;
                        $sql = "SELECT * FROM `fittowork` WHERE `idNumber` = '$idNumber' ORDER BY `id` DESC; 
                    ";
                        $result = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {

                        ?>

                            <tr>
                                <td> <?php echo $ftwNo; ?> </td>
                                <td class="flex gap-2">

                                    <button type="button" onclick="showData(<?php echo $row['id']; ?>)" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Show</button>
                                    <button type="button" onclick="askdelete(<?php echo $row['id']; ?>)" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Delete</button>
                               
                                </td>
                                <td> <?php echo $row['date']; ?> </td>
                                <td> <?php echo $row['time']; ?> </td>
                                <td> <?php echo $row['building']; ?> </td>
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
                                <td> <?php if ($row['statusComplete'] == 1 || $row['statusComplete'] == true) {
                                            echo "Completed ";
                                        } elseif ($row['withPendingLab'] != NULL || $row['withPendingLab'] != "") {
                                            echo "With pending laboratory: " . $row['withPendingLab'];
                                        } ?></td>
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


<div id="deleteFTWRecord" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="deleteFTWRecord">
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
                <input type="text" id="ftwidtodelete" name="ftwidtodelete" class="hidden">
                <button  type="submit" name="deleteFitToWorkRecord" id="deleteFTWRecord" class=" text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                </button>
               
                <button data-modal-hide="deleteFTWRecord" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                </form>
              
            </div>
        </div>
    </div>
</div>


<script>
function exportIndividualFitToWork() {
    const employeeId = document.getElementById('employeeid').value;

    if (!employeeId) {
        console.error("Employee ID not found!");
        return;
    }

    // Open the Excel report in a new tab
    window.open('../fittowork_xls_individual.php?employeeid=' + encodeURIComponent(employeeId), '_blank');

    // Redirect the current page
    window.location.href = '../nurses/fitToWork.php?rf=' + encodeURIComponent(employeeId);
}
</script>


<script>
    const $targetDeactivateUser = document.getElementById('deleteFTWRecord');
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



    function showData(consultId) {

        var currentUrl = window.location.href; // Get the current URL
        var url = new URL(currentUrl);
        var rfParam = url.searchParams.get('rf');
        if (rfParam) {
            // Construct the new URL by appending the consultId

            window.location.href = "fitToWork.php?rf=" + rfParam + '&ftw=' + consultId; // Navigate to the new URL
        } else {
            console.error('The "rf" parameter is not present in the current URL.');
        }

    }


    function askdelete(id){

        document.getElementById("ftwidtodelete").value = id;
        modaldeactivate.toggle();
    }
</script>