<?php
session_start();

include("../includes/connect.php");
if (!isset($_SESSION['connected'])) {
  header("location: ../logout.php");
}

if (isset($_GET['employer'])) {
  $employer = $_GET['employer'];
} else {
  $employer = "not found";
}

?>


<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employees Record</title>
<link rel="shortcut icon" href="../src/Logo 2.png">

  <script src="../src/cdn_tailwindcss.js"></script>

  <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>

  <link rel="stylesheet" href="../fontawesome-free-6.2.0-web/css/all.min.css">
  <link rel="stylesheet" href="../node_modules/DataTables/datatables.min.css">

  <link rel="stylesheet" type="text/css" href="../node_modules/DataTables/Responsive-2.3.0/css/responsive.dataTables.min.css" />

</head>

<body class="h-screen bg-no-repeat bg-cover bg-[url('../src/Background.png')]">
  <?php require_once 'navbar.php'; ?>

  <div style=" background: linear-gradient(-45deg, #a6d0ff, rgba(255, 255, 255, 0.63), rgba(255, 255, 255, 0));" class="h-full  ml-56 2xl:ml-[22rem] flex   left-10 right-5  flex-col  px-2   pt-2 2xl:pt-6 pb-14 z-50 ">
    <div class="m-2 ">

      <?php require_once 'directEmployees.php'; ?>



    </div>

  </div>

  <script src="../node_modules/jquery/dist/jquery.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script> -->
  <script type="text/javascript" src="../node_modules/xlsx/dist/xlsx.full.min.js"></script>


  <script type="text/javascript" src="../node_modules/DataTables/datatables.min.js"></script>
  <script type="text/javascript" src="../node_modules/DataTables/Responsive-2.3.0/js/dataTables.responsive.min.js"></script>


  <script type="text/javascript" src="index.js"></script>
  <script>

    <?php
    $sidebar1;

    if($employer=="GPI"){
      $sidebar1 ="#gpiside1";
    }
    else if($employer=="Maxim"){
      $sidebar1 ="#maximside1";

    }
    else if($employer=="Nippi"){
      $sidebar1 ="#nippiside1";

    }
    else if($employer=="Powerlane"){
      $sidebar1 ="#powerlaneside1";

    }
      else if($employer=="Natcorp"){
      $sidebar1 ="#natcorpside1";

    }
    else if($employer=="Otrelo"){
      $sidebar1 ="#otreloside1";

    }
    else if($employer=="Alarm"){
      $sidebar1 ="#alarmside1";

    }
    else if($employer=="Mangreat"){
      $sidebar1 ="#mangreatside1";

    }
    else if($employer=="Canteen"){
      $sidebar1 ="#canteenside1";

    }
    else{
      $sidebar1 ="#all";

    }
    ?>

    $("<?php echo $sidebar1; ?>").addClass("bg-[#82c7cc]");
    $("#empside").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");

    $("#sidehistory").removeClass("bg-gray-200");
    $("#sideMyRequest").removeClass("bg-gray-200");
    $("#sidepms").removeClass("bg-gray-200");

    $("#empside1").addClass("text-white bg-gradient-to-r from-[#004AAD] to-[#5DE0E6]");
    $("#sidehistory1").removeClass("bg-gray-200");
    $("#sideMyRequest1").removeClass("bg-gray-200");
    $("#sidepms1").removeClass("bg-gray-200");
    $(".empIcon").attr("fill", "#FFFFFF");
    $(".homeIcon").attr("fill", "#4d4d4d");



    function activateDeactivate(element){
    if(element.getAttribute("data-activate")== "1"){
      $("#deactivateUser").addClass("hidden");
      $("#separationDate").addClass("hidden");
      $("#activateUser").removeClass("hidden");
    }
    else{
      $("#activateUser").addClass("hidden");
      $("#separationDate").removeClass("hidden");
      $("#deactivateUser").removeClass("hidden");
    }
  document.getElementById("idOfUser").value = element.getAttribute("data-id");
    $('#nameofUser').text(element.getAttribute("data-name"));

    if(element.getAttribute("data-activate") == '1'){

    $('#activateDeactivateText').text("activate");

    }
    else{
    $('#activateDeactivateText').text("deactivate");

    }


  modaldeactivate.toggle();
}
  
const $targetDeactivateUser = document.getElementById('activateDeactivate');
  const deactivateModal = {
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
  const modaldeactivate = new Modal($targetDeactivateUser, deactivateModal);




    
document.getElementById('proceedImportButton').addEventListener('click', () => {
  const fileInput = document.getElementById('file_input');
  const file = fileInput.files[0];

  if (!file) {
    alert("Please select a file to upload.");
    return;
}
const reader = new FileReader();

reader.onload = (event) => {
    const data = new Uint8Array(event.target.result);
    const workbook = XLSX.read(data, { type: 'array' });

    // Assuming the first sheet contains the data
    const sheetName = workbook.SheetNames[0];
    const sheet = workbook.Sheets[sheetName];

    // Convert sheet data to JSON
    const jsonData = XLSX.utils.sheet_to_json(sheet, { header: 1 });
    const departments = jsonData.slice(1).map(row => row[10]);
    const uniqueDepartments = [...new Set(departments)];
console.log(uniqueDepartments);
document.getElementById("departmentFormat1").value=uniqueDepartments;



    const sex = jsonData.slice(1).map(row => row[5]);
    const uniqueSex = [...new Set(sex)];
    document.getElementById("sexFormat1").value=uniqueSex;
    const civil = jsonData.slice(1).map(row => row[7]);
    const uniquecivil = [...new Set(civil)];
    document.getElementById("civilFormat1").value=uniquecivil;
    // Display or process the data


                        var increment = 1;

    uniqueDepartments.forEach(department => {
     
    $('#departmentDiv').append(
  '<div class="flex justify-center border border-gray-300">'+department+'</div>' +   `<select id="department`+increment+`" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected disabled>Select Department</option>
                            <?php
                          
                            $sql = "SELECT * FROM `department` ORDER BY `department` ASC;";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {

                            ?>
                            <option value="<?php echo $row['department']; ?> "><?php echo $row['department']; ?> </option>
                            <?php }?>

                        </select>`
);
increment++;

    })

    var incrementSex = 1;
    uniqueSex.forEach(sex => {
    $('#sexDiv').append(
  '<div class="flex justify-center border border-gray-300">'+sex+'</div>' + `<select  id="sex`+incrementSex+`" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected disabled>Select Sex</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>`
);
incrementSex++;
    })
    var incrementCivil = 1;
    uniquecivil.forEach(civil => {
    $('#civilDiv').append(
  '<div class="flex justify-center border border-gray-300">'+civil+'</div>' +   `<select id="civil`+incrementCivil+`" class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full px-2.5 py-1.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected disabled>Select Status</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="divorced">Divorced</option>
                            <option value="annulled">Annulled</option>
                            <option value="widowed">Widowed</option>

                        </select>`
);
incrementCivil++;

    })


    document.getElementById("proceedButton").addEventListener("click", function() {
      $("#addNewEmployeesImport").removeClass("hidden");
      $("#proceedImportButton").addClass("hidden");

      var uniqueDepartmentsArray = []; 
      var uniqueSexArray = []; 
      var uniqueCivilrray = []; 

      // console.log("Number of unique departments:", uniqueDepartments.length);
      for(var i=1; i<=uniqueDepartments.length; i++){
        var dept = "department"+i;
        // console.log(document.getElementById(dept).value);
        const deptValues = document.getElementById(dept).value;
        uniqueDepartmentsArray.push(deptValues);
        // console.log(deptValues); 
      }
      for(var i=1; i<=uniqueSex.length; i++){
        var sex = "sex"+i;
        console.log(document.getElementById(sex).value);
        const sexValues = document.getElementById(sex).value;
        uniqueSexArray.push(sexValues);
        // console.log(sexValues); 
      }
      for(var i=1; i<=uniquecivil.length; i++){
        var civil = "civil"+i;
        console.log(document.getElementById(civil).value);
        const civilValues = document.getElementById(civil).value;
        uniqueCivilrray.push(civilValues);
        // console.log(civilValues); 
      }
      console.log(uniqueDepartmentsArray); 
document.getElementById("departmentFormat2").value=uniqueDepartmentsArray;
document.getElementById("sexFormat2").value=uniqueSexArray;
document.getElementById("civilFormat2").value=uniqueCivilrray;




    });


    // document.getElementById('output').innerText = JSON.stringify(jsonData, null, 2);
};

reader.readAsArrayBuffer(file);
});



    const $targetEl = document.getElementById('sidebar');

    const options = {
      placement: 'left',
      backdrop: false,
      bodyScrolling: true,
      edge: false,
      edgeOffset: '',
      backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-30',
      onHide: () => {
        console.log('drawer is hidden');
      },
      onShow: () => {
        console.log('drawer is shown');
      },
      onToggle: () => {
        console.log('drawer has been toggled');
      }
    };

    const drawer = new Drawer($targetEl, options);
    drawer.show();
    var show = true;


    var screenWidth = window.screen.width; // Screen width in pixels
    var screenHeight = window.screen.height; // Screen height in pixels

    console.log("Screen width: " + screenWidth);
    console.log("Screen height: " + screenHeight);
    var sidebar = 0;



    function shows() {
      if (show) {
        drawer.hide();
        show = false;
      } else {
        drawer.show();
        show = true;
      }
      // var sidebar=0;
      if (sidebar == 0) {
        document.getElementById("mainContent").style.width = "100%";
        document.getElementById("mainContent").style.marginLeft = "0px";
        // document.getElementById("sidebar").style.opacity= ""; 
        // document.getElementById("sidebar").style.transition = "all .1s";

        document.getElementById("mainContent").style.transition = "all .3s";






        sidebar = 1;
      } else {
        document.getElementById("mainContent").style.width = "calc(100% - 288px)";
        document.getElementById("mainContent").style.marginLeft = "288px";

        sidebar = 0;
      }


    }

    if (screenWidth <= 1132) {
      shows();

    } else {
      drawer.show();
      // sidebar=0;/

    }
  </script>
</body>

</html>