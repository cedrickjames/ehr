<?php
$employer = $_GET['employer'];

header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Employees Record(".$employer.").xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);

include("../includes/connect.php");

$con->next_result();
$sql = "SELECT * FROM `employeespersonalinfo` WHERE employer = '$employer' ORDER BY `id` ASC";


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
        <b>Employees Record</b>
        <br>
        <h3> <b> Employees Record(<?php echo $employer ?>) </b></h3>

        <br>
    </center>
    <br>

    <div id="table-scroll">
        <table width="100%" border="1" align="left">

            <thead>
                <tr>
                                <th>Id Number</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Birthday </th>
                                <th>Age</th>
                                <th>Sex</th>
                                <th>Address</th>
                                <th>Civil Status</th>
                                <th>Employer</th>
                                <th>Building</th>
                                <th>Department</th>
                                <th>Section</th>
                                <th>Position</th>
                                <th>Date Hired</th>
                                <th>Separated</th>
                                <th>Date of Separation</th>
                                
                </tr>
       
                <?php

                ?>

            </thead>
            <tbody>
                <?php
                $result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    if ($row['activeStatus']==1){
                        $separated="";
                    }
                    else{
                        $separated="Separated";
                    }
                    echo "<tr>    
                              
                            <td>".$row['idNumber']."</td>
                            <td>".$row['Name']."</td>
                            <td>".$row['email']."</td>
                             <td>".$row['birthday']."</td>
                              <td>".$row['age']."</td>
                               <td>".$row['sex']."</td>
                                <td>".$row['address']."</td>
                                 <td>".$row['civilStatus']."</td>
                                  <td>".$row['employer']."</td>
                                   <td>".$row['building']."</td>
                                    <td>".$row['department']."</td>
                                     <td>".$row['section']."</td>
                                      <td>".$row['position']."</td>
                                       <td>".$row['dateHired']."</td>
                                        <td>".$separated."</td>
                                         <td>".$row['dateOfSeparation']."</td>
                                          
                                    </tr>";
                }

                ?>
            </tbody>
        </table>
    </div>
</body>

</html>