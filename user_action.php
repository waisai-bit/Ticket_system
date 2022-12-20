<?php
include('header.php');

if(isset($_REQUEST['mode']))
{
	$mode=$_REQUEST['mode'];
	$userId=$_REQUEST['UserID'];

	if($mode=="edit")
	{
		$select="SELECT * FROM users WHERE id='$userId'";
		$selret=mysqli_query($con,$select);
		$array=mysqli_fetch_array($selret);
		$userName=$array['name'];
		$email=$array['email'];
		$role=$array['user_type'];
		$status=$array['status'];
		$password=$array['password'];
	}
	else if ($mode== "delete") 
	{
		$del="DELETE FROM users WHERE id='$userId' ";
		$delquery=mysqli_query($con,$del);
		if($delquery)
		{
			header('Location: user.php');
		}

	}
}

if(isset($_POST['btnUpdate'])){
    
	$userId=$_POST['userId'];
	$userName=$_POST['userName'];
	$email=$_POST['email'];
	$role=$_POST['role'];
	$status=$_POST['status'];
	$password=$_POST['newPassword'];

    $update="UPDATE users
            SET name='$userName',
                email='$email',
                password='$password',
                user_type='$role',
                status='$status'
                WHERE id='$userId'";

    $retupdate=mysqli_query($con,$update);
    if($retupdate) //True 
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
	
    <div id="userModal">
		<div class="modal-dialog">
			<form method="post" id="userForm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" onclick="location.href='user.php'">&times;</button>
						<h4 class="modal-title">Edit User</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="userName" class="control-label">Name*</label>
							<input type="text" class="form-control" id="userName" name="userName" value="<?php if (isset($userName)){echo $userName;} ?>" placeholder="User name" required>			
						</div>
						
						<div class="form-group">
							<label for="email" class="control-label">Email*</label>
							<input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" placeholder="Email" required>			
						</div>
						<div class="form-group">
							<label for="role" class="control-label">Role</label>				
							<select id="role" name="role" class="form-control">
							<!-- <option value="admin">Admin</option>				 -->
								<?php
								if($array['user_type'] == 'admin'){
									echo"<option value='admin'>Admin</option>";
									echo"<option value='user'>Member</option>";
								}
								 else if($array['user_type'] == 'user') {
									echo"<option value='user'>Member</option>";
									echo"<option value='admin'>Admin</option>";
								}	
								else{
									echo"<option value='admin'>Admin</option>";
									echo"<option value='user'>Member</option>";
								}
								?>
								</select>
						</div>	
						
						<div class="form-group">
							<label for="status" class="control-label">Status</label>				
							<select id="status" name="status" class="form-control">
							<!-- <option value="1">Active</option>				 -->
                            <?php
								if($array['status'] == 1){
									echo"<option value=1>Active</option>";
									echo"<option value=0>Inactive</option>";
								}
								 else if($array['status'] == 0) {
									echo"<option value=0>Inactive</option>";
									echo"<option value=1>Active</option>";
								}	
								else{
									echo"<option value=1>Active</option>";
									echo"<option value=0>Inactive</option>";
								}
								?>
							</select>						
						</div>

						<div class="form-group">
							<label for="newPassword" class="control-label">Re-New Password*</label>
							<input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Password" required>			
						</div>											
						
					</div>
					<div class="modal-footer">
						<input type="hidden" name="userId" id="userId"  value="<?php echo $userId; ?>"/>
                        <input type='submit' name='btnUpdate' class="btn btn-info" value='Update info'>
						<!-- <input type="submit" name="btnUpdate" id="update" class="btn btn-info" value="Update Info" /> -->
                       <button type="button" class="btn btn-default" onclick="location.href='user.php'">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
<?php include('footer.php'); ?>