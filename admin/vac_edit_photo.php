<?php
	include 'includes/session.php';

	if(isset($_POST['upload'])){
		$vacid = $_POST['id'];
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
		
		$sql = "UPDATE vacancy SET banner = ? WHERE id = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("si", $filename, $vacid);
		if($stmt->execute()){
			$_SESSION['success'] = 'Vacancy photo updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
		$stmt->close();
	}
	else{
		$_SESSION['error'] = 'Select employee to update photo first';
	}

	header('location: vacancy.php');
?>
