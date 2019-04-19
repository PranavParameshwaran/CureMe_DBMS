<?php
session_start();
include('../include_doctor/config.php');
include('../include_doctor/checklogin.php');
if(isset($_POST['submit']))
{
	$docspecialization=$_POST['Doctorspecialization'];
	$docname=$_POST['docname'];
	$docaddress=$_POST['clinicaddress'];
	$docfees=$_POST['docfees'];
	$doccontactno=$_POST['doccontact'];
	$docemail=$_POST['docemail'];
	$sql=mysqli_query($con,"Update doctors set specilization='$docspecialization',doctorName='$docname',address='$docaddress',docFees='$docfees',contactno='$doccontactno' where id='".$_SESSION['id']."'");
	if($sql)
		echo "<script>alert('Doctor Details updated Successfully');</script>";
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
	<?php include('../include_doctor/sidebar.php');?>
		<div class="app-content">
			<?php include('../include_doctor/header.php');?>
			<div class="main-content" >
				<div class="wrap-content container" id="container">
					<div class="container-fluid container-fullw bg-white">
						<div class="row margin-top-30">
							<div class="panel panel-white">
								<div class="panel-heading">
									<h5 class="panel-title">Edit Doctor</h5>
								</div>
								
								<div class="panel-body">
									<?php 
									$sql=mysqli_query($con,"select * from doctors where docEmail='".$_SESSION['dlogin']."'");
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
													<?php
													$ret=mysqli_query($con,"select * from doctorspecilization");
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
													 Doctor Clinic Address
												</label>
												<textarea name="clinicaddress" class="form-control">
													<?php echo htmlentities($data['address']);?>
												</textarea>
											</div>
											
											<div class="form-group">
											<label for="fess">
												 Doctor Consultancy Fees
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
