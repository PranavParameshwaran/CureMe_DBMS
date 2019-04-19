<?php
include_once('../include_admin/config.php');

if(isset($_POST['submit']))
{
	$fname=$_POST['full_name'];
	$address=$_POST['address'];
	$city=$_POST['city'];
	$gender=$_POST['gender'];
	$password=($_POST['password']);
	$query=mysqli_query($con,"insert into admin(username,address,city,gender,password) values('$fname','$address','$city','$gender','$password')");
	if($query)
	{
		echo "<script>alert('Successfully Registered. You can login now');</script>";
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
				<a href="../../index.html"><h2>Go to HospiDB Home</h2></a>
			</div>

			<div class="box-register">
				<form name="registration" id="registration"  method="post">
					<fieldset>
						<legend>
							Register
						</legend>
						<p>
							Enter your personal details below:
						</p>
						
						<div class="form-group">
							<input type="text" class="form-control" name="full_name" placeholder="Name" required>
						</div>
						
						<div class="form-group">
							<input type="text" class="form-control" name="address" placeholder="Address" required>
						</div>
						
						<div class="form-group">
							<input type="text" class="form-control" name="city" placeholder="City" required>
						</div>
						
						<div class="form-group">
							<label class="block">
								Gender
							</label>
							
							<div >
								
								<input type="radio" id="rg-female" name="gender" value="female" >
								<label for="rg-female">
									Female
								</label>
								
								<input type="radio" id="rg-male" name="gender" value="male">
								<label for="rg-male">
									Male
								</label>

							</div>
						</div>
						
						<p>
							Enter your password details :
						</p>
						
						<div class="form-group">
							<span class="input-icon">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
								<i class="fa fa-lock"></i> 
							</span>
						</div>
						
						<div class="form-group">
							<span class="input-icon">
								<input type="password" class="form-control" name="password_again" placeholder="Password Again" required>
								<i class="fa fa-lock"></i> 
							</span>
						</div>
						
						<div class="form-actions">
							<p>
								Already have an account?
								<a href="index.php">
									Login to my account
								</a>
							</p>
							<button type="submit" class="btn btn-primary pull-right" id="submit" name="submit">
								Submit <i class="fa fa-arrow-circle-right"></i>
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
		
	<script>
	function userAvailability() {
		$("#loaderIcon").show();
		jQuery.ajax({
			url: "check_availability.php",
			data:'email='+$("#email").val(),
			type: "POST",
			success:function(data){
				$("#user-availability-status1").html(data);
				$("#loaderIcon").hide();
			},
			error:function (){}
		});
	}
	</script>	
		
</body>

</html>