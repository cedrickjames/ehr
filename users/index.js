$(document).ready(function () {
  
    $('#usersTable').DataTable(  {
      "pageLength": 3000,
    "columnDefs": [
      { "width": "1%", "targets": 0, },
      {"className": "dt-center", "targets": "_all"}
    ],
      responsive: true,
             scrollCollapse: false,
             
    scrollY: '50vh'
      
    }   );
    
    
                      
});

