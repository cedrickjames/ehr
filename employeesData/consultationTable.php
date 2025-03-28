
<?php

if (isset($_GET['rf'])) {
    $idNumber = $_GET['rf'];
} else {
    $idNumber = "not found";
}

// if(isset($_POST['deleteFitToWorkRecord'])){
//     $id = $_POST['ftwidtodelete'];
//     $sql = "DELETE FROM `fittowork` WHERE `id` = '$id'";
//     $results = mysqli_query($con, $sql);
   
//     if ($results) {
//       echo "<script>alert('Delete successful.');</script>";
//     } else {
//       echo "<script>alert('There is a problem with deleting record. Please contact your administrator.');</script>";
//     }
//   }

  
if (isset($_POST['exportIndividualConsultation'])) {

  
?>
    <script type="text/javascript">
       
        window.open('../consultation_xls_individual.php?employeeid=<?php echo $idNumber; ?>', '_blank');
        location.href='../nurses/consultation.php?rf=<?php echo $idNumber; ?>';
    </script>
<?php
exit;
}




?>

<div class="text-[9px] 2xl:text-lg mb-5">
<div class="flex justify-between">
<form id="excelReport" class="flex justify-between w-full" action="" method="POST">
        <p class="mb-2 my-auto"><span class=" self-center text-md font-semibold whitespace-nowrap   text-[#193F9F]">Previous Consultation</span></p>
        <button type="submit" name="exportIndividualConsultation"  class="lg:block text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-[8px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2 mx-3 md:mx-2">Export</button>
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
                            <th>Status</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Type</th>
                            <th>Bldg Transaction</th>
                            <th>Medical Category</th>
                            <th>Chief Complaint</th>
                            <th>Diagnosis</th>
                            <th>Intervention</th>
                            <th>Clinic Rest From</th>
                            <th>Clinic Rest To</th>
                            <th>Meds</th>
                            <th>Laboratory</th>
                            <th>Others</th>
                            <th>Remarks</th>
                            <th>Pending Lab</th>

                            <!-- <th>Days Late</th> -->
                            <!-- <th>Assigned to</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cnsltnNo = 1;
                        $sql = "SELECT * FROM `consultation` WHERE `idNumber` = '$idNumber' AND `status` = 'done'  ORDER BY `id` ASC; 
                    ";
                        $result = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {

                        ?>

                            <tr>
                                <td> <?php echo $cnsltnNo; ?> </td>
                                <td>
                                    <button type="button" onclick="showData(<?php echo $row['id']; ?>)" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Show</button>
                                </td>

                                <td> <?php if ($row['statusComplete'] == true) {
                                            echo "Completed";
                                        } else {
                                            echo "With Pending Lab";
                                        } ?> </td>
                                <td> <?php echo $row['date']; ?> </td>
                                <td> <?php echo $row['time']; ?> </td>
                                <td> <?php echo $row['type']; ?> </td>
                                <td> <?php echo $row['building']; ?> </td>
                                <td> <?php echo $row['categories']; ?> </td>
                                <td> <?php echo $row['chiefComplaint']; ?> </td>
                                <td> <?php echo $row['diagnosis']; ?> </td>
                                <td> <?php echo $row['intervention']; ?> </td>
                                <td> <?php echo $row['clinicRestFrom']; ?> </td>
                                <td> <?php echo $row['clinicRestTo']; ?> </td>
                                <td> <?php echo $row['meds']; ?> </td>
                                <td> <?php echo $row['bloodChemistry'] . ' ' . $row['cbc'] . ' ' . $row['urinalysis'] . ' ' . $row['fecalysis'] . ' ' . $row['xray'] . ' ' . $row['others'] . ' ' . $row['bp'] . ' ' . $row['temp'] . ' ' . $row['02sat'] . ' ' . $row['pr'] . ' ' . $row['rr']; ?> </td>
                                <td> <?php echo $row['otherRemarks']; ?> </td>
                                <td> <?php echo $row['remarks']; ?> </td>
                                <td> <?php echo $row['withPendingLab']; ?> </td>

                            </tr>


                        <?php

                            $cnsltnNo++;
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>

</div>


<script>
    function showData(consultId) {
        var currentUrl = window.location.href; // Get the current URL
        var url = new URL(currentUrl);
        var rfParam = url.searchParams.get('rf');
        if (rfParam) {
            // Construct the new URL by appending the consultId

            window.location.href = "consultation.php?rf=" + rfParam + '&cnsltn=' + consultId; // Navigate to the new URL
        } else {
            console.error('The "rf" parameter is not present in the current URL.');
        }

    }
</script>