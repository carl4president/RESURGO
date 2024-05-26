<footer>
        <section id="footer-content">
        <div class="row">
            <div class="col">
                <h4>ABOUT OLSHCO</h4>
                <p>OLSHCO, located in Guimba, Nueva Ecija, is a Catholic private school that was founded in 1947. It provides extensive educational programs and has been managed by the Missionaries of the Sacred Heart (MSC) and the Franciscan Sisters of the Immaculate Conception of the Holy Mother of God (SFIC) since its establishment.</p>
            </div>
            <div class="col">
                <h4>CONNECT WITH US!</h4>
                <ul>
                    <li><img src="img/location.png" alt="">Guimba, Nueva Ecija 3115 Guimba Central Luzon</li>
                    <li><img src="img/telephone.png" alt="">(044) 364 7186</li>
                    <li><img src="img/mail.png" alt="">olshco1947@yahoo.com.ph</li>
                </ul>
            </div>
        </div>
        <div class="col">
            <h4>QUICK LINKS</h4>
            <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="#">School Information</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms & Conditions</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </div>
        </section>
        
      <section id="copyright">
         <h4>Copyright © 2024 Our Lady of the Sacred Heart College of Guimba, Inc. || <span>
             <a href="credits.php"  style="color: #5f0000; text-decoration: none; cursor: pointer;" onmouseover="this.style.color='#440000';" onmouseout="this.style.color='#5f0000';">Team RESURGO</a>
         </span> • All Rights Reserved</h4>
      </section>
    </footer>
    <script type="text/javascript">
    var counter = 1;
    var totalSlides = 4; 

    
    function changeSlide() {
        document.getElementById('radio' + counter).checked = true;
        counter++;
        if (counter > totalSlides) {
            counter = 1;
        }
    }

    
    setInterval(changeSlide, 5000);

    
    document.addEventListener('DOMContentLoaded', function() {
        var manualBtns = document.querySelectorAll('.manual-btn');

        manualBtns.forEach(function(btn, index) {
            btn.addEventListener('click', function() {
                counter = index + 1;
                changeSlide();
            });
        });
    });
</script>

<script>
$(document).ready(function(){
    
    
    function restoreChatHistory() {
        var chatHistory = localStorage.getItem("chatHistory");
        if (chatHistory) {
            $(".form").html(chatHistory);
        }
    }
    
    
    restoreChatHistory();
    
    const createChatLi = (message, className) => {
    const chatLi = document.createElement("div");
    chatLi.classList.add("inbox", className);
    let chatContent;
    if (className === "outgoing") {
        chatContent = `<div class="user-inbox inbox"><div class="msg-header"><p>${message}</p></div></div>`;
    } else if (className === "incoming") {
        chatContent = `<div class="bot-inbox inbox"><div class="icon"><span class="material-symbols-outlined">smart_toy</span></div><div class="msg-header"><p>${message}</p></div></div>`;
    } else { 
        chatContent = `<div class="bot-inbox inbox"><div class="icon"><span class="material-symbols-outlined">smart_toy</span></div><div class="msg-header"><p>${message}</p></div></div>`;
    }
    chatLi.innerHTML = chatContent;
    return chatLi; 
    }
    
    $("#send-btn").on("click", function(){
        $value = $("#data").val();
        $msg = createChatLi($value, "outgoing");
        $(".form").append($msg);
        $("#data").val('');
        
        localStorage.setItem("chatHistory", $(".form").html());
        
        
        displayThinking();
        
        setTimeout(() => {
            $.ajax({
                url: 'message.php',
                type: 'POST',
                data: 'text='+$value,
                success: function(result){
                    $(".thinking").remove(); 
                    
                    
                    displayBotResponse(result);
                }
            });
        }, 3000); 
    });
    
function displayThinking() {
    const thinkingMessage = createChatLi("Thinking...", "incoming");
    thinkingMessage.classList.add("thinking");
    $(".form").append(thinkingMessage);
    $(".form").scrollTop($(".form")[0].scrollHeight);

    const thinkingText = "......";
    let typedText = "";

    for (let i = 0; i < thinkingText.length; i++) {
        setTimeout(() => {
            typedText += thinkingText[i];
            $(".thinking .msg-header p").text(typedText);
        }, i * 600); // Typing speed (milliseconds per dot)
    }
}



    
    function displayBotResponse(response) {
        const $replay = createChatLi("", "incoming-bot");
        $(".form").append($replay);
        $(".form").scrollTop($(".form")[0].scrollHeight);
    
        
        for (let i = 0; i < response.length; i++) {
            setTimeout(() => {
                $replay.querySelector(".msg-header p").textContent += response[i];
                $(".form").scrollTop($(".form")[0].scrollHeight);
                localStorage.setItem("chatHistory", $(".form").html());
            }, i * 20); 
        }
    }
    
    $('.apply-btn').click(function(){
        window.location.href = 'application_portal/vacancy/index.php';
    })
    $("#refresh").on("click", function(){
        
        $(".form > .inbox:not(.preserve)").remove();
        localStorage.removeItem("chatHistory");
    });
    
$("#refresh").on("mouseenter", function() {
    $(this).append("<div class='tooltip'>Refresh</div>");
}).on("mouseleave", function() {
    $(this).find(".tooltip").remove();
});


    
});
</script>

<script src="script/mobile_script.js"></script>


</body>
</html>