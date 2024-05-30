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
  
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="icon" href="../img/logo.png" type="image/icon type">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="../style/log_style.css">
</head>
<body>
  <div class="wrapper">
    <form id="loginForm" autocomplete="off">
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
            <div class="g-recaptcha" data-sitekey="6LemGMIpAAAAAGnGqqWJLvaHEvlsjdbgiqg843Fv" data-callback="validateCaptchaChange"></div>
            <span class="invalid-captcha"></span>
        </div>
      <button type="submit" class="btn">Login</button>
      <div class="register-link">
        <p>Do you want to back to home page? <a href="../index.php">Home Page</a></p>
      </div>
    </form>
  </div>
  
  
<div class="modal fade" id="errorMessageModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #c73e1d;">
            <div class="modal-header">
                <h5 class="modal-title" style="color: white;">Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="errorMessage" style="color: white;"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
      
      function validateCaptchaChange() {
        var response = grecaptcha.getResponse();
        var invalidCaptchaElement = document.querySelector('.invalid-captcha');
        if (response.length != 0) {
          invalidCaptchaElement.textContent = '';
        }
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
   $(document).ready(function() {
      const adminPassField = $("input[name='password']");
      const adminShowBtn = $(".show-hide i");

      adminShowBtn.on("click", function() {
        if (adminPassField.attr("type") === "password") {
          adminPassField.attr("type", "text");
          adminShowBtn.addClass("hide");
        } else {
          adminPassField.attr("type", "password");
          adminShowBtn.removeClass("hide");
        }
      });

      function submitLoginForm() {
        $.ajax({
          type: 'POST',
          url: 'login.php',
          data: $('#loginForm').serialize(),
          success: function(response) {
            var data = JSON.parse(response);
            if (data.error) {
                $('#errorMessage').text(data.message);
                $('#errorMessageModal').modal('show');
            } else {
                location.reload();
            }
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
          }
        });
      }
      
      $('#loginForm').on('submit', function(e) {
          e.preventDefault();
        var response = grecaptcha.getResponse();
        var invalidCaptchaElement = document.querySelector('.invalid-captcha');
        if (response.length === 0) {
          invalidCaptchaElement.textContent = 'Please check the CAPTCHA to verify you are not a robot.';
          return false;
        }

        submitLoginForm();
      });
      
       $('#errorMessageModal').on('hidden.bs.modal', function (e) {
        location.reload(); 
      });
    });
  </script>
</body>
</html>