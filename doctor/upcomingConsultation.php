<?php 
include ("../includes/connect.php");

  
    $sql = "SELECT COUNT(*) AS total
FROM `consultation`
WHERE `status` = 'doc' AND `seenByDoc` = false;";
    $results = mysqli_query($con,$sql);
    while ($row = mysqli_fetch_assoc($results)) {
        echo $total = $row['total'];
    }
     
?>