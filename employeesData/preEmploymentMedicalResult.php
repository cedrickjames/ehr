<?php

if (isset($_GET['rf'])) {
    $idNumber = $_GET['rf'];
} else {
    $idNumber = "not found";
}

?>
<div class="text-[9px] 2xl:text-lg mb-5">
    <p class="mb-2"><span class=" self-center text-md font-semibold whitespace-nowrap  text-[#193F9F]">Pre-Employment Medical Result</span></p>

    <div id="" class="">
        <div class=" p-4 rounded-lg  bg-gray-50 " id="headApproval" role="tabpanel" aria-labelledby="profile-tab">
            <section class="mt-2 2xl:mt-10">
                <table id="preEmpMedResult" class="display text-[9px] 2xl:text-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Date received </th>
                            <th>Date performed </th>
                            <th>IMC</th>
                            <th>OEH</th>
                            <th>PE</th>
                            <th>CBC</th>
                            <th>UA</th>
                            <th>FA</th>
                            <th>CXR</th>
                            <th>VA</th>
                            <th>DEN</th>
                            <th>DT</th>
                            <th>PT</th>
                            <th>Others</th>
                            <th>Follow up Status</th>
                            <th>Status</th>
                            <th>FMC</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `preemployment` WHERE `idNumber` = '$idNumber' ORDER BY `id` ASC";
                        $result = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['dateReceived'] ?></td>
                                <td><?php echo $row['datePerformed'] ?></td>
                                <td><?php echo $row['IMC'] ?></td>
                                <td><?php echo $row['OEH'] ?></td>
                                <td><?php echo $row['PE'] ?></td>
                                <td><?php echo $row['CBC'] ?></td>
                                <td><?php echo $row['U_A'] ?></td>
                                <td><?php echo $row['FA'] ?></td>
                                <td><?php echo $row['CXR'] ?></td>
                                <td><?php echo $row['VA'] ?></td>
                                <td><?php echo $row['DEN'] ?></td>
                                <td><?php echo $row['DT'] ?></td>
                                <td><?php echo $row['PT'] ?></td>
                                <td><?php echo $row['otherTest'] ?></td>
                                <td><?php echo $row['followUpStatus'] ?></td>
                                <td><?php echo $row['status'] ?></td>
                                <td><?php echo $row['FMC'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>

</div>