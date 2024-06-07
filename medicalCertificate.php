<?php
include ("includes/connect.php");
    require 'dompdf/vendor/autoload.php';

    use Dompdf\Dompdf;
    session_start();

    if(!isset($_SESSION['connected'])){
        header("location: logout.php");
      }


      if (isset($_GET['rf'])) {
        $rfid = $_GET['rf'];
    } else {
      $rfid = "not found";
    
    }
    
    if (isset($_GET['mdcrtid'])) {
        $mdcrtId = $_GET['mdcrtid'];
      } else {
      $mdcrtId = "not found";
      
      }
      $sqluserinfo = "SELECT medicalcertificate.*,  
      employeespersonalinfo.rfidNumber,
       employeespersonalinfo.*
      FROM 
          medicalcertificate  
      INNER JOIN 
          employeespersonalinfo 
     
      ON
          medicalcertificate.rfid  = employeespersonalinfo.rfidNumber WHERE medicalcertificate.consultationId = $mdcrtId ORDER BY
medicalcertificate.id ASC; ";
      $resultInfo = mysqli_query($con, $sqluserinfo);
      while($userRow = mysqli_fetch_assoc($resultInfo)){
        $treatedOn = $userRow['treatedOn'];
        $dueTo = $userRow['dueTo'];
        $diagnosis = $userRow['diagnosis'];
        $remarks = $userRow['remarks'];
        $Name = $userRow['Name'];
        $date = $userRow['date'];
        $date1 = strtotime($date);
$formatted_date = date('F d, Y', $date1);



$date2 = strtotime($treatedOn);
$formatted_date_treated_on = date('F d, Y', $date2);



      }
    $html ='<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Medical Certificate</title>
        <style>
        @page { margin: 15px; }
        body {
            border: 4px black solid;
        }
     
        table {
            width: 100%;
		}
        .underline{
             font-size: 12pt;
			border-bottom: 1px solid;
            
            padding: 0px;

        }
    </style>
    
       
    </head>
    <body>
    <div style="text-align: center;padding-block-start: 20px; padding-top: 10px">
    <p style="font-size: 15pt; margin: 0; font-weight: bold">GLORY (PHILIPPINES), INC.</p>
    <p style="font-size: 12pt; margin: 0; ">Business Address: Lot 1 and 3 Block 19 Phase 3    </p>
    <p style="font-size: 12pt; margin: 0; ">Cavite Economic Zone, Rosario, Cavite</p>
    <p style="font-size: 9pt; margin: 0; ">Contact Numbers: (046) 437-0501 / 0939923329</p>
    </div>
    <hr style="width:100%; height: 3px;  margin-bottom: 0px ">
    <div style="text-align: center;padding-block-start: 20px; padding-top: 10px">
    <p style="font-size: 16pt; margin: 0; font-weight: bold">Medical Certificate</p>
    </div>
    <div style="padding: 10px; ">
    <p style="font-size: 12pt; margin: 0; text-align: right; ">Date: '.$formatted_date.'</p>
    </div>
    <div style="padding: 10px; margin-bottom: 5px">
    <p style="font-size: 12pt; margin: 0; ">To whom it may concern,</p>
    </div>
    <div style="padding: 10px;">
    
    <table>
    <tr >
        <td style="width:45%">&nbsp;&nbsp;&nbsp; This is to certify that Mr./Ms. </td>
         <td style="width:50%" class="underline">'.$Name.'</td>
    </tr>
    </table>
    <table>

    <tr >
    <td style="width:38%" >was examined and treated on </td>
     <td  class="underline">&nbsp; ' .$formatted_date_treated_on.'</td>
     <td style="width:10%" > due to</td>
   

</tr>
</table>
<p style="font-size: 12pt; margin: 0; text-decoration: underline "> '.$dueTo.'.</p>

    </div>

    <div style="padding: 10px; margin-bottom: 5px">
    <p style="font-size: 12pt; margin: 0; ">Diagnosis: </p>
    <p style="font-size: 12pt; margin: 0; text-decoration: underline "> '.$diagnosis.'. </p>

    </div>
    <div style="padding: 10px; margin-bottom: 5px">
    <p style="font-size: 12pt; margin: 0; ">Remarks: </p>
    <p style="font-size: 12pt; margin: 0; text-decoration: underline ">'.$remarks.' .</p>

    </div>
    <div style="padding: 10px; margin-bottom: 5px">
    <p style="font-size: 12pt; margin: 0;    font-style: italic; ">Note: This certificate is issued upon request for whatever purpose it may serve
    except for medico-legal cases.
   </p>

    </div>

    <div style="padding: 10px; ">
    
    <table>
    <tr >
        <td style="width:50%"></td>
         <td style="width:50%; text-align: center" class="underline">John Alden C. Amores, MD, PCOM</td>
    </tr>
    </table>
    <table>
    <tr >
        <td style="width:50%"></td>
         <td style="width:50%; text-align: center" class="underline">Lic No. 126857</td>
    </tr>
    </table>

    </div>

    </body>
    </html>';   
    $dompdf = new Dompdf();

$dompdf->loadHtml($html);
$dompdf->setPaper('A5', 'portrait');
$dompdf->render();
$dompdf->stream('Medical Certificate.pdf', ['Attachment' => 0]);
?>

