<?php 
include ("../includes/connect.php");

  
    $sql = "UPDATE `consultation` SET `seenByDoc`=1 WHERE `seenByDoc` = 0";
    $results = mysqli_query($con,$sql);

?>