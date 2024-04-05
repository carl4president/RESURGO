<?php

include 'includes/session.php';

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $position = $_POST['position'];
    $availability = $_POST['availability'];
    $status = $_POST['status'];
    $description = $_POST['description'];


    
    $sql = "UPDATE vacancy SET
            position = ?,
            availability = ?,
            status = ?,
            description = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        
        mysqli_stmt_bind_param($stmt, "ssssi", $position, $availability, $status, $description, $id);

        
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            $_SESSION['success'] = 'Vacancy updated successfully';
        } else {
            
            echo json_encode(['status' => 'error', 'message' => 'Error updating vacancy']);
        }

        
        mysqli_stmt_close($stmt);
    } else {
        
        echo json_encode(['status' => 'error', 'message' => 'Error preparing statement']);
    }
} else {
    
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

header('location:vacancy.php');
?>
