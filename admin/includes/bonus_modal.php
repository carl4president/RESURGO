<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Employee Bonus</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="bonus_add.php">
				<div class="form-group">
                  	<label for="employee_id" class="col-sm-3 control-label">Employee ID:</label>

                  	<div class="col-sm-9">
                    	<select type="text" class="form-control" id="employee_id" name="employee" required>
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
                    <label for="description" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-9">
					<select class="form-control" id="description" name="description" required>
							<?php
							$sql = "SELECT * FROM bonus";
							$result = $conn->query($sql);

							
							if ($result->num_rows > 0) {
								
								while ($row = $result->fetch_assoc()) {
									echo "<option value='" . $row['id'] . "'>" . $row['description'] . "</option>";
								}
							} else {
								
								echo "<option value=''>No bonus list found</option>";
							}
							?>
						</select>
                    </div>
                </div>
			<div class="form-group">
				<label for="datepicker_add" class="col-sm-3 control-label">Date</label>

				<div class="col-sm-9"> 
					<div class="date_picker">
					<input type="text" class="form-control" id="datepicker_add" name="date_bonus" required>
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
            	<h4 class="modal-title"><b><span class="date"></span> - <span class="employee_name"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="bonus_edit.php">
            		<input type="hidden" class="beid" name="id">
				<div class="form-group">
                    <label for="edit_description" class="col-sm-3 control-label">Description</label>

                    <div class="col-sm-9">
					<select class="form-control" id="edit_description" name="description" required>
							<?php
							$sql = "SELECT * FROM bonus";
							$result = $conn->query($sql);

							
							if ($result->num_rows > 0) {
								
								while ($row = $result->fetch_assoc()) {
									echo "<option value='" . $row['id'] . "'>" . $row['description'] . "</option>";
								}
							} else {
								
								echo "<option value=''>No bonus list found</option>";
							}
							?>
						</select>
                    </div>
                </div>
				<div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Date</label>

                    <div class="col-sm-9"> 
                      <div class="date_edit">
                        <input type="text" class="form-control" id="datepicker_edit" name="edit_date_bonus">
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
            	<h4 class="modal-title"><b><span class="date"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="bonus_delete.php">
            		<input type="hidden" class="beid" name="id">
            		<div class="text-center">
	                	<p>DELETE EMPLOYEE BONUS</p>
	                	<h2 class="employee_name bold"></h2>
						<h3 class="description bold"></h3>
						<h4 class="amounts bold"></h4>
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
        $('#datepicker_add').keydown(function(event) {
        event.preventDefault(); 
        })
        
        $('#datepicker_edit').keydown(function(event) {
        event.preventDefault(); 
        })
    });

document.getElementById('description').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var amountField = document.getElementById('amount');

    
    if (selectedOption.hasAttribute('data-amount')) {
        amountField.value = selectedOption.getAttribute('data-amount');
    } else {
        
        amountField.value = '';
        amountField.removeAttribute('readonly');
    }
});
</script>



     