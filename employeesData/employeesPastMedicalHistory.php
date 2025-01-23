<?php



if (isset($_GET['rf'])) {
    $idNumber = $_GET['rf'];
} else {
    $idNumber = "not found";
}


if (isset($_POST['editPastMed'])) {

    $smoking = isset($_POST['smoking']) ? $_POST['smoking'] : "0";
    $drugs = isset($_POST['drugs']) ? $_POST['drugs'] : "0";
    $alcohol = isset($_POST['alcohol']) ? $_POST['alcohol'] : "0";
    $asthma = isset($_POST['asthma']) ? $_POST['asthma'] : "0";
    $ptb = isset($_POST['ptb']) ? $_POST['ptb'] : "0";
    $diabetes = isset($_POST['diabetes']) ? $_POST['diabetes'] : "0";
    $heartDisease = isset($_POST['heartDisease']) ? $_POST['heartDisease'] : "0";
    $hpn = isset($_POST['hpn']) ? $_POST['hpn'] : "0";
    $renalDisease = isset($_POST['renalDisease']) ? $_POST['renalDisease'] : "0";
    $adequate = isset($_POST['adequate']) ? $_POST['adequate'] : "0";
    $inadequate = isset($_POST['inadequate']) ? $_POST['inadequate'] : "0";
    $menorrhagia = isset($_POST['menorrhagia']) ? $_POST['menorrhagia'] : "0";
    $metrorrhagia = isset($_POST['metrorrhagia']) ? $_POST['metrorrhagia'] : "0";
    $amenorrhea = isset($_POST['amenorrhea']) ? $_POST['amenorrhea'] : "0";
    $dysmenorrhea = isset($_POST['dysmenorrhea']) ? $_POST['dysmenorrhea'] : "0";

    $othersFHInput =  $_POST['othersFH'];

    $othersFHInput = str_replace("'", "&apos;", $othersFHInput);
    $othersFHInput = str_replace('"', '&quot;', $othersFHInput);


    $pastPresentMed =  $_POST['pastAndPresentMedHistory'];
    $far =  $_POST['far'];
    $near =  $_POST['near'];
    $surgicalHistory =  $_POST['surgicalHistory'];
    $presentMedication =  $_POST['presentMedication'];
    $allergies =  $_POST['allergies'];
    $interval =  $_POST['intervalMH'];
    $duration =  $_POST['duration'];
    $flow =  $_POST['flow'];
    $gravida =  $_POST['gravida'];
    $para =  $_POST['para'];
    $termBirth =  $_POST['termBirth'];
    $livingChildren =  $_POST['livingChildren'];
    $preTermBirth =  $_POST['preTermBirth'];
    $abortionMiscarriage =  $_POST['abortion'];
    $multiplePregnancies =  $_POST['multiplePregnancies'];

    $query = mysqli_query($con, "SELECT * FROM `pastmedicalhistory` WHERE `idNumber`= '$idNumber'");
    $numrows = mysqli_num_rows($query);

    if ($numrows > 0) {
        $sql = "UPDATE `pastmedicalhistory` SET `smoking`='$smoking',`drugs`='$drugs',`alcohol`='$alcohol',`asthma`='$asthma',`ptb`='$ptb',`diabetes`='$diabetes',`heartDisease`='$heartDisease',`hpn`='$hpn',`renalDisease`='$renalDisease',`adequate`='$adequate',`inadequate`='$inadequate',`menorrhagia`='$menorrhagia',`metrorrhagia`='$metrorrhagia',`amenorrhea`='$amenorrhea',`dysmenorrhea`='$dysmenorrhea',`othersFH`='$othersFHInput',`pastAndPresentMedHistory`='$pastPresentMed',`far`='$far',`near`='$near',`surgicalHistory`='$surgicalHistory',`presentMedication`='$presentMedication',`allergies`='$allergies',`intervalMH`='$interval',`duration`='$duration',`flow`='$flow',`gravida`='$gravida',`para`='$para',`termBirth`='$termBirth',`livingChildren`='$livingChildren',`preTermBirth`='$preTermBirth',`abortion`='$abortionMiscarriage',`multiplePregnancies`='$multiplePregnancies' WHERE `idNumber` = '$idNumber';";
        $results = mysqli_query($con, $sql);

        if ($results) {
            echo "<script>alert('Updated successfuly.') </script>";
            echo "<script> location.href='index.php'; </script>";
        } else {
            echo "<script>alert('There's a problem updating the medical record.') </script>";
        }
    } else {
        $sql = "INSERT INTO `pastmedicalhistory`(`idNumber`, `smoking`, `drugs`, `alcohol`, `asthma`, `ptb`, `diabetes`, `heartDisease`, `hpn`, `renalDisease`, `othersFH`, `pastAndPresentMedHistory`, `far`, `near`, `adequate`, `inadequate`, `surgicalHistory`, `presentMedication`, `allergies`, `intervalMH`, `duration`, `flow`, `menorrhagia`, `metrorrhagia`, `amenorrhea`, `dysmenorrhea`, `gravida`, `para`, `termBirth`, `livingChildren`, `preTermBirth`, `abortion`, `multiplePregnancies`) 
        VALUES ('$idNumber','$smoking','$drugs','$alcohol','$asthma','$ptb','$diabetes','$heartDisease','$hpn','$renalDisease','$othersFHInput','$pastPresentMed','$far','$near','$adequate','$inadequate','$surgicalHistory','$presentMedication','$allergies','$interval','$duration','$flow','$menorrhagia','$metrorrhagia','$amenorrhea','$dysmenorrhea','$gravida','$para','$termBirth','$livingChildren','$preTermBirth','$abortionMiscarriage','$multiplePregnancies')";

        $results = mysqli_query($con, $sql);

        if ($results) {
            echo "<script>alert('Saved successfuly.') </script>";
            echo "<script> location.href='index.php'; </script>";
        } else {
            echo "<script>alert('There's a problem saving the medical record.') </script>";
        }
    }
}



$smoking = "";
$drugs = "";
$alcohol = "";
$asthma = "";
$ptb = "";
$diabetes = "";
$heartDisease = "";
$hpn = "";
$renalDisease = "";
$othersFH = "";

$pastPresentMed = "";
$far = "";
$near = "";
$adequate = "";
$inadequate = "";
$surgicalHistory = "";
$presentMedication = "";
$allergies = "";
$interval = "";
$duration = "";
$flow = "";
$menorrhagia = "";
$metrorrhagia = "";
$amenorrhea = "";
$dysmenorrhea = "";
$gravida = "";
$para = "";
$termBirth = "";
$livingChildren = "";
$preTermBirth = "";
$abortionMiscarriage = "";
$multiplePregnancies = "";

// $sql1 = "SELECT pastmedicalhistory.idNumber, pastmedicalhistory.*
// FROM queing
// INNER JOIN pastmedicalhistory ON pastmedicalhistory.idNumber = queing.idNumber where pastmedicalhistory.idNumber = '$idNumber';";

$sql1 = "SELECT *
FROM pastmedicalhistory where idNumber = '$idNumber';";
// echo $sql1;
$result = mysqli_query($con, $sql1);
while ($userRow = mysqli_fetch_assoc($result)) {

    $smoking = $userRow['smoking'];
    $drugs = $userRow['drugs'];
    $alcohol = $userRow['alcohol'];
    $asthma = $userRow['asthma'];
    $ptb = $userRow['ptb'];
    $diabetes = $userRow['diabetes'];
    $heartDisease = $userRow['heartDisease'];
    $hpn = $userRow['hpn'];
    $renalDisease = $userRow['renalDisease'];
    $othersFH = $userRow['othersFH'];

    $pastPresentMed = $userRow['pastAndPresentMedHistory'];
    $far = $userRow['far'];
    $near = $userRow['near'];
    $adequate = $userRow['adequate'];
    $inadequate = $userRow['inadequate'];
    $surgicalHistory = $userRow['surgicalHistory'];
    $presentMedication = $userRow['presentMedication'];
    $allergies = $userRow['allergies'];
    $interval = $userRow['intervalMH'];
    $duration = $userRow['duration'];
    $flow = $userRow['flow'];
    $menorrhagia = $userRow['menorrhagia'];
    $metrorrhagia = $userRow['metrorrhagia'];
    $amenorrhea = $userRow['amenorrhea'];
    $dysmenorrhea = $userRow['dysmenorrhea'];
    $gravida = $userRow['gravida'];
    $para = $userRow['para'];
    $termBirth = $userRow['termBirth'];
    $livingChildren = $userRow['livingChildren'];
    $preTermBirth = $userRow['preTermBirth'];
    $abortionMiscarriage = $userRow['abortion'];
    $multiplePregnancies = $userRow['multiplePregnancies'];
}

?>

<div class="relative ">
    <form action="" method="post" id="formPastMedHistory">
        <p class="mb-2 2xl:mb-5"><span class=" self-center text-[12px] 2xl:text-lg font-semibold whitespace-nowrap   text-[#193F9F]">Employee's Past Medical History</span></p>

        <div class="absolute top-0 right-0">
            <button type="button" id="enableformbtn" onclick="enableFormInputsPastMedHis()" style="background: none; border: none; padding: 0; cursor: pointer;">
                <svg class="w-6 h-6 " xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1000" zoomAndPan="magnify" viewBox="0 0 750 749.999995" height="1000" preserveAspectRatio="xMidYMid meet" version="1.0">
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
            </button>
            <button type="button" id="disableformBtn" class="hidden" onclick="disableFormInputsPastMedHis()" style="background: none; border: none; padding: 0; cursor: pointer;">
                <svg class="w-6 h-6 " xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1000" zoomAndPan="magnify" viewBox="0 0 750 749.999995" height="1000" preserveAspectRatio="xMidYMid meet" version="1.0">
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
            </button>
        </div>
        <div class="text-xs 2xl:text-lg  rounded-lg bg-white/50 grid grid-cols-3 gap-2 w-full w-full p-4 ">

            <h3 class="my-auto mb-4 font-semibold text-gray-900 ">A. Personal and Social History</h3>
            <ul class="col-span-2 items-center w-full text-[9px] 2xl:text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex   ">
                <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                    <div class="gap-2 flex items-center ps-3">
                        <input <?php if ($smoking == '1') {
                                    echo "checked";
                                }  ?> name="smoking" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label class="w-full  ms-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Smoking</label>
                    </div>
                </li>
                <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                    <div class="gap-2 flex items-center ps-3">
                        <input <?php if ($drugs == '1') {
                                    echo "checked";
                                }  ?> name="drugs" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label class="w-full  ms-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Drugs</label>
                    </div>
                </li>
                <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                    <div class="gap-2 flex items-center ps-3">
                        <input <?php if ($alcohol == '1') {
                                    echo "checked";
                                }  ?> name="alcohol" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label class="w-full  ms-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Alcohol</label>
                    </div>
                </li>

            </ul>


            <h3 class="my-auto mb-4 font-semibold text-gray-900 ">B. Family History</h3>
            <ul class="col-span-2 items-center w-full text-[9px] 2xl:text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex   ">
                <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                    <div class="gap-2 flex items-center ps-3">
                        <input <?php if ($asthma == '1') {
                                    echo "checked";
                                }  ?> name="asthma" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label class="w-full  ms-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Asthma</label>
                    </div>
                </li>
                <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                    <div class="gap-2 flex items-center ps-3">
                        <input <?php if ($ptb == '1') {
                                    echo "checked";
                                }  ?> name="ptb" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label class="w-full  ms-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">PTB</label>
                    </div>
                </li>
                <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                    <div class="gap-2 flex items-center ps-3">
                        <input <?php if ($diabetes == '1') {
                                    echo "checked";
                                }  ?> name="diabetes" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label class="w-full  ms-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Diabetes</label>
                    </div>
                </li>

            </ul>
            <div></div>
            <ul class="right-0 col-span-2 items-center w-full text-[9px] 2xl:text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex   ">
                <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                    <div class="gap-2 flex items-center ps-3">
                        <input <?php if ($heartDisease == '1') {
                                    echo "checked";
                                }  ?> name="heartDisease" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label class="w-full py-3  ms-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Heart Disease</label>
                    </div>
                </li>
                <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                    <div class="gap-2 flex items-center ps-3">
                        <input <?php if ($hpn == '1') {
                                    echo "checked";
                                }  ?> name="hpn" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label class="w-full  ms-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">HPN</label>
                    </div>
                </li>
                <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                    <div class="gap-2 flex items-center ps-3">
                        <input <?php if ($renalDisease == '1') {
                                    echo "checked";
                                }  ?> name="renalDisease" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label class="w-full  ms-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Renal Disease</label>
                    </div>
                </li>

            </ul>

            <div></div>
            <ul class="right-0 col-span-2 items-center w-full text-[9px] 2xl:text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex   ">
                <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                    <div class="gap-2 flex items-center py-1 ps-3">
                        <input <?php if ($othersFH != "") {
                                    echo "checked";
                                }  ?> type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label class="  ms-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Others</label>
                        <div class="relative z-0 group">
                            <input type="text" name="othersFH" id="floating_email" value="<?php echo $othersFH; ?>" class="block py-2.5 px-0  text-[9px] 2xl:text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none    focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                            <label for="floating_email" class="peer-focus:font-medium absolute text-[9px] 2xl:text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600  peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Type here</label>
                        </div>
                    </div>

                </li>


            </ul>


            <h3 class="col-span-3 my-auto mb-2 font-semibold text-gray-900 ">C. Past and Present Medical History</h3>
            <textarea id="pastAndPresent" name="pastAndPresentMedHistory" rows="4" class="col-span-3 block p-1 2xl:p-2.5 w-full text-[9px] 2xl:text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500    " placeholder=""><?php echo $pastPresentMed; ?></textarea>

            <h3 class="font-semibold text-gray-900 ">D. Visual Acuity Test:</h3>
            <div class="col-span-2 gap-2 flex">
                <div class=" ">
                    <label for="base-input" class="block mb-0 2xl:mb-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Far: </label>
                    <input type="text" name="far" value="<?php echo $far; ?>"  class="bg-gray-50 border border-gray-300 text-gray-900 text-[9px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 2xl:p-2.5    ">
                </div>
                <div class="">
                    <label for="base-input" class="block mb-0 2xl:mb-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Near</label>
                    <input type="text"  name="near" value="<?php echo $near; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[9px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 2xl:p-2.5    ">
                </div>

            </div>
            <div>


            </div>

            <ul class="col-span-2 items-center w-full text-[9px] 2xl:text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex   ">
                <h3 class="font-semibold text-gray-900 "> Color: </h3>

                <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                    <div class="gap-2 flex items-center ps-3">
                        <input <?php if ($adequate == '1') {
                                    echo "checked";
                                }  ?> name="adequate" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label class="w-full py-3 ms-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Adequate</label>
                    </div>
                </li>
                <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                    <div class="gap-2 flex items-center ps-3">
                        <input <?php if ($inadequate == '1') {
                                    echo "checked";
                                }  ?> name="inadequate" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label class="w-full  ms-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Inadequate</label>
                    </div>
                </li>

            </ul>
            <h3 class="my-auto mb-4 font-semibold text-gray-900 ">E. Surgical History:</h3>
            <input type="text" name="surgicalHistory" value="<?php echo $surgicalHistory; ?>"  class="col-span-2 bg-gray-50 border border-gray-300 text-gray-900 text-[9px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 2xl:p-2.5    ">
            <h3 class="my-auto mb-4 font-semibold text-gray-900 ">F. Present Medication: </h3>
            <input type="text" name="presentMedication" value="<?php echo $presentMedication; ?>"  class="col-span-2 bg-gray-50 border border-gray-300 text-gray-900 text-[9px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 2xl:p-2.5    ">
            <h3 class="my-auto mb-4 font-semibold text-gray-900 ">G. Allergies: </h3>
            <input type="text" name="allergies" value="<?php echo $allergies; ?>"  class="col-span-2 bg-gray-50 border border-gray-300 text-gray-900 text-[9px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 2xl:p-2.5    ">

            <h3 class="col-span-3 my-auto mb-4 font-semibold text-gray-900  italic">H. For Women only: </h3>
            <h3 class=" font-semibold text-gray-900  ">Menstrual History:</h3>
            <div class="col-span-2 gap-2 flex">
                <div class="mb-5 ">
                    <label for="base-input" class="block mb-0 2xl:mb-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Interval: </label>
                    <input type="text" name="intervalMH" value="<?php echo $interval; ?>"  class="bg-gray-50 border border-gray-300 text-gray-900 text-[9px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 2xl:p-2.5    ">
                </div>
                <div class="mb-5">
                    <label for="base-input" class="block mb-0 2xl:mb-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Duration</label>
                    <input type="text" name="duration" value="<?php echo $duration; ?>"  class="bg-gray-50 border border-gray-300 text-gray-900 text-[9px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 2xl:p-2.5    ">
                </div>
                <div class="mb-5">
                    <label for="base-input" class="block mb-0 2xl:mb-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Flow:</label>
                    <input type="text" name="flow" value="<?php echo $flow; ?>"  class="bg-gray-50 border border-gray-300 text-gray-900 text-[9px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 2xl:p-2.5    ">
                </div>
            </div>

            <h3 class="my-auto mb-4 font-semibold text-gray-900 ">Menstrual Disorders:</h3>
            <ul class="col-span-2 items-center w-full text-[9px] 2xl:text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex   ">

                <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                    <div class="gap-2 flex items-center ps-3">
                        <input <?php if ($menorrhagia == '1') {
                                    echo "checked";
                                }  ?> name="menorrhagia" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label class="w-full  ms-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Menorrhagia</label>
                    </div>
                </li>
                <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                    <div class="gap-2 flex items-center ps-3">
                        <input <?php if ($metrorrhagia == '1') {
                                    echo "checked";
                                }  ?> name="metrorrhagia" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label class="w-full  ms-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Metrorrhagia</label>
                    </div>
                </li>


            </ul>
            <div></div>
            <ul class="col-span-2 items-center w-full text-[9px] 2xl:text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex   ">

                <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                    <div class="gap-2 flex items-center ps-3">
                        <input <?php if ($amenorrhea == '1') {
                                    echo "checked";
                                }  ?> name="amenorrhea" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label class="w-full py-3 ms-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Amenorrhea</label>
                    </div>
                </li>
                <li class="px-2 w-full border-b border-gray-200 sm:border-b-0 sm:border-r ">
                    <div class="gap-2 flex items-center ps-3">
                        <input <?php if ($dysmenorrhea == '1') {
                                    echo "checked";
                                }  ?> name="dysmenorrhea" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label class="w-full py-3 ms-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Dysmenorrhea</label>
                    </div>
                </li>

            </ul>

            <h3 class=" font-semibold text-gray-900  ">Pregnancy History</h3>
            <div class="col-span-2 gap-2 flex">
                <div class=" ">
                    <label for="base-input" class="block mb-0 2xl:mb-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Gravida:</label>
                    <input type="text" name="gravida"  value="<?php echo $gravida; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[9px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 2xl:p-2.5    ">
                </div>
                <div class="">
                    <label for="base-input" class="block mb-0 2xl:mb-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Para:</label>
                    <input type="text" name="para"  value="<?php echo $para; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[9px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 2xl:p-2.5    ">
                </div>
                <div class="">
                    <label for="base-input" class="block mb-0 2xl:mb-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Term Birth: </label>
                    <input type="text" name="termBirth"  value="<?php echo $termBirth; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[9px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 2xl:p-2.5    ">
                </div>
            </div>
            <div></div>
            <div class="col-span-2 gap-2 flex">
                <div class=" w-1/2 ">
                    <label for="base-input" class="block mb-0 2xl:mb-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Living Children: </label>
                    <input type="text" name="livingChildren"  value="<?php echo $livingChildren; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[9px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 2xl:p-2.5    ">
                </div>
                <div class=" w-1/2">
                    <label for="base-input" class="block mb-0 2xl:mb-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Pre-Term Birth: </label>
                    <input type="text" name="preTermBirth"  value="<?php echo $preTermBirth; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[9px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 2xl:p-2.5    ">
                </div>
            </div>
            <div></div>
            <div class="col-span-2 gap-2 flex">
                <div class=" w-1/2 ">
                    <label for="base-input" class="block mb-0 2xl:mb-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Abortion/ Miscarriage: </label>
                    <input type="text" name="abortion"  value="<?php echo $abortionMiscarriage; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[9px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 2xl:p-2.5    ">
                </div>
                <div class=" w-1/2">
                    <label for="base-input" class="block mb-0 2xl:mb-2 text-[9px] 2xl:text-sm font-medium text-gray-900 ">Multiple Pregnancies:</label>
                    <input type="text" name="multiplePregnancies"  value="<?php echo $multiplePregnancies; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[9px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 2xl:p-2.5    ">
                </div>
            </div>
            <div id="updateBtn" class="hidden col-span-3 justify-center flex">
                <button type="submit" name="editPastMed" class="w-64 text-white bg-gradient-to-r from-[#00669B]  to-[#9AC1CA] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300  shadow-lg shadow-teal-500/50  font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2">Update</button>
            </div>
        </div>


    </form>
</div>


<script>
    function disableFormInputsPastMedHis() {
        var form = document.getElementById("formPastMedHistory");
        var inputs = form.getElementsByTagName("input");

        for (var i = 0; i < inputs.length; i++) {
            inputs[i].disabled = true;
        }
        var textarea = document.getElementById("pastAndPresent");
        textarea.disabled = true;

        var disableformBtn = document.getElementById("disableformBtn");
        var enableformbtn = document.getElementById("enableformbtn");
        var updateBtn = document.getElementById("updateBtn");

        disableformBtn.classList.add("hidden");
        enableformbtn.classList.remove("hidden");

        updateBtn.classList.add("hidden");

    }

    function enableFormInputsPastMedHis() {
        var form = document.getElementById("formPastMedHistory");
        var inputs = form.getElementsByTagName("input");

        for (var i = 0; i < inputs.length; i++) {
            inputs[i].disabled = false;
        }
        // console.log("enabled");
        var textarea = document.getElementById("pastAndPresent");
        textarea.disabled = false;

        var disableformBtn = document.getElementById("disableformBtn");
        var enableformbtn = document.getElementById("enableformbtn");
        var updateBtn = document.getElementById("updateBtn");

        disableformBtn.classList.remove("hidden");
        enableformbtn.classList.add("hidden");

        updateBtn.classList.remove("hidden");






    }
    disableFormInputsPastMedHis();
</script>