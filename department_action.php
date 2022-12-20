<?php 
include('header.php'); 

if(isset($_REQUEST['mode']))
{
	$mode=$_REQUEST['mode'];
	$depId=$_REQUEST['DepID'];

	if($mode=="edit")
	{
		$select="SELECT * FROM departments WHERE id='$depId'";
		$selret=mysqli_query($con,$select);
		$array=mysqli_fetch_array($selret);
		$depName=$array['department'];
		$depStatus=$array['status'];
	}
	else if ($mode== "delete") 
	{
		$del="DELETE FROM departments WHERE id='$depId' ";
		$delquery=mysqli_query($con,$del);
		if($delquery)
		{
			header('Location: department.php');
		}

	}
}

if(isset($_POST['btnUpdate'])){
    
	$depId=$_POST['departmentId'];
	$depName=$_POST['department'];
	$depStatus=$_POST['status'];

    $update="UPDATE departments
            SET department='$depName',
                status='$depStatus'
                WHERE id='$depId'";

    $retupdate=mysqli_query($con,$update);
    if($retupdate) //True 
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
	<div id="departmentModal">
		<div class="modal-dialog">
			<form method="post" id="departmentForm">
				<div class="modal-content">
					<div class="modal-header">
                    <button type="button" class="close" onclick="location.href='department.php'">&times;</button>
						<h4 class="modal-title"> Add Department</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="department" class="control-label">Department</label>
							<input type="text" class="form-control" id="department" name="department" value="<?php if (isset($depId)){echo $depName;} ?>" placeholder="department" required>			
						</div>
						<div class="form-group">
							<label for="status" class="control-label">Status</label>				
							<select id="status" name="status" class="form-control">
                            <?php
								if($depStatus== 1){
									echo"<option value=1>Enable</option>";
									echo"<option value=0>Disable</option>";
								}
								 else if($depStatus == 0) {
									echo"<option value=0>Disable</option>";
									echo"<option value=1>Enable</option>";
								}	
								else{
									echo"<option value=1>Enable</option>";
									echo"<option value=0>Disable</option>";
								}
								?>
							</select>						
						</div>						
						
					</div>
					<div class="modal-footer">
						<input type="hidden" name="departmentId" id="departmentId" value="<?php if (isset($depId)){echo $depId;} ?>"/>
						
						<input type="submit" name="btnUpdate" id="save" class="btn btn-info" value="Update info" />
                        <button type="button" class="btn btn-default" onclick="location.href='department.php'">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>	
<?php include('footer.php');?>