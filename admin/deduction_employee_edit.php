<?php
include 'includes/session.php';

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $deduction = $_POST['deduction'];
    $type = $_POST['type'];
    $effective_date = ($_POST['type'] == 1 || $_POST['type'] == 2) ? '0000-00-00' : $_POST['effective_date'];

    $sql = "UPDATE employee_deductions 
            SET deduction_id = ?, 
                type = ?, 
                effective_date = ? 
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $deduction, $type, $effective_date, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = 'Employee Deduction updated successfully';
    } else {
        $_SESSION['error'] = $conn->error;
    }

    $stmt->close();
} else {
    $_SESSION['error'] = 'Fill up the edit form first';
}

header('location: deduction_employee.php');
?>
