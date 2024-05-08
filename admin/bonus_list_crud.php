<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$description = $_POST['description'];
		$amount = $_POST['amount'];
		
		$sql = "INSERT INTO bonus (description, amount) VALUES (?, ?)";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("si", $description, $amount);
		if($stmt->execute()){
			$_SESSION['success'] = 'Bonus added successfully';
		}
		else{
			$_SESSION['error'] = $stmt->error;
		}
	}
	elseif(isset($_POST['edit'])){
		$id = $_POST['id'];
        $description = $_POST['description'];
		$amount = $_POST['amount'];
		
		$sql = "UPDATE bonus SET description = ?, amount = ? WHERE id = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("sii", $description, $amount, $id);
		if($stmt->execute()){
			$_SESSION['success'] = 'Bonus updated successfully';
		}
		else{
			$_SESSION['error'] = $stmt->error;
		}
	}
	elseif(isset($_POST['delete'])){
	    $id = $_POST['id'];
	    $sql = "DELETE FROM bonus WHERE id = ?";
	    $stmt = $conn->prepare($sql);
	    $stmt->bind_param("i", $id);
	    if($stmt->execute()){
	        $_SESSION['success'] = 'Bonus deleted successfully';
	    }
	    else{
	        $_SESSION['error'] = $stmt->error;
	    }
	}
	else{
	    $_SESSION['error'] = 'Invalid action';
	}

	header('location: bonus_list.php');
	exit(); 
?>