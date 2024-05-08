<?php
include 'includes/session.php';

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $employee_id = $_POST['employee_id'];
    $date = $_POST['date'];
    $hours = $_POST['hours'] + ($_POST['mins'] / 60);
    $rate = $_POST['rate'];

    $totalOvertimePay = $rate * $hours;

        $sql = "UPDATE overtime SET hours = ?, rate = ?, total_overtime_pay = ?, date_overtime = ? WHERE id = ?";
        $updateQuery = $conn->prepare($sql);
        $updateQuery->bind_param("dddsi", $hours, $rate, $totalOvertimePay, $date, $id);
        if ($updateQuery->execute()) {
            $_SESSION['success'] = 'Overtime updated successfully';
        } else {
            $_SESSION['error'] = $conn->error;
        }
} else {
    $_SESSION['error'] = 'Fill up edit form first';
}

header('location:overtime.php');

?>
