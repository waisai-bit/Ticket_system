<?php
include('header.php');
if(isset($_POST['btnsave'])){

	$depName=$_POST['department'];
	$depStatus=$_POST['status'];
	//Insert Data
	$insert="INSERT INTO `departments`(`department`, `status`) VALUES ('$depName','$depStatus')";
	$result=mysqli_query($con,$insert);
	if($result) //True 
	{
		header('Location: department.php');
	}
	else
	{
		echo "<p>Something wrong" . mysqli_error() . "</p>";
		header('Location: department.php');
	}
}

?>
<div class="container">	
	<div class="row home-sections">
	<h2>Ticket System</h2>	
    <?php include('menu.php'); ?>	
	</div> 
	
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-10">
				<h3 class="panel-title">&nbsp;</h3>
			</div>
			<div class="col-md-2 text-right">
				<button type="button" name="add" id="addDepartment" class="btn btn-success btn-xs"><i class="fa fa-plus"> </i> Add New</button>
			</div>
		</div>
	</div>
			
	<table id="datatableid" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th width="50px">S/N</th>
				<th>Department</th>					
				<th>Status</th>
				<th></th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
<?php  
	$query="SELECT * FROM departments";
	$result=mysqli_query($con,$query);
	$count=mysqli_num_rows($result);
	for ($i=0;$i<$count;$i++) 
{ 
	$array=mysqli_fetch_array($result);

	$depId=$array['id'];
	$depName=$array['department'];
	$depStatus = '';
			if($array['status'] == 1)	{
				$depStatus = '<span class="label label-success"> Enabled</span>';
			} else if($array['status'] == 0) {
				$depStatus = '<span class="label label-danger">Disabled</span>';
			}	
	echo "<tr>";
		echo "<td>$depId</td>";
		echo "<td>$depName</td>";
		echo "<td>$depStatus</td>";

		echo "<td width='50px'><a href='department_action.php?mode=edit&DepID=$depId' class='btn btn-warning btn-xs'><i class='fa-solid fa-pen-to-square'></i> Edit</a></td>";	
		echo"<td width='50px'><a href='department_action.php?mode=delete&DepID=$depId' class='btn btn-danger btn-xs'><i class='fa-regular fa-trash-can'></i> Delete</a></td>";
	echo "</tr>";
}
?>
</table>


<!-- modal-dialog with fade -->
	<div id="departmentModal" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="departmentForm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"> Add Department</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="department" class="control-label">Department</label>
							<input type="text" class="form-control" id="department" name="department" placeholder="department" required>			
						</div>
						<div class="form-group">
							<label for="status" class="control-label">Status</label>				
							<select id="status" name="status" class="form-control">
							<option value="1">Enable</option>				
							<option value="0">Disable</option>	
							</select>						
						</div>						
						
					</div>
					<div class="modal-footer">
						<input type="hidden" name="departmentId" id="departmentId" value="<?php if (isset($depId)){echo $depId;} ?>"/>
						
						<input type="submit" name="btnsave" id="save" class="btn btn-info" value="Save" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>	
<?php include('footer.php');?>