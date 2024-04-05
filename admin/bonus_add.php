<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$employee = $_POST['employee'];
		$description = $_POST['description'];
		$date_bonus = $_POST['date_bonus'];
		
		$sql = "SELECT * FROM employees WHERE employee_id = '$employee'";
		$query = $conn->query($sql);
		if($query->num_rows < 1){
			$_SESSION['error'] = 'Employee not found';
		}
		else{
			$row = $query->fetch_assoc();
			$employee_id = $row['employee_id'];
			$sql = "INSERT INTO employee_bonus (employee_id, date_bonus, bonus_id) VALUES ('$employee_id', '$date_bonus', '$description')";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Emoloyee Bonus added successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: bonus.php');

?>