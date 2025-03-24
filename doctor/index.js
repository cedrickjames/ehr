$(document).ready(function () {
  
    $('#clinicVisits').DataTable(  {
    "columnDefs": [
      { "width": "1%", "targets": 0, },
      {"className": "dt-center", "targets": "_all"}
    ],
      responsive: true,
      
      
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
      
    $('#sickLeave').DataTable(  {
        "columnDefs": [
          { "width": "1%", "targets": 0, },
          {"className": "dt-center", "targets": "_all"}
        ],
          responsive: true,
          
        }   );
          
    $('#bloodChem').DataTable(  {
        "columnDefs": [
          { "width": "1%", "targets": 0, },
          {"className": "dt-center", "targets": "_all"}
        ],
          responsive: true,
          
        }   );

        $('#annualPEResult').DataTable(  {
            "columnDefs": [
              { "width": "1%", "targets": 0, },
              {"className": "dt-center", "targets": "_all"}
            ],
              responsive: true,
              
            }   );


            $('#vaccinationRecord').DataTable(  {
                "columnDefs": [
                  { "width": "1%", "targets": 0, },
                  {"className": "dt-center", "targets": "_all"}
                ],
                  responsive: true,
                  
                }   );


                $('#preEmpMedResult').DataTable(  {
                    "columnDefs": [
                      { "width": "1%", "targets": 0, },
                      {"className": "dt-center", "targets": "_all"}
                    ],
                      responsive: true,
                      
                    }   );

                    $('#queTable').DataTable(  {
                      "columnDefs": [
                        { "width": "1%", "targets": 0, },
                        {"className": "dt-center", "targets": "_all"}
                      ],
                        responsive: true,
                        
                      }   );

                      $('#docQueTable').DataTable(  {
                        "columnDefs": [
                          { "width": "1%", "targets": 0, },
                          {"className": "dt-center", "targets": "_all"}
                        ],
                          responsive: true,
                          
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