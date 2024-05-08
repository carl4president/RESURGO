<?php
include 'includes/session.php';

if (isset($_POST['add'])) {
    $employee_id = $_POST['employee_id'];
    $deduction = $_POST['deduction'];
    $type = $_POST['type'];
     $effective_date = ($_POST['type'] == 1 || $_POST['type'] == 2) ? '0000-00-00' : $_POST['effective_date'];


    $sql = "INSERT INTO employee_deductions (employee_id, deduction_id, type, effective_date) 
            VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siii", $employee_id, $deduction, $type, $effective_date);

    if ($stmt->execute()) {
        $_SESSION['success'] = 'Employee Deduction added successfully';
    } else {
        $_SESSION['error'] = $conn->error;
    }
} else {
    $_SESSION['error'] = 'Fill up add form first';
}

header('location: deduction_employee.php'); 
?>
