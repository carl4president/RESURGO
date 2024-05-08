<?php
include 'includes/session.php';

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $time_in_am = date('H:i:s', strtotime($_POST['time_in_am']));
    $time_out_am = date('H:i:s', strtotime($_POST['time_out_am']));
    $time_in_pm = date('H:i:s', strtotime($_POST['time_in_pm']));
    $time_out_pm = date('H:i:s', strtotime($_POST['time_out_pm']));

    $time_in_am_obj = new DateTime($time_in_am);
    $time_out_am_obj = new DateTime($time_out_am);
    $time_in_pm_obj = new DateTime($time_in_pm);
    $time_out_pm_obj = new DateTime($time_out_pm);

    $interval_am = $time_in_am_obj->diff($time_out_am_obj);
    $interval_pm = $time_in_pm_obj->diff($time_out_pm_obj);
    
    $total_hours_am = $interval_am->h + $interval_am->i / 60;
    $total_hours_pm = $interval_pm->h + $interval_pm->i / 60;
    $total_hours = $total_hours_am + $total_hours_pm;

    // Correctly rounding the total hours to two decimal places
    $total_hours = round($total_hours, 2);

    $sql = "UPDATE schedules SET time_in_am = ?, time_out_am = ?, time_in_pm = ?, time_out_pm = ?, total_hours = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        $_SESSION['error'] = 'SQL error: ' . $conn->error;
    } else {
        $stmt->bind_param("ssssdi", $time_in_am, $time_out_am, $time_in_pm, $time_out_pm, $total_hours, $id);
        if ($stmt->execute()) {
            $_SESSION['success'] = 'Schedule updated successfully';
        } else {
            $_SESSION['error'] = $stmt->error;
        }
        $stmt->close();
    }
} else {
    $_SESSION['error'] = 'Fill up edit form first';
}

header('location: schedule.php');
?>
