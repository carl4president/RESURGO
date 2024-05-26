<?php
include 'includes/session.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        foreach ($ipList as $ip) {
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }

    if (!empty($_SERVER['REMOTE_ADDR']) && filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) {
        return $_SERVER['REMOTE_ADDR'];
    }

    return null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $IP = getUserIP();
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($IP) {
        $filePath = 'detection.log';
        $logEntry = "\nHackerIP: " . $IP . " username: " . $username . " password: " . $password;

        if ($file = fopen($filePath, 'a')) {
            fwrite($file, $logEntry);
            fclose($file);
        }

        header("Location: ../admin/Login.php");
        exit();
    }
}
?>
