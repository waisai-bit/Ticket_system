<?php
include('header.php');

if(isset($_POST['btnsave'])){
	$userId=$_SESSION["userid"];
	$uniqid = uniqid(); 
	$subject=$_POST['subject'];
	$departmentId=$_POST['department'];
	$message=$_POST['message'];
	$status=$_POST['status'];
	
	//Insert Data
	$insert="INSERT INTO `tickets`(`uniqid`, `user`, `subject`, `message`, `department`, `ticket_status`) 
			VALUES ('$uniqid','$userId','$subject','$message','$departmentId','$status')";
	$result=mysqli_query($con,$insert);
	if($result) //True 
	{
		header('Location: ticket.php');
	}
	else
	{
		echo "<p>Something wrong" . mysqli_error() . "</p>";
		header('Location: ticket.php');
	}
}


?>
<div class="container">	
	<div class="row home-sections">
	<h2>Ticket System</h2>
   <?php include('menu.php');?>
	</div> 
	<div><p>View and manage tickets that may have responses from support team.</p>	</div>
    <div class="panel-heading">
		<div class="row">
			<div class="col-md-10">
				<h3 class="panel-title"></h3>
			</div>
			<div class="col-md-2 text-right">
				<button type="button" name="add" id="addTicket" class="btn btn-success btn-sm"><i class="fa fa-plus"> </i> Create Ticket</button>
			</div>
		</div>
	</div>
			
	<?php  
	$query="SELECT * FROM tickets t, departments d, users u where t.user=u.id and t.department=d.id";
	$result=mysqli_query($con,$query);
	$count=mysqli_num_rows($result);
	?>
	<table id="datatableid" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>S/N</th>
					<th>Ticket ID</th>
					<th>Subject</th>
					<th>Message</th>
					<th>Department</th>
					<th>Created By</th>						
					<th>Status</th>
		<?php	if($_SESSION["user"] == 0 and $_SESSION["admin"] == 1){
					echo"<th></th>";
					echo"<th class='text-center'>Action</th>";
		}
		?>
				</tr>
			</thead>
<?php  
	for ($i=0;$i<$count;$i++) 
{ 
	$array=mysqli_fetch_array($result);

	$ticketId=$array['ticket_id'];
	$uniqid=$array['uniqid'];
	$user=$array['name'];
	$subject=$array['subject'];
	$message=$array['message'];
	$department=$array['department'];

	$status = '';
			if($array['ticket_status'] == 2)	{
				$status = '<span class="label label-success">Solved</span>';
			}else if($array['ticket_status'] == 1) {
				$status = '<span class="label label-warning">In review</span>';
			}else if($array['ticket_status'] == 0) {
				$status = '<span class="label label-danger">Pending</span>';
			}	
	$role = '';
			if($array['user_type'] == 'admin')	{
				$role = '<span class="label label-danger">Admin</span>';
			} else if($array['user_type'] == 'user') {
				$role = '<span class="label label-warning">Member</span>';
			}	
if($_SESSION["user"] == 1 and $_SESSION["admin"] == 0 and $_SESSION['userid']==$array['id']){
	echo "<tr>";
		echo "<td>$ticketId</td>";
		echo "<td>$uniqid</td>";
		echo "<td>$subject</td>";
		echo "<td>$message</td>";
		echo "<td>$department</td>";
		echo "<td>$user $role</td>";
		echo "<td>$status</td>";
	echo "</tr>";
}elseif($_SESSION["user"] == 0 and $_SESSION["admin"] == 1){
	echo "<tr>";
	echo "<td>$ticketId</td>";
	echo "<td>$uniqid</td>";
	echo "<td>$subject</td>";
	echo "<td>$message</td>";
	echo "<td>$department</td>";
	echo "<td>$user $role</td>";
	echo "<td>$status</td>";
	echo "<td width='40px'><a href='ticket_action.php?mode=edit&TicketID=$ticketId' class='btn btn-warning btn-xs'><i class='fa-solid fa-pen-to-square'></i> Edit</a></td>";
	echo"<td width='40px'><a href='ticket_action.php?mode=delete&TicketID=$ticketId' class='btn btn-danger btn-xs'><i class='fa-regular fa-trash-can'></i> Delete</a></td>";
	echo "</tr>";
}
}
?>
	</table>


	<!-- modal-dialog with fade -->
	<div id="ticketModal" class="modal fade">
		<div class="modal-dialog">
			<form method="post" id="ticketForm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add Ticket</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="subject" class="control-label">Subject</label>
							<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>			
						</div>
						<div class="form-group">
							<label for="department" class="control-label">Department</label>							
							<select id="department" name="department" class="form-control" placeholder="Department...">					
										<?php
										$run=mysqli_query($con,"SELECT * FROM departments");
										$c=mysqli_num_rows($run);
										for($i=0;$i<$c;$i++)
										{
											$array=mysqli_fetch_array($run);
												$depId=$array['id'];
												$depName=$array['department'];
												$status=$array['status'];
												if($status==1){
												echo "<option value='$depId'>$depName</option>";}
										}
							?>
							</select>						
						</div>						
						<div class="form-group">
							<label for="message" class="control-label">Message</label>							
							<textarea class="form-control" rows="5" id="message" name="message"></textarea>							
						</div>	
						<div class="form-group">
							<label for="status" class="control-label">Status</label>							
							<label class="radio-inline">
								<input type="radio" name="status" id="open" value="0" checked required>Pending
							</label>
							<?php if($_SESSION["admin"]==1) { ?>
								<label class="radio-inline">
									<input type="radio" name="status" id="close" value="1" required>In Review
								</label>
								<label class="radio-inline">
									<input type="radio" name="status" id="close" value="2" required>Solved
								</label>
							<?php } ?>	
						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="ticketId" id="ticketId" value="<?php if (isset($ticketId)){echo $ticketId;} ?>"/>
						<input type="submit" name="btnsave" id="save" class="btn btn-info" value="Save Ticket" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>	
<?php include('footer.php');?>