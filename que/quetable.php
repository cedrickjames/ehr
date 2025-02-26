<?php


$userID = $_SESSION['userID'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  // Iterate through the $_POST array to find the button that was clicked
  foreach ($_POST as $key => $value) {
      if (strpos($key, 'assist_') === 0) {
          // Extract the number from the button name
          $queNo = substr($key, strlen('assist_'));

          $idNumber =  $_POST['idNumber'.$queNo];
          $_SESSION['idNumber'] = $idNumber;
          $sql = "UPDATE `queing` SET `status`='processing', `nurseAssisting` = '$userID' WHERE `idNumber` = '$idNumber' and `status` = 'waiting'";
          $results = mysqli_query($con,$sql);
          
      }
      else if (strpos($key, 'doneAssist_') === 0) {
        // Extract the number from the button name
        $queNo = substr($key, strlen('doneAssist_'));

        $idNumber =  $_POST['idNumber'.$queNo];
        // $_SESSION['idNumber'] = $idNumber;
        $sql = "UPDATE `queing` SET `status`='done' WHERE `idNumber` = '$idNumber'";
        $results = mysqli_query($con,$sql);
        
        // echo $queNo;
    }

  }
} 


?>

<div class="text-[9px] 2xl:text-lg mb-5">
<p class="mb-2"><span class=" self-center text-lg font-semibold whitespace-nowrap   text-[#193F9F]">On Queue</span></p>

        <div id="" class="">
        <div class=" p-4 rounded-lg  bg-gray-50 " id="headApproval" role="tabpanel"
            aria-labelledby="profile-tab">
            <form action="index.php" method = "post">
            <section class="mt-2 2xl:mt-10">
                <table id="queTable" class="display text-[9px] 2xl:text-sm" style="width:100%">
                <thead>
                        <tr>
                            <th >No.</th>
                            <th >Status</th>
                            <th >Name</th>
                            <th >Employer</th>
                            <th >Action</th>
                            <th >Nurse</th>

                           
                            
                            <!-- <th>Days Late</th> -->
                            <!-- <th>Assigned to</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $queNo = 1;
                        $sql="SELECT 
                        queing.*, 
                        employeespersonalinfo.idNumber, 
                        employeespersonalinfo.*, 
                        COALESCE(users.name, '') AS nurse_assisting_name
                    FROM 
                        queing  
                    INNER JOIN 
                        employeespersonalinfo 
                    ON 
                        employeespersonalinfo.idNumber = queing.idNumber
                    LEFT JOIN
                        users
                    ON
                        queing.nurseAssisting = users.idNumber WHERE queing.status != 'done' ORDER BY
    queing.id ASC; 
                    ";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_assoc($result)){
          
                ?> <tr style="background-color: <?php if($row['status'] == 'processing'){echo "#d9ffdd";} ?>"> 
                    <td> <?php echo $queNo;?> </td>
                    <td> <?php if ($row['status'] == 'waiting'){ echo "Waiting";} 
                    else if($row['status'] == 'processing')
                    {echo "On Going";}?> </td>
                    <td> <?php echo $row['Name'];?> </td>
                    <td><?php echo $row['employer'];?> </td>
                    <td> <div class="content-center flex flex-wrap justify-center gap-2">
                    <input type="text" class="hidden" name="idNumber<?php echo $queNo;?>" value="<?php echo $row['idNumber'];?>">
                    <button  <?php 
                    if($row['status'] == "waiting") {
                      echo "disabled";
                      }else if($row['status'] == "processing" && $row['nurseAssisting'] != $userID){
                        echo "disabled";

                      } ?> id="dropdownMenuIconButton<?php echo $queNo;?>" data-dropdown-toggle="dropdownDots<?php echo $queNo;?>" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900  rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 <?php if($row['status'] == "waiting") {
                        echo "dark:bg-gray-300 bg-gray-300 ";
                        }else if($row['status'] == "processing" && $row['nurseAssisting'] != $userID){
                          echo "dark:bg-gray-300 bg-gray-300 ";
  
                        } else{
                        echo "bg-white dark:bg-gray-800 dark:hover:bg-gray-700";

                        } ?>   dark:focus:ring-gray-600" type="button">
<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
<path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
</svg>
</button>

<?php

if($row['status'] == "waiting"){
?>
<button  <?php
            if($row['nurseAssisting'] == "" || $row['nurseAssisting'] == $userID){
              echo "";
            } else {
              echo "disabled";
            }

        ?>
 id="assisBtn<?php echo $queNo;?>" type="submit" name="assist_<?php echo $queNo;?>"   class="relative inline-flex items-center justify-center p-0.5  me-2 overflow-hidden  font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white ">
<span class="relative px-2 py-2 transition-all ease-in duration-75 <?php
            if($row['nurseAssisting'] == "" || $row['nurseAssisting'] == $userID){
              echo "bg-white group-hover:bg-opacity-0";
            } else {
              echo "bg-gray-300 ";
            }

        ?> rounded-md ">
Assist
</span>
</button>
<?php
}else if($row['status'] == "processing" && $row['nurseAssisting'] != $userID){
  ?>
<button  <?php
            if($row['nurseAssisting'] == "" || $row['nurseAssisting'] == $userID){
              echo "";
            } else {
              echo "disabled";
            }

        ?>
 id="assisBtn<?php echo $queNo;?>" type="submit" name="assist_<?php echo $queNo;?>"   class="relative inline-flex items-center justify-center p-0.5  me-2 overflow-hidden  font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white ">
<span class="relative px-2 py-2 transition-all ease-in duration-75 <?php
            if($row['nurseAssisting'] == "" || $row['nurseAssisting'] == $userID){
              echo "bg-white group-hover:bg-opacity-0";
            } else {
              echo "bg-gray-300 ";
            }

        ?> rounded-md ">
Assist
</span>
</button>
<?php

}
else if($row['status'] == "processing" && $row['nurseAssisting'] == $userID){
  ?>
<button  <?php
            if($row['nurseAssisting'] == "" || $row['nurseAssisting'] == $userID){
              echo "";
            } else {
              echo "disabled";
            }

        ?>
 id="assisDoneBtn<?php echo $queNo;?>" type="button"   data-modal-target="doneConfirmation" data-modal-toggle="doneConfirmation"  class="relative inline-flex items-center justify-center p-0.5  me-2 overflow-hidden  font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-red-400 to-blue-600 group-hover:from-red-400 group-hover:to-blue-600 hover:text-white ">
<span class="relative px-2 py-2 transition-all ease-in duration-75 <?php
            if($row['nurseAssisting'] == "" || $row['nurseAssisting'] == $userID){
              echo "bg-white group-hover:bg-opacity-0";
            } else {
              echo "bg-gray-300 ";
            }

        ?> rounded-md ">
Done
</span>
</button>


<div id="doneConfirmation" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="doneConfirmation">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you?</h3>
                <button data-modal-hide="doneConfirmation" name="doneAssist_<?php echo $queNo;?>" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                </button>
                <button data-modal-hide="doneConfirmation" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
            </div>
        </div>
    </div>
</div>



<?php

}
?>

                    </div>
<!-- Dropdown menu -->
<div id="dropdownDots<?php echo $queNo;?>" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
    <ul class="py-2 text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton<?php echo $queNo;?>">
      <li>
        <a href="../nurses/fitToWork.php?rf=<?php echo $row['idNumber']; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Fit To Work</a>
      </li>
      <li>
        <a href="../nurses/consultation.php?rf=<?php echo $row['idNumber'] ;?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Medical Consultation</a>
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
        <a href="../nurses/medicalRecord.php?rf=<?php echo $row['idNumber'] ;?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Medical Record</a>
      </li>
      <li>
        <a href="../nurses/vaccination.php?rf=<?php echo $row['idNumber'] ;?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Vaccination</a>
      </li>
    </ul>

</div>
 </td>
 <td> <?php echo $row['nurse_assisting_name'];?> </td>
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
