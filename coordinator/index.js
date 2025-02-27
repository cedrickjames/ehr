$(document).ready(function () {
  
    $('#deptHeadTable').DataTable(  {
      "pageLength": 3000,
    "columnDefs": [
      { "width": "1%", "targets": 0, },
      {"className": "dt-center", "targets": "_all"}
    ],
      responsive: true,
      
      
    }   );

    $('#queTable').DataTable(  {
      "pageLength": 3000,
      "columnDefs": [
        { "width": "1%", "targets": 0, },
        {"className": "dt-center", "targets": "_all"}
      ],
      order: [[2, "asc"]],
        responsive: true,
        scrollCollapse: false,
scrollY: '50vh',
scrollCollapse: false
      }   );


      $('#employeeTable').DataTable(  {
        "pageLength": 3000,
        "columnDefs": [
          { "width": "1%", "targets": 0, },
          {"className": "dt-center", "targets": "_all"}
        ],
          responsive: true,
          scrollCollapse: false,
  scrollY: '50vh',
  scrollCollapse: false
        }   );
      

      
  
});