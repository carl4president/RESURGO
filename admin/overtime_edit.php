<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$employee_id = $_POST['employee_id'];
		$date = $_POST['date'];
		$hours = $_POST['hours'] + ($_POST['mins'] / 60);
		$rate = $_POST['rate'];

		$totalOvertimePay = $rate * $hours;

		$existingRecordSql = "SELECT * FROM overtime WHERE employee_id = '$employee_id' AND date_overtime = '$date'";
		$existingRecordQuery = $conn->query($existingRecordSql);

		if ($existingRecordQuery->num_rows > 0) {
			
			$_SESSION['error'] = 'Employee Overtime is already exist';
		} else {
			
			$sql = "UPDATE overtime SET hours = '$hours', rate = '$rate', total_overtime_pay = '$totalOvertimePay', date_overtime = '$date' WHERE id = '$id'";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Overtime updated successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:overtime.php');
?>
