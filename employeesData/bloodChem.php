<?php

if (isset($_GET['rf'])) {
    $idNumber = $_GET['rf'];
} else {
    $idNumber = "not found";
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
                            <th>Remarks</th>


                            <!-- <th>Days Late</th> -->
                            <!-- <th>Assigned to</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `bloodchem` WHERE `idNumber` = '$idNumber' ORDER BY `id` ASC";
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
                                <td> <?php

                                        if ($row['FBS'] != "") {
                                            echo "FBS: " . $row['FBS'] . " ";
                                        }
                                        if ($row['cholesterol'] != "") {
                                            echo "cholesterol: " . $row['cholesterol'] . " ";
                                        }
                                        if ($row['triglycerides'] != "") {
                                            echo "triglycerides: " . $row['triglycerides'] . " ";
                                        }
                                        if ($row['HDL'] != "") {
                                            echo "HDL: " . $row['HDL'] . " ";
                                        }
                                        if ($row['LDL'] != "") {
                                            echo "LDL: " . $row['LDL'] . " ";
                                        }
                                        if ($row['BUN'] != "") {
                                            echo "BUN: " . $row['BUN'] . " ";
                                        }
                                        if ($row['BUA'] != "") {
                                            echo "BUA: " . $row['BUA'] . " ";
                                        }
                                        if ($row['SGPT'] != "") {
                                            echo "SGPT: " . $row['SGPT'] . " ";
                                        }
                                        if ($row['SGDT'] != "") {
                                            echo "SGDT: " . $row['SGDT'] . " ";
                                        }
                                        if ($row['HBA1C'] != "") {
                                            echo "HBA1C: " . $row['HBA1C'] . " ";
                                        }
                                        if ($row['others'] != "") {
                                            echo "others: " . $row['others'] . " ";
                                        }
                                        ?> </td>
                                <td><?php echo $row['remarks'] ?></td>


                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>

</div>