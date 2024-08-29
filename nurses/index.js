$(document).ready(function () {
  
    $('#clinicVisits').DataTable(  {
    "columnDefs": [
      { "width": "1%", "targets": 0, },
      {"className": "dt-center", "targets": "_all"}
    ],
      responsive: true,
             scrollCollapse: true,
    scrollY: '50vh'
      
    }   );
    
    $('#ftwMainTable').DataTable(  {
      "columnDefs": [
        { "width": "1%", "targets": 0, },
        {"className": "dt-center", "targets": "_all"}
      ],
        responsive: true,
         scrollCollapse: true,
    scrollY: '50vh'
        
      }   );
    $('#medicalRecordTable').DataTable(  {
      "columnDefs": [
        { "width": "1%", "targets": 0, },
        {"className": "dt-center", "targets": "_all"}
      ],
        responsive: true,
         scrollCollapse: true,
    scrollY: '50vh'
        
      }   );

      
    $('#sickLeave').DataTable(  {
        "columnDefs": [
          { "width": "1%", "targets": 0, },
          {"className": "dt-center", "targets": "_all"}
        ],
          responsive: true,
                 scrollCollapse: true,
    scrollY: '50vh'
        }   );
          
    $('#bloodChem').DataTable(  {
        "columnDefs": [
          { "width": "1%", "targets": 0, },
          {"className": "dt-center", "targets": "_all"}
        ],
          responsive: true,
                 scrollCollapse: true,
    scrollY: '50vh'
        }   );

        $('#annualPEResult').DataTable(  {
            "columnDefs": [
              { "width": "1%", "targets": 0, },
              {"className": "dt-center", "targets": "_all"}
            ],
              responsive: true,
                     scrollCollapse: true,
    scrollY: '50vh'
            }   );


            $('#vaccinationRecord').DataTable(  {
                "columnDefs": [
                  { "width": "1%", "targets": 0, },
                  {"className": "dt-center", "targets": "_all"}
                ],
                  responsive: true,
                         scrollCollapse: true,
    scrollY: '50vh'
                }   );


                $('#preEmpMedResult').DataTable(  {
                    "columnDefs": [
                      { "width": "1%", "targets": 0, },
                      {"className": "dt-center", "targets": "_all"}
                    ],
                      responsive: true,
                             scrollCollapse: true,
    scrollY: '50vh'
                    }   );

                    $('#queTable').DataTable(  {
                      "columnDefs": [
                        { "width": "1%", "targets": 0, },
                        {"className": "dt-center", "targets": "_all"}
                      ],
                        responsive: true,
                               scrollCollapse: true,
    scrollY: '50vh'
                      }   );

                      $('#fromDocQueTable').DataTable(  {
                        "columnDefs": [
                          { "width": "1%", "targets": 0, },
                          {"className": "dt-center", "targets": "_all"}
                        ],
                          responsive: true,
                                 scrollCollapse: true,
    scrollY: '50vh'
                        }   );
                      
});

