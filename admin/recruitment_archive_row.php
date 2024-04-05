<?php
include 'includes/session.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "SELECT a.*, v.position FROM application_archive a
            INNER JOIN vacancy v ON v.id = a.position_id
            WHERE a.id = '$id'";
    $query = $conn->query($sql);

    if ($query) {
        $row = $query->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Error retrieving data']);
    }
}
?>
