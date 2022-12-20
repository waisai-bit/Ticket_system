<?php 
include('header.php'); 

if(isset($_REQUEST['mode']))
{
	$mode=$_REQUEST['mode'];
	$ticketId=$_REQUEST['TicketID'];

	if($mode=="edit")
	{
		// $select="SELECT * FROM tickets WHERE ticket_id='$ticketId'";
        $select="SELECT * FROM tickets t, departments d
                WHERE  t.department=d.id and t.ticket_id='$ticketId'";
		$selret=mysqli_query($con,$select);
		$array=mysqli_fetch_array($selret);
		
        $subject=$array['subject'];
        // $message=$array['message'];
        $depName=$array['department'];
        $depId=$array['id'];
        $ticket_status=$array['ticket_status'];
	}
	else if ($mode== "delete") 
	{
		$del="DELETE FROM tickets WHERE ticket_id='$ticketId' ";
		$delquery=mysqli_query($con,$del);
		if($delquery)
		{
			header('Location: ticket.php');
		}

	}
}

if(isset($_POST['btnUpdate'])){
    
    $ticketId=$_POST["ticketId"];
	$subject=$_POST['subject'];
	$departmentId=$_POST['department'];
	$status=$_POST['status'];

    $update="UPDATE tickets
            SET subject='$subject',
                department='$departmentId',
                ticket_status='$status' 
                WHERE ticket_id='$ticketId'";

    $retupdate=mysqli_query($con,$update);
    if($retupdate) //True 
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
<div id="ticketModal">
		<div class="modal-dialog">
			<form method="post" id="ticketForm">
				<div class="modal-content">
					<div class="modal-header">
                    <button type="button" class="close" onclick="location.href='ticket.php'">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Edit Ticket</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="subject" class="control-label">Subject</label>
							<input type="text" class="form-control" id="subject" name="subject" value="<?php echo $subject;?>" placeholder="Subject" required>			
						</div>
						<div class="form-group">
							<label for="department" class="control-label">Department</label>							
							<select id="department" name="department" class="form-control" value="<?php echo $depName;?>" placeholder="Department...">					
										<?php
                                        if (isset($depName))
                                        {
                                            echo "<option value='$depId'> $depName</option>";
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
                                    }
							?>
							</select>						
						</div>						
						<!-- <div class="form-group">
							<label for="message" class="control-label">Message</label>							
							<textarea class="form-control" rows="5" id="message" name="message"></textarea>							
						</div>	 -->
						<div class="form-group">
							<label for="status" class="control-label">Status</label>	
							<?php if($ticket_status==0) { ?>						
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
							<?php } }elseif($ticket_status==1) { ?>						
							<label class="radio-inline">
								<input type="radio" name="status" id="open" value="0" required>Pending
							</label>
							<?php if($_SESSION["admin"]==1) { ?>
								<label class="radio-inline">
									<input type="radio" name="status" id="close" value="1" checked required>In Review
								</label>
								<label class="radio-inline">
									<input type="radio" name="status" id="close" value="2" required>Solved
								</label>
							<?php } }elseif($ticket_status==2) { ?>						
							<label class="radio-inline">
								<input type="radio" name="status" id="open" value="0" required>Pending
							</label>
							<?php if($_SESSION["admin"]==1) { ?>
								<label class="radio-inline">
									<input type="radio" name="status" id="close" value="1"  required>In Review
								</label>
								<label class="radio-inline">
									<input type="radio" name="status" id="close" value="2" checked required>Solved
								</label>
							<?php } }?>	

						</div>
					</div>
					<div class="modal-footer">
						<input type="hidden" name="ticketId" id="ticketId" value="<?php if (isset($ticketId)){echo $ticketId;} ?>"/>
						<input type="submit" name="btnUpdate" id="save" class="btn btn-info" value="Update info" />
                        <button type="button" class="btn btn-default" onclick="location.href='ticket.php'">Close</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>	
<?php include('footer.php');?>