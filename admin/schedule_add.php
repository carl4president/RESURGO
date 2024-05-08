<?php
include 'includes/session.php';

if (isset($_POST['add'])) {
    $time_in_am = $_POST['time_in_am'];
    $time_in_am = date('H:i:s', strtotime($time_in_am));
    $time_out_am = $_POST['time_out_am'];
    $time_out_am = date('H:i:s', strtotime($time_out_am));
    $time_in_pm = $_POST['time_in_pm'];
    $time_in_pm = date('H:i:s', strtotime($time_in_pm));
    $time_out_pm = $_POST['time_out_pm'];
    $time_out_pm = date('H:i:s', strtotime($time_out_pm));

    $time_in_am_obj = new DateTime($time_in_am);
    $time_out_am_obj = new DateTime($time_out_am);
    $time_in_pm_obj = new DateTime($time_in_pm);
    $time_out_pm_obj = new DateTime($time_out_pm);

    $interval_am = $time_in_am_obj->diff($time_out_am_obj);
    $interval_pm = $time_in_pm_obj->diff($time_out_pm_obj);
    
    $total_hours_am = $interval_am->h + ($interval_am->i / 60);
    $total_hours_pm = $interval_pm->h + ($interval_pm->i / 60);
    $total_hours = $total_hours_am + $total_hours_pm;

    $sql = "INSERT INTO schedules (time_in_AM, time_out_AM, time_in_PM, time_out_PM, total_hours) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        $_SESSION['error'] = 'SQL error: ' . $conn->error;
    } else {
        $stmt->bind_param("sssss", $time_in_am, $time_out_am, $time_in_pm, $time_out_pm, $total_hours);
        if ($stmt->execute()) {
            $_SESSION['success'] = 'Schedule added successfully';
        } else {
            $_SESSION['error'] = $stmt->error;
        }
        $stmt->close();
    }
} else {
    $_SESSION['error'] = 'Fill up add form first';
}

header('location: schedule.php');
?>
