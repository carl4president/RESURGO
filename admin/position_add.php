<?php
        include 'includes/session.php';
        
        if(isset($_POST['add'])){
            $title = $_POST['title'];
            $rate = $_POST['rate'];
        
            $stmt = $conn->prepare("INSERT INTO vacancy (position, rate) VALUES (?, ?)");
            $stmt->bind_param("sd", $title, $rate);
            if($stmt->execute()){
                $_SESSION['success'] = 'Position added successfully';
            }
            else{
                $_SESSION['error'] = $conn->error;
            }
        }
        else{
            $_SESSION['error'] = 'Fill up add form first';
        }
        
        header('location: position.php');


?>