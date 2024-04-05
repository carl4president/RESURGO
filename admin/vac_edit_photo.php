<?php
	include 'includes/session.php';

	if(isset($_POST['upload'])){
		$vacid = $_POST['id'];
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
		
		$sql = "UPDATE vacancy SET photo = '$filename' WHERE id = '$vacid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Vacancy photo updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Select employee to update photo first';
	}

	header('location: vacancy.php');
?>