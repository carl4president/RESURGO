<?php
	$conn = new mysqli('localhost', 'u625829254_resurgo', 'Resurgo21', 'u625829254_resurgo');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>