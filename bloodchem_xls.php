<?php
$month = $_GET['month'];
$year = $_GET['year'];
$employer = $_GET['employer'];

header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=HLP(" . $employer . ") Record for the Month of " . $month . ".xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
$monthNumber = date('m', strtotime($month));

include("includes/connect.php");


$con->next_result();
if ($employer == "All") {
    $sql = "SELECT p.*, e.employer, e.Name, e.section, e.department,e.building, e.rfidNumber , e.sex, p.building AS bldg_transaction FROM bloodchem p JOIN employeespersonalinfo e ON e.rfidNumber = p.rfid WHERE MONTH(p.date) = '$monthNumber'
    AND YEAR(p.date) = '$year' ORDER BY `id` ASC";
} else {
    $sql = "SELECT p.*, e.employer, e.Name, e.section, e.department,e.building, e.rfidNumber , e.sex, p.building AS bldg_transaction FROM bloodchem p JOIN employeespersonalinfo e ON e.rfidNumber = p.rfid WHERE e.employer = '$employer' AND MONTH(p.date) = '$monthNumber'
    AND YEAR(p.date) = '$year' ORDER BY `id` ASC";
}

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
        <b>Electronic Medical Record</b>
        <br>
        <h3> <b> HLP(<?php echo $employer ?>) Record for the Month of <?php echo $month ?></b></h3>

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
                    <th rowspan="2">Name</th>
                    <th rowspan="2">Section </th>
                    <th rowspan="2">Department</th>
                    <th rowspan="2">Building</th>
                    <th rowspan="2">Employer</th>
                    <th rowspan="2">Gender</th>
                    <th rowspan="2">Type</th>
                    <th rowspan="2">Diagnosis</th>
                    <th rowspan="2">Intervention</th>
                    <th rowspan="2">Medicine</th>
                    <th rowspan="2">Follow-up Date</th>
                    <th rowspan="2">Remarks</th>
                    <th colspan="11">Laboratory</th>

                </tr>
                <tr>
                    <th>FBS</th>
                    <th>Cholesterol</th>
                    <th>Triglycerides</th>
                    <th>HDl</th>
                    <th>LDL</th>
                    <th>BUN</th>
                    <th>BUA</th>
                    <th>SGPT</th>
                    <th>SGDT</th>
                    <th>HBA1C</th>
                    <th>Others</th>
                </tr>
                <?php

                ?>

            </thead>
            <tbody>

                <?php
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>    
                              
                            <td>" . $row['date'] . "</td>
                            <td>" . $row['time'] . "</td>
                            <td>" . $row['bldg_transaction'] . "</td>
                             <td>" . $row['Name'] . "</td>
                              <td>" . $row['section'] . "</td>
                               <td>" . $row['department'] . "</td>
                                <td>" . $row['building'] . "</td>
                                 <td>" . $row['employer'] . "</td>
                                  <td>" . $row['sex'] . "</td>
                                   <td>" . $row['type'] . "</td>
                                    <td>" . $row['diagnosis'] . "</td>
                                     <td>" . $row['intervention'] . "</td>
                                      <td>" . $row['medications'] . "</td>
                                       <td>" . $row['followupdate'] . "</td>
                                        <td>" . $row['remarks'] . "</td>
                                         <td>" . $row['FBS'] . "</td>
                                          <td>" . $row['cholesterol'] . "</td>
                                           <td>" . $row['triglycerides'] . "</td>
                                            <td>" . $row['HDL'] . "</td>
                                             <td>" . $row['LDL'] . "</td>
                                              <td>" . $row['BUN'] . "</td>
                                              <td>" . $row['BUA'] . "</td>
                                              <td>" . $row['SGPT'] . "</td>
                                              <td>" . $row['SGDT'] . "</td>
                                              <td>" . $row['HBA1C'] . "</td>
                                              <td>" . $row['others'] . "</td>
                                    </tr>";
                }

                ?>
            </tbody>
        </table>
    </div>
</body>

</html>