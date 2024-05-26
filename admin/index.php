<?php
  session_start();
  if(isset($_SESSION['employee'])){
    header('location:home.php');
  }  else if(isset($_SESSION['admin'])){
    header('location:../admin/home.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OLSHCO ADMIN LOGIN</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="icon" href="../img/logo.png" type="image/icon type">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <style>
      *{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
body{
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: url(../img/bg.jpg) no-repeat;
  background-size: cover;
  background-position: center;
}
.wrapper{
  width: 420px;
  background: white;
  border: 2px solid rgba(255, 255, 255, .2);
  color: black;
  border-radius: 12px;
  padding: 30px 40px;
}
.wrapper h1{
  font-size: 36px;
  text-align: center;
}
.wrapper .input-box{
  position: relative;
  width: 100%;
  height: 50px;
  
  margin: 30px 0;
}
.input-box input {
  width: 100%;
  height: 100%;
  background: white;
  border: 1px solid #5f0000;
  outline: none;
  border-radius: 40px;
  font-size: 16px;
  color: #000; 
  padding: 20px 45px 20px 20px;
}

.input-box input:focus {
    border: 1px solid #5f0000;
}

.input-box label {
    position: absolute;
    top: 50%;
    left: 15px;
    transform: translateY(-50%);
    color: #4a4646;
    pointer-events: none;
    transition: 0.2s ease;
}
.input-box input:is(:focus, :valid) {
    padding: 16px 15px 0;
}
.input-box input:is(:focus, :valid)~label {
    transform: translateY(-120%);
    color: maroon;
    font-size: 0.75rem;
}

.input-box i{
  position: absolute;
  right: 10px;
  top: 0;
  font-size: 20px;

}

.wrapper .btn{
  width: 100%;
  height: 45px;
  background: #5f0000;
  border: none;
  outline: none;
  border-radius: 40px;
  box-shadow: 0 0 10px rgba(0, 0, 0, .1);
  cursor: pointer;
  font-size: 16px;
  color: #fff;
  font-weight: 600;
}
.wrapper .register-link{
  font-size: 14.5px;
  text-align: center;
  margin: 20px 0 15px;

}
.register-link p a{
  color: #337ab7;
  text-decoration: none;
  font-weight: 600;
}
.register-link p a:hover{
  text-decoration: underline;
}

.show-hide{
  position: absolute;
  right: 15px;
  top: 30%;
  transform: translateY(-50%);
}
.show-hide i{
  font-size: 19px;
  color: #5f0000;
  cursor: pointer;
  display: none;
}
.show-hide i.hide:before{
  content: '\f070';
}
input:valid ~ .show-hide i{
  display: block;
}

.g-recaptcha-container{
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 25px 0;
}
  </style>
</head>
<body>
  <div class="wrapper">
    <form action="login.php" method="post" onsubmit="return validateCaptcha();">
      <h1>Login</h1>
      <div class="input-box">
        <input type="text" name="username" oninput="validateSus()" required>
        <label>Username</label>
      </div>
      <div class="input-box">
        <input type="password" name="password" oninput="validateSus()" required>
        <label>Password</label>
        <span class="show-hide">
         <i class="fa fa-eye"></i>
         </span>
      </div>
      <div class="g-recaptcha-container">
            <div class="g-recaptcha" data-sitekey="6LemGMIpAAAAAGnGqqWJLvaHEvlsjdbgiqg843Fv"></div>
        </div>
      <button type="submit" class="btn">Login</button>
      <div class="register-link">
        <p>Do you want to back to home page? <a href="../index.php">Home Page</a></p>
      </div>
    </form>
  </div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
      const adminPassField = document.querySelector("input[name='password']");
      const adminShowBtn = document.querySelector(".show-hide i");

      adminShowBtn.addEventListener("click", function() {
        if (adminPassField.type === "password") {
          adminPassField.type = "text";
          adminShowBtn.classList.add("hide");
        } else {
          adminPassField.type = "password";
          adminShowBtn.classList.remove("hide");
        }
      });
    });

    function validateCaptcha() {
      var response = grecaptcha.getResponse();
      if (response.length === 0) {
        alert('Please check the CAPTCHA to verify you are not a robot.');
        return false;
      }
      return true;
    }
  function validateSus() {
    const usernameInput = document.querySelector("input[name='username']");
    const passwordInput = document.querySelector("input[name='password']");
    const maliciousPattern = /['\\=]/;
    
    if (maliciousPattern.test(usernameInput.value) || maliciousPattern.test(passwordInput.value)) {

        usernameInput.value = "";
        passwordInput.value = "";

        window.location.href = 'Login.php';
        
        return false;
    } 
}

     
  </script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>
</html>