<?php
        include 'includes/session.php';
        
        if(isset($_POST['edit'])){
        	$id = $_POST['id'];
        	$title = $_POST['title'];
        	$availability = $_POST['availability'];
        	$rate = $_POST['rate'];
        
        	$sql = "UPDATE vacancy SET position = ?, availability = ?, rate = ? WHERE id = ?";
        	$stmt = $conn->prepare($sql);
        	$stmt->bind_param("ssdi", $title, $availability, $rate, $id);
        
        	if($stmt->execute()){
        		$_SESSION['success'] = 'Position updated successfully';
        	}
        	else{
        		$_SESSION['error'] = $conn->error;
        	}
        }
        else{
        	$_SESSION['error'] = 'Fill up edit form first';
        }
        
        header('location:position.php');

?>