<?php
include 'includes/session.php';

if (isset($_POST['edit'])) {

    $id = $_POST['id'];
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

    
    $sql = "UPDATE leave_requests 
            SET leave_type = '$leaveType',
                start_date = '$startDate',
                end_date = '$endDate',
                duration = '$duration',
                reason = '$reason',
                status = '$status',
                date_requested = NOW()
            WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "Leave request update successfully";
    } else {
        $_SESSION['error'] = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
header("location: leave.php");
?>
