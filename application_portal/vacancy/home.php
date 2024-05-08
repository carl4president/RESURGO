<?php 
include '../includes/conn.php'; 
?>
<style>
#portfolio .img-fluid{
    width: calc(100%);
    height: 30vh;
    z-index: -1;
    position: relative;
    padding: 1em;
}
.vacancy-list{
cursor: pointer;
}
span.hightlight{
    background: yellow;
}

nav{
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 30px;
    background: #5F0000;
    box-shadow: 0 5px 15px rgba(32, 32, 32, 0.06);
    z-index: 999;
    position: sticky;
    top: 0;
    left: 0;
}

</style>
</head>
        <section id="header">
        <a href="#"><img src="img/logo.png" class= "logo" alt=""></a>
         
         <div>
            <ul id="navbar">
                <li><a href="../../index.php">Home</a></li>
                <li><a href="#">About <i class='fas fa-caret-down fas-about'></i></a>
                <div class="dropdown-menu">
                    <ul>
                        <li><a href="../../history.php">History</a></li>
                        <li><a href="../../mision_vision.php">
                            Mission Vision
                        </a></li>
                    </ul>
                </div>
                </li>
                <li><a href="../../contact.php">Contact</a></li>
                <li><a href="../../requirement_procedures.php">Online Application Requirements</a></li>
            
                <li><a href="index.php">Careers</a></li>
                <li><a href="../../employee_portal/index.php">Login</a></li>
                <a href="#" id="close"><img class="close" src="img/close.png" width="10px" height="10px"></img></a>
            </ul>
    
         </div>
         <div id="mobile">
         <img id="bar" class="bar" src="img/outdent.png" width="10px" height="10px"></img>
         </div>
    </section>
    <header class="masthead">
            <div class="container-fluid h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end mb-4 page-title">
                    	<h3 class="text-white">Welcome to OLSHCO Online Application</h3>
                        <hr />
                    <div class="col-md-12 mb-2 text-left">
                        <div class="card">
                            <div class="card-body">
                                  <h4 class="text-center">Find Vacancies</h4>
                               <div class="form-group">
                                   <div class="input-group">
                                       <input type="text" class="form-control" id="filter" placeholder="Search here....">
                                       <div class="input-group-append">
                                           <span class="input-group-text"><i class="fa fa-search"></i></span>
                                       </div>
                                   </div>
                               </div>
                            </div>
                        </div>
                    </div>                        
                    </div>
                    
                </div>
            </div>
        </header>
        
        <section id="list" style="background-color: white;">
            <div class="container mt-3 pt-2">
                <h4 class="text-center">Vacancy List</h4>
                <center><hr style="background: #0026A3; max-width: calc(5%)"></center>
                <?php
                $vacancy = $conn->query("SELECT * FROM vacancy order by date(date_created) desc ");
                while($row = $vacancy->fetch_assoc()):
                    $trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
                    unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                    $dets = strtr(html_entity_decode($row['details']),$trans);
                    $dets=str_replace(array("<li>","</li>"), array("",","), $dets);
                ?>
                <div class="card vacancy-list" data-id="<?php echo $row['id'] ?>">
                    <div class="card-body">
                        <h3><b class="filter-txt"><?php echo $row['position'] ?></b></h3>
                        <span><small>Needed: <?php echo $row['availability'] ?></small></span>
                        <hr>
                        <larger class="truncate filter-txt"><?php echo strip_tags($dets) ?></larger>
                        <br>
                        <center><hr style="background: #0026A3; max-width: calc(80%)"></center>
                        

                    </div>
                </div>
                <br>
                <?php endwhile; ?>
            </div>
        </section>


        <script>
    $('.card.vacancy-list').click(function(){
    var id = $(this).attr('data-id');
    var encryptedId = id;
    for (var i = 0; i < 10; i++) {
        encryptedId = btoa(encryptedId); 
    }
    location.href = "index.php?page=view_vacancy&id=" + encryptedId;
})

    $('#filter').keyup(function(e){
        var filter = $(this).val()

        $('.card.vacancy-list .filter-txt').each(function(){
            var txto = $(this).html();
            txt = txto
            if((txt.toLowerCase()).includes((filter.toLowerCase())) == true){
                $(this).closest('.card').toggle(true)
            }else{
                $(this).closest('.card').toggle(false)
               
            }
        })
    })
</script>
<script src="js/mobile_script.js"></script>