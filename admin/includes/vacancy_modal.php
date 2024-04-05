
<div class="modal fade" id="edit" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><b>Edit Vacancy</b></h4>
            </div>
            <div class="modal-body">
            <form class="form-horizontal" action="vacancy_edit.php" method="post">
				<input type="hidden" name="id" id="vacid" class="form-control">
                <div class="form-group">
			
				<label class="col-sm-2 control-label">Position Name</label>
                <div class="col-sm-9">
				<input type="text" name="position" class="form-control" id="edit_position">
                </div>
			
		</div>
		<div class="form-group">
			
				<label class="col-sm-2 control-label">Availability</label>
                <div class="col-sm-9">
				<input type="number" name="availability" min='0' class="form-control" id="edit_availability">
                </div>
			
		</div>
		
            <div class="form-group">
			
				<label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-9">
				<?php
				$status = isset($response['status']) ? $response['status'] : 1; 

				
				?>
				<select name="status" class="form-control" id="edit_status">
					<option value="1" <?php echo $status == 1 ? "selected" : '' ?>>Active</option>
					<option value="0" <?php echo $status == 0 ? "selected" : '' ?>>Closed</option>
				</select>
                </div>
			
				</div>
		
		<div class="form-group">
			
				<label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-12">
				<textarea id="edit_vac" name="description" class="text-jqte"></textarea>
                </div>
		</div>
		<div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
                 </form>
            </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addnew" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><b>Add Vacancy</b></h4>
            </div>
            <div class="modal-body">
            <form class="form-horizontal" action="vacancy_add.php" method="post" enctype="multipart/form-data">

			<div class="form-group">
                    <label for="photo" class="col-sm-2 control-label">Photo</label>

                    <div class="col-sm-9">
					<input type="file" name="photo" id="photo">
                    </div>
                </div>
                <div class="form-group">
			
				<label class="col-sm-2 control-label">Position Name</label>
                <div class="col-sm-9">
        		    <input type="text" name="position" class="form-control">
					</div>
			
		</div>
		<div class="form-group">
			
				<label class="col-sm-2 control-label">Availability</label>
                <div class="col-sm-9">
				<input type="number" name="availability" min='1' class="form-control">
                </div>
			
		</div>
		
            <div class="form-group">
			
				<label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-9">
				<?php
				$status = isset($response['status']) ? $response['status'] : 1; 
				?>
				<select name="status" class="form-control" id="edit_status">
					<option value="1" <?php echo $status == 1 ? "selected" : '' ?>>Active</option>
					<option value="0" <?php echo $status == 0 ? "selected" : '' ?>>Closed</option>
				</select>
                </div>
			
				</div>
		
		<div class="form-group">
			
				<label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-12">
				<textarea name="description" class="text-jqte"></textarea>
                </div>
		</div>
		<div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-flat" name="save"><i class="fa fa-check-square-o"></i> Save</button>
                 </form>
            </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="view" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<h4><b>Postion :</b><h2 id="val_position"></h2></h4>
			<h4 style="margin-top: 20px;"><b>Availabilty :</b><h2 id="val_availability"></h2></h4>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-lg-12">
            <p id="vac_val"></p>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-lg-12">
			<button class="btn btn-default btn-sm float-right" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
		</div>
	</div>
</div>
</div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_photo" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="del_employee_name"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="vac_edit_photo.php" enctype="multipart/form-data">
                <input type="hidden" class="vacaid" name="id">
                <div class="form-group">
                    <label for="photo" class="col-sm-3 control-label">Photo</label>

                    <div class="col-sm-9">
                      <input type="file" id="photo" name="photo" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="vacancy_delete.php">
            		<input type="hidden" id="del_vacid" name="id">
            		<div class="text-center">
	                	<p>DELETE VACANCY</p>
	                	<h2 id="del_vacancy_position" class="bold"></h2>
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
	$('.text-jqte').jqte();
	
</script>


