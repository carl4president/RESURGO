<?php
    include 'includes/session.php';

    if (isset($_POST['add'])) {
        $employee_id = $_POST['employee'];
        $date = $_POST['date'];
        $hours = $_POST['hours'] + ($_POST['mins'] / 60);
        $rate = $_POST['rate'];

        $sql = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
        $query = $conn->query($sql);

        if ($query->num_rows < 1) {
            $_SESSION['error'] = 'Employee not found';
        } else {
            $existingRecordSql = "SELECT * FROM overtime WHERE employee_id = '$employee_id' AND date_overtime = '$date'";
            $existingRecordQuery = $conn->query($existingRecordSql);

            if ($existingRecordQuery->num_rows > 0) {
              
                $totalOvertimePay = $rate * $hours;
                $updateSql = "UPDATE overtime SET hours = '$hours', rate = '$rate', total_overtime_pay = '$totalOvertimePay' WHERE employee_id = '$employee_id' AND date_overtime = '$date'";
                if ($conn->query($updateSql)) {
                    $_SESSION['success'] = 'Overtime updated successfully';
                } else {
                    $_SESSION['error'] = $conn->error;
                }
            } else {
                
                $totalOvertimePay = $rate * $hours;
                $insertSql = "INSERT INTO overtime (employee_id, date_overtime, hours, rate, total_overtime_pay) VALUES ('$employee_id', '$date', '$hours', '$rate', '$totalOvertimePay')";
                if ($conn->query($insertSql)) {
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
