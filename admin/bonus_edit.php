<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$description = $_POST['description'];
        $date_bonus = $_POST['edit_date_bonus'];
		
		$sql = "UPDATE employee_bonus SET date_bonus = '$date_bonus', bonus_id = '$description' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Emoloyee Bonus updated successfully';
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