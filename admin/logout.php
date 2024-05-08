<?php
	session_start();
	session_destroy();

	header('location: ../employee_portal/index.php');
?>