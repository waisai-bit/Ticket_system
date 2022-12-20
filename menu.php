
<nav class="navbar navbar-inverse" style="background:#126fdac7;color:#fff;font-weight:bold;border:1px solid #126fdac7">
        <div class="container-fluid">		
            <ul class="nav navbar-nav menus">
                <li id="ticket"><a href="ticket.php" class="navbar-brand">Ticket</a></li>
                <?php if($_SESSION["admin"]==1) { ?>
				<li id="department"><a href="department.php" >Department</a></li>
				<li id="user"><a href="user.php" >Users</a></li>				
			<?php } ?>									
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="label label-pill label-danger count"></span> 
				<img src="resources/img/power-button.png" width="20px">&nbsp;<?php if(isset($_SESSION["userid"])) { echo $_SESSION["user_name"]; } ?></a>
				<ul class="dropdown-menu">					
					<li><a href="logout.php">Logout</a></li>
                    
				</ul>
			</li>
            </ul>
        </div>
</nav>
