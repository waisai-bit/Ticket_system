<?php
include('header.php');

if(isset($_POST['btnsave'])){
	$userName=$_POST['userName'];
	$email=$_POST['email'];
	$role=$_POST['role'];
	$status=$_POST['status'];
	$password=$_POST['newPassword'];
	$checkEmail="SELECT * FROM users
				WHERE email='$email'";
	$result=mysqli_query($con,$checkEmail);
	$count=mysqli_num_rows($result);

	if($count!=0) 
	{
		echo "<script>window.alert('User's Email $email is Already Taken! Plz Try Another')</script>";
		// echo "<script>window.location='user.php'</script>";
		header('Location: user.php');
		exit();
	}
	//Insert Data
	$insert="INSERT INTO `users`(`name`, `email`, `password`, `user_type`, `status`) 
			VALUES ('$userName','$email','$password','$role','$status')";
	$result=mysqli_query($con,$insert);
	if($result) //True 
	{
		header('Location: user.php');
	}
	else
	{
		echo "<p>Something wrong" . mysqli_error() . "</p>";
		header('Location: user.php');
	}
}


?>
<div class="container">	
	<div class="row home-sections">
	<h2>Ticket System</h2>
   <?php include('menu.php');?>
	</div> 
    <div class="panel-heading">
		<div class="row">
			<div class="col-md-10">
				<h3 class="panel-title"></h3>
			</div>
			<div class="col-md-2 text-right">
				<button type="button" name="add" id="addUser" class="btn btn-success btn-xs"><i class="fa fa-plus"> </i> Add New</button>
			</div>
		</div>
	</div>
	<?php 
		$query="SELECT * FROM users";
		$result=mysqli_query($con,$query);
		$count=mysqli_num_rows($result);
	?>
			
	<table id="datatableid" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th width="50px">S/N</th>
				<th>Name</th>					
				<th>Email</th>
				<th>Role</th>
				<th>Status</th>
				<th></th>
				<th  class="text-center">Action</th>
			</tr>
		</thead>
<?php  
	for ($i=0;$i<$count;$i++) 
{ 
	$array=mysqli_fetch_array($result);

	$userId=$array['id'];
	$userName=$array['name'];
	$email=$array['email'];
	$password=$array['password'];
	$status = '';
			if($array['status'] == 1)	{
				$status = '<span class="label label-success">Active</span>';
			} else if($array['status'] == 0) {
				$status = '<span class="label label-danger">Inactive</span>';
			}	
			
	$role = '';
			if($array['user_type'] == 'admin')	{
				$role = '<span class="label label-danger">Admin</span>';
			} else if($array['user_type'] == 'user') {
				$role = '<span class="label label-warning">Member</span>';
			}	
	
	echo "<tr>";
		echo "<td>$userId</td>";
		echo "<td>$userName</td>";
		echo "<td>$email</td>";
		echo "<td>$role</td>";
		echo "<td>$status</td>";
		// echo"<td><button type='button' name='btnupdate' id='".$userId."' class='btn btn-warning btn-xs update'>Edit</button></td>";
		echo "<td width='50px'><a href='user_action.php?mode=edit&UserID=$userId' class='btn btn-warning btn-xs'><i class='fa-solid fa-pen-to-square'></i> Edit</a></td>";
		echo"<td width='50px'><a href='user_action.php?mode=delete&UserID=$userId' class='btn btn-danger btn-xs'><i class='fa-regular fa-trash-can'></i> Delete</a></td>";

	echo "</tr>";
}
?>
	</table>


	<!-- modal-dialog with fade -->
	<div id="userModal" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="userForm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add User</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="userName" class="control-label">Name*</label>
							<input type="text" class="form-control" id="userName" name="userName" placeholder="User name" required>			
						</div>
						
						<div class="form-group">
							<label for="email" class="control-label">Email*</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>			
						</div>
						<div class="form-group">
							<label for="role" class="control-label">Role</label>				
							<select id="role" name="role" class="form-control">
							<option value="admin">Admin</option>
							<option value="user">Member</option>
								</select>
						</div>	
						
						<div class="form-group">
							<label for="status" class="control-label">Status</label>				
							<select id="status" name="status" class="form-control">
							<option value="1">Active</option>				
							<option value="0">Inactive</option>	
							</select>						
						</div>

						<div class="form-group">
							<label for="newPassword" class="control-label">New Password*</label>
							<input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Password" required>			
						</div>											
						
					</div>
					<div class="modal-footer">
						<input type="hidden" name="userId" id="userId"  value="<?php if (isset($userId)){echo $userId;} ?>"/>
						<!-- <input type="hidden" name="action" id="action" value="" /> -->
						<input type="submit" name="btnsave" id="save" class="btn btn-info" value="Save" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>	
<?php include('footer.php');?>