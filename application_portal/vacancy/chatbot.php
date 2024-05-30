<style>
    .chatbot-toggler {
  position: fixed;
  bottom: 30px;
  right: 35px;
  outline: none;
  border: none;
  height: 50px;
  width: 50px;
  display: flex;
  cursor: pointer;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  background: #DC0000;
  transition: all 0.2s ease;
  z-index: 1000;
}
body.show-chatbot .chatbot-toggler {
  transform: rotate(90deg);
}
.chatbot-toggler span {
  color: #fff;
  position: absolute;
}
.chatbot-toggler span:last-child,
body.show-chatbot .chatbot-toggler span:first-child  {
  opacity: 0;
}
body.show-chatbot .chatbot-toggler span:last-child {
  opacity: 1;
}
.chatbot {
  position: fixed;
  right: 35px;
  bottom: 90px;
  width: 420px;
  background: #fff;
  border-radius: 15px;
  overflow: hidden;
  opacity: 0;
  pointer-events: none;
  transform: scale(0.5);
  transform-origin: bottom right;
  box-shadow: 0 0 128px 0 rgba(0,0,0,0.1),
              0 32px 64px -48px rgba(0,0,0,0.5);
  transition: all 0.1s ease;
  z-index: 1000;
}
body.show-chatbot .chatbot {
  opacity: 1;
  pointer-events: auto;
  transform: scale(1);
}
.chatbot header {
  padding: 16px 0;
  position: relative;
  text-align: center;
  color: #fff;
  background: #AE0000;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
.chatbot header span {
  position: absolute;
  right: 15px;
  top: 50%;
  display: none;
  cursor: pointer;
  transform: translateY(-50%);
}


#refresh {
  position: absolute;
  right: 15px;
  cursor: pointer;
  display: block;
}

.chatbot .form{
    padding: 20px 15px 50px 15px;
    min-height: 400px;
    max-height: 400px;
    overflow-y: auto;
}

.chatbot .chatbox {
  overflow-y: auto;
  height: 410px;
  padding: 30px 20px 100px;
}
.chatbot :where(.chatbox, textarea)::-webkit-scrollbar {
  width: 6px;
}
.chatbot :where(.chatbox, textarea)::-webkit-scrollbar-track {
  background: #fff;
  border-radius: 25px;
}
.chatbot :where(.chatbox, textarea)::-webkit-scrollbar-thumb {
  background: #ccc;
  border-radius: 25px;
}
.chatbot .form .inbox{
    max-width: 500px;
    width: 100%;
    display: flex;
    align-items: baseline;
}
.chatbot .form .user-inbox{
    justify-content: flex-end;
    margin: 13px 0;
}
.chatbot .form .inbox .icon{
    height: 40px;
    width: 40px;
    color: #fff;
    text-align: center;
    line-height: 40px;
    border-radius: 50%;
    font-size: 18px;
    background: #AE0000;
}

.material-symbols-outlined{
  width: 32px;
  height: 32px;
  color: #fff;
  text-align: center;
  margin: 7px 0 0 0;
}
.chatbot .form .inbox .msg-header{
    max-width: 60%;
    margin-left: 10px;
}
.form .inbox .msg-header p{
  white-space: pre-wrap;
  padding: 12px 16px;
  max-width: 100%;
  color: #fff;
  font-size: 0.95rem;
  background: #AE0000;
  border-radius: 0px 10px 10px 10px;
}
.form .user-inbox .msg-header p{
    color: #333;
    background: #efefef;
    border-radius: 10px 10px 0 10px;
}
.chatbot .chat-input {
  display: flex;
  gap: 5px;
  position: absolute;
  bottom: 0;
  width: 100%;
  background: #fff;
  padding: 3px 20px;
  border-top: 1px solid #ddd;
}
.chat-input input {
  height: 55px;
  width: 100%;
  border: none;
  outline: none;
  resize: none;
  max-height: 180px;
  padding: 15px 15px 15px 0;
  font-size: 0.95rem;
}
.chat-input span {
  align-self: flex-end;
  color: #724ae8;
  cursor: pointer;
  height: 55px;
  display: flex;
  align-items: center;
  visibility: hidden;
  font-size: 1.35rem;
}
.chat-input textarea:valid ~ span {
  visibility: visible;
}

.chatbot header h2 {
  font-size: 1.4rem;
  color: white;
}

.chat-input button{
    position: absolute;
    right: 5px;
    top: 50%;
    height: 30px;
    width: 65px;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    outline: none;
    opacity: 0;
    pointer-events: none;
    border-radius: 3px;
    background: #AE0000;
    border: 1px solid #AE0000;
    transform: translateY(-50%);
    transition: all 0.3s ease;
}
.chat-input input:valid ~ button{
    opacity: 1;
    pointer-events: auto;
}
.chat-input button:hover{
    background: #800000;
}

.tooltip {
    position: absolute;
    top: calc(100% - 10px); 
    right: calc(100% - 20px); 
    background-color: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 14px;
    white-space: nowrap;
    z-index: 1001;
    display: block;
}

.chat-logo{
    width: 30px;
    height: 30px;
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);

}
</style>
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