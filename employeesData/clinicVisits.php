<?php

if (isset($_GET['rf'])) {
    $rfid = $_GET['rf'];
} else {
    $rfid = "not found";
}

?>
<div class="text-[9px] 2xl:text-lg mb-5">
    <p class="mb-2"><span class=" self-center text-md font-semibold whitespace-nowrap   text-[#193F9F]">Clinic Visit</span></p>

    <div id="" class="">
        <div class=" p-4 rounded-lg  bg-gray-50 " id="" role="tabpanel" aria-labelledby="profile-tab">
            <section class="mt-2 2xl:mt-10">
                <table id="clinicVisits" class="display text-[9px] 2xl:text-sm" style="width:100%">
                    <thead>
                        <tr>

                            <th>Date</th>
                            <th>Time</th>
                            <th>Type</th>
                            <th>Bldg Transaction</th>
                            <th>Status</th>
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
                        $sql = "SELECT * FROM `consultation` WHERE `rfid` = '$rfid' ORDER BY `id` ASC";
                        $result = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {

                        ?>
                            <tr>

                                <td> <?php echo $row['date']; ?> </td>
                                <td> <?php echo $row['time']; ?> </td>
                                <td> <?php echo $row['type']; ?> </td>
                                <td> <?php echo $row['building']; ?> </td>
                                <td> <?php if ($row['statusComplete'] == true) {
                                            echo "Completed";
                                        } else {
                                            echo "With Pending Lab";
                                        } ?> </td>
                                <td> <?php echo $row['categories']; ?> </td>
                                <td> <?php echo $row['chiefComplaint']; ?> </td>
                                <td> <?php echo $row['diagnosis']; ?> </td>
                                <td> <?php echo $row['intervention']; ?> </td>
                                <td> <?php echo $row['clinicRestFrom']; ?> </td>
                                <td> <?php echo $row['clinicRestTo']; ?> </td>
                                <td> <?php echo $row['meds']; ?> </td>
                                <td> <?php echo $row['bloodChemistry'] . ' ' . $row['cbc'] . ' ' . $row['urinalysis'] . ' ' . $row['fecalysis'] . ' ' . $row['xray'] . ' ' . $row['others'] . ' ' . $row['bp'] . ' ' . $row['temp'] . ' ' . $row['02sat'] . ' ' . $row['pr'] . ' ' . $row['rr']; ?> </td>
                                <td> <?php echo $row['othersRemarks']; ?> </td>
                                <td> <?php echo $row['remarks']; ?> </td>
                                <td> <?php echo $row['withPendingLab']; ?> </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>

</div>