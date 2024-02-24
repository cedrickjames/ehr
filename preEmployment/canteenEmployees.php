

<div class="text-[9px] 2xl:text-lg mb-5">
<p class="mb-2"><span class=" self-center text-md font-semibold whitespace-nowrap   text-[#193F9F]">Direct Employees</span></p>

        <div id="" class="">
        <div class=" p-4 rounded-lg  bg-gray-50 " id="headApproval" role="tabpanel"
            aria-labelledby="profile-tab">
            <form action="index.php" method = "post">
            <section class="mt-2 2xl:mt-10">
                <table id="queTable" class="display text-[9px] 2xl:text-sm" style="width:100%">
                <thead>
                        <tr>
                            <th >No.</th>
                            <th >Name</th>
                            <th >Employer</th>
                            <th >Action</th>
                            

                           
                            
                            <!-- <th>Days Late</th> -->
                            <!-- <th>Assigned to</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $queNo = 1;
                        $sql="SELECT * FROM `employeespersonalinfo` WHERE `employer` = 'Canteen' ORDER BY `Name` ASC; 
                    ";
        $result = mysqli_query($con,$sql);
        while($row=mysqli_fetch_assoc($result)){
          
                ?> <tr> 
                    <td> <?php echo $queNo;?> </td>
                    <td> <?php echo $row['Name'];?> </td>
                    <td><?php echo $row['employer'];?> </td>
                    <td> <div class="content-center flex flex-wrap justify-center gap-2">
                    <input type="text" class="hidden" name="rfid<?php echo $queNo;?>" value="<?php echo $row['rfidNumber'];?>">
                    <button  id="dropdownMenuIconButton<?php echo $queNo;?>" data-dropdown-toggle="dropdownDots<?php echo $queNo;?>" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900  rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 bg-white dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
<svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
<path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
</svg>
</button>



                    </div>
<!-- Dropdown menu -->
<div id="dropdownDots<?php echo $queNo;?>" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton<?php echo $queNo;?>">
      <li>
        <a href="../nurses/fitToWork.php?rf=<?php echo $row['rfidNumber']; ?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Fit To Work</a>
      </li>
      <li>
        <a href="../nurses/consultation.php?rf=<?php echo $row['rfidNumber'] ;?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Medical Consultation</a>
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
        <a href="../nurses/medicalRecord.php?rf=<?php echo $row['rfidNumber'] ;?>" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Medical Record</a>
      </li>
    </ul>

</div>
 </td>
 
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
