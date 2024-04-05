<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$time_in = $_POST['time_in'];
		$time_in = date('H:i:s', strtotime($time_in));
		$time_out = $_POST['time_out'];
		$time_out = date('H:i:s', strtotime($time_out));

		$time_in_obj = DateTime::createFromFormat('H:i:s', $time_in);
		$time_out_obj = DateTime::createFromFormat('H:i:s', $time_out);


		$interval = $time_in_obj->diff($time_out_obj);
		$hours = $interval->format('%h');
		$minutes = $interval->format('%i');
		$total_hours = $hours + ($minutes / 60);

		$sql = "UPDATE schedules SET time_in = '$time_in', time_out = '$time_out', total_hours = '$total_hours' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Schedule updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:schedule.php');
?>
