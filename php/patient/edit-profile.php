<?php
session_start();
include('../include_patient/config.php');
include('../include_patient/checklogin.php');
check_login();
if(isset($_POST['submit']))
{
	$fname=$_POST['fname'];
	$address=$_POST['address'];
	$city=$_POST['city'];
	$gender=$_POST['gender'];

	$sql=mysqli_query($con,"Update users set fullName='$fname',address='$address',city='$city',gender='$gender' where id='".$_SESSION['id']."'");
	if($sql)
		$msg="Your Profile updated Successfully";

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>CureMe - HospiDB</title>
	<meta charset="utf-8" />
	

	<link rel="stylesheet" href="../design/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../design/vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../design/vendor/themify-icons/themify-icons.min.css">
	
	<link rel="stylesheet" href="../design/assets/css/styles.css">
	<link rel="stylesheet" href="../design/assets/css/themes/theme-1.css" id="skin_color" />


</head>

<body>
	<div id="app">		
		<?php include('../include_patient/sidebar.php');?>
		<div class="app-content">
			
			<?php include('../include_patient/header.php');?>
					
			<div class="main-content" >
				<div class="wrap-content container" id="container">
					<div class="container-fluid container-fullw bg-white">
						<div class="row">
							<div >
								<h5 style="color: green; font-size:18px; ">
								<?php if($msg) { echo htmlentities($msg);}?> 
								</h5>
								<div class="panel panel-white">
									<div class="panel-heading">
										<h5 class="panel-title">Edit Profile</h5>
									</div>
									<div class="panel-body">
										<?php 
										$sql=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
										while($data=mysqli_fetch_array($sql))
										{
										?>
											<form role="form" name="edit" method="post">
											
												<div class="form-group">
													<label for="fname">
														User Name
													</label>
													<input type="text" name="fname" class="form-control" value="<?php echo htmlentities($data['fullName']);?>" >
												</div>

												<div class="form-group ">
													<label for="address">
														Address
													</label>
													<textarea name="address" class="form-control">
														<?php echo htmlentities($data['address']);?>
													</textarea>
												</div>
												
												<div class="form-group">
													<label for="city">
														City
													</label>
													<input type="text" name="city" class="form-control" required="required"  value="<?php echo htmlentities($data['city']);?>" >
												</div>

												<div class="form-group">
													<label for="gender">
														Gender
													</label>
													<input type="text" name="gender" class="form-control" required="required"  value="<?php echo htmlentities($data['gender']);?>">
												</div>

												<div class="form-group">
													<label for="fess">
														User Email
													</label>
													<input type="email" name="uemail" class="form-control"  readonly="readonly"  value="<?php echo htmlentities($data['email']);?>">
													<a href="change-emaild.php">Update your email id</a>
												</div>

												<button type="submit" name="submit" class="btn btn-o btn-primary">
													Update
												</button>
											</form>
										
										<?php 
										} 
										?>
									</div>
								</div>
							</div>		
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	

</body>
</html>
