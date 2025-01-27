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

$sqluserinfo = "SELECT * from consultation WHERE id = '$dcnsltn';";
$resultInfo = mysqli_query($con, $sqluserinfo);
while ($userRow = mysqli_fetch_assoc($resultInfo)) {
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
  // echo $remarks;
  $otherRemarks = $userRow['otherRemarks'];
  $finalDx = $userRow['finalDx'];


  $medicalLab = $userRow['medicalLab'];
  $medicationDispense = $userRow['medicationDispense'];


  $statusComplete = $userRow['statusComplete'];
  $withPendingLab = $userRow['withPendingLab'];

  $havemedCert = $userRow['havemedCert'];

}


if (isset($_POST['updateConsultation'])) {

  $cnsltnDate = $_POST['cnsltnDate'];
  $cnsltnTime = $_POST['currentTime'];
  $cnsltnType = $_POST['cnsltnType'];




  $cnsltnCategories = $_POST['cnsltnCategories'];
  $cnsltnBuilding = $_POST['cnsltnBuilding'];
  $cnsltnChiefComplaint = $_POST['cnsltnChiefComplaint'];
  $cnsltnDiagnosis = $_POST['cnsltnDiagnosis'];
  $cnsltnIntervention = $_POST['cnsltnIntervention'];
  $cnsltnClinicRestFrom = $_POST['cnsltnClinicRestFrom'];
  $cnsltnClinicRestTo = $_POST['cnsltnClinicRestTo'];
  $cnsltnMeds = $_POST['cnsltnMeds'];


  if ($cnsltnMeds != "") {

    $cnsltnMeds = implode(', ', $cnsltnMeds);
  }

  $cnsltnMedsQuantity = $_POST['cnsltnMedsQuantity'];

  $cnsltnBloodChem = $_POST['cnsltnBloodChem'];
  $cnsltnCbc = $_POST['cnsltnCbc'];
  $cnsltnUrinalysis = $_POST['cnsltnUrinalysis'];
  $cnsltnFecalysis = $_POST['cnsltnFecalysis'];
  $cnsltnXray = $_POST['cnsltnXray'];
  $cnsltnOthersLab = $_POST['cnsltnOthersLab'];
  $cnsltnBp = $_POST['cnsltnBp'];
  $cnsltnTemp = $_POST['cnsltnTemp'];
  $cnsltn02Sat = $_POST['cnsltn02Sat'];
  $cnsltnPr = $_POST['cnsltnPr'];
  $cnsltnRr = $_POST['cnsltnRr'];
  $cnsltnRemarks = $_POST['cnsltnRemarks'];
  $cnsltnOthersRemarks = $_POST['cnsltnOthersRemarks'];
  $cnstltnmedLab = $_POST['medLab'];
  $cnstltnmedDis= $_POST['medDis'];

  
  $cnsltnCompleted = isset($_POST['cnsltnCompleted']) ? $_POST['cnsltnCompleted'] : "0";
  $cnsltnWithPendingLab = $_POST['cnsltnWithPendingLab'];

  if($cnsltnCompleted==1){
    $cnsltnWithPendingLab='';
  }
  // echo $smoking;
  $sql = "UPDATE `consultation` SET `type`='$cnsltnType',`categories`='$cnsltnCategories',`building`='$cnsltnBuilding',`chiefComplaint`='$cnsltnChiefComplaint',`diagnosis`='$cnsltnDiagnosis',`intervention`='$cnsltnIntervention',`clinicRestFrom`='$cnsltnClinicRestFrom',`clinicRestTo`='$cnsltnClinicRestTo',`meds`='$cnsltnMeds',`medsQty`='$cnsltnMedsQuantity',`bloodChemistry`='$cnsltnBloodChem',`cbc`='$cnsltnCbc',`urinalysis`='$cnsltnUrinalysis',`fecalysis`='$cnsltnFecalysis',`xray`='$cnsltnXray',`others`='$cnsltnOthersLab',`bp`='$cnsltnBp',`temp`='$cnsltnTemp',`02sat`='$cnsltn02Sat',`pr`='$cnsltnPr',`rr`='$cnsltnRr',`remarks`='$cnsltnRemarks',`medicalLab`='$cnstltnmedLab',`medicationDispense`='$cnstltnmedDis',`otherRemarks`='$cnsltnOthersRemarks',`statusComplete`='$cnsltnCompleted',`withPendingLab`='$cnsltnWithPendingLab' WHERE `id` = '$dcnsltn'";
   
  
   $results = mysqli_query($con, $sql);

  if ($results) {
    echo "<script>alert('Successfull') </script>";
    echo "<script> location.href='pendingConsultation.php?rf=",$idNumber,"&dcnsltn=",$dcnsltn,"'; </script>";
  }
}


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

      <div class="col-span-2">
      <label for="medcertdate" class="block  my-auto font-semibold text-gray-900 ">Date: </label>
      <input type="date" name="cnsltnDate" value="<?php echo $date; ?>" id="medcertdate" class="bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ">
      </div>
      <div class=" gap-4 col-span-2">
        <h3 class="my-auto  font-semibold text-gray-900 ">Time: </h3>
        <input type="text" id="currentTime" name="currentTime" value="<?php echo $time; ?>" class="bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ">
      </div>
      <div class=" gap-4  col-span-2">

        <h3 class="my-auto  font-semibold text-gray-900 ">Type: </h3>
        <select id="categoriesSelect" name="cnsltnType" class="bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
          <option <?php if ($type == "Initial") {
                    echo "selected";
                  } ?> value="Initial">Initial</option>
          <option <?php if ($type == "Follow Up") {
                    echo "selected";
                  } ?> value="Follow Up">Follow Up</option>

        </select>

      </div>
      <div class=" gap-4  col-span-2">

        <h3 class="my-auto  font-semibold text-gray-900 ">Building:</h3>
        <select id="categoriesSelect" name="cnsltnBuilding" class="bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
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


      <div class=" gap-4  col-span-4">

        <h3 class="my-auto w-1/2 font-semibold text-gray-900 ">Medical Category:</h3>
        <select id="categoriesSelect" name="cnsltnCategories" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
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



      <div class=" gap-4 col-span-2">
        <h3 class=" my-auto w-full font-semibold text-gray-900 ">Chief Compliant: </h3>
        <input type="text" name="cnsltnChiefComplaint" value="<?php echo $chiefComplaint; ?>"  class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
      </div>
      <div class="col-span-2">
        <label class="block  my-auto font-semibold text-gray-900 ">Diagnosis: </label>
        <!-- <input type="text"  name="cnsltnDiagnosis" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 "> -->
        <select id="ftwDiagnosiOption" name="cnsltnDiagnosis" class="bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
          <option  disabled>Select Diagnosis</option>
          <option value="addDiagnosisButton">Add Diagnosis</option>
          <?php
          $sql1 = "Select * FROM `diagnosis`";
          $result = mysqli_query($con, $sql1);
          while ($list = mysqli_fetch_assoc($result)) {
            $diagnosis1 = $list["diagnosisName"];
          ?>
            <option <?php if ($diagnosis == $diagnosis1) {
                      echo "selected";
                    } ?> value=<?php echo $diagnosis1; ?>><?php echo $diagnosis1; ?></option>
          <?php

            //  echo "<option value='$diagnosis' >$diagnosis</option>";

          }
          ?>

        </select>








        <div id="addDiagnosis" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
          <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                  Add Diagnosis
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="addDiagnosis">
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                  </svg>
                  <span class="sr-only">Close modal</span>
                </button>
              </div>
              <!-- Modal body -->
              <div class="p-4 md:p-5">
                <form class="space-y-4" action="#">
                  <div>

                    <input type="text" name="diagnosis" id="diagnosis" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
                  </div>


                  <button type="button" onclick="addDiagnosis()" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add</button>

                </form>
              </div>
            </div>
          </div>
        </div>







      </div>
      <div class="col-span-4  gap-4">
      <label class="block  my-auto font-semibold text-gray-900 ">Intervention: </label>
        <select id="interventionSelect" name="cnsltnIntervention" class="bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
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

          <option  <?php if ($intervention == "Clinic Rest Only") {
                    echo "selected";
                  } ?> value="Clinic Rest Only">Clinic Rest Only</option>
        </select>
      </div>
      
      <div id="clinicRestTime" class="hidden col-span-4">
        <label class="block  my-auto font-semibold text-gray-900 ">Clinic Rest: </label>
        <div class=" content-center flex gap-4 col-span-2">

          <div class="relative w-1/2">
            <input type="time" name="cnsltnClinicRestFrom"value="<?php echo $clinicRestFrom ?>"  id="fromDate" class="bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ">
            <label for="fromDate" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]  px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">From</label>
          </div>

          <div class="relative w-1/2">

            <input type="time" name="cnsltnClinicRestTo"  value="<?php echo $clinicRestTo ?>" id="toDate" class="bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 ">
            <label for="toDate" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0]  px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">To</label>
          </div>

        </div>
      </div>
      <!-- <div class="content-center  gap-4 col-span-1">
        <h3 class="w-full my-auto font-semibold text-gray-900 ">Clinic Rest:</h3>

      </div> -->


      <!-- <div class="content-center  gap-2 2xl:gap-4 col-span-3">
        <div class="relative w-full">
          <div class="w-1/2 2xl:w-1/6 absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="mx-2 w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
            </svg>
          </div>
          <input datepicker datepicker-autohide value="<?php echo $clinicRestFrom ?>" type="text" class="h-full pl-6 2xl:pl-12 bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-0 2xl:p-2.5  " placeholder="From">
        </div>
        <div class="relative w-full">
          <div class="w-1/2 2xl:w-1/6 absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="mx-2 w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
            </svg>
          </div>
          <input datepicker datepicker-autohide value="<?php echo $clinicRestTo ?>" type="text" class="h-full pl-6 2xl:pl-12 bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-0 2xl:p-2.5  " placeholder="To">
        </div>

        <h3 class=" my-auto font-semibold text-gray-900 ">Meds</h3>
        <input type="text" value="<?php echo $meds; ?>"  class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">

      </div> -->
      <div class="col-span-4">

<label class="block  my-auto font-semibold text-gray-900 ">Medicine (Add medicine below): </label>
<select name="cnsltnMeds[]" id="cnsltnMeds" multiple="multiple" class="form-control js-meds w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
  <?php
  // echo $ftwMeds;
  // Split the string into an array using the comma as the delimiter
  if ($meds != "") {
    $medicines = explode(", ", $meds);

    $options = "";
    foreach ($medicines as $medicine) {
      // Add the whitespace before the value to match the desired output
      $options .= '<option selected value="' . $medicine . '">' . $medicine . '</option>' . PHP_EOL;
    }

    echo $options;
  }

  ?>

  <?php

  ?>

</select>
<!-- <input type="text"  name="cnsltnMeds"  disabled value="<?php echo $ftwAbsenceReason ?>" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 "> -->
</div>

<div id="medicineDiv" class="grid grid-cols-4 gap-1 col-span-4 mt-2">
<div id="medicineDiv1" class="grid grid-cols-4 gap-1 col-span-4">
  <div id="medsdiv" class="col-span-2">
    <label class="block  my-auto font-semibold text-gray-900 ">What's your medicine? </label>
    <select id="nameOfMedicine" class="bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
  <option disabled>Select Medicine</option>
  <option value="addMedicineButton">Add Medicine</option>
  <?php
  $sql1 = "Select * FROM `medicine`";
  $result = mysqli_query($con, $sql1);
  while ($list = mysqli_fetch_assoc($result)) {
    $medicine = $list["medicineName"];
  ?>
    <option  value=<?php echo $medicine; ?>><?php echo $medicine; ?></option>
  <?php

    //  echo "<option value='$diagnosis' >$diagnosis</option>";

  }
  ?>

</select>

<div id="addMedicine" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative w-full max-w-md max-h-full">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
      <!-- Modal header -->
      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
          Add Medicine
        </h3>
        <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="addMedicine">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <!-- Modal body -->
      <div class="p-4 md:p-5">
        <form class="space-y-4" action="#">
          <div>

            <input type="text" name="medicine" id="medicine" class="mb-4 bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" />
          </div>


          <button type="button" onclick="addMedicine()" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add</button>

        </form>
      </div>
    </div>
  </div>
</div>



    <!-- <input type="text" id="nameOfMedicine" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 "> -->

  </div>

  <div id="medsqtydiv" class=" col-span-2">
    <div class="w-full">
      <label class="block  my-auto font-semibold text-gray-900 ">Choose quantity:</label>
      <div class="flex relative ">
        <div class="relative flex items-center max-w-[8rem]">
          <button type="button" id="decrement-button" data-input-counter-decrement="quantityMeds" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-9 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
            </svg>
          </button>
          <input type="text" name="cnsltnMedsQuantity" id="quantityMeds" data-input-counter data-input-counter-min="1" data-input-counter-max="50" aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-9 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="999" value="1" required />
          <button type="button" id="increment-button" data-input-counter-increment="quantityMeds" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-9 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
            <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
            </svg>
          </button>

        </div>

        <button type="button" id="addmedsbtn" onclick="addSelectedValue(document.getElementById('nameOfMedicine').value, document.getElementById('quantityMeds').value)" class="ml-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg  p-2 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> Add to list
        </button>
      </div>


    </div>
    <!-- <input type="number"  name="cnsltnMedsQuantity" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 "> -->


  </div>
</div>

</div>
      <div class="col-span-1">
        <h3 class=" my-auto w-full font-semibold text-gray-900 ">Laboratory: </h3>
      </div>
      <div class="ml-4 grid grid-cols-4 col-span-4 gap-1">
      <div class="col-span-2">
        <h3 class="block  my-auto  font-semibold text-gray-900 ">Blood Chemistry: </h3>
        <input type="text" name="cnsltnBloodChem" value="<?php echo $bloodChemistry; ?>"  class=" w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
      </div>
      <div class="col-span-2">
        <h3 class="block  my-auto  font-semibold text-gray-900 ">CBC: </h3>
        <input type="text" name="cnsltnCbc" value="<?php echo $cbc; ?>"  class=" w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
      </div>

      <div class=" col-span-2">
        <h3 class="block  my-auto  font-semibold text-gray-900 ">Urinalysis: </h3>
        <input type="text" name="cnsltnUrinalysis" value="<?php echo $urinalysis; ?>"  class=" w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
      </div>

      <div class="col-span-2">
        <h3 class="block my-auto  font-semibold text-gray-900 ">Fecalysis: </h3>
        <input type="text" name="cnsltnFecalysis"  value="<?php echo $fecalysis; ?>" class=" w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
      </div>
      <div class=" col-span-2">
        <h3 class=" block my-auto  font-semibold text-gray-900 ">X-ray: </h3>
        <input type="text" name="cnsltnXray"  value="<?php echo $xray; ?>" class=" w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
      </div>

      <div class=" gap-4 col-span-2">
        <h3 class="block my-auto  font-semibold text-gray-900 ">Others: </h3>
        <input type="text" name="cnsltnOthersLab"  value="<?php echo $others; ?>" class=" w-full bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
      </div>

      <div class="col-span-4">
          <h3 class=" my-auto w-full font-semibold text-gray-900 ">Vital Signs: </h3>
        </div>

        <div class="col-span-4">
       
       <div class="grid grid-cols-3 gap-1">
         <div class="">
           <h3 class="block my-auto  font-semibold text-gray-900 ">BP: </h3>
           <input type="text" name="cnsltnBp" value="<?php echo $bp; ?>" class="  bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
         </div>
         <div class="">
           <h3 class="block my-auto  font-semibold text-gray-900 ">Temp: </h3>
           <input type="text" name="cnsltnTemp" value="<?php echo $temp; ?>" class="  bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
         </div>
         <div class="">
           <h3 class="block my-auto  font-semibold text-gray-900 ">02 Sat: </h3>
           <input type="text" name="cnsltn02Sat"  value="<?php echo $sat; ?>" class="  bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
         </div>
         <div class="">
           <h3 class="block my-auto  font-semibold text-gray-900 ">PR: </h3>
           <input type="text" name="cnsltnPr"  value="<?php echo $pr; ?>" class="  bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
         </div>
         <div class="">
           <h3 class="block my-auto  font-semibold text-gray-900 ">RR: </h3>
           <input type="text" name="cnsltnRr"  value="<?php echo $rr; ?>" class="  bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
         </div>

       </div>


     </div>
      </div>
    
     
      <div class="col-span-4 gap-4">
        <h3 class=" block my-auto  font-semibold text-gray-900 ">Remarks: <?php //echo $remarks; ?> </h3>
        <select id="remarksSelect2" name="cnsltnRemarks" class="bg-gray-50 border border-gray-300 text-gray-900 text-[10px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
          <option <?php if ($remarks == "Fit to Work") {
                    echo "selected";
                  } ?> value="Fit to Work">Fit To Work</option>
          <option <?php if ($remarks == "Late FTW") {
                    echo "selected";
                  } ?> value="Late FTW">Late FTW</option>
          <option <?php if ($remarks == "No Medical Certificate") {
                    echo "selected";
                  } ?> value="No Medical Certificate">No Medical Certificate</option>
          <option <?php if ($remarks == "For Medical Laboratory") {
                    echo "selected";
                  } ?> value="For Medical Laboratory">For Medical Laboratory</option>
          <option <?php if ($remarks == "For Medication Dispense") {
                    echo "selected";
                  } ?> value="For Medication Dispense">For Medication Dispense</option>
          <option <?php if ($remarks == "Others") {
                    echo "selected";
                  } ?> value="Others">Others</option>
        </select>
        <input type="text" name="medLab" value="<?php echo $medicalLab ?>" placeholder="Medical Laboratory" id="medLab" class="hidden  bg-gray-50 border border-gray-300 text-gray-900 text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
        <input type="text" name="medDis" value="<?php echo $medicationDispense ?>" placeholder="Medication Dispense" id="medDis" class="hidden  bg-gray-50 border border-gray-300 text-gray-900 text-sm w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">

      </div>
      <div class="col-span-4  gap-4">
        <h3 class="  block my-auto  font-semibold text-gray-900 ">Others: </h3>
        <input type="text" value="<?php echo $otherRemarks; ?>" name="cnsltnOthersRemarks"  class="  bg-gray-50 border border-gray-300 text-gray-900  w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
      </div>
      <div class="col-span-4  gap-4">
        <h3 class="  block my-auto  font-semibold text-gray-900 ">Final Dx: </h3>
        <input disabled type="text" name="finalDx" value="<?php echo $finalDx; ?>"  class="  bg-gray-50 border border-gray-300 text-gray-900  w-full rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
      </div>
      <div class=" col-span-4  gap-4">

        <h3 class=" block my-auto font-semibold text-gray-900 ">Status</h3>
        <ul class="col-span-2 items-center w-full text-[10px] 2xl:text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex  ">
          <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
            <div class="gap-2 flex items-center ps-3">
              <input  <?php if ($statusComplete == '1') {
                                                              echo "checked";
                                                            } ?> id="vue-checkbox-list" type="checkbox" name="cnsltnCompleted" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
              <label for="vue-checkbox-list" class="w-full py-3 ms-2 text-[10px] 2xl:text-sm font-medium text-gray-900 ">Completed</label>
            </div>
          </li>

          <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
            <div class="gap-2 flex items-center ps-3">
              <input id="vue-checkbox-list" type="checkbox" name="cnsltnWithPendingLab"  <?php if ($withPendingLab != '') {
                                                              echo "checked";
                                                            } ?> value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
              <label for="vue-checkbox-list" class=" py-3 ms-2 text-[10px] 2xl:text-sm font-medium text-gray-900 ">With Pending Lab</label>
              <div class="relative z-0 group">
                <input type="text" value="<?php echo $withPendingLab;?>" name="cnsltnWithPendingLab" id="floating_email" class="block py-2.5 px-0  text-[10px] 2xl:text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none    focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                <label for="floating_email" class="peer-focus:font-medium absolute text-[10px] 2xl:text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6"></label>
              </div>
            </div>

          </li>

        </ul>

      </div>
      
      <div class="col-span-4 gap-4 justify-center flex h-14">
        <button type="submit" name="updateConsultation" class="w-full justify-center mt-2 text-center inline-flex items-center text-white bg-gradient-to-r from-[#00669B]  to-[#9AC1CA] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300  shadow-lg shadow-teal-500/50  font-medium rounded-lg text-[9px] 2xl:text-xl px-5 py-1 text-center me-2 mb-2">
          <?php require_once '../src/navBarIcons/proceed.svg' ?>

          Update</button>
          <?php if ($havemedCert == '1') {
            ?>
            <a type="button"  href='../medicalCertificate.php?rf=<?php echo $idNumber;?>&mdcrtid=<?php echo $dcnsltn;?>' target='_blank' class="text-center inline-flex items-center text-white bg-gradient-to-r from-[#115400]  to-[#9AC1CA] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300  shadow-lg shadow-teal-500/50  font-medium rounded-lg text-[9px] 2xl:text-xl px-5 py-1 text-center me-2 mb-2">
          <?php require_once '../src/navBarIcons/medcert.svg' ?>
          Med Cert</a>
            <?php
          } ?>
        

      </div>

    </div>


  </div>

</form>

<script>


</script>