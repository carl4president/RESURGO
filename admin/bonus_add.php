<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$employee = $_POST['employee'];
		$description = $_POST['description'];
		$date_bonus = $_POST['date_bonus'];
		
		$sql = "SELECT * FROM employees WHERE employee_id = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("s", $employee);
		$stmt->execute();
		$result = $stmt->get_result();
		
		if($result->num_rows < 1){
			$_SESSION['error'] = 'Employee not found';
		}
		else{
			$row = $result->fetch_assoc();
			$employee_id = $row['employee_id'];
			$sql = "INSERT INTO employee_bonus (employee_id, date_bonus, bonus_id) VALUES (?, ?, ?)";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("sss", $employee_id, $date_bonus, $description);
			if($stmt->execute()){
				$_SESSION['success'] = 'Employee Bonus added successfully';
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
