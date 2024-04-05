<?php
include 'includes/session.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "SELECT *, employee_deductions.id as empid FROM employee_deductions LEFT JOIN deductions ON deductions.id=employee_deductions.deduction_id LEFT JOIN employees ON employees.employee_id=employee_deductions.employee_id
    WHERE employee_deductions.id = '$id'";

    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    echo json_encode($row);
}
?>
