<?php
include 'includes/session.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "SELECT *, employee_deductions.id as empid FROM employee_deductions LEFT JOIN deductions ON deductions.id=employee_deductions.deduction_id LEFT JOIN employees ON employees.employee_id=employee_deductions.employee_id
    WHERE employee_deductions.id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    echo json_encode($row);
}
?>
