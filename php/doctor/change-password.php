<?php
session_start();
include('../include_doctor/config.php');
include('../include_doctor/checklogin.php');
check_login();
date_default_timezone_set('Asia/Kolkata');
$currentTime = date( 'd-m-Y h:i:s A', time () );
if(isset($_POST['submit']))
{
	$sql=mysqli_query($con,"SELECT password FROM  doctors where password='".md5($_POST['cpass'])."' && id='".$_SESSION['id']."'");
	$num=mysqli_fetch_array($sql);
	if($num>0)
	{
		$con=mysqli_query($con,"update doctors set password='".md5($_POST['npass'])."', updationDate='$currentTime' where id='".$_SESSION['id']."'");
		$_SESSION['msg1']="Password Changed Successfully !!";
	}
	else
	{
		$_SESSION['msg1']="Old Password not match !!";
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
	
<script type="text/javascript">
	function valid()
	{
		if(document.chngpwd.cpass.value=="")
		{
			alert("Current Password Filed is Empty !!");
			document.chngpwd.cpass.focus();
			return false;
		}
		else if(document.chngpwd.npass.value=="")
		{
			alert("New Password Filed is Empty !!");
			document.chngpwd.npass.focus();
			return false;
		}
		else if(document.chngpwd.cfpass.value=="")
		{
			alert("Confirm Password Filed is Empty !!");
			document.chngpwd.cfpass.focus();
			return false;
		}
		else if(document.chngpwd.npass.value!= document.chngpwd.cfpass.value)
		{
			alert("Password and Confirm Password Field do not match  !!");
			document.chngpwd.cfpass.focus();
			return false;
		}
		return true;
	}
</script>

</head>
<body>
	<div id="app">		
		<?php include('../include_doctor/sidebar.php');?>
		<div class="app-content">
			<?php include('../include_doctor/header.php');?>
			<div class="main-content" >
				<div class="wrap-content container" id="container">
					<div class="container-fluid container-fullw bg-white">
						<div class="row margin-top-30">
							<div class="panel panel-white">
								<div class="panel-heading">
									<h5 class="panel-title">Change Password</h5>
								</div>
								
								<div class="panel-body">
									<p style="color:red;">
										<?php echo htmlentities($_SESSION['msg1']);?>
										<?php echo htmlentities($_SESSION['msg1']="");?>
									</p>	
									
									<form role="form" name="chngpwd" method="post" onSubmit="return valid();">
										
										<div class="form-group">
											<label for="exampleInputEmail1">
												Current Password
											</label>
											<input type="password" name="cpass" class="form-control"  placeholder="Enter Current Password">
										</div>
										
										<div class="form-group">
											<label for="exampleInputPassword1">
												New Password
											</label>
											<input type="password" name="npass" class="form-control"  placeholder="New Password">
										</div>
										
										<div class="form-group">
											<label for="exampleInputPassword1">
												Confirm Password
											</label>
											<input type="password" name="cfpass" class="form-control"  placeholder="Confirm Password">
										</div>
										
										<button type="submit" name="submit" class="btn btn-o btn-primary">
											Submit
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
			
	<script src="../design/vendor/jquery/jquery.min.js"></script>
	<script src="../design/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../design/vendor/modernizr/modernizr.js"></script>
	<script src="../design/vendor/jquery-cookie/jquery.cookie.js"></script>
	<script src="../design/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script src="../design/vendor/switchery/switchery.min.js"></script>

	<script src="../design/assets/js/main.js"></script>
	<script src="../design/assets/js/form-elements.js"></script>
	
	<script>
		jQuery(document).ready(function() {
			Main.init();
			FormElements.init();
		});
	</script>

</body>
</html>
