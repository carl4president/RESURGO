<style>
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

.view-vacancy{
	color: white;
	font-family: Palatino; 
	font-weight: bold;
	transition: color 0.3s ease;
}

.view-vacancy:hover{
	text-decoration:none;
	color: #d03d56;

}

@media only screen and (max-width: 360px){

    #navbar {
        padding: 10px 30px;
    }
    
    nav img{
        width: 40px;
        height: 40px;
    }
        
}

</style>
<nav>
            <a href="../../index.php"><img src="img/logo.png" height="60px" width="60px" alt=""></a>
			<a href="index.php" class="view-vacancy">VIEW VACANCY</a>
        </nav>
<?php


if(isset($_GET['id'])) {
    
    $decodedId = $_GET['id'];
    for ($i = 0; $i < 10; $i++) {
        $decodedId = base64_decode($decodedId);
    }
    
    
    $qry = $conn->query("SELECT * FROM vacancy WHERE id=".$decodedId)->fetch_array();
    foreach($qry as $k => $v){
        $$k = $v;
    }
} else {
    echo "ID parameter is missing.";
}
?>


<header class="masthead" style="background: url('<?php echo $banner === '' ? '../../img/bg.jpg' : '../../images/' . $banner; ?>'); background-repeat: no-repeat; background-size: cover; height: 80px;">


            <div class="container-fluid h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                   
                    
                </div>
            </div>
        </header>
<section id="" style="padding-bottom: 15px; background-color:white;">
<?php include '../includes/conn.php' ?>

<div class="container mb-2 pt-4 ">
	<div class="card" style="border: 3px solid rgba(0, 0, 0, 0.125)">
		<div class="card-body">
			<div class="row">
				<div class="col-lg-12">
					<h4 class="text-center"><b><?php echo $position ?></b></h4>
					<center><hr style="background: #0026A3; max-width: calc(5%)"></center>
					<p class="text-center">
						<small>
							<i><b>Needed: <larger><?php echo $availability ?></larger></b></i>
						</small>
						<?php if($status == 1): ?>
							<span class="badge badge-success pt-2">Hiring</span>
						<?php else: ?>
							<span class="badge badge-danger pt-2">Closed</span>
						<?php endif; ?>
					</p>
				</div>
			</div>
				<hr class="divider" style="max-width: calc(100%)">
			<div class="row">
				<div class="col-lg-12">
					<?php echo html_entity_decode($description) ?>
				</div>
			</div>
			<hr class="divider" style="max-width: calc(100%)">
			<div class="row">
				<div class="col-lg-12">
						<?php if($status == 1): ?>
							<button class="btn btn-block col-md-3 btn-danger btn-sm float-right" type="button" id="apply_now">Apply Now</button>

						<?php else: ?>
							<button class="btn btn-block col-md-3 btn-danger btn-sm float-right" type="button" disabled="" id="">Application Closed</button>
						<?php endif; ?>

				</div>
			</div>
			</div>
		</div>
	</div>
</section>
<script>
    $('html, body').animate({
        scrollTop: ($('section').offset().top - 72)
    }, 1000);
    
    $('#apply_now').click(function(){
        var id = '<?php echo $decodedId; ?>';
        var decodedId = id; 
        
        
        for (var i = 0; i < 10; i++) {
            decodedId = btoa(decodedId);
        }
        
        window.location.href = '../../online_application.php?id=' + decodedId;
    });
</script>


