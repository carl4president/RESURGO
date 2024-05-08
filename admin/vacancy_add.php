<?php
include 'includes/session.php';

if (isset($_POST['save'])) {
    $filename = isset($_FILES['photo']['name']) ? $_FILES['photo']['name'] : null;
    if(!empty($filename)){
        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
    }
    $position = $_POST['position'];
    $availability = $_POST['availability'];
    $status = $_POST['status'];
    $description = $_POST['description'];

    
    $check_sql = "SELECT * FROM vacancy WHERE position = ?";
    $check_stmt = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($check_stmt, "s", $position);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        
        $_SESSION['error'] = 'The vacancy for a ' . $position . ' is Already Exists; Go Ahead and Perform the Edit.';
    } else {
        
        $insert_sql = "INSERT INTO vacancy (photo, position, availability, status, description) VALUES (?, ?, ?, ?, ?)";
        $insert_stmt = mysqli_prepare($conn, $insert_sql);
        mysqli_stmt_bind_param($insert_stmt, "sssis", $filename, $position, $availability, $status, $description);
        $result = mysqli_stmt_execute($insert_stmt);

        if ($result) {
            $_SESSION['success'] = 'Vacancy added successfully';
        } else {
            
            echo json_encode(['status' => 'error', 'message' => 'Error adding vacancy']);
        }

        
        mysqli_stmt_close($insert_stmt);
    }

    
    mysqli_stmt_close($check_stmt);
} else {
    
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}


header('location:vacancy.php');
?>
