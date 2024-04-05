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
         <h4>Copyright © 2023 Our Lady of the Sacred Heart College of Guimba, Inc. • All Rights Reserved</h4>
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
<script src="../script/mobile_script.js"></script>


</body>
</html>