<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$time_in = $_POST['time_in'];
		$time_in = date('H:i:s', strtotime($time_in));
		$time_out = $_POST['time_out'];
		$time_out = date('H:i:s', strtotime($time_out));

		$time_in_obj = new DateTime($time_in);
		$time_out_obj = new DateTime($time_out);
		$interval = $time_in_obj->diff($time_out_obj);
		$hours = $interval->format('%h');
		$minutes = $interval->format('%i');
		$total_hours = $hours + ($minutes / 60);

		$sql = "INSERT INTO schedules (time_in, time_out, total_hours) VALUES ('$time_in', '$time_out', '$total_hours')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Schedule added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: schedule.php');

?>