<link rel="stylesheet" href="../../style/chatbot_style.css">
<section id="chatbot-sec">
        <button class="chatbot-toggler">
      <span class="material-symbols-rounded">mode_comment</span>
      <span class="material-symbols-outlined">close</span>
    </button>
    <div class="chatbot">
      <header>
         <img src="img/logo.png" class= "chat-logo" alt="">
        <h2>RESURBOT</h2>
        <span class="close-btn material-symbols-outlined">close</span>
        <span id="refresh" class="material-symbols-outlined">refresh</span>
      </header>
      <div class="form">
            <div class="bot-inbox inbox preserve">
                <div class="icon">
                    <span class="material-symbols-outlined">smart_toy</span>
                </div>
                <div class="msg-header">
                    <p>Hello there! My name is RESURBOT, how can I help you?</p>
                </div>
            </div>
        </div>
        <div class="query-recommendations">
            <ul>
                <li class="query-suggestion">What is OLSHCO?</li>
                <li class="query-suggestion">Where is olshco located?</li>
                <li class="query-suggestion">Does olshco provide job opportunities?</li>
                <li class="query-suggestion">How can i apply for the job?</li>
                <li class="query-suggestion">What is your contact information?</li>
                <li class="query-suggestion">What is resurgo?</li>
                <li class="query-suggestion">Who are the developers of resurgo?</li>
                <li class="query-suggestion">What is the vision of the school?</li>
                <li class="query-suggestion">What is schools mission?</li>
                <li class="query-suggestion">What is vision and mission of school?</li>
            </ul>
        </div>
      <div class="chat-input">
        <input id="data" type="text" placeholder="Enter a message..." spellcheck="false" required>
        <button id="send-btn">Send</button>
      </div>
      </div>
</section>
<script>
    document.getElementById('data').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();  
            document.getElementById('send-btn').click();  
        }
    });

    document.querySelectorAll('.query-suggestion').forEach(item => {
        item.addEventListener('click', event => {
            document.getElementById('data').value = event.target.textContent;
            document.getElementById('send-btn').click();
        });
    });
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
                url: '../../message.php',
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