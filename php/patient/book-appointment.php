<?php
session_start();
include('../include_patient/config.php');
include('../include_patient/checklogin.php');
check_login();

if(isset($_POST['submit']))
{

	$specilization=$_POST['Doctorspecialization'];
	$doctorid=$_POST['doctor'];
	$userid=$_SESSION['id'];
	$fees=$_POST['fees'];
	$appdate=$_POST['appdate'];
	$time=$_POST['apptime'];
	$userstatus=1;
	$docstatus=1;
	$query=mysqli_query($con,"insert into appointment(doctorSpecialization,doctorId,userId,consultancyFees,appointmentDate,appointmentTime,userStatus,doctorStatus) values('$specilization','$doctorid','$userid','$fees','$appdate','$time','$userstatus','$docstatus')");

	if($query)
	{

		/*$mob="6382175890";  
		$msg="Your Appointment is Fixed with $specilization department on $appdate at $time. Wishing You speedy recovery";

		$json = json_decode(file_get_contents("https://smsapi.engineeringtgr.com/send/?Mobile=7395947293&Password=Q3689C&Message=".urlencode($msg)."&To=".urlencode($mob)."&Key=Web.dCAUbZFdQ8NTyoW9SPfX0Yzuv") ,true);
		if ($json["status"]==="success")
		    echo $json["msg"];
		else
		    echo $json["msg"];
	   	
*/
		echo "<script>alert('Your appointment successfully booked');</script>";
		
		    
		$mob="6382175890";  
		$msg=" Appointment Has been Fixed with $specilization department on $appdate at $time. Wishing ";

		$json = json_decode(file_get_contents("https://smsapi.engineeringtgr.com/send/?Mobile=7981029296&Password=G3422N&Message=".urlencode($msg)."&To=".urlencode($mob)."&Key=Web.dGJSQHcpw4Bbh93zy") ,true);
		if ($json["status"]==="success")
		    echo $json["msg"];
		else
		    echo $json["msg"];
		
		    
		/*    
		$mob="6382175890";  
		$msg="Your Appointment is Fixed with $specilization department on $appdate at $time. Wishing You speedy recovery";

		$json = json_decode(file_get_contents("https://smsapi.engineeringtgr.com/send/?Mobile=6382175890&Password=B2862A&Message=".urlencode($msg)."&To=".urlencode($mob)."&Key=Web.djlXUB6D5npImVTso3gAKOYw7") ,true);
		if ($json["status"]==="success")
		    echo $json["msg"];
		else
		    echo $json["msg"];
	   	*/



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
		
	<script>
	function getdoctor(val) {
		$.ajax({
			type: "POST",
			url: "get_doctor.php",
			data:'specilizationid='+val,
			success: function(data){
				$("#doctor").html(data);
			}
		});
	}
	</script>	


	<script>
	function getfee(val) {
		$.ajax({
			type: "POST",
			url: "get_doctor.php",
			data:'doctor='+val,
			success: function(data){
				$("#fees").html(data);
			}
		});
	}
	</script>	



</head>
	
<body>
	<div id="app">		
	<?php include('../include_patient/sidebar.php');?>
		<div class="app-content">
			<?php include('../include_patient/header.php');?>
			<div class="main-content" >
				<div class="wrap-content container" id="container">
					<div class="container-fluid container-fullw bg-white">
						<div class="panel panel-white">
							<div class="panel-heading">
								<h5 class="panel-title">Book Appointment</h5>
							</div>
							<div class="panel-body">
								<p style="color:red;">
									<?php echo htmlentities($_SESSION['msg1']);?>
									<?php echo htmlentities($_SESSION['msg1']="");?>
								</p>	
								<form role="form" name="book" method="post" >
									<div class="form-group">
										<label for="DoctorSpecialization">
											Doctor Specialization
										</label>
										<select name="Doctorspecialization" class="form-control" onChange="getdoctor(this.value);" required="required">
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
										<label for="doctor">
											Doctors
										</label>
										<select name="doctor" class="form-control" id="doctor" onChange="getfee(this.value);" required="required">
											<option value="">Select Doctor</option>
										</select>
									</div>

									<div class="form-group">
										<label for="consultancyfees">
											Consultancy Fees
										</label>
										<select name="fees" class="form-control" id="fees"  readonly></select>
									</div>
										
									<div class="form-group">
										<label for="AppointmentDate">
											Date
										</label>
										<input class="form-control datepicker" name="appdate"  placeholder="Date" required="required" data-date-format="yyyy-mm-dd">eg : dd-mm-yyyy
									</div>
										
									<div class="form-group">
										<label for="Appointmenttime">
											Time
										</label>
										<input class="form-control" name="apptime" id="timepicker1" placeholder="Time" required="required">eg : 10:00 PM
									</div>														
										
									<button type="submit" name="submit" class="btn btn-o btn-primary">
										Submit
									</button>
									<?php include('../../../contact.php');?>
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



	</body>
</html>
