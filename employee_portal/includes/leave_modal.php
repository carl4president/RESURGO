<?php
  include '../timezone.php';
  $range_to = date('m/d/Y');
  $range_from = date('m/d/Y', strtotime('-30 day', strtotime($range_to)));
?>
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Leave Request</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="leave_add_cancel.php" id="add_leaveForm">
                <?php
                    $employee_id = $_SESSION['employee'];
                ?>
                <input type="hidden" class="form-control" name="employee_id" value="<?php echo $employee_id; ?>" required>

                <div class="form-group">
                        <label for="leave_type" class="col-sm-3 control-label">Leave Type</label>

                        <div class="col-sm-9">
                            <select class="form-control" id="leave_type" name="leave_type" required>
                                <option value="Vacation Leave">Vacation Leave</option>
                                <option value="Family or Personal Leave">Family or Personal Leave</option>
                                <option value="Bereavement Leave">Bereavement Leave</option>
                                <option value="Unpaid Leave">Unpaid Leave</option>
                                <option value="Sick Leave">Sick Leave</option>
                                <option value="Emergency Leave">Emergency Leave</option>
                                
                            </select>
                            <input type="text" class="form-control" id="other_leave_type" name="other_leave_type" style="display: none;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="reservation_leave" class="col-sm-3 control-label">Start Date - End Date</label>

                        <div class="col-sm-9"> 
                        <input type="text" class="form-control pull-right col-sm-8" id="reservation_leave_add" name="date_range" value="<?php echo (isset($_GET['range'])) ? $_GET['range'] : $range_from.' - '.$range_to; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reason" class="col-sm-3 control-label">Reason</label>

                        <div class="col-sm-9"> 
                        <textarea name="reason" id="reason" class="form-control"></textarea>
                        </div>
                    </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Edit Leave Request</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="leave_edit.php" id="edit_leaveForm"> 
                    <input type="hidden" class="id" name="id">

                    <div class="form-group">
                        <label for="reservation_leave" class="col-sm-3 control-label">Start Date - End Date</label>

                        <div class="col-sm-9"> 
                        <input type="text" class="form-control pull-right col-sm-8" id="reservation_leave_edit" name="date_range" value="<?php echo (isset($_GET['range'])) ? $_GET['range'] : $range_from.' - '.$range_to; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_reason" class="col-sm-3 control-label">Reason</label>

                        <div class="col-sm-9"> 
                        <textarea name="reason" id="edit_reason" class="form-control"></textarea>
                        </div>
                    </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="edit"><i class="fa fa-save"></i> Save</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<div class="modal fade" id="cancel" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Confirm Cancel of Leave Request</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="leave_add_cancel.php">
            		<input type="hidden" class="id" name="id">
            		<div class="text-center">
	                	<p><b>CANCEL LEAVE REQUEST</b></p>
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
            	<button type="submit" class="btn btn-primary btn-flat" name="cancel"> Continue</button>
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
            	<h4 class="modal-title"><b>Confirm Retrieve of Leave Request</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="leave_add_cancel.php">
            		<input type="hidden" class="id" name="id">
            		<div class="text-center">
	                	<p>RETRIEVE LEAVE REQUEST</p>
	                	<h2 class="retrieve_emp_name"></h2>
                        <br>
                        <h4>Leave Type: <b><span class="retrieve_leave_type"></span></b></h4>
                        <h4>Start Date : <b><span class="retrieve_start_date"></span></b></h4>
                        <h4>End Date : <b><span class="retrieve_end_date"></span></b></h4>
                        <h4>Duration : <b><span class="retrieve_duration"></span> Days</b></h4>
                        <h4>Reason : <b><span class="retrieve_reason"></span></b></h4>

	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="retrieve"> Retrieve</button>
            	</form>
          	</div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function() {
    $('#reservation_leave_add, #reservation_leave_edit').keydown(function(event) {
        event.preventDefault();
    });

    $('#reservation_leave_add, #reservation_leave_edit').daterangepicker({
        minDate: moment().add(3, 'days'),
        isInvalidDate: function(date) {
            return date.day() === 0 || date.day() === 6;
        }
    });

    function updateMinimumDate(datePickerId, leaveType) {
        var minDate;

        console.log("Leave Type:", leaveType);

        if (leaveType === 'Sick Leave' || leaveType === 'Emergency Leave') {
            minDate = moment().startOf('day');
            if (moment().hour() >= 12) {
                minDate.add(0, 'day');
            }
        } else {
            minDate = moment().add(3, 'days');
        }

        console.log("Minimum Date:", minDate);

        $(datePickerId).data('daterangepicker').remove();
        $(datePickerId).daterangepicker({
            minDate: minDate,
            isInvalidDate: function(date) {
                return date.day() === 0 || date.day() === 6;
            }
        });
    }

    $('#leave_type').change(function() {
        updateMinimumDate('#reservation_leave_add', $(this).val());
    });

    $('#edit_leave_type').change(function() {
        updateMinimumDate('#reservation_leave_edit', $(this).val());
    });

    $('#add_leaveForm').submit(function(e) {
        var reason = $('#reason').val().trim();
        if (reason === '') {
            e.preventDefault();
            alert('Please provide a reason for your leave request.');
            $('#reason').focus();
        } else if (reason.length < 5) {
            e.preventDefault();
            alert('Reason must be at least 5 characters long.');
            $('#reason').focus();
        }
    });

    $('#edit_leaveForm').submit(function(e) {
        var reason = $('#edit_reason').val().trim();
        if (reason === '') {
            e.preventDefault();
            alert('Please provide a reason for your leave request.');
            $('#edit_reason').focus();
        } else if (reason.length < 5) {
            e.preventDefault();
            alert('Reason must be at least 5 characters long.');
            $('#edit_reason').focus();
        }
    });
});
</script>
