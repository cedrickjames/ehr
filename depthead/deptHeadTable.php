<?php


$userID = $_SESSION['userID'];
$department =  $_SESSION['department'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Iterate through the $_POST array to find the button that was clicked
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'approve_') === 0) {
            // Extract the number from the button name
            $ftwNo = substr($key, strlen('approve_'));


            $sql = "UPDATE `fittowork` SET `approval`='hr' WHERE `id` = '$ftwNo'";
            $results = mysqli_query($con, $sql);

            // Output the queNo
            // echo "Button with queNo $queNo was clicked.";


            // You can use $queNo in further processing as needed
        }
    }
}
?>

<div class="text-[9px] 2xl:text-lg mb-5">
    <p class="mb-2"><span class=" self-center text-md font-semibold whitespace-nowrap   text-[#193F9F]">On Queue</span></p>

    <div id="" class="">
        <div class=" p-4 rounded-lg  bg-gray-50 " id="headApproval" role="tabpanel" aria-labelledby="profile-tab">
            <form action="" method="post">
                <section class="mt-2 2xl:mt-10">
                    <table id="deptHeadTable" class="display text-[9px] 2xl:text-sm" style="width:100%">
                        <thead>
                            <tr>

                                <th>No.</th>
                                <th>Action</th>
                                <th>Name</th>
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
                                <th>Others</th>
                                <th>Remarks</th>


                                <!-- <th>Days Late</th> -->
                                <!-- <th>Assigned to</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ftwNo = 1;
                            $sql = "SELECT  fittowork.*, employeespersonalinfo.Name  FROM fittowork  INNER JOIN employeespersonalinfo ON employeespersonalinfo.idNumber = fittowork.idNumber  WHERE fittowork.approval = 'head' AND fittowork.department = '$department' ORDER BY `id` ASC;";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {

                            ?>

                                <tr>
                                    <td> <?php echo $ftwNo; ?> </td>
                                    <td><button type="submit" name="approve_<?php echo $row['id']; ?>" class="relative inline-flex items-center justify-center p-0.5  me-2 overflow-hidden  font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white ">
                                            <span class="relative px-2 py-2 transition-all ease-in duration-75 bg-white group-hover:bg-opacity-0 rounded-md ">
                                                Approve
                                            </span>
                                        </button></td>
                                    <td> <?php echo $row['Name']; ?> </td>
                                    <td> <?php echo $row['date']; ?> </td>
                                    <td> <?php echo $row['time']; ?> </td>
                                    <td> <?php echo $row['building']; ?> </td>
                                    <td> <?php echo $row['reasonOfAbsence']; ?> </td>
                                    <td> <?php echo $row['diagnosis']; ?> </td>
                                    <td> <?php echo $row['medicalCategory']; ?> </td>
                                    <td> <?php echo $row['confinementType']; ?> </td>
                                    <td> <?php echo $row['fromDateOfSickLeave']; ?> </td>
                                    <td> <?php echo $row['toDateOfSickLeave']; ?> </td>
                                    <td> <?php echo $row['bloodChemistry'] . ' ' . $row['cbc'] . ' ' . $row['urinalysis'] . ' ' . $row['fecalysis'] . ' ' . $row['xray'] . ' ' . $row['others'] . ' ' . $row['bp'] . ' ' . $row['temp'] . ' ' . $row['02sat'] . ' ' . $row['pr'] . ' ' . $row['rr']; ?> </td>
                                    <td> <?php echo $row['otherRemarks']; ?> </td>
                                    <td> <?php echo $row['remarks']; ?> </td>
                                </tr>


                            <?php

                                $ftwNo++;
                            }
                            ?>
                        </tbody>
                    </table>
                </section>
            </form>
        </div>
    </div>

</div>