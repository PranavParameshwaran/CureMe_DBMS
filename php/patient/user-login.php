<?php
session_start();
error_reporting(0);
include("../include_patient/config.php");

if(isset($_POST['submit']))
{
	$ret=mysqli_query($con," SELECT * FROM users WHERE email='".$_POST['username']."' and password='".md5($_POST['password'])."' ");
	$num=mysqli_fetch_array($ret);
	
	if($num>0)
	{
		$extra="dashboard.php";//
		$_SESSION['login']=$_POST['username'];
		$_SESSION['id']=$num['id'];
		$host=$_SERVER['HTTP_HOST'];
	
		$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
		header("location:http://$host$uri/$extra");
		exit();
	}
	else
	{
		$_SESSION['login']=$_POST['username'];	
		$_SESSION['errmsg']="Invalid username or password";
		$extra="user-login.php";
		$host  = $_SERVER['HTTP_HOST'];
		
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
		header("location:http://$host$uri/$extra");
		exit();
	}
}
?>


<!DOCTYPE html>
<html lang="en">
	
	<head>
		<title>CureMe - HospiDB</title>
		<meta charset="utf-8" />
 		<link rel="stylesheet" href="../design/assets/css/styles.css"> 		
	</head>

	<body class="login">
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="logo margin-top-30">
				<a href="../../index.html"><h2> Go to HospiDB Home </h2></a>
				</div>

				<div class="box-login">
					<form class="form-login" method="post">
						<fieldset>
							<legend>
								Login
							</legend>
							
							<p>
								Please enter your e-mail and password to log in.<br />
								<span style="color:red;">
									<?php echo $_SESSION['errmsg']; ?>
									<?php echo $_SESSION['errmsg']="";?>
								</span>
							</p>
							
							<div class="form-group">
								<span class="input-icon">
									<input type="text" class="form-control" name="username" placeholder="E-mail Id">
									<i class="fa fa-user"></i> 
								</span>
							</div>
							
							<div class="form-group form-actions">
								<span class="input-icon">
									<input type="password" class="form-control password" name="password" placeholder="Password">
									<i class="fa fa-lock"></i>
								</span>
							</div>
							
							<div class="form-actions">
								
								<button type="submit" class="btn btn-primary pull-right" name="submit">
									Login <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>
							
							<div class="new-account">
								Don't have an account ?
								<a href="registration.php">
									Register an account
								</a>
							</div>
						
						</fieldset>
					</form>
				</div>

			</div>
		</div>

	
	</body>

</html>