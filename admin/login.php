<?php
    session_start();
    include 'includes/conn.php';
    
    if (isset($_POST['g-recaptcha-response'])) {
    
    $secretKey = "6LemGMIpAAAAAGFAh_8hQlQiwSFETKfdoDt2J6ny"; 
    $ip = $_SERVER['REMOTE_ADDR'];
    $response = $_POST['g-recaptcha-response'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . urlencode($secretKey) . "&response=" . urlencode($response) . "&remoteip=" . urlencode($ip);
    $fire = file_get_contents($url);
    $data = json_decode($fire);
    
    if ($data->success == true) {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $sql = "SELECT * FROM admin WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if($result->num_rows < 1){
            echo "<script>alert('Invalid Credentials'); window.location.href='../employee_portal/index.php';</script>";
        }
        else{
            $row = $result->fetch_assoc();
            if(password_verify($password, $row['password'])){
                $_SESSION['admin'] = $row['id'];
            }
            else{
            echo "<script>alert('Invalid Credentials'); window.location.href='../employee_portal/index.php';</script>";
            exit;
            }
        }
        
    }
    else {
        echo "<script>alert('Please Fill the Recaptcha');</script>";
    }
    echo "<script>window.location.replace('../employee_portal/index.php');</script>";
    exit;
}

$conn->close();
?>