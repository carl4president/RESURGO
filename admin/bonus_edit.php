<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$description = $_POST['description'];
        $date_bonus = $_POST['edit_date_bonus'];
		
		$sql = "UPDATE employee_bonus SET date_bonus = ?, bonus_id = ? WHERE id = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ssi", $date_bonus, $description, $id);
		if($stmt->execute()){
			$_SESSION['success'] = 'Employee Bonus updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:bonus.php');
?>
