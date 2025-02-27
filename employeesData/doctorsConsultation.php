<?php

if (isset($_GET['dcnsltn'])) {
  $dcnsltn = $_GET['dcnsltn'];
} else {
  $dcnsltn = "not found";
}
if (isset($_GET['rf'])) {
  $idNumber = $_GET['rf'];
} else {
  $idNumber = "not found";
}
$currentDate = date('Y-m-d');


$sqluserinfo = "SELECT consultation.*, employeespersonalinfo.Name, medicalcertificate.id as medcertID, medicalcertificate.idNumber as medcertRfid, medicalcertificate.consultationId, medicalcertificate.date as medcertDate, medicalcertificate.treatedOn, medicalcertificate.dueTo, medicalcertificate.diagnosis as medcertDiag, medicalcertificate.remarks as medcertRemarks,COALESCE(users.name, '') AS nurse_assisting_name
FROM consultation
INNER JOIN employeespersonalinfo ON consultation.idNumber = employeespersonalinfo.idNumber LEFT JOIN
                        medicalcertificate
                    ON
                        consultation.id = medicalcertificate.consultationId LEFT JOIN
                        users
                    ON
                        consultation.nurseAssisting = users.idNumber WHERE consultation.id = '$dcnsltn';";
                        // echo $sqluserinfo;
$resultInfo = mysqli_query($con, $sqluserinfo);
while ($userRow = mysqli_fetch_assoc($resultInfo)) {
  $nurse = $userRow['nurse_assisting_name'];

  $date = $userRow['date'];
  $time = $userRow['time'];
  $type = $userRow['type'];
  $building = $userRow['building'];
  $categories = $userRow['categories'];
  $chiefComplaint = $userRow['chiefComplaint'];
  $diagnosis = $userRow['diagnosis'];
  $intervention = $userRow['intervention'];
  $clinicRestFrom = $userRow['clinicRestFrom'];
  $clinicRestTo = $userRow['clinicRestTo'];
  $meds = $userRow['meds'];
  $medsQty = $userRow['medsQty'];
  $isMedcertRequired = $userRow['isMedcertRequired'];
  $timeOfFiling = $userRow['timeOfFiling'];




  $bloodChemistry = $userRow['bloodChemistry'];
  $cbc = $userRow['cbc'];
  $urinalysis = $userRow['urinalysis'];
  $fecalysis = $userRow['fecalysis'];
  $xray = $userRow['xray'];
  $others = $userRow['others'];
  $bp = $userRow['bp'];
  $temp = $userRow['temp'];
  $sat = $userRow['02sat'];
  $pr = $userRow['pr'];
  $rr = $userRow['rr'];
  $remarks = $userRow['remarks'];
  $isFitToWork = $userRow['isFitToWork'];
  $otherRemarks = $userRow['otherRemarks'];
  $statusComplete = $userRow['statusComplete'];
  $withPendingLab = $userRow['withPendingLab'];
  $Name = $userRow['Name'];
  $consultationId = $userRow['consultationId'];
  $medcertID = $userRow['medcertID'];


  
}


if (isset($_POST['submitDoctorsConsultation'])) {

  $finalDx = $_POST['finalDx'];
  $timeOfFiling = $_POST['timeOfFiling'];

  $briefMedicalHistory = $_POST['briefMedicalHistory'];
  $physicalExam = $_POST['physicalExam'];



  


  if (isset($_POST['ftwRemarks']) && !empty($_POST['ftwRemarks'])) {
    $remarksSelect = $_POST['ftwRemarks']; //
  }else{
    $remarksSelect='';
  }
  $medlab = $_POST['forLab']; 
  $forMed = $_POST['forMed'];


  if (isset($_POST['ftwRemarks']) && !empty($_POST['ftwRemarks'])) {
    $ftwRemarks = $_POST['ftwRemarks']; //
  }else{
    $ftwRemarks='';
  }

  
  if (isset($_POST['medicalCertificate']) && !empty($_POST['medicalCertificate'])) {
    $isMedcertRequired = $_POST['medicalCertificate']; //
  }else{
    $isMedcertRequired='';
  }

  
  if (isset($_POST['ftwDaysOfRest']) && !empty($_POST['ftwDaysOfRest'])) {
    $ftwDaysOfRest = $_POST['ftwDaysOfRest']; //
  }else{
    $ftwDaysOfRest='';
  }
 
 if (isset($_POST['ftwUnfitReason']) && !empty($_POST['ftwUnfitReason'])) {
  $ftwUnfitReason = $_POST['ftwUnfitReason']; //
}else{
  $ftwUnfitReason='';
}
  

 if ($ftwRemarks != "Unfit to work") {
  $ftwUnfitReason="";
  $ftwDaysOfRest="";
}


  // if ($remarksSelect == "Others") {
  //   $sql = "UPDATE `consultation` SET `status` = 'nurse2', `remarks` = '$remarksSelect', `finalDx`='$finalDx' WHERE `id` = '$dcnsltn'";
  //   $results = mysqli_query($con, $sql);
  // }
  $sql = "UPDATE `consultation` SET `status` = 'nurse2', `remarks` = '$remarksSelect', `finalDx`='$finalDx', `medicalLab` = '$medlab',`medicationDispense`='$forMed',`isFitToWork`='$ftwRemarks',`isMedcertRequired`='$isMedcertRequired',`timeOfFiling`='$timeOfFiling',`daysOfRest`='$ftwDaysOfRest',`reasonOfUnfitToWork`='$ftwUnfitReason',`ftwRemarks`='$ftwRemarks', `briefMedicalHistory`='$briefMedicalHistory', `physicalExams`='$physicalExam' WHERE `id` = '$dcnsltn'";
  $results = mysqli_query($con, $sql);
  if ($results) {
    echo "<script>alert('Record Updated Successfuly!') </script>";
    echo "<script> location.href='index.php'; </script>";
  }
}

// if(isset($_POST['generateMedCert'])){

//   $medcertdate = $_POST['medcertdate'];
//   $treatedOn = $_POST['treatedOn'];
//   $dueTo = $_POST['dueTo'];
//   $diagnosis = $_POST['diagnosis'];
//   $remarksMed = $_POST['remarksMed'];

//   $sql = "INSERT INTO `medicalcertificate`(`idNumber`, `consultationId`, `date`, `treatedOn`, `dueTo`, `diagnosis`, `remarks`) VALUES ('$idNumber','$dcnsltn','$medcertdate','$treatedOn','$dueTo','$diagnosis','$remarksMed')";
//   $results = mysqli_query($con,$sql);

// }

?>
<form action="" method="POST">
  <div class="relative ">
    <p class="mb-2 2xl:mb-5"><span class=" self-center text-[12px] 2xl:text-lg font-semibold whitespace-nowrap   text-[#193F9F]">Consultation</span></p>

    <div class="absolute top-0 right-0">

      <svg class="w-6 h-6  " xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1000" zoomAndPan="magnify" viewBox="0 0 750 749.999995" height="1000" preserveAspectRatio="xMidYMid meet" version="1.0">
        <defs>
          <clipPath id="e6f058db3b">
            <path d="M 45 63 L 685 63 L 685 701.445312 L 45 701.445312 Z M 45 63 " clip-rule="nonzero" />
          </clipPath>
        </defs>
        <g clip-path="url(#e6f058db3b)">
          <path fill="#b0bdc2" d="M 364.851562 701.667969 C 349.628906 701.667969 334.390625 700.570312 319.183594 698.375 C 276.882812 692.257812 236.742188 677.859375 199.875 655.574219 C 163.007812 633.292969 131.601562 604.445312 106.527344 569.832031 C 82.3125 536.410156 65.007812 499.0625 55.089844 458.824219 C 45.167969 418.585938 43.128906 377.472656 49.035156 336.628906 C 55.152344 294.324219 69.550781 254.1875 91.835938 217.320312 C 123.480469 164.972656 169.085938 123.078125 223.722656 96.175781 C 276.894531 69.992188 336.136719 59.074219 395.027344 64.605469 C 407.085938 65.734375 415.941406 76.425781 414.8125 88.488281 C 413.683594 100.546875 402.992188 109.410156 390.929688 108.269531 C 340.113281 103.5 288.996094 112.925781 243.097656 135.523438 C 195.992188 158.71875 156.667969 194.847656 129.367188 240.007812 C 110.132812 271.824219 97.710938 306.445312 92.4375 342.902344 C 87.347656 378.128906 89.105469 413.597656 97.667969 448.328125 C 106.230469 483.058594 121.160156 515.28125 142.039062 544.105469 C 163.652344 573.9375 190.742188 598.8125 222.558594 618.046875 C 254.375 637.277344 288.996094 649.699219 325.453125 654.972656 C 360.679688 660.0625 396.15625 658.304688 430.878906 649.742188 C 465.601562 641.179688 497.832031 626.25 526.65625 605.371094 C 556.488281 583.757812 581.363281 556.667969 600.59375 524.851562 C 622.910156 487.933594 635.980469 447.582031 639.441406 404.921875 C 642.746094 364.21875 636.777344 322.472656 622.1875 284.1875 C 617.875 272.871094 623.550781 260.203125 634.867188 255.882812 C 646.179688 251.570312 658.851562 257.25 663.167969 268.5625 C 680.070312 312.910156 686.980469 361.289062 683.15625 408.457031 C 681.199219 432.578125 676.472656 456.480469 669.101562 479.503906 C 661.527344 503.183594 651.101562 526.070312 638.132812 547.53125 C 615.847656 584.398438 587 615.804688 552.386719 640.878906 C 518.964844 665.09375 481.621094 682.394531 441.378906 692.316406 C 416.125 698.542969 390.511719 701.664062 364.851562 701.664062 Z M 364.851562 701.667969 " fill-opacity="1" fill-rule="nonzero" />
        </g>
        <path fill="#b0bdc2" d="M 285.675781 558.175781 C 274.546875 558.175781 263.621094 554.527344 254.652344 547.636719 C 243.011719 538.695312 235.789062 525.167969 234.839844 510.515625 L 230.867188 449.117188 C 229.941406 434.824219 234.113281 420.601562 242.605469 409.066406 L 488.039062 75.800781 C 504.691406 53.183594 536.648438 48.335938 559.269531 64.988281 L 630.148438 117.1875 C 641.109375 125.257812 648.265625 137.109375 650.308594 150.5625 C 652.351562 164.015625 649.03125 177.460938 640.960938 188.417969 L 396.0625 520.964844 C 387.039062 533.21875 373.839844 541.605469 358.917969 544.578125 L 295.632812 557.183594 C 292.328125 557.839844 288.996094 558.164062 285.683594 558.164062 Z M 529.0625 98.933594 C 526.882812 98.933594 524.730469 99.933594 523.347656 101.820312 L 277.914062 435.082031 C 275.535156 438.3125 274.371094 442.296875 274.628906 446.296875 L 278.601562 507.6875 C 278.78125 510.480469 280.40625 512.125 281.359375 512.855469 C 282.308594 513.585938 284.316406 514.730469 287.0625 514.183594 L 350.34375 501.582031 C 354.527344 500.75 358.21875 498.402344 360.742188 494.972656 L 605.644531 162.425781 C 607.160156 160.371094 607.109375 158.246094 606.945312 157.160156 C 606.78125 156.078125 606.199219 154.03125 604.136719 152.515625 L 533.257812 100.316406 C 531.996094 99.386719 530.523438 98.9375 529.0625 98.9375 Z M 529.0625 98.933594 " fill-opacity="1" fill-rule="nonzero" />
        <path fill="#b0bdc2" d="M 584.089844 241.300781 C 579.574219 241.300781 575.023438 239.910156 571.105469 237.027344 L 467.941406 161.054688 C 458.191406 153.871094 456.105469 140.144531 463.289062 130.394531 C 470.472656 120.640625 484.199219 118.558594 493.949219 125.738281 L 597.113281 201.710938 C 606.863281 208.894531 608.949219 222.621094 601.765625 232.371094 C 597.46875 238.210938 590.820312 241.300781 584.089844 241.300781 Z M 584.089844 241.300781 " fill-opacity="1" fill-rule="nonzero" />
      </svg>
    </div>
    <div class="text-[9px] 2xl:text-lg  rounded-lg bg-white/50 grid grid-cols-4 gap-1 w-full w-full p-4 ">
    <p class="col-span-4 mb-2 2xl:mb-5"><span class=" self-center text-[12px] 2xl:text-lg font-semibold whitespace-nowrap   text-[#193F9F]">Assisted by Nurse: <?php echo $nurse; ?></span></p>
      <div class="col-span-2">
        <label for="fromDate" class="block  my-auto font-semibold text-gray-900 ">Date: </label>

        <input type="date" value="<?php $formattedDate = date("Y-m-d", strtotime($date));
                                  echo $formattedDate; ?>" name="cnsltnClinicRestFrom" id="fromDate" class="bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " readonly>
      </div>
      <div class="col-span-2">
        <label for="currentTime" class="block  my-auto font-semibold text-gray-900 ">Time: </label>
        <!-- <h3 class="my-auto  font-semibold text-gray-900 ">Time: </h3> -->
        <input type="text" id="currentTime" name="currentTime" value="<?php echo $time; ?>" class="p-2 border rounded-md w-full focus:outline-none focus:border-blue-500" readonly>
      </div>
      <div class="col-span-2">
        <label for="categoriesSelect" class="block  my-auto font-semibold text-gray-900 ">Type: </label>

        <!-- <h3 class="my-auto  font-semibold text-gray-900 ">Type: </h3> -->
        <select id="categoriesSelect" class="bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " disabled>
          <option <?php if ($type == "Initial") {
                    echo "selected";
                  } ?> value="Initial">Initial</option>
          <option <?php if ($type == "Follow Up") {
                    echo "selected";
                  } ?> value="Follow Up">Follow Up</option>

        </select>

      </div>
      <div class="col-span-2">
        <label for="buildingSelect" class="block  my-auto font-semibold text-gray-900 ">Building: </label>

        <!-- <h3 class="my-auto  font-semibold text-gray-900 ">Building:</h3> -->
        <select id="buildingSelect" class="bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " disabled>
          <option <?php if ($building == "GPI 1") {
                    echo "selected";
                  } ?> value="GPI 1">GPI 1</option>
          <option <?php if ($building == "GPI 5") {
                    echo "selected";
                  } ?> value="GPI 5">GPI 5</option>
          <option <?php if ($building == "GPI 7") {
                    echo "selected";
                  } ?> value="GPI 7">GPI 7</option>
          <option <?php if ($building == "GPI 8") {
                    echo "selected";
                  } ?> value="GPI 8">GPI 8</option>
        </select>

      </div>


      <div class="col-span-2">
        <label for="categoriesSelect" class="block  my-auto font-semibold text-gray-900 ">Medical Category: </label>

        <!-- <h3 class="my-auto w-1/2 font-semibold text-gray-900 ">Medical Category:</h3> -->
        <select id="categoriesSelect" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " disabled>
          <option <?php if ($categories == "common") {
                    echo "selected";
                  } ?> value="common">Common</option>
          <option <?php if ($categories == "Long Term") {
                    echo "selected";
                  } ?> value="Long Term">Long Term</option>
          <option <?php if ($categories == "Maternity") {
                    echo "selected";
                  } ?> value="Maternity">Maternity</option>
          <option <?php if ($categories == "Work Related") {
                    echo "selected";
                  } ?> value="Work Related">Work Related</option>
        </select>

      </div>



      <div class="col-span-2">
        <h3 class=" my-auto w-full font-semibold text-gray-900 ">Chief Compliant: </h3>
        <input type="text" value="<?php echo $chiefComplaint; ?>" id="chiefCompliant" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
      </div>
      <!-- <div class="col-span-2">
            <h3 class=" my-auto  font-semibold text-gray-900 ">Diagnosis: </h3>
      <input type="text" value="<?php echo $diagnosis; ?>" id="" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">

            </div> -->
      <div class="col-span-4">
        <h3 class=" my-auto  font-semibold text-gray-900 ">Intervention: </h3>
        <select id="intervention" class="bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " disabled>
          <option <?php if ($intervention == "Medication Only") {
                    echo "selected";
                  } ?> value="Medication Only">Medication only</option>
          <option <?php if ($intervention == "Medical Consultation") {
                    echo "selected";
                  } ?> value="Medical Consultation">Medical Consultation</option>
          <option <?php if ($intervention == "Medication and Medical Consultation") {
                    echo "selected";
                  } ?> value="Medication and Medical Consultation">Medication and Medical Consultation</option>
          <option <?php if ($intervention == "Medication, Clinic Rest and Medical Consultation") {
                    echo "selected";
                  } ?> value="Medication, Clinic Rest and Medical Consultation">Medication, Clinic Rest and Medical Consultation</option>
          <option <?php if ($intervention == "Clinic Rest Only") {
                    echo "selected";
                  } ?> value="Clinic Rest Only">Clinic Rest Only</option>

        </select>
      </div>
      <div id="clinicrest" class="hidden content-center col-span-4">
        <h3 class=" my-auto font-semibold text-gray-900  ">Clinic Rest:</h3>
        <div class=" content-center flex gap-4 col-span-2">
          <div class="relative w-1/2">

            <input type="time" value="<?php echo $clinicRestFrom; ?>" name="cnsltnClinicRestFrom" id="fromDate" class="bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " readonly>
            <label for="fromDate" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]  px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">From</label>
          </div>
          <div class="relative w-1/2">

            <input type="time" value="<?php echo $clinicRestTo; ?>" name="cnsltnClinicRestTo" id="toDate" class="bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 " readonly>
            <label for="toDate" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]  px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">To</label>
          </div>
        </div>
      </div>

      <div class="col-span-4 gap-4  grid grid-cols-4">

        <div class="col-span-2">
          <label for="" class="block  my-auto font-semibold text-gray-900 ">Meds</label>

          <input type="text" value="<?php echo $meds; ?>" id="medsid" class="w-full bg-gray-50 border border-gray-300 text-gray-900   rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
        </div>
        <div class="col-span-2  gap-4 ">
          <div class="relative">
            <label for="" class="block  my-auto font-semibold text-gray-900 ">Quantity</label>

            <input type="number" id="medsqtyid" value="<?php echo $medsQty; ?>" name="cnsltnMedsQuantity" class=" w-full bg-gray-50 border border-gray-300 text-gray-900   rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
            <!-- <label for="medsqtyid" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]  px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Quantity</label> -->
          </div>
        </div>
      </div>


      <div class="col-span-4">
        <h3 class=" my-auto w-full font-semibold text-gray-900 ">Laboratory: </h3>
      </div>
      <div class="ml-4 grid grid-cols-4 col-span-4 gap-1">
        <div class="col-span-2">
          <h3 class="block   font-semibold text-gray-900 ">Blood Chemistry: </h3>
          <input type="text" value="<?php echo $bloodChemistry; ?>" id="" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
        </div>

        <div class="col-span-2">
          <h3 class="block   font-semibold text-gray-900 ">CBC: </h3>
          <input type="text" value="<?php echo $cbc; ?>" id="" class=" w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5" readonly>
        </div>

        <div class="col-span-2">
          <h3 class="block  my-auto font-semibold text-gray-900 ">Urinalysis: </h3>
          <input type="text" value="<?php echo $urinalysis; ?>" id="" class=" w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
        </div>

        <div class="col-span-2">
          <h3 class="my-auto  font-semibold text-gray-900 ">Fecalysis: </h3>
          <input type="text" id="" value="<?php echo $fecalysis; ?>" class=" w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
        </div>

        <div class="col-span-2">
          <h3 class="my-auto  font-semibold text-gray-900 ">X-ray: </h3>
          <input type="text" id="" value="<?php echo $xray; ?>" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
        </div>

        <div class="col-span-2">
          <h3 class=" my-auto  font-semibold text-gray-900 ">Others: </h3>
          <input type="text" id="" value="<?php echo $others; ?>" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
        </div>

        <div class="col-span-1">
          <h3 class="w-full my-auto  font-semibold text-gray-900 "></h3>
        </div>

        <div class="col-span-4">
          <h3 class=" my-auto w-full font-semibold text-gray-900 ">Vital Signs: </h3>
        </div>
        <div class="flex col-span-4">
          <div class="grid grid-cols-3 gap-1 w-full">
            <div class="">
              <h3 class=" block my-auto  font-semibold text-gray-900 ">BP: </h3>
              <input type="text" id="" value="<?php echo $bp; ?>" class="  bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
            </div>
            <div class="">
              <h3 class="block my-auto  font-semibold text-gray-900 ">Temp: </h3>
              <input type="text" id="" value="<?php echo $temp; ?>" class="  bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
            </div>
            <div class="">
              <h3 class="block my-auto  font-semibold text-gray-900 ">02 Sat: </h3>
              <input type="text" id="" value="<?php echo $sat; ?>" class="  bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
            </div>
            <div class="">
              <h3 class="block my-auto  font-semibold text-gray-900 ">PR: </h3>
              <input type="text" id="" value="<?php echo $pr; ?>" class="  bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
            </div>
            <div class="">
              <h3 class="block my-auto  font-semibold text-gray-900 ">RR: </h3>
              <input type="text" id="" value="<?php echo $rr; ?>" class="  bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
            </div>

          </div>

        </div>

      </div>
      <div class="col-span-4 <?php if($isFitToWork=="" || $isFitToWork==NULL ){ echo "hidden"; } ?>"  >
      <div class="col-span-4 " >
        <label class="block  my-auto  font-semibold text-gray-900 ">Fit to Work or Unfit to Work: </label>
        <select <?php if($isFitToWork=="" || $isFitToWork==NULL ){ echo "disabled"; } ?> id="remarksSelect" name="ftwRemarks" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
          <option <?php if ($remarks == "Fit to Work") {
                    echo "selected";
                  } ?> value="Fit to Work">Fit To Work</option>
                 
          <option <?php if ($remarks == "Unfit to work") {
                    echo "selected";
                  } ?> value="Unfit to work">Unfit to work</option>
        </select>



      </div>
      
      <div class="col-span-4" >
      <h3 class=" font-semibold text-gray-900 dark:text-white">Time of Filing</h3>
      <ul class="gap-2 items-center w-full text-[12px] 2xl:text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
      <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
        <div class=" gap-2 flex items-center ps-3">
            <input <?php if($timeOfFiling=="On Time"){ echo "checked";} ?>  id="horizontal-timeOfFiling-id" type="radio" checked value="On Time" name="timeOfFiling" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
            <label for="horizontal-timeOfFiling-id" class="w-full py-3 ms-2 text-[12px] 2xl:text-sm font-medium text-gray-900 dark:text-gray-300">On Time</label>
        </div>
    </li>

    <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
        <div class="gap-2 flex items-center ps-3">
            <input <?php if($timeOfFiling=="Late Filing"){ echo "checked";} ?>  id="horizontal-timeOfFiling-license" type="radio" value="Late Filing" name="timeOfFiling" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
            <label for="horizontal-timeOfFiling-license" class="w-full py-3 ms-2 text-[12px] 2xl:text-sm font-medium text-gray-900 dark:text-gray-300">Late</label>
        </div>
    </li>
   
    

</ul>
      </div>

      <div class="col-span-4" id="fitToWorkFields">
      <h3 class=" font-semibold text-gray-900 dark:text-white">Medical Certificate</h3>
      <ul  class="gap-2 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
      <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
        <div class=" gap-2 flex items-center ps-3">
            <input <?php if($isMedcertRequired=="noNeed"){ echo "checked";} if($isFitToWork=="" || $isFitToWork==NULL ){ echo "disabled"; } ?> id="horizontal-medicalCertificate-id" type="radio"  value="noNeed" name="medicalCertificate" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
            <label for="horizontal-medicalCertificate-id" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Not Required</label>
        </div>
    </li>

    <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
        <div class="gap-2 flex items-center ps-3">
            <input <?php if($isMedcertRequired=="withMedCert"){ echo "checked";} if($isFitToWork=="" || $isFitToWork==NULL ){ echo "disabled"; } ?> id="horizontal-medicalCertificate-license" type="radio" value="withMedCert" name="medicalCertificate" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
            <label for="horizontal-medicalCertificate-license" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">MedCert Provided</label>
        </div>
    </li>
    <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
        <div class=" gap-2 flex items-center ps-3">
            <input <?php if($isMedcertRequired=="noMedCert"){ echo "checked";} if($isFitToWork=="" || $isFitToWork==NULL ){ echo "disabled"; } ?> id="horizontal-medicalCertificate-noMedcert" type="radio" value="noMedCert" name="medicalCertificate" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
            <label for="horizontal-medicalCertificate-noMedcert" class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">MedCert Not Provided</label>
        </div>
    </li>
    <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
        <div class=" gap-2 flex items-center ps-3">
            <input <?php if($isMedcertRequired=="invalidMedCert"){ echo "checked";} if($isFitToWork=="" || $isFitToWork==NULL ){ echo "disabled"; } ?> id="horizontal-medicalCertificate-invalidMedCert" type="radio" value="invalidMedCert" name="medicalCertificate" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
            <label for="horizontal-medicalCertificate-invalidMedCert" class="w-full py-3 ms-2 text-[12px] 2xl:text-sm font-medium text-gray-900 dark:text-gray-300">Invalid Medcert</label>
        </div>
    </li>
    

</ul>
      </div>

      <div class="content-center col-span-2" id="restDays">
<label class=" block my-auto font-semibold text-gray-900 ">Days of rest</label>
<input <?php if($isFitToWork=="" || $isFitToWork==NULL ){ echo "disabled"; } ?> type="number"  name="ftwDaysOfRest" class="w-full bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">

</div>
<div class="content-center col-span-2" id="unfitReason">
<label class=" block my-auto font-semibold text-gray-900 ">Reason</label>
<input <?php if($isFitToWork=="" || $isFitToWork==NULL ){ echo "disabled"; } ?> type="text"  name="ftwUnfitReason" class="w-full bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                </div>
      </div>
      <div id="othersInput" class="col-span-4 hidden  gap-4">
        <h3 class=" my-auto  font-semibold text-gray-900 ">Others: </h3>
        <input type="text" name="othersInput" class="  bg-gray-50 border border-gray-300 text-gray-900  w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
      </div>

      <div id="forLab" class="col-span-4   gap-4">
        <h3 class=" my-auto  font-semibold text-gray-900 ">For Medical Laboratory: </h3>
        <input type="text" name="forLab" class="  bg-gray-50 border border-gray-300 text-gray-900  w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
      </div>

      <div id="forMed" class="col-span-4   gap-4">
        <h3 class=" my-auto  font-semibold text-gray-900 ">For Medication Dispense: </h3>
        <input type="text" name="forMed" class="  bg-gray-50 border border-gray-300 text-gray-900  w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
      </div>
      <div class="col-span-4  gap-4">
        <h3 class=" my-auto  font-semibold text-gray-900 ">Nurse Notes: </h3>
        <input type="text" value="<?php echo $otherRemarks; ?>" id="" class="  bg-gray-50 border border-gray-300 text-gray-900  w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " readonly>
      </div>

      <div class="col-span-4  gap-4">
        <h3 class=" my-auto  font-semibold text-gray-900 ">Brief Medical History</h3>
        <textarea  rows="3" name="briefMedicalHistory" class="block p-2.5 w-full text-[12px] text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="briefMedicalHistory"></textarea>
      </div>
      <div class="col-span-4  gap-4">
        <h3 class=" my-auto  font-semibold text-gray-900 ">Physical Examination</h3>
        <textarea  rows="3" name="physicalExam" class="block p-2.5 w-full text-[12px] text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="physicalExam"></textarea>
      </div>

      <div class="col-span-4  gap-4">
        <h3 class=" my-auto  font-semibold text-gray-900 ">Final Dx: </h3>
        <input type="text" name="finalDx" id="finalDx" class="  bg-gray-50 border border-gray-300 text-gray-900 text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 " required>
      </div>
      <div class="col-span-4 flex gap-4">
        <h3 class=" my-auto  font-semibold text-gray-900 ">Medical Certificate: </h3>
        
<?php
if($medcertID== NULL || $medcertID==''){
?>
<button onclick="openModalMedCert();" id="generateMedcert" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
          Generate
        </button>
<?php
}
else{
// echo $medcertID;

?>
        <a href='../medicalCertificate.php?rf=<?php echo $idNumber; ?>&mdcrtid=<?php echo $dcnsltn; ?>' target='_blank' id="viewmedcert" class=' text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800'>View Medcert</a>

<?php
}
?>
        <a href='../medicalCertificate.php?rf=<?php echo $idNumber; ?>&mdcrtid=<?php echo $dcnsltn; ?>' target='_blank' id="viewmedcert" class='hidden text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800'>View Medcert</a>

      </div>
      <div class="col-span-4 gap-4 justify-center flex h-14">
        <button type="submit" name="submitDoctorsConsultation" class="text-center inline-flex items-center text-white bg-gradient-to-r from-[#00669B]  to-[#9AC1CA] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300  shadow-lg shadow-teal-500/50  font-medium rounded-lg text-[9px] 2xl:text-xl px-5 py-1 text-center me-2 mb-2">
          <?php require_once '../src/navBarIcons/proceed.svg' ?>

          Proceed</button>
        <button type="button" data-modal-target="medcert" data-modal-toggle="medcert" class="hidden text-center inline-flex items-center text-white bg-gradient-to-r from-[#115400]  to-[#9AC1CA] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300  shadow-lg shadow-teal-500/50  font-medium rounded-lg text-[9px] 2xl:text-xl px-5 py-1 text-center me-2 mb-2">
          <?php require_once '../src/navBarIcons/medcert.svg' ?>
          Med Cert</button>

      </div>

    </div>


  </div>

</form>

<div id="medcert" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative py-4 w-full max-w-4xl max-h-full">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
      <!-- Modal header -->
      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
        <h3 class="font-semibold text-gray-900 dark:text-white">
          Create Medical Certificate
        </h3>
        <button type="button" onclick="modalmedcert.toggle();" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-[12px] w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" >
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <!-- Modal body -->
      <form class="p-4 md:p-5" action="#">
        <div class="grid gap-4 mb-4 grid-cols-2">

          <div class="col-span-2 sm:col-span-1">
            <label for="medcertname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
            <input type="text" value="<?php echo $Name; ?>" name="medcertname" id="medcertname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Patient Name">
          </div>
          <div class="col-span-2 sm:col-span-1">
            <label for="medcertdate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
            <input type="date" name="medcertdate" value="<?php echo $currentDate; ?>" id="medcertdate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">

          </div>

          <div class="col-span-2">
            <label for="treatedOn" class="block mb-2 text-[12px] font-medium text-gray-900 dark:text-white">Was examined and treated on</label>
            <!-- <textarea id="treatedOn" name="treatedOn" rows="1" class="block p-2.5 w-full text-[12px] text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" ></textarea>                     -->
            <input type="date" name="treatedOn" value="<?php echo $currentDate; ?>" id="treatedOn" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">

          </div>
          <div class="col-span-2">
            <label for="dueTo" class="block mb-2 text-[12px] font-medium text-gray-900 dark:text-white">due to</label>
            <textarea id="dueTo" name="dueTo" rows="1" class="block p-2.5 w-full text-[12px] text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
          </div>
          <div class="col-span-2">
            <label for="diagnosis" class="block mb-2 text-[12px] font-medium text-gray-900 dark:text-white">Diagnosis: </label>
            <textarea id="diagnosis" name="diagnosis" rows="1" class="block p-2.5 w-full text-[12px] text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
          </div>
          <div class="col-span-2">
            <label for="remarksMed" class="block mb-2 text-[12px] font-medium text-gray-900 dark:text-white">Remarks: </label>
            <textarea id="remarksMed" name="remarksMed" rows="1" class="block p-2.5 w-full text-[12px] text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
          </div>
        </div>
        <button type="button" onclick="generateMedCert()" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          Generate Med Cert
        </button>
      </form>
    </div>
  </div>
</div>


<script>


const $tagetmedcertModal = document.getElementById('medcert');
  const optionsmedcertModal = {
    placement: 'center-center',
    backdrop: 'static',
    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
    closable: true,
    onHide: () => {
    },
    onShow: () => {

    },
    onToggle: () => {
    }
  };
  const modalmedcert = new Modal($tagetmedcertModal, optionsmedcertModal);

function openModalMedCert(){
  var chiefCompliant = document.getElementById("chiefCompliant").value;
  document.getElementById("dueTo").value=chiefCompliant;
  
  var finalDx = document.getElementById("finalDx").value;
  document.getElementById("diagnosis").value=finalDx;


  modalmedcert.toggle();
}
  

  
  function generateMedCert() {
    // console.log("lkasdhf");

    var url = new URL(window.location.href);

    var rfValue = url.searchParams.get("rf");
    var dcnsltnValue = url.searchParams.get("dcnsltn");
    var medcertdate = document.getElementById("medcertdate").value;
    var treatedOn = document.getElementById("treatedOn").value;
    var dueTo = document.getElementById("dueTo").value;
    var diagnosis = document.getElementById("diagnosis").value;
    var remarksMed = document.getElementById("remarksMed").value;

    console.log(rfValue, dcnsltnValue, medcertdate, treatedOn, dueTo, diagnosis, remarksMed)




    var generateMedicalCert = new XMLHttpRequest();
    generateMedicalCert.open("POST", "generateMedicalCert.php", true);
    generateMedicalCert.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    generateMedicalCert.onreadystatechange = function() {
      if (generateMedicalCert.readyState === XMLHttpRequest.DONE) {
        if (generateMedicalCert.status === 200) {
          // Update was successful
          console.log(generateMedicalCert);
          alert("Medcert Generated")
          modalmedcert.toggle();


        } else {
          console.log("Error: " + generateMedicalCert.status);
        }
      }
    };

    // Construct the data to be updated
    var data = "rfValue=" + encodeURIComponent(rfValue);
    data += "&dcnsltnValue=" + encodeURIComponent(dcnsltnValue);
    data += "&medcertdate=" + encodeURIComponent(medcertdate);
    data += "&treatedOn=" + encodeURIComponent(treatedOn);
    data += "&dueTo=" + encodeURIComponent(dueTo);
    data += "&diagnosis=" + encodeURIComponent(diagnosis);
    data += "&remarksMed=" + encodeURIComponent(remarksMed);



    // Add any other parameters needed for the update

    generateMedicalCert.send(data);


    var divElement = document.getElementById('generateMedcert');

    // Remove the class from the div
    divElement.classList.add('hidden');

    var divElement2 = document.getElementById('viewmedcert');

    // Remove the class from the div
    divElement2.classList.remove('hidden');

  }
</script>