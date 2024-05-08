<?php
  session_start();
  if(isset($_SESSION['admin'])){
    header('location:../admin/home.php');
  } else if(isset($_SESSION['employee'])){
     header('location:home.php');
  }
include 'includes/conn.php';

if (isset($_POST['g-recaptcha-response'])) {
    
    $secretKey = "6LemGMIpAAAAAGFAh_8hQlQiwSFETKfdoDt2J6ny"; 
    $ip = $_SERVER['REMOTE_ADDR'];
    $response = $_POST['g-recaptcha-response'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . urlencode($secretKey) . "&response=" . urlencode($response) . "&remoteip=" . urlencode($ip);
    $fire = file_get_contents($url);
    $data = json_decode($fire);
    
    if ($data->success == true) {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        
        $query = "SELECT employee_id, username, password FROM employees WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['employee'] = $row['employee_id'];
                header('Location: index.php');
            } else{
                echo "<script>alert('Invalid Credentials'); window.location.href='index.php';</script>";
                exit;
            }
        }
        else{

        echo "<script>alert('Invalid Credentials'); window.location.href='index.php';</script>";
        exit;
        }
    } else {
        echo "<script>alert('Please Fill the Recaptcha'); window.location.href='index.php';</script>";
        exit;
    }
}

$conn->close();
?>
