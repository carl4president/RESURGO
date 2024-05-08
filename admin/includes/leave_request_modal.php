<?php
  include '../timezone.php';
  $range_to = date('m/d/Y');
  $range_from = date('m/d/Y', strtotime('-30 day', strtotime($range_to)));
?>


<div class="modal fade" id="accept" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="accept_employee_id"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="leave_reject_accept.php">
            		<input type="hidden" class="id" name="id">
            		<div class="text-center">
	                	<p>ACCEPT LEAVE REQUEST</p>
	                	<h2 class="accept_emp_name"></h2>
                        <br>
                        <h4>Leave Type: <b><span class="accept_leave_type"></span></b></h4>
                        <h4>Start Date : <b><span class="accept_start_date"></span></b></h4>
                        <h4>End Date : <b><span class="accept_end_date"></span></b></h4>
                        <h4>Duration : <b><span class="accept_duration"></span> Days</b></h4>
                        <h4>Reason : <b><span class="accept_reason"></span></b></h4>

	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="accept"> Continue</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<div class="modal fade" id="reject" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="accept_employee_id"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="leave_reject_accept.php">
            		<input type="hidden" class="id" name="id">
            		<div class="text-center">
	                	<p>REJECT LEAVE REQUEST</p>
	                	<h2 class="accept_emp_name"></h2>
                        <br>
                        <h4>Leave Type: <b><span class="accept_leave_type"></span></<b></h4>
                        <h4>Start Date : <b><span class="accept_start_date"></span></b></h4>
                        <h4>End Date : <b><span class="accept_end_date"></span></b></h4>
                        <h4>Duration : <b><span class="accept_duration"></span> Days</b></h4>
                        <h4>Reason : <b><span class="accept_reason"></span></b></h4>

	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="reject"> Continue</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<div class="modal fade" id="retrieve" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="accept_employee_id"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="leave_reject_accept.php">
            		<input type="hidden" class="id" name="id">
            		<div class="text-center">
	                	<p>RETRIEVE LEAVE REQUEST</p>
	                	<h2 class="accept_emp_name"></h2>
                        <br>
                        <h4>Leave Type: <b><span class="accept_leave_type"></span></b></h4>
                        <h4>Start Date : <b><span class="accept_start_date"></span></b></h4>
                        <h4>End Date : <b><span class="accept_end_date"></span></b></h4>
                        <h4>Duration : <b><span class="accept_duration"></span> Days</b></h4>
                        <h4>Reason : <b><span class="accept_reason"></span></b></h4>

	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="retrieve"> Continue</button>
            	</form>
          	</div>
        </div>
    </div>
</div>
<div class="modal fade" id="retrieve_reject" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="accept_employee_id"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="leave_reject_accept.php">
            		<input type="hidden" class="id" name="id">
            		<div class="text-center">
	                	<p>RETRIEVE LEAVE REQUEST</p>
	                	<h2 class="accept_emp_name"></h2>
                        <br>
                        <h4>Leave Type: <b><span class="accept_leave_type"></span></b></h4>
                        <h4>Start Date : <b><span class="accept_start_date"></span></b></h4>
                        <h4>End Date : <b><span class="accept_end_date"></span></b></h4>
                        <h4>Duration : <b><span class="accept_duration"></span> Days</b></h4>
                        <h4>Reason : <b><span class="accept_reason"></span></b></h4>

	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="retrieve_reject"> Continue</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete_reject" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="accept_employee_id"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="leave_reject_accept.php">
            		<input type="hidden" class="id" name="id">
            		<div class="text-center">
	                	<p>DELETE LEAVE REQUEST</p>
	                	<h2 class="accept_emp_name"></h2>
                        <br>
                        <h4>Leave Type: <b><span class="accept_leave_type"></span></<b></h4>
                        <h4>Start Date : <b><span class="accept_start_date"></span></b></h4>
                        <h4>End Date : <b><span class="accept_end_date"></span></b></h4>
                        <h4>Duration : <b><span class="accept_duration"></span> Days</b></h4>
                        <h4>Reason : <b><span class="accept_reason"></span></b></h4>

	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="delete_reject"> Continue</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="accept_employee_id"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="leave_reject_accept.php">
            		<input type="hidden" class="id" name="id">
            		<div class="text-center">
	                	<p>DELETE LEAVE REQUEST</p>
	                	<h2 class="accept_emp_name"></h2>
                        <br>
                        <h4>Leave Type: <b><span class="accept_leave_type"></span></<b></h4>
                        <h4>Start Date : <b><span class="accept_start_date"></span></b></h4>
                        <h4>End Date : <b><span class="accept_end_date"></span></b></h4>
                        <h4>Duration : <b><span class="accept_duration"></span> Days</b></h4>
                        <h4>Reason : <b><span class="accept_reason"></span></b></h4>

	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="delete"> Continue</button>
            	</form>
          	</div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>