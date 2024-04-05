<?php

include 'con.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['delete'])) {
        
        $job_id = isset($_POST['job_id']) ? $_POST['job_id'] : null;

        
        if ($job_id !== null) {
            
            $query = "DELETE FROM jobs WHERE id = ?";
            $stmt = $con->prepare($query);

            
            $stmt->bind_param("i", $job_id);

            
            $result = $stmt->execute();

            
            if ($result) {
                echo "<script>alert('Job deleted successfully.')</script>";
                echo "<script>window.location.replace('recruitment.php');</script>";
            } else {
                echo 'Error executing the statement: ' . $stmt->error;
            }

            
            $stmt->close();
        } else {
            echo 'Invalid job ID';
        }
    } else {
        echo 'Delete button not clicked';
    }
} else {
    echo 'Invalid request method';
}


$con->close();
?>
