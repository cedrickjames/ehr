<?php

if (isset($_GET['rf'])) {
    $rfid = $_GET['rf'];
} else {
    $rfid = "not found";
}

?>
<div class="text-[9px] 2xl:text-lg mb-5">
    <p class="mb-2"><span class=" self-center text-md font-semibold whitespace-nowrap  text-[#193F9F]">Sick Leave (Fit to Work)</span></p>

    <div id="" class="">
        <div class=" p-4 rounded-lg  bg-gray-50 " id="" role="tabpanel" aria-labelledby="profile-tab">
            <section class="mt-2 2xl:mt-10">
                <table id="sickLeave" class="display text-[9px] 2xl:text-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Bldg Transaction</th>
                            <th>Reason of Absence</th>
                            <th>Diagnosis</th>
                            <th>Medical Category</th>
                            <th>Confinement Type</th>
                            <th>Date of Absence</th>
                            <th>Laboratory</th>
                            <th>Remarks</th>


                            <!-- <th>Days Late</th> -->
                            <!-- <th>Assigned to</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `fittowork` WHERE `rfid` = '$rfid' ORDER BY `id` ASC";
                        $result = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {

                            if ($row['fromDateOfSickLeave'] == $row['toDateOfSickLeave']) {
                                $date_of_absence = $row['fromDateOfSickLeave'];
                            } else {
                                $date_of_absence = $row['fromDateOfSickLeave'] . ' to ' . $row['toDateOfSickLeave'];
                            }
                        ?>
                            <tr>
                                <td><?php echo $row['date'] ?></td>
                                <td><?php echo $row['time'] ?></td>
                                <td><?php echo $row['building'] ?></td>
                                <td><?php echo $row['reasonOfAbsence'] ?></td>
                                <td><?php echo $row['diagnosis'] ?></td>
                                <td><?php echo $row['medicalCategory'] ?></td>
                                <td><?php echo $row['confinementType'] ?></td>
                                <td><?php echo $date_of_absence ?></td>
                                <td> <?php echo $row['bloodChemistry'] . ' ' . $row['cbc'] . ' ' . $row['urinalysis'] . ' ' . $row['fecalysis'] . ' ' . $row['xray'] . ' ' . $row['others'] . ' ' . $row['bp'] . ' ' . $row['temp'] . ' ' . $row['02sat'] . ' ' . $row['pr'] . ' ' . $row['rr']; ?> </td>
                                <td><?php echo $row['remarks'] ?></td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>

</div>