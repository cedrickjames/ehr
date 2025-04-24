<?php
$month = $_GET['month'];
$year = $_GET['year'];
$employer = $_GET['employer'];

header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Pre-Employment(".$employer.") Record for the Month of " . $month . ".xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
$monthNumber = date('m', strtotime($month));

include("includes/connect.php");

$con->next_result();
if($employer == "All"){
    $sql = "SELECT * FROM preemployment  WHERE MONTH(dateReceived) = '$monthNumber'
    AND YEAR(dateReceived) = '$year' ORDER BY `id` ASC";
}
else{
    $sql = "SELECT * FROM preemployment WHERE employer = '$employer' AND MONTH(dateReceived) = '$monthNumber'
    AND YEAR(dateReceived) = '$year' ORDER BY `id` ASC";
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
        <b>Employees Medical Record</b>
        <br>
        <h3> <b> Pre-Employment(<?php echo $employer ?>) Record for the Month of <?php echo $month ?></b></h3>

        <br>
    </center>
    <br>

    <div id="table-scroll">
        <table width="100%" border="1" align="left">

            <thead>
                <tr>
                                <th>Date received </th>
                                <th>Date performed </th>
                                <th>Name </th>
                                <th>Section </th>
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
                                <th>Follow up status</th>
                                <th>Status</th>
                                <th>Attendee</th>
                                <th>Confirmation date</th>
                                <th>FMC</th>
                </tr>
       
                <?php

                ?>

            </thead>
            <tbody>
                <?php
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>    
                              
                            <td>".$row['dateReceived']."</td>
                            <td>".$row['datePerformed']."</td>
                            <td>".$row['name']."</td>
                             <td>".$row['section']."</td>
                              <td>".$row['IMC']."</td>
                               <td>".$row['OEH']."</td>
                                <td>".$row['PE']."</td>
                                 <td>".$row['CBC']."</td>
                                  <td>".$row['U_A']."</td>
                                   <td>".$row['FA']."</td>
                                    <td>".$row['CXR']."</td>
                                     <td>".$row['VA']."</td>
                                      <td>".$row['DEN']."</td>
                                       <td>".$row['DT']."</td>
                                        <td>".$row['PT']."</td>
                                         <td>".$row['otherTest']."</td>
                                          <td>".$row['followUpStatus']."</td>
                                           <td>".$row['status']."</td>
                                            <td>".$row['attendee']."</td>
                                             <td>".$row['confirmationDate']."</td>
                                              <td>".$row['FMC']."</td>
                                    </tr>";
                }

                ?>
            </tbody>
        </table>
    </div>
</body>

</html>