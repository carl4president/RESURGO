<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Lady of the Sacred Heart College of Guimba, Inc.</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="style/home_style.css">
    <link rel="icon" href="img/logo.png" type="image/icon type">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,1,0" />
    <script src="script/chat_script.js" defer></script>

</head>
<body>

    <section id="header">
        <a href="#"><img src="img/logo.png" class= "logo" alt=""></a>
         
         <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">About <i class='fas fa-caret-down fas-about'></i></a>
                <div class="dropdown-menu">
                    <ul>
                        <li><a href="history.php">History</a></li>
                        <li><a href="mision_vision.php">
                            Mission Vision
                        </a></li>
                    </ul>
                </div>
                </li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="requirement_procedures.php">Online Application Requirements</a></li>
            
                <li><a href="application_portal/vacancy/index.php">Careers</a></li>
                <li><a href="employee_portal/index.php">Login</a></li>
                <a href="#" id="close"><i class="fas fa-times"></i></a>
            </ul>
    
         </div>
         <div id="mobile">
         <i id="bar" class="fa fa-outdent"></i>
         </div>
    </section>
    <section id="chatbot-sec">
        <button class="chatbot-toggler">
      <span class="material-symbols-rounded">mode_comment</span>
      <span class="material-symbols-outlined">close</span>
    </button>
    <div class="chatbot">
      <header>
        <h2>Chatbot</h2>
        <span class="close-btn material-symbols-outlined">close</span>
      </header>
      <div class="form">
            <div class="bot-inbox inbox">
                <div class="icon">
                    <span class="material-symbols-outlined">smart_toy</span>
                </div>
                <div class="msg-header">
                    <p>Hello there, how can I help you?</p>
                </div>
            </div>
        </div>
      <div class="chat-input">
        <input id="data" type="text" placeholder="Enter a message..." spellcheck="false" required>
        <button id="send-btn">Send</button>
      </div>
      </div>
</section>