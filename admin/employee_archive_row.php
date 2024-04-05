<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, employees_archive.id as empid FROM employees_archive LEFT JOIN vacancy ON vacancy.id=employees_archive.position_id LEFT JOIN schedules ON schedules.id=employees_archive.schedule_id WHERE employees_archive.id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>