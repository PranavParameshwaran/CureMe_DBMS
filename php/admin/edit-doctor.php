<?php
session_start();
include('../include_admin/config.php');
include('../include_admin/checklogin.php');
check_login();
$did=intval($_GET['id']);
if(isset($_POST['submit']))
{
	$docspecialization=$_POST['Doctorspecialization'];
	$docname=$_POST['docname'];
	$docaddress=$_POST['clinicaddress'];
	$docfees=$_POST['docfees'];
	$doccontactno=$_POST['doccontact'];
	$docemail=$_POST['docemail'];
	$sql=mysqli_query($con,"Update doctors set specilization='$docspecialization',doctorName='$docname',address='$docaddress',docFees='$docfees',contactno='$doccontactno',docEmail='$docemail' where id='$did'");
	if($sql)
	$msg="Doctor Details updated Successfully";
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

</head>
	
<body>
	<div id="app">		
		<?php include('../include_admin/sidebar.php');?>
		<div class="app-content">
			<?php include('../include_admin/header.php');?>
			<div class="main-content" >
				<div class="wrap-content container" id="container">
					<section id="page-title">
					</section>
					<div class="container-fluid container-fullw bg-white">
						<h5 style="color: green; font-size:18px; ">
							<?php if($msg) { echo htmlentities($msg);}?> 
						</h5>
						<div class="row margin-top-30">
						
							<div class="panel panel-white">
								<div class="panel-heading">
									<h5 class="panel-title">Edit Doctor information</h5>
								</div>
								<div class="panel-body">
									<?php $sql=mysqli_query($con,"select * from doctors where id='$did'");
									while($data=mysqli_fetch_array($sql))
									{
									?>
										<form role="form" name="adddoc" method="post" onSubmit="return valid();">
											<div class="form-group">
												<label for="DoctorSpecialization">
													Doctor Specialization
												</label>
												
												<select name="Doctorspecialization" class="form-control" required="required">
													<option value="<?php echo htmlentities($data['specilization']);?>">
														<?php echo htmlentities($data['specilization']);?>
													</option>
													<?php $ret=mysqli_query($con,"select * from doctorspecilization");
													
													while($row=mysqli_fetch_array($ret))
													{
													?>
														<option value="<?php echo htmlentities($row['specilization']);?>">
															<?php echo htmlentities($row['specilization']);?>
														</option>
													<?php 
													} 
													?>
												</select>
											</div>

											<div class="form-group">
												<label for="doctorname">
													Doctor Name
												</label>
												
												<input type="text" name="docname" class="form-control" value="<?php echo htmlentities($data['doctorName']);?>" >
											</div>

											<div class="form-group">
												<label for="address">
													Address
												</label>
												<textarea name="clinicaddress" class="form-control"><?php echo htmlentities($data['address']);?></textarea>
											</div>
											
											<div class="form-group">
												<label for="fess">
													 Doctor Consultation Fees
												</label>
												<input type="text" name="docfees" class="form-control" required="required"  value="<?php echo htmlentities($data['docFees']);?>" >
											</div>

											<div class="form-group">
												<label for="fess">
													 Doctor Contact no
												</label>
												<input type="text" name="doccontact" class="form-control" required="required"  value="<?php echo htmlentities($data['contactno']);?>">
											</div>

											<div class="form-group">
												<label for="fess">
													Doctor Email
												</label>
												<input type="email" name="docemail" class="form-control"  readonly="readonly"  value="<?php echo htmlentities($data['docEmail']);?>">
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
