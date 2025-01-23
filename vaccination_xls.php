<?php
$month = $_GET['month'];
$year = $_GET['year'];
$vax = $_GET['vax'];

if($vax == "All"){
$type = "";
}else{
    $type = $_GET['vax'];
}
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=".$type." Vaccination Record for the Month of " . $month . ".xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
$monthNumber = date('m', strtotime($month));

include("includes/connect.php");

$con->next_result();
if($vax == "All"){
    $sql = "SELECT v.*, e.Name FROM `vaccination` v LEFT JOIN `employeespersonalinfo` e ON e.idNumber = v.idNumber WHERE (MONTH(v.firstDose) = '$monthNumber'
    AND YEAR(v.firstDose) = '$year') OR (MONTH(v.secondDose) = '$monthNumber'
    AND YEAR(v.secondDose) = '$year') OR (MONTH(v.thirdDose) = '$monthNumber'
    AND YEAR(v.thirdDose) = '$year') ORDER BY `id` ASC";
}
else{
    $sql = "SELECT v.*, e.Name FROM `vaccination` v LEFT JOIN `employeespersonalinfo` e ON e.idNumber = v.idNumber WHERE v.vaccineType = '$vax' AND (MONTH(v.firstDose) = '$monthNumber'
    AND YEAR(v.firstDose) = '$year') OR (MONTH(v.secondDose) = '$monthNumber'
    AND YEAR(v.secondDose) = '$year') OR (MONTH(v.thirdDose) = '$monthNumber'
    AND YEAR(v.thirdDose) = '$year') ORDER BY `id` ASC";
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
        <h3> <b> <?php echo $type ?> Vaccination Record for the Month of <?php echo $month ?></b></h3>

        <br>
    </center>
    <br>

    <div id="table-scroll">
        <table width="100%" border="1" align="left">

        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Employee</th>
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
                                <td><?php echo $row['Name'] ?></td>
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
    </div>
</body>

</html>