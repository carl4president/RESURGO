<?php
    session_start();
    include 'includes/conn.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        
        $query = "SELECT employee_id, username, password FROM employees WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            
            $row = $result->fetch_assoc();

            
            if (password_verify($password, $row['password'])) {
                

                
                $_SESSION['employee'] = $row['employee_id'];

                
                header('location: index.php');
                exit(); 
            }
        }

        echo "<script>alert('Invalid Credentials');</script>";
        echo "<script>window.location.replace('index.php');</script>";

    }

    
    $conn->close();
?>
