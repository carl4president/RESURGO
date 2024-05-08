<?php
include 'includes/session.php';

if (isset($_POST['accept'])) {
    
    $id = $_POST['id'];

    
    $sql = "UPDATE leave_requests SET status = 'Accepted' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "Leave request accepted successfully";
    } else {
        $_SESSION['error'] = "Error accepting leave request: " . $conn->error;
    }
    header("location: leave.php");
} elseif (isset($_POST['reject'])) {
    
    $id = $_POST['id'];

    
    $sql = "UPDATE leave_requests SET status = 'Rejected' WHERE id  = $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "Leave request rejected successfully";
    } else {
        $_SESSION['error'] = "Error rejecting leave request: " . $conn->error;
    }
    header("location: leave.php");
} elseif (isset($_POST['retrieve'])) {
    
    $id = $_POST['id'];

    
    $sql = "UPDATE leave_requests SET status = 'Pending' WHERE id  = $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "Leave request retrieved successfully";
    } else {
        $_SESSION['error'] = "Error rejecting leave request: " . $conn->error;
    }
    header("location: leave_accepted.php");
} elseif (isset($_POST['delete'])) {
    
    $id = $_POST['id'];

    
    $sql = "DELETE FROM leave_requests WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "Leave request deleted successfully";
    } else {
        $_SESSION['error'] = "Error deleting leave request: " . $conn->error;
    }
    header("location: leave_accepted.php");
} elseif (isset($_POST['retrieve_reject'])) {
    
    $id = $_POST['id'];
    

    
    $sql = "UPDATE leave_requests SET status = 'Pending' WHERE id  = $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "Leave request retrieved successfully";
    } else {
        $_SESSION['error'] = "Error rejecting leave request: " . $conn->error;
    }
    header("location: leave_rejected.php");
} elseif (isset($_POST['delete_reject'])) {
    
    $id = $_POST['id'];

    
    $sql = "DELETE FROM leave_requests WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "Leave request deleted successfully";
    } else {
        $_SESSION['error'] = "Error deleting leave request: " . $conn->error;
    }
    header("location: leave_rejected.php");
}


?>
