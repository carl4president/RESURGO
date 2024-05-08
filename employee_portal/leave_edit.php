<?php
include 'includes/session.php';

if (isset($_POST['edit'])) {

    $id = $_POST['id'];
    $dateRange = $_POST['date_range'];
    list($startDate, $endDate) = explode(" - ", $dateRange);
    $startDate = date('Y-m-d', strtotime($startDate)); 
    $endDate = date('Y-m-d', strtotime($endDate));     
    $reason = $_POST['reason'];

    $startDateTime = new DateTime($startDate);
    $endDateTime = new DateTime($endDate);
    $duration = $startDateTime->diff($endDateTime)->days;

    $sql = "UPDATE leave_requests 
            SET start_date = ?,
                end_date = ?,
                duration = ?,
                reason = ?,
                date_requested = NOW()
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $startDate, $endDate, $duration, $reason, $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['success'] = "Leave request updated successfully";
    } else {
        $_SESSION['error'] = "Error updating leave request: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
header("location: leave.php");
?>
