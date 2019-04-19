<?php
session_start();
include('../include_doctor/config.php');
include('../include_doctor/checklogin.php');
check_login();

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
	

</head>
<body>
	<div id="app">		
		<?php include('../include_doctor/sidebar.php');?>
		<div class="app-content">
			
			<?php include('../include_doctor/header.php');?>
			
			<div class="main-content" >
				<div class="wrap-content container" id="container">	
					<div class="row">
						<div class="col-sm-8">
							<h2 class="mainTitle">Hi, 
							<span class="username">
								<?php 
								$query=mysqli_query($con,"select doctorName from doctors where id='".$_SESSION['id']."'");
								while($row=mysqli_fetch_array($query))
								{
									echo $row['doctorName'];
								}
								?> 
							</span>

							<h2 class="mainTitle"> Believe in yourself !!! <br> Serve for country !!!  </h2>

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
