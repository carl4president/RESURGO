<?php
include 'includes/session.php';

if (isset($_POST['delete'])) {
    
    $id = $_POST['id'];
    $status = 1;
    
        $updateQuery = "UPDATE employees SET status = ? WHERE id = ?";
    
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("is", $status, $id);
        $stmt->execute();
    
        header("Location: employee.php");
        exit();

            } 
elseif (isset($_POST['retrieve'])) {
    
    $id = $_POST['id'];
    $status = 0;
    
        $updateQuery = "UPDATE employees SET status = ? WHERE id = ?";
    
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("is", $status, $id);
        $stmt->execute();

                header("Location: employee_archive.php");
                exit();
            }
?>