<?php
$employeeid = $_GET['employeeid'];

header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Consultation Report for " . $employeeid . ".xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);

include("includes/connect.php");

$con->next_result();

$sql = mysqli_query($con, "SELECT c.*, e.Name, e.section, e.department, e.building  AS bldg, e.employer, e.sex FROM `consultation`c
LEFT JOIN `employeespersonalinfo` e ON e.idNumber = c.idNumber WHERE c.idNumber = '$employeeid' AND c.status = 'done' ORDER BY `id` ASC ");


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
        <h3> <b> Consultation Report for <?php echo $employeeid ?></b></h3>

        <br>
    </center>
    <br>

    <div id="table-scroll">
        <table width="100%" border="1" align="left">

            <thead>
                <tr>
                    <th rowspan="2">Date</th>
                    <th rowspan="2">Time</th>
                    <th rowspan="2">Type</th>
                    <th rowspan="2">Building Transaction</th>
                    <th rowspan="2">Full Name</th>
                    <th rowspan="2">Section</th>
                    <th rowspan="2">Department</th>
                    <th rowspan="2">Building</th>
                    <th rowspan="2">Employer</th>
                    <th rowspan="2">Sex</th>
                    <th rowspan="2">Medical Category</th>
                    <th rowspan="2">Chief Complaint</th>
                    <th rowspan="2">Diagnosis</th>
                    <th rowspan="2">Intervention</th>
                    <th colspan="2">Clinic Rest</th>
                    <th rowspan="2">Medicine</th>
                    <th rowspan="2">Medicine Quantity</th>
                    <th colspan="6">Laboratory</th>
                    <th colspan="5">Vital Signs</th>
                    <th rowspan="2">Status</th>
                    <th rowspan="2">Nurse Remarks</th>
                    <th rowspan="2">Completed Laboratory</th>
                    <th rowspan="2">Pending Laboratory</th>
                    <th rowspan="2">Medication Dispense from Doc</th>
                    <th rowspan="2">Brief Medical History from Doc</th>
                    <th rowspan="2">Physical Examination from Doc</th>
                    <th rowspan="2">Final diagnosis</th>


                   
                    
                </tr>
                <tr>
                <th>From</th>
                <th>To</th>

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
                    $type =  $row['type'];

                    $building_transaction = $row['building'];
                    $fullname = $row['Name'];
                    $section  = $row['section'];
                    $department =  $row['department'];
                    $building =  $row['bldg'];
                    $employer =  $row['employer'];
                    $gender =  $row['sex'];
                    $category =  $row['categories'];
                    $chiefComplaint =  $row['chiefComplaint'];
                    $diagnosis =  $row['diagnosis'];
                    $intervention =  $row['intervention'];
                    $clinicRestFrom =  $row['clinicRestFrom'];
                    $clinicRestTo =  $row['clinicRestTo'];
                    $meds =  $row['meds'];
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
                    $otherRemarks =  $row['otherRemarks'];

                    $completedLab =  $row['completedLab'];
                    $withPendingLab =  $row['withPendingLab'];
                    $medicationDispense =  $row['medicationDispense'];
                    $briefMedicalHistory =  $row['briefMedicalHistory'];
                    $physicalExams =  $row['physicalExams'];
                    $finalDx =  $row['finalDx'];

                    $statusComplete =  $row['statusComplete'];
                    $wPendingLab = $row['withPendingLab'];

                    if ($statusComplete == 1) {
                        $status = "Completed";
                    } elseif ($wPendingLab != "" || $wPendingLab != NULL) {
                        $status = "Pending";
                    }

                    if($meds){
                        preg_match('/(\w+)\((\d+)\)/', $meds, $matches);

                        $medicine = $matches[1]; // "Bioflu"
                        $quantity = $matches[2]; // "2"
                    }else{
                        $medicine = "";
                        $quantity = "";
                    }
                    


                    echo "<tr>    
                                  <td>$date</td>
                                  <td>$time</td>
                                  <td>$type</td>
                                  <td>$building_transaction</td>
                                  <td>$fullname</td>
                                  <td>$section</td>
                                     <td>$department</td>
                                      <td>$building</td>
                                       <td>$employer</td>
                                        <td>$gender</td>
                                         <td>$category</td>
                                          <td>$chiefComplaint</td>
                                           <td>$diagnosis</td>
                                            <td>$intervention</td>
                                            <td>$clinicRestFrom</td>
                                             <td>$clinicRestTo</td>
            
                                                <td>$medicine</td>
                                                <td>$quantity</td>

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
                                                    <td>$status</td>
                                                    <td>$otherRemarks</td>
                                                    <td>$completedLab</td>
                                                    <td>$withPendingLab</td>
                                                    <td>$medicationDispense</td>
                                                    <td>$briefMedicalHistory</td>
                                                    <td>$physicalExams</td>
                                                    <td>$finalDx</td>



                                                 

                                    </tr>";
                }

                ?>
            </tbody>
        </table>
    </div>
</body>

</html>