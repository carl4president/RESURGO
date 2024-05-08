<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
	$conn = new mysqli('localhost', 'root', '', 'OLSHCOHRMS');

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function save_application(){
		extract($_POST);
		$data = " lastname = '$last_name' ";
		$data .= ", firstname = '$first_name' ";
		$data .= ", middlename = '$middle_name' ";
		$data .= ", address = '$address' ";
		$data .= ", contact = '$contact' ";
		$data .= ", email = '$email' ";
		$data .= ", gender = '$gender' ";
		$data .= ", cover_letter = '".htmlentities(str_replace("'","&#x2019;",$cover_letter))."' ";
		$data .= ", position_id = '$position_id' ";
		if(isset($status))
		$data .= ", process_id = '$status' ";

		if($_FILES['resume']['tmp_name'] != ''){
						$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['resume']['name'];
						$move = move_uploaded_file($_FILES['resume']['tmp_name'],'assets/resume/'. $fname);
					$data .= ", resume_path = '$fname' ";

		}
		if(empty($id)){
			// echo "INSERT INTO application set ".$data;
			// exit;
			echo "INSERT INTO application SET " . $data;
			$save = $this->db->query("INSERT INTO application set ".$data);
			if ($save) {
				echo "Data inserted successfully!";
			} else {
				echo "Error: " . $this->db->error;
			}
		}else{
			echo "UPDATE application SET " . $data . " WHERE id=" . $id;
			$save = $this->db->query("UPDATE application set ".$data." where id=".$id);
			
		}
		if($save)
			return 1;
	}

}