<?php
  session_start();
  if(isset($_SESSION['employee'])){
    header('location:home.php');
  }  else if(isset($_SESSION['admin'])){
    header('location:../admin/home.php');
  }
?>
<?php include 'includes/header.php'; ?>
<link rel="stylesheet" href="../style/reg_log_style.css">
<body class="hold-transition login-page body">

  	<div class="container" id="container">
        <div class="form-container sign-up">
            <form action="login.php" method="post" onsubmit="return validateCaptcha('employeeCaptcha');">
                <h1>Employee Login</h1>
                <div class="user-box">
                  <input type="text" name="username" required autocomplete="off">
                  <label>Username</label>
                </div>
            
                <div class="user-box">
                  <input type="password" name="password" required autocomplete="off">
                  <label>Password</label>
                </div>
                <div class="g-recaptcha" data-sitekey="6LemGMIpAAAAAGnGqqWJLvaHEvlsjdbgiqg843Fv"></div>
            
                <button>LOGIN</button>
                <span style="font-size: 13px; padding-top: 30px;">Have you not yet signed in for attendance? <br> <center> <a href="../attendance/index.php"> Attendance Now! </a> </center></span>
            </form>
            
        </div>
        <div class="form-container sign-in">
            <form action="../admin/login.php" method="post" onsubmit="return validateCaptcha('adminCaptcha');">
                <h1>Admin Login</h1>
                <div class="user-box">
                  <input type="text" name="username" id="username" required autocomplete="off">
                  <label>Username</label>
                </div>
            
                <div class="user-box">
                  <input type="password" name="password" id="password" required autocomplete="off">
                  <label>Password</label>
                </div>
                <div class="g-recaptcha" data-sitekey="6LemGMIpAAAAAGnGqqWJLvaHEvlsjdbgiqg843Fv"></div>
                <button type="submit" name="login">LOGIN</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                     <img src="../img/logo.png" alt="">
					 <p>ARE YOU AN ADMIN?</p>
                    <button id="login">Admin Login</a></button>
                    <br>
                    <span style="font-size: 13px; padding-top: 30px;">Do you want to go back to the home page? <br> <center> <a href="../index.php" style="color: #00CFE5; cursor: pointer;" onmouseover="this.style.color='#008C9B';" onmouseout="this.style.color='#00CFE5';"> Home Page </a> </center></span>
                </div>
                <div class="toggle-panel toggle-right">
                    <img src="../img/logo.png" alt="">
                    <p>ARE YOU AN EMPLOYEE?</p>
                    <button id="register">Employee Login</button>
                    <br>
                    <span style="font-size: 13px; padding-top: 30px;">Do you want to go back to the home page? <br> <center> <a href="../index.php"  style="color: #00CFE5; cursor: pointer;" onmouseover="this.style.color='#008C9B';" onmouseout="this.style.color='#00CFE5';"> Home Page </a> </center></span>
                </div>
            </div>
        </div>
  	<?php
  		if(isset($_SESSION['error'])){
  			echo "
  				<div class='callout callout-danger text-center mt20'>
			  		<p>".$_SESSION['error']."</p> 
			  	</div>
  			";
  			unset($_SESSION['error']);
  		}
  	?>
</div>
<script src="../script/reg_log_script.js"></script>	
<script>
function validateCaptcha(captchaId) {
    var captchaWidgetId = {
        'employeeCaptcha': 0,  // Adjust the index based on the render order of your CAPTCHAs
        'adminCaptcha': 1      // Adjust the index based on the render order of your CAPTCHAs
    };
    var response = grecaptcha.getResponse(captchaWidgetId[captchaId]);
    if (response.length === 0) {
        alert('Please check the CAPTCHA to verify you are not a robot.');
        return false;
    }
    return true;
}
</script>

<?php include 'includes/scripts.php' ?>
</body>
</html>