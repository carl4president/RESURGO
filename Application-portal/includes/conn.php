<?php
	$conn = new mysqli('localhost', 'root', '', 'OLSHCOHRMS');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>