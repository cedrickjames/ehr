<?php

if (isset($_GET['rf'])) {
    $rfid = $_GET['rf'];
} else {
    $rfid = "not found";
}

?>
<div class="text-[9px] 2xl:text-lg mb-5">
    <p class="mb-2"><span class=" self-center text-md font-semibold whitespace-nowrap   text-[#193F9F]">Fit to Work History</span></p>

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
                        $sql = "SELECT * FROM `fittowork` WHERE `rfid` = '$rfid' ORDER BY `id` ASC; 
                    ";
                        $result = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {

                        ?>

                            <tr>
                                <td> <?php echo $ftwNo; ?> </td>
                                <td>
                                    <button type="button" onclick="showData(<?php echo $row['id']; ?>)" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Show</button>
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


<script>
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
</script>