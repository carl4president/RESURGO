<?php
include 'attendance/conn.php';

$getMesg = mysqli_real_escape_string($conn, $_POST['text']);


$check_data = "SELECT replies FROM chatbot WHERE queries LIKE '%$getMesg%'";
$run_query = mysqli_query($conn, $check_data) or die("Error");


if(mysqli_num_rows($run_query) > 0){
    $fetch_data = mysqli_fetch_assoc($run_query);
    $replay = $fetch_data['replies'];
    if(strlen($getMesg) >= 2){
        echo $replay;
    } else {
        echo "Sorry, I couldn't find an answer to your query. For further assistance, please contact the developer at resurgo@resurgo.xyz.";
    }
}
else{
   echo "Sorry, I couldn't find an answer to your query. For further assistance, please contact the developer at resurgo@resurgo.xyz.";
}


?>