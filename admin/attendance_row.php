<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
        $id = $_POST['id'];
        $sql = "SELECT *, attendance.id as attid FROM attendance LEFT JOIN employees ON employees.employee_id=attendance.employee_id WHERE attendance.id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();


		echo json_encode($row);
	}
?>