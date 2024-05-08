<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$description = $_POST['description'];
		$amount = $_POST['amount'];
		
		$sql = "INSERT INTO bonus (description, amount) VALUES ('$description', '$amount')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Bonus added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	elseif(isset($_POST['edit'])){
		$id = $_POST['id'];
        $description = $_POST['description'];
		$amount = $_POST['amount'];
		
		$sql = "UPDATE bonus SET description = '$description', amount = '$amount' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Bonus updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	elseif(isset($_POST['delete'])){
	    $id = $_POST['id'];
	    $sql = "DELETE FROM bonus WHERE id = '$id'";
	    if($conn->query($sql)){
	        $_SESSION['success'] = 'Bonus deleted successfully';
	    }
	    else{
	        $_SESSION['error'] = $conn->error;
	    }
	}
	else{
	    $_SESSION['error'] = 'Invalid action';
	}

	header('location: bonus_list.php');
	exit(); 
?>
