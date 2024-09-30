$(document).ready(function () {
  
    $('#clinicVisits').DataTable(  {
      "pageLength": 3000,
    "columnDefs": [
      { "width": "1%", "targets": 0, },
      {"className": "dt-center", "targets": "_all"}
    ],
      responsive: true,
             scrollCollapse: false,
             
    scrollY: '50vh'
      
    }   );
    
    $('#ftwMainTable').DataTable(  {
      "pageLength": 3000,
      "columnDefs": [
        { "width": "1%", "targets": 0, },
        {"className": "dt-center", "targets": "_all"}
      ],
        responsive: true,
         scrollCollapse: false,
    scrollY: '50vh'
        
      }   );
    $('#medicalRecordTable').DataTable(  {
      "pageLength": 3000,
      "columnDefs": [
        { "width": "1%", "targets": 0, },
        {"className": "dt-center", "targets": "_all"}
      ],
        responsive: true,
         scrollCollapse: false,
    scrollY: '50vh'
        
      }   );

      
    $('#sickLeave').DataTable(  {
      "pageLength": 3000,
        "columnDefs": [
          { "width": "1%", "targets": 0, },
          {"className": "dt-center", "targets": "_all"}
        ],
          responsive: true,
                 scrollCollapse: false,
    scrollY: '50vh'
        }   );
          
    $('#bloodChem').DataTable(  {
      "pageLength": 3000,
        "columnDefs": [
          { "width": "1%", "targets": 0, },
          {"className": "dt-center", "targets": "_all"}
        ],
          responsive: true,
                 scrollCollapse: false,
    scrollY: '50vh'
        }   );

        $('#annualPEResult').DataTable(  {
          "pageLength": 3000,
            "columnDefs": [
              { "width": "1%", "targets": 0, },
              {"className": "dt-center", "targets": "_all"}
            ],
              responsive: true,
                     scrollCollapse: false,
    scrollY: '50vh'
            }   );


            $('#vaccinationRecord').DataTable(  {
              "pageLength": 3000,
                "columnDefs": [
                  { "width": "1%", "targets": 0, },
                  {"className": "dt-center", "targets": "_all"}
                ],
                  responsive: true,
                         scrollCollapse: false,
    scrollY: '50vh'
                }   );


                $('#preEmpMedResult').DataTable(  {
                  "pageLength": 3000,
                    "columnDefs": [
                      { "width": "1%", "targets": 0, },
                      {"className": "dt-center", "targets": "_all"}
                    ],
                      responsive: true,
                             scrollCollapse: false,
    scrollY: '50vh'
                    }   );

                    $('#queTable').DataTable(  {
                      "pageLength": 3000,
                      
                      "columnDefs": [
                        { "width": "1%", "targets": 0, },
                        {"className": "dt-center", "targets": "_all"}
                      ],
                        responsive: true,
                               scrollCollapse: false,
    scrollY: '50vh'
                      }   );

                      $('#fromDocQueTable').DataTable(  {
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

