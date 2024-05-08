<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$employee_id = isset($_SESSION['employee']) ? $_SESSION['employee'] : '';

		$sql = "SELECT *, employees.id AS empid 
		FROM employees 
		LEFT JOIN schedules ON schedules.id = employees.schedule_id 
		WHERE employees.employee_id = '$employee_id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>