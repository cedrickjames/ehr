<?php

if (isset($_GET['rf'])) {
    $rfid = $_GET['rf'];
} else {
    $rfid = "not found";
}

?>
<div class=" text-[9px] 2xl:text-lg mb-5">
    <p class="mb-2"><span class=" self-center text-md font-semibold whitespace-nowrap   text-[#193F9F]">Blood Chemistry Testing</span></p>

    <div id="" class="">
        <div class=" p-4 rounded-lg  bg-gray-50 " id="headApproval" role="tabpanel" aria-labelledby="profile-tab">
            <section class="mt-2 2xl:mt-10">
                <table id="bloodChem" class="display text-[9px] 2xl:text-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Bldg Transaction</th>
                            <th>Diagnosis</th>
                            <th>Intervention</th>
                            <th>Medications</th>
                            <th>Follow up Date</th>
                            <th>Laboratory</th>
                            <th>Others</th>
                            <th>Remarks</th>


                            <!-- <th>Days Late</th> -->
                            <!-- <th>Assigned to</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `bloodchem` WHERE `rfid` = '$rfid' ORDER BY `id` ASC";
                        $result = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {

                        ?>
                            <tr>
                                <td><?php echo $row['date'] ?></td>
                                <td><?php echo $row['time'] ?></td>
                                <td><?php echo $row['building'] ?></td>
                                <td><?php echo $row['diagnosis'] ?></td>
                                <td><?php echo $row['intervention'] ?></td>
                                <td><?php echo $row['medications'] ?></td>
                                <td><?php echo $row['followupdate'] ?></td>
                                <td> <?php echo $row['FBS'] . ' ' . $row['cholesterol'] . ' ' . $row['triglycerides'] . ' ' . $row['HDL'] . ' ' . $row['LDL'] . ' ' . $row['BUN'] . ' ' . $row['BUA'] . ' ' . $row['SGPT'] . ' ' . $row['SGOT'] . ' ' . $row['HBA1C']; ?> </td>
                                <td><?php echo $row['others'] ?></td>
                                <td><?php echo $row['remarks'] ?></td>


                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>

</div>