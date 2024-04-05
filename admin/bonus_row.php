<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, employee_bonus.id AS beid, employees.employee_id AS empid FROM employee_bonus LEFT JOIN employees ON employees.employee_id = employee_bonus.employee_id LEFT JOIN bonus ON bonus.id = employee_bonus.bonus_id WHERE employee_bonus.id='$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>