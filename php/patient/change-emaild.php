<?php
session_start();
include('../include_patient/config.php');
include('../include_patient/checklogin.php');
check_login();
if(isset($_POST['submit']))
{
	$email=$_POST['email'];
	$sql=mysqli_query($con,"Update users set email='$email' where id='".$_SESSION['id']."'");
	if($sql)
	{
		$msg="Your email updated Successfully";
	}

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
	<link rel="stylesheet" href="../design/assets/css/plugins.css">
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
							<div class="col-md-12">
								<h5 style="color: green; font-size:18px; ">
									<?php if($msg) { echo htmlentities($msg);}?> 
								</h5>
								<div class="panel panel-white">
									<div class="panel-heading">
										<h5 class="panel-title">Edit Email</h5>
									</div>
									<div class="panel-body">
										<form name="registration" id="updatemail"  method="post">
											<div class="form-group">
												<label for="fess">
													User Email
												</label>
											<input type="email" class="form-control" name="email" id="email" onBlur="userAvailability()"  placeholder="Email" required>

						 					<span id="user-availability-status1" style="font-size:12px;"></span>
											</div>
											<button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">
												Update
											</button>
										</form>
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
