<?php

if (isset($_GET['rf'])) {
    $idNumber = $_GET['rf'];
} else {
    $idNumber = "not found";
}

?>
<div class="text-[9px] 2xl:text-lg mb-5">
    <p class="mb-2"><span class=" self-center text-md font-semibold whitespace-nowrap   text-[#193F9F]">Vaccination Record</span></p>

    <div id="" class="">
        <div class=" p-4 rounded-lg  bg-gray-50 " id="headApproval" role="tabpanel" aria-labelledby="profile-tab">
            <section class="mt-2 2xl:mt-10">
                <table id="vaccinationRecord" class="display text-[9px] 2xl:text-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Action</th>
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
                        $sql = "SELECT * FROM `vaccination` WHERE `idNumber` = '$idNumber' ORDER BY `id` ASC";
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
                                    <button type="button" onclick="showData(<?php echo $row['id']; ?>)" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Show</button>
                                </td>
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
<script>
    function showData(vcnId) {

        var currentUrl = window.location.href; // Get the current URL
        var url = new URL(currentUrl);
        var rfParam = url.searchParams.get('rf');
        if (rfParam) {
            // Construct the new URL by appending the consultId

            window.location.href = "vaccination.php?rf=" + rfParam + '&vcn=' + vcnId; // Navigate to the new URL
        } else {
            console.error('The "rf" parameter is not present in the current URL.');
        }

    }
</script>