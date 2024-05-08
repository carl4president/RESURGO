<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT lr.*, e.firstname, e.middlename, e.lastname 
				FROM leave_requests lr 
				JOIN employees e ON lr.employee_id = e.employee_id 
				WHERE lr.id = $id";

		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>
