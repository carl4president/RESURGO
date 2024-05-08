<?php
include 'includes/session.php';

if (isset($_POST['delete'])) {
    
    $id = $_POST['id'];
    
    $sql = "DELETE FROM employee_deductions WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = 'Employee Deduction deleted successfully';
    } else {
        $_SESSION['error'] = $stmt->error;
    }

    $stmt->close();
} else {
    $_SESSION['error'] = 'Select item to delete first';
}

header('location: deduction_employee.php');
?>
