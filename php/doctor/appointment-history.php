<?php
session_start();
include('../include_doctor/config.php');
include('../include_doctor/checklogin.php');
check_login();


if(isset($_GET['cancel']))
{
    mysqli_query($con,"update appointment set doctorStatus='0' where id = '".$_GET['id']."'");
    $_SESSION['msg']="Record Removed !!";


	$to = "cruzerblaze1999@gmail.com";
	$subject = "Hospital DB";
	$txt = "Dear Patient, \n Your Medical Report has been removed from the database and the has been attached with this Email Id. \n For Further clarifications regarding this you can reply to the mail. \n \n Wishing you a Speedy Recovery !!!\n\n\n Live and Let live a healthy life \n CureMe - HospiDB";
	$headers = "From: Web.demo218@gmail.com";
	mail($to,$subject,$txt,$headers);

    
}

if(isset($_GET['send']))
{
    $_SESSION['msg']="Reports has been sent in mail !!";

	$to = "cruzerblaze1999@gmail.com";
	$subject = "Hospital DB";
	$txt = "Dear Patient, \n Your Medical Report has been attached with this Email Id. \n For Further clarifications you can reply to the mail. \n\n Wishing you a Speedy Recovery !!!\n\n\n Live and Let live a healthy life CureMe - HospiDB";
	$headers = "From: Web.demo218@gmail.com";
	mail($to,$subject,$txt,$headers);

    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Appointment History</title>
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
						
						<br><br>
						<h1>Search Patients Records</h1>

						<form action="" method="post" >
							<input type="text" name="search" >
							<input type="submit" name="submit" value="Search">
						</form>
						
						<table class="table table-hover" id="sample-table-1">
							<thead>
								<tr>
									<th class="center">#</th>
									<th class="hidden-xs">Patient  Name</th>
									<th>Specialization</th>
									<th>Consultancy Fee</th>
									<th>Next Consulting Date / Time </th>
									<th>Last Check Up/Queries Date </th>
									<th>Report</th>
									<th>Current Status</th>
									<th>Action</th>
								</tr>
							</thead>
							
							<tbody>
								
								<?php
								$sql=mysqli_query($con,"select users.fullName as fname,appointment.*  from appointment join users on users.id=appointment.userId where appointment.doctorId='".$_SESSION['id']."' and users.fullName='".$_POST["search"]."'");
								$cnt=1;
								while($row=mysqli_fetch_array($sql))
								{
								?>
									<tr>
										<td class="center"><?php echo $cnt;?>.</td>
										<td class="hidden-xs"><?php echo $row['fname'];?></td>
										<td><?php echo $row['doctorSpecialization'];?></td>
										<td><?php echo $row['consultancyFees'];?></td>
										<td><?php echo $row['appointmentDate'];?> / 
											<?php echo $row['appointmentTime'];?>
										</td>
										<td><?php echo $row['postingDate'];?></td>
										<td>
											<div class="visible-md visible-lg hidden-sm hidden-xs">
												<?php 
												if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
												{ 
												?>
													<a href="appointment-history.php?id=<?php echo $row['id']?>&send" onClick="return confirm('Are you sure you want to send report ?')"class="btn btn-transparent btn-xs tooltips">Send Report</a>
												<?php 
												} 
												else 
													echo "closed";
												?>
											</div>	
										</td>
										<td>
											<?php 
											if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
												echo "Active";
											if(($row['userStatus']==0) && ($row['doctorStatus']==1))  
												echo "Cancel by Patient";
											if(($row['userStatus']==1) && ($row['doctorStatus']==0))  
												echo "Cancel by you";
											?>
										</td>
										<td >
											<div class="visible-md visible-lg hidden-sm hidden-xs">
												<?php 
												if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
												{ 
												?>
													<a href="appointment-history.php?id=<?php echo $row['id']?>&cancel=update" onClick="return confirm('Are you sure you want to cancel this appointment ?')"class="btn btn-transparent btn-xs tooltips" title="Cancel Appointment" tooltip-placement="top" tooltip="Remove">Remove</a>
												<?php 
												} 
												else 
													echo "Removed";
												?>
											</div>
										</td>
									</tr>
								
								<?php 
									$cnt=$cnt+1;
								}?>
							</tbody>
						</table>

						<br><br>
						<h1>Records of Patients</h1>

						<div class="row">
							<div class="col-md-12">
								
								<p style="color:red;"><?php echo htmlentities($_SESSION['msg']);?>
									<?php echo htmlentities($_SESSION['msg']="");?>
								</p>	
								<table class="table table-hover" id="sample-table-1">
									<thead>
										<tr>
											<th class="center">#</th>
											<th class="hidden-xs">Patient  Name</th>
											<th>Specialization</th>
											<th>Consultancy Fee</th>
											<th>Next Consulting Date / Time </th>
											<th>Last Check Up/Queries Date </th>
											<th>Report</th>
											<th>Current Status</th>
											<th>Action</th>
										</tr>
									</thead>
									
									<tbody>
										
										<?php
										$sql=mysqli_query($con,"select users.fullName as fname,appointment.*  from appointment join users on users.id=appointment.userId where appointment.doctorId='".$_SESSION['id']."'");
										$cnt=1;
										while($row=mysqli_fetch_array($sql))
										{
										?>
											<tr>
												<td class="center"><?php echo $cnt;?>.</td>
												<td class="hidden-xs"><?php echo $row['fname'];?></td>
												<td><?php echo $row['doctorSpecialization'];?></td>
												<td><?php echo $row['consultancyFees'];?></td>
												<td><?php echo $row['appointmentDate'];?> / 
													<?php echo $row['appointmentTime'];?>
												</td>
												<td><?php echo $row['postingDate'];?></td>
												<td>
													<div class="visible-md visible-lg hidden-sm hidden-xs">
														<?php 
														if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
														{ 
														?>
															<a href="appointment-history.php?id=<?php echo $row['id']?>&send" onClick="return confirm('Are you sure you want to send report ?')"class="btn btn-transparent btn-xs tooltips">Send Report</a>
														<?php 
														} 
														else 
															echo "closed";
														?>
													</div>	
												</td>
												<td>
													<?php 
													if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
														echo "Active";
													if(($row['userStatus']==0) && ($row['doctorStatus']==1))  
														echo "Cancel by Patient";
													if(($row['userStatus']==1) && ($row['doctorStatus']==0))  
														echo "Cancel by you";
													?>
												</td>
												<td >
													<div class="visible-md visible-lg hidden-sm hidden-xs">
														<?php 
														if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
														{ 
														?>
															<a href="appointment-history.php?id=<?php echo $row['id']?>&cancel=update" onClick="return confirm('Are you sure you want to cancel this appointment ?')"class="btn btn-transparent btn-xs tooltips" title="Cancel Appointment" tooltip-placement="top" tooltip="Remove">Remove</a>
														<?php 
														} 
														else 
															echo "Removed";
														?>
													</div>
												</td>
											</tr>
										
										<?php 
											$cnt=$cnt+1;
										}?>
									</tbody>
								</table>
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
