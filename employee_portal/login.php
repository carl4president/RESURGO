<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OLSHCO EMPLOYEE LOGIN</title>
  
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="icon" href="../img/logo.png" type="image/icon type">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">z
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
      <div class="register-link">
       <p>Did you sign for attendance? <a href="../attendance/index.php">Attendance Now!</a></p>
      </div>
    </form>
  </div>
  
  
<div class="modal" id="errorMessageModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="errorMessage"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
          url: '../honeypot/index.php',
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