<?php
  session_start();
  if(isset($_SESSION['employee'])){
    header('location:home.php');
  }
?>
<?php include 'includes/header.php'; ?>
<link rel="stylesheet" href="../style/reg_log_style.css">
<body class="hold-transition login-page body">

  	<div class="container" id="container">
        <div class="form-container sign-up">
            <form action="login.php" method="post">
                <h1>Employee Login</h1>
                <div class="user-box">
                  <input type="text" name="username" required autocomplete="off">
                  <label>Username</label>
                </div>
            
                <div class="user-box">
                  <input type="password" name="password" required autocomplete="off">
                  <label>Password</label>
                </div>
            
                <button>LOGIN</button>
                <span style="font-size: 13px; padding-top: 30px;">Have you not yet signed in for attendance? <br> <center> <a href="../index.php"> Attendance Now! </a> </center></span>
            </form>
            
        </div>
        <div class="form-container sign-in">
            <form action="../admin/login.php" method="post">
                <h1>Admin Login</h1>
                <div class="user-box">
                  <input type="text" name="username" id="username" required autocomplete="off">
                  <label>Username</label>
                </div>
            
                <div class="user-box">
                  <input type="password" name="password" id="password" required autocomplete="off">
                  <label>Password</label>
                </div>
                <button type="submit" name="login">LOGIN</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                     <img src="../img/logo.png" alt="">
					 <p>ARE YOU AN ADMIN?</p>
                    <button id="login">Admin Login</a></button>
                </div>
                <div class="toggle-panel toggle-right">
                    <img src="../img/logo.png" alt="">
                    <p>ARE YOU AN EMPLOYEE?</p>
                    <button id="register">Employee Login</button>
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
<?php include 'includes/scripts.php' ?>
</body>
</html>