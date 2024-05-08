<?php

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'hr_management';


$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $query = "SELECT resume FROM application WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);

    
    mysqli_stmt_bind_param($stmt, "i", $id);

    
    mysqli_stmt_execute($stmt);

    
    mysqli_stmt_bind_result($stmt, $resumeContent);

    if (mysqli_stmt_fetch($stmt)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="resume.pdf"');

        
        echo $resumeContent;
        exit;
    } else {
        echo 'Resume not found.';
    }

    mysqli_stmt_close($stmt);
} else {
    echo 'ID parameter is missing.';
}

mysqli_close($con);
?>
