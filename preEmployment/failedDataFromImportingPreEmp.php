<?php
session_start(); // Ensure session is started to access session variables

// Retrieve failed data from the session
$failedData = isset($_SESSION['failedData']) ? $_SESSION['failedData'] : [];

// Set headers to prompt file download as CSV
header("Content-Type: text/csv; charset=utf-8");
header("Content-Disposition: attachment; filename=Failed_Data_from_Importing_Pre_Emp.csv");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);

// Open PHP output stream for CSV
$output = fopen('php://output', 'w');

// Add CSV headers



fputcsv($output, [
    'Name','Email','Birthday','Age','Sex','Address','Civil Status','Employer','Building','Department','Section','Position','Date Hired','Date Received', 'Date Performed','IMC','OEH', 'PE', 'CBC', 'U/A', 'FA', 'CXR', 'VA', 'DEN', 'DT', 'PT', 'Other Test', 'Follow Up Status', 'Status', 'Attendee', 'Compliance Date', 'FMC'
]);

// Write the failed data rows to the CSV
if (!empty($failedData)) {
    foreach ($failedData as $row) {
        // Ensure $row is an array; fputcsv will write it directly
        if (is_array($row)) {
            fputcsv($output, $row);
        }
    }
}

// Close the output stream and exit to complete file download
fclose($output);

exit();
// header("Location: index.php");
?>
