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
    VALUES ('$employee', '$leaveType', '$startDate', '$endDate', '$duration', '$reason', '$status', NOW())";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "Leave request added successfully";
    } else {
        $_SESSION['error'] = "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif (isset($_POST['delete'])) {
    
    $id = $_POST['id'];

    
    $sql = "DELETE FROM leave_requests WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "Leave request deleted successfully";
    } else {
        $_SESSION['error'] = "Error deleting leave request: " . $conn->error;
    }
    header("location: leave_accepted.php");
}
header("location: leave.php");
?>
