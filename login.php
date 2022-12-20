<?php
include('header.php');

$errorMessage='';
if (isset($_POST['login'])) 
    {
		if(!empty($_POST["login"]) && $_POST["email"]!=''&& $_POST["password"]!='') {	
			$email = $_POST['email'];
			$password = $_POST['password'];
			$sqlQuery = "SELECT * FROM users 
				WHERE email='$email' AND password='$password' AND status = 1";
				
			$resultSet = mysqli_query($con, $sqlQuery);
			$isValidLogin = mysqli_num_rows($resultSet);	
			if($isValidLogin){
				$array = mysqli_fetch_array($resultSet);
				$_SESSION["userid"] = $array['id'];
				$_SESSION["user_name"] = $array['name'];
				if($array['user_type'] == 'admin') {
					$_SESSION["admin"] = 1;
                    $_SESSION["user"] = 0;
				}elseif($array['user_type'] == 'user') {
					$_SESSION["user"] = 1;
                    $_SESSION["admin"] = 0;
				}
				header("location: ticket.php"); 		
			} else {		
				$errorMessage = "Invalid login!"; 		 
			}
		} else if(!empty($_POST["login"])){
			$errorMessage = "Enter Both user and password!";	
		}	
    }
?>
<section id="login_form">
        <div class=container>
           <h2>Ticket System</h2>
            <div class="row">
                <div class="col-md-6">
                    <div  class="panel panel-info" style="margin-left:20px"> 
                        <div class="panel-heading" style="background:#126fdac7;color:white;">
                            <div class="panel-title">User Login</div>
                        </div>
                    <div class="panel-body">
                 <?php if ($errorMessage !='') { ?>
					<div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $errorMessage; ?></div>                            
				<?php } ?>
                        <form id="login" class="form-horizontal" role="form" method="POST" action="">
                            <div class=input-group>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" id="email" name="email" placeholder="email" required>
                            </div>
                            <div class=input-group>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
                            </div>
                            <div class="form-group">                               
                                <div class="col-md-12">
                                  <input type="submit" name="login" value="Login" class="btn btn-success">						  
                                </div>						
                            </div>	
                        </form>
                     </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
include('footer.php');
?>
  
