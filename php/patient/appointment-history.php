<?php
session_start();
include('../include_patient/config.php');
include('../include_patient/checklogin.php');
check_login();
if(isset($_GET['cancel']))
{
    mysqli_query($con,"update appointment set userStatus='0' where id = '".$_GET['id']."'");
    $_SESSION['msg']="Your appointment canceled !!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>CureMe - HospiDB </title>
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
							<div class="col-md-12">
								
								<p style="color:red;">
									<?php echo htmlentities($_SESSION['msg']);?>
									<?php echo htmlentities($_SESSION['msg']="");?>
								</p>	
								
								<table class="table table-hover" id="sample-table-1">
									<thead>
										<tr>
											<th class="center">#</th>
											<th class="hidden-xs">Doctor Name</th>
											<th>Specialization</th>
											<th>Consultation Fee</th>
											<th>Appointment Date </th>
											<th>Appointment Booked Date  </th>
											<th>Current Status</th>
											<th>Action</th>
										</tr>
									</thead>
									
									<tbody>
									
										<?php
										$sql=mysqli_query($con,"select doctors.doctorName as docname,appointment.*  from appointment join doctors on doctors.id=appointment.doctorId where appointment.userId='".$_SESSION['id']."'");
										$cnt=1;
										while($row=mysqli_fetch_array($sql))
										{
										?>
											<tr>
												<td class="center"><?php echo $cnt;?>.</td>
												<td class="hidden-xs"><?php echo $row['docname'];?></td>
												<td><?php echo $row['doctorSpecialization'];?></td>
												<td><?php echo $row['consultancyFees'];?></td>
												<td><?php echo $row['appointmentDate'];?></td>
												<td><?php echo $row['postingDate'];?></td>
												<td>
													<?php 
													if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
														echo "Active";
													if(($row['userStatus']==0) && ($row['doctorStatus']==1))  
														echo "Cancel by You";
													if(($row['userStatus']==1) && ($row['doctorStatus']==0))  
														echo "Cancel by Doctor";
													?>	
												</td>
												<td >
													<div class="visible-md visible-lg hidden-sm hidden-xs">
														<?php 
														if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
														{ 
														?>
															<a href="appointment-history.php?id=<?php echo $row['id']?>&cancel=update" onClick="return confirm('Are you sure you want to cancel this appointment ?')"class="btn btn-transparent btn-xs tooltips" title="Cancel Appointment" tooltip-placement="top" tooltip="Remove">Cancel</a>
														<?php 
														} 
														else 
															echo "Canceled";
														?>
													</div>
												</td>
											</tr>
											
										<?php 
										$cnt=$cnt+1;
										}
										?>	
									</tbody>
								</table>

							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

	</div>

</body>
</html>
