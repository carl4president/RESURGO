<?php
    include 'includes/session.php';

    if (isset($_POST['add'])) {
        $employee_id = $_POST['employee'];
        $date = $_POST['date'];
        $hours = $_POST['hours'] + ($_POST['mins'] / 60);
        $rate = $_POST['rate'];

        $sql = "SELECT * FROM employees WHERE employee_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $employee_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows < 1) {
            $_SESSION['error'] = 'Employee not found';
        } else {
            $existingRecordSql = "SELECT * FROM overtime WHERE employee_id = ? AND date_overtime = ?";
            $existingRecordStmt = $conn->prepare($existingRecordSql);
            $existingRecordStmt->bind_param("ss", $employee_id, $date);
            $existingRecordStmt->execute();
            $existingRecordResult = $existingRecordStmt->get_result();

            if ($existingRecordResult->num_rows > 0) {
                $totalOvertimePay = $rate * $hours;
                $updateSql = "UPDATE overtime SET hours = ?, rate = ?, total_overtime_pay = ? WHERE employee_id = ? AND date_overtime = ?";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->bind_param("dddis", $hours, $rate, $totalOvertimePay, $employee_id, $date);
                if ($updateStmt->execute()) {
                    $_SESSION['success'] = 'Overtime updated successfully';
                } else {
                    $_SESSION['error'] = $conn->error;
                }
            } else {
                $totalOvertimePay = $rate * $hours;
                $insertSql = "INSERT INTO overtime (employee_id, date_overtime, hours, rate, total_overtime_pay) VALUES (?, ?, ?, ?, ?)";
                $insertStmt = $conn->prepare($insertSql);
                $insertStmt->bind_param("ssdds", $employee_id, $date, $hours, $rate, $totalOvertimePay);
                if ($insertStmt->execute()) {
                    $_SESSION['success'] = 'Overtime added successfully';
                } else {
                    $_SESSION['error'] = $conn->error;
                }
            }
        }
    } else {
        $_SESSION['error'] = 'Fill up add form first';
    }

    header('location: overtime.php');
?>
