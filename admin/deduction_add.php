<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$description = $_POST['description'];
		$amount = $_POST['amount'];

		$sql = "INSERT INTO deductions (deduction, amount) VALUES (?, ?)";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ss", $description, $amount);
		if($stmt->execute()){
			$_SESSION['success'] = 'Deduction added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		$stmt->close();
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: deduction.php');
?>
