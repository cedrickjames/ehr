<?php


$userID = $_SESSION['userID'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Iterate through the $_POST array to find the button that was clicked
  foreach ($_POST as $key => $value) {
    if (strpos($key, 'assist_') === 0) {
      // Extract the number from the button name
      $queNo = substr($key, strlen('assist_'));

      $idNumber =  $_POST['rfid' . $queNo];
      $_SESSION['rfid'] = $idNumber;
      $sql = "UPDATE `queing` SET `status`='processing', `nurseAssisting` = '$userID' WHERE `idNumber` = '$idNumber'";
      $results = mysqli_query($con, $sql);
    } else if (strpos($key, 'doneAssist_') === 0) {
      // Extract the number from the button name
      $queNo = substr($key, strlen('doneAssist_'));

      $idNumber =  $_POST['rfid' . $queNo];
      // $_SESSION['rfid'] = $idNumber;
      $sql = "UPDATE `queing` SET `status`='done' WHERE `idNumber` = '$idNumber'";
      $results = mysqli_query($con, $sql);

      // echo $queNo;
    }
  }
}
?>

<div class="text-[9px] 2xl:text-lg mb-5">
  <p class="mb-2"><span class=" self-center text-md font-semibold whitespace-nowrap   text-[#193F9F]">On Que</span></p>

  <div id="" class="">
    <div class=" p-4 rounded-lg  bg-gray-50 " id="headApproval" role="tabpanel" aria-labelledby="profile-tab">
      <form action="index.php" method="post">
        <section class="mt-2 2xl:mt-10">
          <table id="fromDocQueTable" class="display text-[9px] 2xl:text-sm" style="width:100%">
            <thead>
              <tr>
                <th>No.</th>
                <th>Date</th>
                <th>Name</th>
                <th>Action</th>
                <th>Nurse</th>



                <!-- <th>Days Late</th> -->
                <!-- <th>Assigned to</th> -->
              </tr>
            </thead>
            <tbody>
              <?php
              $queNo = 1;
              $sql = "SELECT consultation.*, 
                        employeespersonalinfo.idNumber, 
                        employeespersonalinfo.Name, 
                        COALESCE(users.name, '') AS nurse_assisting_name
                    FROM 
                        consultation  
                    INNER JOIN 
                        employeespersonalinfo 
                    ON 
                        employeespersonalinfo.idNumber = consultation.idNumber
                    LEFT JOIN
                        users
                    ON
                        consultation.nurseAssisting = users.idNumber WHERE consultation.statusComplete = '1' ORDER BY
    consultation.id ASC; 
                    ";
              $result = mysqli_query($con, $sql);
              while ($row = mysqli_fetch_assoc($result)) {

              ?> <tr style="background-color: <?php if ($row['status'] == 'processing') {
                                                echo "#d9ffdd";
                                              } ?>">
                  <td> <?php echo $queNo; ?> </td>
                  <td> <?php 
                  $date = new DateTime($row['date']);
                  $date = $date->format('F d, Y');
                  echo $date;
                  
                  ?> </td>

                  <td> <?php echo $row['Name']; ?> </td>
                  <td>
                    <div class="content-center flex flex-wrap justify-center gap-2">
                      <input type="text" class="hidden" name="rfid<?php echo $queNo; ?>" value="<?php echo $row['idNumber']; ?>">
                      <a type="button" href="../nurses/completedConsultation.php?rf=<?php echo $row['idNumber']; ?>&dcnsltn=<?php echo $row['id']; ?>" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 rounded-full px-3 py-2  text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">View</a>
                      <?php


                      ?>

                    </div>
                    <!-- Dropdown menu -->
                    <div id="dropdownDots<?php echo $queNo; ?>" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                      <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton<?php echo $queNo; ?>">
                        <li>
                          <a href="../nurses/fitToWork.php?rf=<?php echo $row['idNumber']; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Fit To Work</a>
                        </li>
                        <li>
                          <a href="../nurses/consultation.php?rf=<?php echo $row['idNumber']; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Medical Consultation</a>
                        </li>
                        <li>
                          <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dental Consultation</a>
                        </li>
                        <li>
                          <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Medicine Dispence</a>
                        </li>
                        <li>
                          <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Pregnancy Notification</a>
                        </li>
                        <li>
                          <a href="../nurses/medicalRecord.php?rf=<?php echo $row['idNumber']; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Medical Record</a>
                        </li>
                      </ul>

                    </div>
                  </td>
                  <td> <?php echo $row['nurse_assisting_name']; ?> </td>
                </tr> <?php

                      $queNo++;
                    }
                      ?>

            </tbody>
          </table>
        </section>
      </form>
    </div>
  </div>

</div>