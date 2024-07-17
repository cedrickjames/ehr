<?php
// Check if the 'key1' parameter is set in the URL
include("../includes/connect.php");


if (isset($_GET['rf'])) {
  $rfid = $_GET['rf'];
} else {
  $rfid = "not found";
}

if ($rfid == "not found") {
  // $rfid;
  $name = "Undefined";
  $age = 0;
  $sex = 'n/a';
  $address = 'n/a';
  $civilStatus = 'n/a';
  $employer = 'n/a';
  $section = 'n/a';
  $position = 'n/a';
  $dateHired = '01/01/1999';
}

// $sql1 = "SELECT employeespersonalinfo.rfidNumber, employeespersonalinfo.*
// FROM queing
// INNER JOIN employeespersonalinfo ON employeespersonalinfo.rfidNumber = queing.rfidNumber where employeespersonalinfo.rfidNumber = '$rfid';";
$sql1 = "SELECT*
FROM employeespersonalinfo where rfidNumber = '$rfid';";
$result = mysqli_query($con, $sql1);
while ($userRow = mysqli_fetch_assoc($result)) {
  $name = $userRow['Name'];
  $age = $userRow['age'];
  0;
  $sex = $userRow['sex'];
  $address = $userRow['address'];
  $civilStatus = $userRow['civilStatus'];
  $employer = $userRow['employer'];
  $section = $userRow['section'];
  $position = $userRow['position'];
  $dateHired = $userRow['dateHired'];
}



// Check if the 'key2' parameter is set in the URL

?>

<div class="h-auto relative mb-5">
  <p class="mb-2 2xl:mb-5"><span class=" self-center text-[12px] 2xl:text-lg font-semibold whitespace-nowrap   text-[#193F9F]">Employee's Personal Data</span></p>

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
  <div class="text-[10px] 2xl:text-sm rounded-lg bg-white/50 grid grid-cols-2 gap-2 w-full w-full p-2 2xl:p-4 ">
    <div class="">
      <p class=" 2xl:my-2"><span class="uppercase self-center text-md font-semibold  text-[#323232]"> NAME: </span><span style="font-family: sans-serif" class="tracking-wide uppercase self-center text-md font-bold    text-[#000000]"><?php echo $name; ?></span></p>
      <p class=" 2xl:my-2"><span class="uppercase self-center text-md font-semibold  text-[#323232]"> ADDRESS: </span><span style="font-family: sans-serif" class="tracking-wide uppercase self-center text-md font-bold    text-[#000000]"><?php echo $address; ?></span></p>
      <p class=" 2xl:my-2"><span class="uppercase self-center text-md font-semibold  text-[#323232]"> SEC/dept: </span><span style="font-family: sans-serif" class="tracking-wide uppercase self-center text-md font-bold    text-[#000000]"><?php echo $section; ?></span></p>
      <p class=" 2xl:my-2"><span class="uppercase self-center text-md font-semibold  text-[#323232]"> POSITION: </span><span style="font-family: sans-serif" class="tracking-wide uppercase self-center text-md font-bold    text-[#000000]"><?php echo $position; ?></span></p>
    </div>
    <div class="">
      <div class="grid grid-cols-2  w-full">
        <p class=" 2xl:my-2"><span class="uppercase self-center text-md font-semibold  text-[#323232]"> AGE: </span><span style="font-family: sans-serif" class="tracking-wide uppercase  self-center text-md font-bold    text-[#000000]"> <?php echo $age; ?> </span></p>
        <p class=" 2xl:my-2"><span class="uppercase self-center text-md font-semibold  text-[#323232]"> sex: </span><span style="font-family: sans-serif" class="tracking-wide uppercase  self-center text-md font-bold    text-[#000000]"> <?php echo $sex; ?></span></p>

      </div>
      <p class=" 2xl:my-2"><span class="uppercase self-center text-md font-semibold  text-[#323232]"> civil: </span><span style="font-family: sans-serif" class="tracking-wide uppercase  self-center text-md font-bold    text-[#000000]"><?php echo $civilStatus; ?></span></p>
      <p class=" 2xl:my-2"><span class="uppercase self-center text-md font-semibold  text-[#323232]"> employer: </span><span style="font-family: sans-serif" class="tracking-wide uppercase  self-center text-md font-bold    text-[#000000]"> <?php echo $employer; ?></span></p>
      <p class=" 2xl:my-2"><span class="uppercase self-center text-md font-semibold  text-[#323232]"> date: </span><span style="font-family: sans-serif" class="tracking-wide uppercase  self-center text-md font-bold    text-[#000000]"> <?php $date_timestamp = strtotime($dateHired);
                                                                                                                                                                                                                                            $formatted_date = date('F d, Y', $date_timestamp);

                                                                                                                                                                                                                                            echo $formatted_date; ?></span></p>
    </div>

  </div>
</div>