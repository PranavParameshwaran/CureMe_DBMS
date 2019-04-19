<?php
session_start();
include("../include_doctor/config.php");

if(isset($_POST['submit']))
{
	$ret=mysqli_query($con,"SELECT * FROM doctors WHERE docEmail='".$_POST['username']."' and password='".md5($_POST['password'])."'");
	$num=mysqli_fetch_array($ret);
	
	if($num>0)
	{
		$extra="dashboard.php";
		$_SESSION['dlogin']=$_POST['username'];
		$_SESSION['id']=$num['id'];
		$uip=$_SERVER['REMOTE_ADDR'];
		$status=1;
		$log=mysqli_query($con,"insert into doctorslog(uid,username,userip,status) values('".$_SESSION['id']."','".$_SESSION['dlogin']."','$uip','$status')");
		$host=$_SERVER['HTTP_HOST'];
		$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
		header("location:http://$host$uri/$extra");
		exit();
	}
	else
	{
		$host  = $_SERVER['HTTP_HOST'];
		$_SESSION['dlogin']=$_POST['username'];
		$uip=$_SERVER['REMOTE_ADDR'];
		$status=0;
		mysqli_query($con,"insert into doctorslog(username,userip,status) values('".$_SESSION['dlogin']."','$uip','$status')");
		$_SESSION['errmsg']="Invalid username or password";
		$extra="index.php";
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
							Please enter your email id and password to log in.<br />
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
						
					
					</fieldset>
				</form>
			</div>
		</div>
	</div>

	<script src="../design/vendor/jquery/jquery.min.js"></script>
	<script src="../design/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../design/vendor/modernizr/modernizr.js"></script>
	<script src="../design/vendor/jquery-cookie/jquery.cookie.js"></script>
	<script src="../design/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script src="../design/vendor/switchery/switchery.min.js"></script>
	<script src="../design/vendor/jquery-validation/jquery.validate.min.js"></script>

	<script src="../design/assets/js/main.js"></script>
	<script src="../design/assets/js/login.js"></script>
	
	<script>
		jQuery(document).ready(function() {
			Main.init();
			Login.init();
		});
	</script>

</body>

</html>