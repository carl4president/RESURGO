<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    include('../includes/conn.php');
    ob_start();
    ob_end_flush();
    include('header.php');

	
    ?>

    <style>
    	header.masthead {
		  background-repeat: no-repeat;
		  background-size: cover;
		}
    </style>
    <body id="page-top">
       
        <?php 
        $page = isset($_GET['page']) ?$_GET['page'] : "home";
        include $page.'.php';
        ?>
       

<div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-righ t"></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      </div>
    </div>
  </div>
     <section id="copyright" style="background: white; display:flex; justify-content: center; padding: 10px; border-top: 2px solid #DBDBDB;">
         <h4 style="font-size: 18px; margin: 0; color: maroon;">Copyright © 2023 Our Lady of the Sacred Heart College of Guimba, Inc. || 
             <a href="../../credits.php"  style="color: #5f0000; text-decoration: none; font-family: 'Merriweather Sans'; cursor: pointer;" onmouseover="this.style.color='#440000';" onmouseout="this.style.color='#5f0000';">Team RESURGO</a>
          • All Rights Reserved</h4>
      </section>
        
       <?php include('footer.php') ?>
    </body>

    <?php $conn->close() ?>

</html>
