<?php
	include 'includes/session.php';

    if(isset($_POST['edit'])){
    	$id = $_POST['id'];
    	$description = $_POST['description'];
    	$amount = $_POST['amount'];
    
    	$sql = "UPDATE deductions SET deduction = ?, amount = ? WHERE id = ?";
    	$stmt = $conn->prepare($sql);
    	$stmt->bind_param("sdi", $description, $amount, $id);
    	if($stmt->execute()){
    		$_SESSION['success'] = 'Deduction updated successfully';
    	}
    	else{
    		$_SESSION['error'] = $conn->error;
    	}
    	$stmt->close();
    }
    else{
    	$_SESSION['error'] = 'Fill up edit form first';
    }
    
    header('location:deduction.php');
?>
