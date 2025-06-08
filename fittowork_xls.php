<?php
$month = $_GET['month'];
$year = $_GET['year'];

header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Fit to work Report for the Month of " . $month . ".xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
$monthNumber = date('m', strtotime($month));

include("includes/connect.php");

$con->next_result();

$sql = mysqli_query($con, "SELECT f.*, e.Name, e.section, e.department, e.building  AS bldg, e.employer, e.sex FROM `fittowork`f 
LEFT JOIN `employeespersonalinfo` e ON e.idNumber = f.idNumber WHERE MONTH(f.date) = '$monthNumber'
    AND YEAR(f.date) = '$year' ORDER BY `id` ASC");


?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <center>
        <b>
            <font color="blue">GLORY (PHILIPPINES), INC.</font>
        </b>
        <br>
        <b>Employees Medical Record</b>
        <br>
        <h3> <b> "Fit to work" for the Month of <?php echo $month ?></b></h3>

        <br>
    </center>
    <br>

    <div id="table-scroll">
        <table width="100%" border="1" align="left">

            <thead>
                <tr>
                    <th rowspan="2">Date</th>
                    <th rowspan="2">Time</th>
                    <th rowspan="2">Building Transaction</th>
                    <th rowspan="2">ID Number</th>
                    <th rowspan="2">Full Name</th>
                    <th rowspan="2">Section</th>
                    <th rowspan="2">Department</th>
                    <th rowspan="2">Building</th>
                    <th rowspan="2">Employer</th>
                    <th rowspan="2">Gender</th>
                    <th rowspan="2">Category</th>
                    <th rowspan="2">Confinement Type</th>
                    <th rowspan="2">Medical Category</th>
                    <th rowspan="2">SL Date From</th>
                    <th rowspan="2">SL Date To</th>
                    <th rowspan="2">No. of Days</th>
                    <th rowspan="2">Reason of Absence</th>
                    <th rowspan="2">Diagnosis</th>
                    <th rowspan="2">Medicine</th>
                    <th colspan="6">Laboratory</th>
                    <th colspan="5">Vital Signs</th>
                    <th rowspan="2">Remarks</th>
                    <th rowspan="2">Other Remarks</th>
                    <th rowspan="2">Medical Certificate</th>
                    <th rowspan="2">Time of Filing</th>


                    <th rowspan="2">Status</th>
                </tr>
                <tr>
                    <th>Blood Chemistry</th>
                    <th>CBC</th>
                    <th>Urinalysis</th>
                    <th>Fecalysis</th>
                    <th>Xray</th>
                    <th>Others</th>
                    <th>BP</th>
                    <th>Temp</th>
                    <th>02 Sat</th>
                    <th>PR</th>
                    <th>RR</th>
                </tr>
                <?php

                ?>

            </thead>
            <tbody>
                <?php

                while ($row = mysqli_fetch_array($sql)) {
                    $date = $row['date'];
                    $time =  $row['time'];
                    $building_transaction = $row['building'];
                    $idNumber = $row['idNumber'];

                    $fullname = $row['Name'];
                    $section  = $row['section'];
                    $department =  $row['department'];
                    $building =  $row['bldg'];
                    $employer =  $row['employer'];
                    $gender =  $row['sex'];
                    $category =  $row['categories'];
                    $confinement_type =  $row['confinementType'];
                    $medical_cat =  $row['medicalCategory'];
                    $date_from = $row['fromDateOfSickLeave'];
                    $date_to = $row['toDateOfSickLeave'];
                    $no_of_days =  $row['days'];
                    $reason_of_absence =  $row['reasonOfAbsence'];
                    $diagnosis =  $row['diagnosis'];
                    $medicine =  $row['medicine'];
                    $bloodchem =  $row['bloodChemistry'];
                    $cbc = $row['cbc'];
                    $urynalysis =  $row['urinalysis'];
                    $fecalysis =  $row['fecalysis'];
                    $xray =  $row['xray'];
                    $others =  $row['others'];
                    $bp =  $row['bp'];
                    $temp =  $row['temp'];
                    $o2sat =  $row['02sat'];
                    $pr =  $row['pr'];
                    $rr =  $row['rr'];
                    $remarks = $row['remarks'];
                    $other_remarks =  $row['otherRemarks'];
                    $isMedcertRequired =  $row['isMedcertRequired'];
                    $timeOfFiling =  $row['timeOfFiling'];


                    $statusComplete =  $row['statusComplete'];
                    $wPendingLab = $row['withPendingLab'];

                    if ($statusComplete == 1) {
                        $status = "Completed";
                    } elseif ($wPendingLab != "" || $wPendingLab != NULL) {
                        $status = "With Pending Laboratory: " . $wPendingLab;
                    }

                    echo "<tr>    
                                  <td>$date</td>
                                  <td>$time</td>
                                  <td>$building_transaction</td>
                                  <td>$idNumber</td>
                                  <td>$fullname</td>
                                  <td>$section</td>
                                     <td>$department</td>
                                      <td>$building</td>
                                       <td>$employer</td>
                                        <td>$gender</td>
                                         <td>$category</td>
                                          <td>$confinement_type</td>
                                           <td>$medical_cat</td>
                                            <td>$date_from</td>
                                            <td>$date_to</td>
                                             <td>$no_of_days</td>
                                              <td>$reason_of_absence</td>
                                               <td>$diagnosis</td>
                                                <td>$medicine</td>
                                                 <td>$bloodchem</td>
                                                  <td>$cbc</td>
                                                   <td>$urynalysis</td>
                                                    <td>$fecalysis</td>
                                                    <td>$xray</td>
                                                    <td>$others</td>
                                                    <td>$bp</td>
                                                    <td>$temp</td>
                                                    <td>$o2sat</td>
                                                    <td>$pr</td>
                                                    <td>$rr</td>
                                                    <td>$remarks</td>
                                                    <td>$other_remarks</td>
                                                    <td>$isMedcertRequired</td>
                                                    <td>$timeOfFiling</td>


                                                     <td>$status</td>

                                    </tr>";
                }

                ?>
            </tbody>
        </table>
    </div>
</body>

</html>