<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_GET['rf'])) {
  $idNumber = $_GET['rf'];
} else {
  $idNumber = "not found";
}

$currentDate = date('Y-m-d');

if (isset($_GET['vcn'])) {
  $vcn = $_GET['vcn'];

  $sqlcnslt = "SELECT * FROM `vaccination` WHERE `idNumber` = '$idNumber' and `id` = '$vcn' ORDER BY `id` ASC;";
  $resultcnslt = mysqli_query($con, $sqlcnslt);
  while ($row = mysqli_fetch_assoc($resultcnslt)) {

    $vaccineType = $row['vaccineType'];
    $vaccineBrand = $row['vaccineBrand'];
    $firstDose = $row['firstDose'];
    $secondDose = $row['secondDose'];
    $thirdDose = $row['thirdDose'];
    $provider1 = $row['provider1'];
    $provider2 = $row['provider2'];
    $provider3 = $row['provider3'];
    $remarks = $row['remarks'];
  }
} else {
  $vaccineType = "";
  $vaccineBrand = "";
  $firstDose = $currentDate;
  $secondDose = NULL;
  $thirdDose = NULL;
  $provider1 = $_SESSION['name'];
  $provider2 = "";
  $provider3 = "";
  $remarks = "";
}



if (isset($_POST['addVax'])) {
  $idNumber = $_GET['rf'];
  $vaxType = $_POST['vaxType'];
  $vaxBrand = $_POST['vaxBrand'];
  $firstDose = $_POST['firstDose'];
  $provider1 = $_POST['provider1'];
  $secondDose = $_POST['secondDose'];
  $provider2 = $_POST['provider2'];
  $thirdDose = $_POST['thirdDose'];
  $provider3 = $_POST['provider3'];
  $remarks = $_POST['remarks'];
 
  $sql = "INSERT INTO `vaccination`( `idNumber`, `vaccineType`, `vaccineBrand`, `firstDose`, `provider1`,`secondDose`, `provider2`, `thirdDose`,`provider3`, `remarks`) VALUES ('$idNumber','$vaxType','$vaxBrand','$firstDose','$provider1','$secondDose','$provider2','$thirdDose','$provider3','$remarks')";
  $results = mysqli_query($con, $sql);
  if ($results) {
    echo "<script>alert('Record added succesfully!')</script>";
    echo "<script> location.href='../nurses/vaccination.php?rf=$idNumber'; </script>";
  } else {
    echo "<script>alert('There's a problem saving to database.')</script>";
  }
}


if (isset($_POST['updateVax'])) {
  $idNumber = $_GET['rf'];
  $vcn = $_GET['vcn'];
  $vaxType = $_POST['vaxType'];
  $vaxBrand = $_POST['vaxBrand'];
  $firstDose = $_POST['firstDose'];
  $provider1 = $_POST['provider1'];
  $secondDose = $_POST['secondDose'];
  $provider2 = $_POST['provider2'];
  $thirdDose = $_POST['thirdDose'];
  $provider3 = $_POST['provider3'];
  $remarks = $_POST['remarks'];

  $sql = "UPDATE `vaccination` SET  `vaccineType` = '$vaxType', `vaccineBrand`='$vaxBrand', `firstDose`='$firstDose', `provider1`='$provider1',`secondDose`='$secondDose', `provider2`='$provider2', `thirdDose`='$thirdDose',`provider3`='$provider3', `remarks`='$remarks' WHERE `id`= '$vcn';";
  $results = mysqli_query($con, $sql);
  if ($results) {
    echo "<script>alert('Record updated succesfully!')</script>";
    echo "<script> location.href='../nurses/vaccination.php?rf=$idNumber'; </script>";
  } else {
    echo "<script>alert('There's a problem updating.')</script>";
  }
}

?>

<div class="relative ">
  <form method="POST" action="">
    <input type="text" id="" name="" value="<?php echo $vcn; ?>" class="hidden">
    <p class="mb-2 2xl:mb-5"><span class=" self-center text-[12px] 2xl:text-lg font-semibold whitespace-nowrap   text-[#193F9F]">Vaccination</span></p>
    <div class="text-[9px] 2xl:text-lg  rounded-lg bg-white/50 grid grid-cols-4 gap-1 w-full w-full p-4 ">
      <div class="content-center  col-span-2">
        <label class="block  my-auto font-semibold text-gray-900 ">Vaccine Type: </label>
        <select id="vaxType" name="vaxType" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
          <option selected>Select Type</option>
          <option <?php if ($vaccineType == "Flu") {
                    echo "selected";
                  } ?> value="Flu">Flu</option>
          <option <?php if ($vaccineType == "Hepa B") {
                    echo "selected";
                  } ?> value="Hepa B">Hepa B</option>
          <option <?php if ($vaccineType == "Cervical") {
                    echo "selected";
                  } ?> value="Cervical">Cervical</option>

        </select>

      </div>
      <div class="content-center  col-span-2">
        <label class="block my-auto  font-semibold text-gray-900 ">Vaccine Brand: </label>
        <input type="text" id="vaxBrand" name="vaxBrand" value="<?php echo $vaccineBrand; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
      </div>

      <div class="content-center  col-span-2">

        <label class="block my-auto  font-semibold text-gray-900 ">First Dose: </label>
         <input type="date" id="firstDose" name="firstDose" value="<?php echo $firstDose; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

      </div>
        <div class="content-center  col-span-2">

        <label class="block my-auto  font-semibold text-gray-900 ">Provider's Name: </label>
         <input type="text" id="provider1" name="provider1" value="<?php echo $provider1; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

      </div>
      <div class="content-center  col-span-2">

        <label class="block my-auto  font-semibold text-gray-900 ">Second Dose: </label>
        <input type="date" id="secondDose" name="secondDose" value="<?php echo $secondDose; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

        </div>
        <div class="content-center  col-span-2">

        <label class="block my-auto  font-semibold text-gray-900 ">Provider's Name: </label>
        <input type="text" id="provider2" name="provider2" value="<?php echo $provider2; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

        </div>
        <div class="content-center  col-span-2">

        <label class="block my-auto  font-semibold text-gray-900 ">Third Dose: </label>
        <input type="date" id="thirdDose" name="thirdDose" value="<?php echo $thirdDose; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

        </div>
        <div class="content-center  col-span-2">

        <label class="block my-auto  font-semibold text-gray-900 ">Provider's Name: </label>
        <input type="text" id="provider3" name="provider3" value="<?php echo $provider3; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">

        </div>
        <div class="col-span-4">
      <label class="block my-auto  font-semibold text-gray-900 ">Remarks: </label>
      <textarea id="remarks" name="remarks" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-[12px] 2xl:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder=""><?php echo $remarks; ?></textarea>

      </div>

      <div class="col-span-4 justify-center flex gap-2">
        <?php
        if (!isset($_GET['vcn'])) { ?>
          <button type="submit" name="addVax" class="w-64 text-white bg-gradient-to-r from-[#00669B]  to-[#9AC1CA] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300  shadow-lg shadow-teal-500/50  font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2">Add Record</button>
        <?php
        } else {
        ?>
          <button type="submit" name="updateVax" class="w-64 text-white bg-gradient-to-r from-[#9b0066]  to-[#ca9ac1] hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300  shadow-lg shadow-pink-500/50  font-medium rounded-lg text-[12px] 2xl:text-sm px-5 py-2.5 text-center me-2 mb-2">Update Record</button>
        <?php
        }
        ?>

      </div>
    </div>
  </form>
</div>



<script>

</script>
