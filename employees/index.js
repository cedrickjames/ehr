
$(document).ready(function () {
  
    $('#clinicVisits').DataTable(  {
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
      
    $('#sickLeave').DataTable(  {
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
          
    $('#bloodChem').DataTable(  {
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

        $('#annualPEResult').DataTable(  {
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


            $('#vaccinationRecord').DataTable(  {
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


                $('#preEmpMedResult').DataTable(  {
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

                    $('#queTable').DataTable(  {
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

                      $('#fromDocQueTable').DataTable(  {
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
