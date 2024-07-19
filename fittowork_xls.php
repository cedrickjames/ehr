<?php
$month = $_GET['month'];
$year = $_GET['year'];

// header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
// header("Content-Disposition: attachment; filename=Summary Report for the Month of " . $month . ".xls");  //File name extension was wrong
// header("Expires: 0");
// header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
// header("Cache-Control: private", false);
$monthNumber = date('m', strtotime($month));

include("includes/connect.php");

$con->next_result();

$sql = mysqli_query($con, "SELECT f.*, e.Name FROM `fittowork`f LEFT JOIN `employeespersonalinfo` e ON e.rfidNumber = f.rfid WHERE MONTH(`date`) = '$monthNumber' AND YEAR(`date`) = '$year' ORDER BY `id` ASC");


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
        <h3> <b> "Fit to work" for the Month of <?php echo $month ?></b></h3>

        <br>
    </center>
    <br>

    <div id="table-scroll">
        <table width="100%" border="1" align="left">

            <thead>
                <tr>
                    <th rowspan="2">Request No.</th>
                    <th rowspan="2">Requestor</th>
                    <th rowspan="2">Department</th>
                    <th rowspan="2">Request Type (Category)</th>
                    <th rowspan="2">Request Details</th>
                    <th rowspan="2">In-charge</th>
                    <th colspan="3">Requirements</th>
                    <th rowspan="2">ICT Date Approval</th>
                    <th rowspan="2">Date Responded</th>
                    <th rowspan="2">Response Rate (Hours)</th>
                    <th rowspan="2">Remarks</th>
                    <th rowspan="2">Date Finished</th>
                    <th rowspan="2">Accomplishment Rate (Days)</th>
                    <th rowspan="2">Remarks</th>
                    <th rowspan="2">Closed by</th>
                    <th rowspan="2">Action Taken</th>
                    <th rowspan="2">Recommendation</th>
                </tr>
                <tr>
                    <th>Priority Level</th>
                    <th>Hours</th>
                    <th>Days</th>
                </tr>
                <?php

                ?>

            </thead>
            <tbody>
                <?php

                while ($row = mysqli_fetch_array($sql)) {

                    echo "<tr>    
                                  
                                    </tr>";
                }

                ?>
            </tbody>
        </table>
    </div>
</body>

</html>