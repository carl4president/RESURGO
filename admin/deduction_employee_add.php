<?php
include 'includes/session.php';

if (isset($_POST['add'])) {
    $employee_id = $_POST['employee_id'];
    $deduction = $_POST['deduction'];
    $type = $_POST['type'];
    $effective_date = ($type == 3) ? $_POST['effective_date'] : null;


    $sql = "INSERT INTO employee_deductions (employee_id, deduction_id, type, effective_date) 
            VALUES ('$employee_id', '$deduction', '$type', '$effective_date')";

    if ($conn->query($sql)) {
        $_SESSION['success'] = 'Employee Deduction added successfully';
    } else {
        $_SESSION['error'] = $conn->error;
    }
} else {
    $_SESSION['error'] = 'Fill up add form first';
}

header('location: deduction_employee.php'); 
?>
