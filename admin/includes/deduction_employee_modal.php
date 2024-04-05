<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Add Employee Deduction</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="deduction_employee_add.php">
                <div class="form-group">
                  	<label for="employee_id" class="col-sm-3 control-label">Employee ID:</label>

                  	<div class="col-sm-9">
                    	<select type="text" class="form-control" id="employee_id" name="employee_id" required>
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
                  	<label for="deduction" class="col-sm-3 control-label">Deduction</label>

                  	<div class="col-sm-9">
                      <select class="form-control" id="deduction" name="deduction" required>
                                <?php
                                $sql = "SELECT * FROM deductions";
                                $result = $conn->query($sql);

                                
                                if ($result->num_rows > 0) {
                                    
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['deduction'] . "</option>";
                                    }
                                } else {
                                    
                                    echo "<option value=''>No employees found</option>";
                                }
                                ?>
                            </select>
                  	</div>
                </div>
                <div class="form-group">
                <label for="type" class="col-sm-3 control-label">Type</label>
                <div class="col-sm-9">
                    <select class="form-control" id="type" name="type" required>
                        <option value="1">Monthly</option>
                        <option value="2">Semi-Monthly</option>
                        <option value="3">Once</option>
                    </select>
                </div>
            </div>
            <div class="form-group" id="effectiveDateGroup" style="display: none;">
                <label for="effective_date" class="col-sm-3 control-label">Effective Date</label>
                <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_add" name="effective_date">
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
            	<h4 class="modal-title"><b>Update Employee Deduction</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="deduction_employee_edit.php">
            		<input type="hidden" class="deducid" name="id">
          		  <div class="form-group">
                  	<label for="edit_deduction" class="col-sm-3 control-label">Deduction</label>

                      <div class="col-sm-9">
                            <select class="form-control" id="edit_deduction" name="deduction" required>
                                <?php
                                $sql = "SELECT * FROM deductions";
                                $result = $conn->query($sql);

                                
                                if ($result->num_rows > 0) {
                                    
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['deduction'] . "</option>";
                                    }
                                } else {
                                    
                                    echo "<option value=''>No deduction found</option>";
                                }
                                ?>
                            </select>
                        </div>
                </div>
                <div class="form-group">
            <label for="type" class="col-sm-3 control-label">Deduction Type</label>

                <div class="col-sm-9">
                <select class="form-control" id="edit_type" name="type" required>
                        <?php
                        $deductionTypes = [
                            1 => 'Monthly',
                            2 => 'Semi-Monthly',
                            3 => 'Once'
                        ];

                        foreach ($deductionTypes as $type => $deductionText) {
                            $selected = ($deductionType == $type) ? 'selected' : '';
                            echo "<option value='$type' $selected>$deductionText</option>";
                        }
                        ?>
                    </select>
                </div>
                </div>
                <div class="form-group" id="edit_effectiveDateGroup">
                    <label for="edit_date" class="col-sm-3 control-label">Effective Date</label>

                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="edit_date" name="effective_date">
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
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="deduction_employee_delete.php">
            		<input type="hidden" class="deducid" name="id">
            		<div class="text-center">
	                	<p>DELETE EMPLOYEE DEDUCTION</p>
                        <h2>Employee ID : <b><span id="del_empid"></span></b></h2>
                        <h2>Employee Name : <b><span id="del_empname"></span></h2>
	                	<h2>Deduction : <b><span id="del_deduction"></span></h2>
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

<script>
    $(document).ready(function() {

        $('#type').change(function () {

            var selectedType = $(this).val();
            
            if (selectedType == 3) {
                $('#effectiveDateGroup').show();
            } else {
                $('#effectiveDateGroup').hide();
            }
        });
    });
</script>


     