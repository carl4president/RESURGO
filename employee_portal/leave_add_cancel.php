<?php
include 'includes/session.php';

if (isset($_POST['add'])) {
    $employee = $_POST['employee_id'];
    $leaveType = ($_POST['leave_type'] === 'Other') ? $_POST['other_leave_type'] : $_POST['leave_type'];
    $dateRange = $_POST['date_range'];
    list($startDate, $endDate) = explode(" - ", $dateRange);
    $startDate = date('Y-m-d', strtotime($startDate)); 
    $endDate = date('Y-m-d', strtotime($endDate));     
    $reason = $_POST['reason'];
    $startDateTime = new DateTime($startDate);
    $endDateTime = new DateTime($endDate);
    $duration = $startDateTime->diff($endDateTime)->days;
    $status = 'Pending';

    $sql = "INSERT INTO leave_requests (employee_id, leave_type, start_date, end_date, duration, reason, status, date_requested)
    VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $employee, $leaveType, $startDate, $endDate, $duration, $reason, $status);
    if ($stmt->execute()) {
        $_SESSION['success'] = "Leave request added successfully";
    } else {
        $_SESSION['error'] = "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
} elseif (isset($_POST['cancel'])) {
    $id = $_POST['id'];
    
    $sql = "UPDATE leave_requests SET status = 'Cancelled' WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $_SESSION['success'] = "Leave request cancelled successfully";
    } else {
        $_SESSION['error'] = "Error cancelling leave request: " . $conn->error;
    }
    $stmt->close();
    header("location: leave.php");
} elseif (isset($_POST['retrieve'])) {
    $id = $_POST['id'];
    
    $sql = "UPDATE leave_requests SET status = 'Pending' WHERE id = ? AND status = 'Cancelled'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $_SESSION['success'] = "Leave request retrieved successfully";
    } else {
        $_SESSION['error'] = "Error retrieving leave request: " . $conn->error;
    }
    $stmt->close();
    header("location: leave.php");
}

header("location: leave.php");
?>
