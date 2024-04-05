<style>
	nav{
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 30px;
    background: #800000;
    box-shadow: 0 5px 15px rgba(32, 32, 32, 0.06);
    z-index: 999;
    position: sticky;
    top: 0;
    left: 0;
}

.view-vacancy{
	color: white;
}

.view-vacancy:hover{
	text-decoration:none;
	color: white;

}

</style>
<nav>
            <a href="../index.php"><img src="img/logo.png" height="60px" width="60px" alt=""></a>
			<a href="index.php" class="view-vacancy">View Vacancy</a>
        </nav>
<?php
	$qry = $conn->query("SELECT * FROM vacancy where id=".$_GET['id'])->fetch_array();
	foreach($qry as $k =>$v){
		$$k = $v;
	}
?>
<header class="masthead" style="background: url(../../images/<?php echo $photo; ?>); background-repeat: no repeat; background-size: cover; height: 80px;">
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
					<hr class="divider" style="max-width: calc(10%)">
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
							<button class="btn btn-block col-md-4 btn-primary btn-sm float-right" type="button" id="apply_now">Apply Now</button>

						<?php else: ?>
							<button class="btn btn-block col-md-4 btn-primary btn-sm float-right" type="button" disabled="" id="">Application Closed</button>
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
    window.location.href = '../online_application.php?id=<?php echo $_GET['id'] ?>';
});

</script>

