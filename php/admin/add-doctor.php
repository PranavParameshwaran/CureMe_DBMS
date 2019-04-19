<?php
session_start();
include('../include_admin/config.php');
include('../include_admin/checklogin.php');
check_login();

if(isset($_POST['submit']))
{	$docspecialization=$_POST['Doctorspecialization'];
	$docname=$_POST['docname'];
	$docaddress=$_POST['clinicaddress'];
	$docfees=$_POST['docfees'];
	$doccontactno=$_POST['doccontact'];
	$docemail=$_POST['docemail'];
	$password=md5($_POST['npass']);
	$sql=mysqli_query($con,"insert into doctors(specilization,doctorName,address,docFees,contactno,docEmail,password) values('$docspecialization','$docname','$docaddress','$docfees','$doccontactno','$docemail','$password')");
	
	if($sql)
	{
		echo "<script>alert('Doctor info added Successfully');</script>";
		header('location:manage-doctors.php');

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
		 if(document.adddoc.npass.value!= document.adddoc.cfpass.value)
		{
			alert("Password and Confirm Password Field do not match  !!");
			document.adddoc.cfpass.focus();
			return false;
		}
		return true;
	}
</script>

</head>
<body>
		<div id="app">		
			<?php include('../include_admin/sidebar.php');?>
			<div class="app-content">
				<?php include('../include_admin/header.php');?>
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<div class="container-fluid container-fullw bg-white">
							<div class="panel panel-white">
								<div class="panel-heading">
									<h5 class="panel-title">Add Doctor details</h5>
								</div>
								
								<div class="panel-body">
									<form role="form" name="adddoc" method="post" onSubmit="return valid();">
										<div class="form-group">
											<label for="DoctorSpecialization">
												Doctor Specialization
											</label>
											<select name="Doctorspecialization" class="form-control" required="required">
												<option value="">Select Specialization</option>
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
											<input type="text" name="docname" class="form-control"  placeholder="Enter Doctor Name">
										</div>


										<div class="form-group">
											<label for="address">
												 Doctor Clinic Address
											</label>
											<textarea name="clinicaddress" class="form-control"  placeholder="Enter Doctor Clinic Address"></textarea>
										</div>
										
										<div class="form-group">
											<label for="fess">
												 Doctor Consultancy Fees
											</label>
											<input type="text" name="docfees" class="form-control"  placeholder="Enter Doctor Consultancy Fees">
										</div>

										<div class="form-group">
											<label for="fess">
												 Doctor Contact no
											</label>
											<input type="text" name="doccontact" class="form-control"  placeholder="Enter Doctor Contact no">
										</div>

										<div class="form-group">
											<label for="fess">
												 Doctor Email
											</label>
											<input type="email" name="docemail" class="form-control"  placeholder="Enter Doctor Email id">
										</div>

										<div class="form-group">
											<label for="exampleInputPassword1">
												 Password
											</label>
											<input type="password" name="npass" class="form-control"  placeholder="New Password" required="required">
										</div>
										
										<div class="form-group">
											<label for="exampleInputPassword2">
												Confirm Password
											</label>
											<input type="password" name="cfpass" class="form-control"  placeholder="Confirm Password" required="required">
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
