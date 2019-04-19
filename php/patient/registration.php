<?php
include_once('../include_patient/config.php');

if(isset($_POST['submit']))
{
	$fname=$_POST['full_name'];
	$address=$_POST['address'];
	$city=$_POST['city'];
	$gender=$_POST['gender'];
	$email=$_POST['email'];
	$password=md5($_POST['password']);
	$query=mysqli_query($con,"insert into users(fullname,address,city,gender,email,password) values('$fname','$address','$city','$gender','$email','$password')");
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
								Registration
							</legend>
							
							<p>
								Enter your personal details :
							</p>

							<div class="form-group">
								<input type="text" class="form-control" name="full_name" placeholder="Name of patient" required>
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
									
									<input type="radio" id="rg-male" name="gender" value="male">
									<label for="rg-male">
										Male
									</label>


									<input type="radio" id="rg-female" name="gender" value="female" >
									<label for="rg-female">
										Female
									</label>

								</div>
							</div>
							
							<p>
								Enter your contact details :
							</p>
							
							<div class="form-group">
								<span class="input-icon">
									<input type="email" class="form-control" name="email" id="email" onBlur="userAvailability()"  placeholder="Email Id" required>
									<i class="fa fa-envelope"></i> 
								</span>
			
								<span id="user-availability-status1" style="font-size:12px;"></span>
							</div>
							
							<div class="form-group">
								<span class="input-icon">
									<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
									<i class="fa fa-lock"></i> 
								</span>
							</div>

							<div class="form-group">
								<span class="input-icon">
									<input type="password" class="form-control" name="password_again" placeholder="Confirm Password" required>
									<i class="fa fa-lock"></i> 
								</span>
							</div>

							<div class="form-actions">
								<p>
									Already have an account?
									<a href="user-login.php">
										Login to my account
									</a>
								</p>

								<button type="submit" class="btn btn-primary pull-right" id="submit" name="submit">
									Register <i class="fa fa-arrow-circle-right"></i>
								</button>
							</div>

						</fieldset>
					</form>
				</div>

			</div>
		</div>	
		
	</body>

</html>