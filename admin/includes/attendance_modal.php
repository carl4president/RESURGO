<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Attendance</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="attendance_add.php">
				<div class="form-group">
					<label for="employee" class="col-sm-3 control-label">Employee ID</label>

					<div class="col-sm-9">
						<select class="form-control" id="employee" name="employee" required>
							<?php
							$sql = "SELECT employee_id FROM employees";
							$result = $conn->query($sql);

							
							if ($result->num_rows > 0) {
								
								while ($row = $result->fetch_assoc()) {
									echo "<option value='" . $row['employee_id'] . "'>" . $row['employee_id'] . "</option>";
								}
							} else {
								
								echo "<option value=''>No employees found</option>";
							}
							?>
						</select>
					</div>
				</div>

                <div class="form-group">
                    <label for="datepicker_add" class="col-sm-3 control-label">Date</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_add" name="date" required>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="time_in_am" class="col-sm-3 control-label">Time In (AM)</label>

                  	<div class="col-sm-9">
                  		<div class="bootstrap-timepicker">
                    		<input type="text" class="form-control timepicker" id="time_in_am" name="time_in_am">
                    	</div>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="time_out_am" class="col-sm-3 control-label">Time Out (AM)</label>

                  	<div class="col-sm-9">
                  		<div class="bootstrap-timepicker">
                    		<input type="text" class="form-control timepicker" id="time_out_am" name="time_out_am">
                    	</div>
                  	</div>
                </div>
                                <div class="form-group">
                  	<label for="time_in_pm" class="col-sm-3 control-label">Time In (PM)</label>

                  	<div class="col-sm-9">
                  		<div class="bootstrap-timepicker">
                    		<input type="text" class="form-control timepicker" id="time_in_pm" name="time_in_pm">
                    	</div>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="time_out_pm" class="col-sm-3 control-label">Time Out (PM)</label>

                  	<div class="col-sm-9">
                  		<div class="bootstrap-timepicker">
                    		<input type="text" class="form-control timepicker" id="time_out_pm" name="time_out_pm">
                    	</div>
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

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span id="employee_name"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="attendance_edit.php">
            		<input type="hidden" id="attid" name="id">
                <div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Date</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_edit" name="edit_date">
                      </div>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="edit_time_in_am" class="col-sm-3 control-label">Time In (AM)</label>

                  	<div class="col-sm-9">
                  		<div class="bootstrap-timepicker">
                    		<input type="text" class="form-control timepicker" id="edit_time_in_am" name="time_in_am">
                    	</div>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="edit_time_out_am" class="col-sm-3 control-label">Time Out (AM)</label>

                  	<div class="col-sm-9">
                  		<div class="bootstrap-timepicker">
                    		<input type="text" class="form-control timepicker" id="edit_time_out_am" name="time_out_am">
                    	</div>
                  	</div>
                </div>
                 <div class="form-group">
                  	<label for="edit_time_in_pm" class="col-sm-3 control-label">Time In (PM)</label>

                  	<div class="col-sm-9">
                  		<div class="bootstrap-timepicker">
                    		<input type="text" class="form-control timepicker" id="edit_time_in_pm" name="time_in_pm">
                    	</div>
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="edit_time_out_pm" class="col-sm-3 control-label">Time Out (PM)</label>

                  	<div class="col-sm-9">
                  		<div class="bootstrap-timepicker">
                    		<input type="text" class="form-control timepicker" id="edit_time_out_pm" name="time_out_pm">
                    	</div>
                  	</div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span id="attendance_date"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="attendance_delete.php">
            		<input type="hidden" id="del_attid" name="id">
            		<div class="text-center">
	                	<p>DELETE ATTENDANCE</p>
	                	<h2 id="del_employee_name" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datepicker_add, #datepicker_edit').keydown(function(event) {
        event.preventDefault(); 
    })
    });
</script>
     