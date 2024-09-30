$(document).ready(function () {
  
    $('#clinicVisits').DataTable(  {
      "pageLength": 3000,
    "columnDefs": [
      { "width": "1%", "targets": 0, },
      {"className": "dt-center", "targets": "_all"}
    ],
      responsive: true,
      
      
    }   );
      
    $('#sickLeave').DataTable(  {
      "pageLength": 3000,
        "columnDefs": [
          { "width": "1%", "targets": 0, },
          {"className": "dt-center", "targets": "_all"}
        ],
          responsive: true,
          
        }   );
          
    $('#bloodChem').DataTable(  {
      "pageLength": 3000,
        "columnDefs": [
          { "width": "1%", "targets": 0, },
          {"className": "dt-center", "targets": "_all"}
        ],
          responsive: true,
          
        }   );

        $('#annualPEResult').DataTable(  {
          "pageLength": 3000,
            "columnDefs": [
              { "width": "1%", "targets": 0, },
              {"className": "dt-center", "targets": "_all"}
            ],
              responsive: true,
              
            }   );

            $('#vaccinationRecord').DataTable(  {
              "pageLength": 3000,
                "columnDefs": [
                  { "width": "1%", "targets": 0, },
                  {"className": "dt-center", "targets": "_all"}
                ],
                  responsive: true,
                  
                }   );


                $('#preEmpMedResult').DataTable(  {
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
                        responsive: true,
                        
                      }   );

                      $('#fromDocQueTable').DataTable(  {
                        "pageLength": 3000,
                        "columnDefs": [
                          { "width": "1%", "targets": 0, },
                          {"className": "dt-center", "targets": "_all"}
                        ],
                          responsive: true,
                          
                        }   );
                      
});