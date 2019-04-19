<?php
session_start();
include('../include_admin/config.php');
include('../include_admin/checklogin.php');
check_login();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>CureMe - HospiDB</title>
	
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
					<div class="container-fluid container-fullw bg-white">
						<div class="row">
							<div class="col-md-12">
								<p style="color:red;"><?php echo htmlentities($_SESSION['msg']);?>
									<?php echo htmlentities($_SESSION['msg']="");?>
								</p>	
								<table class="table table-hover" id="sample-table-1">
									<thead>
										<tr>
											<th class="center">#</th>
											<th class="hidden-xs">Doctor Name</th>
											<th>Patient Name</th>
											<th>Specialization</th>
											<th>Consultancy Fee</th>
											<th>Appointment Date / Time </th>
											<th>Appointment Creation Date  </th>
											<th>Current Status</th>
											<th>Action</th>
											
										</tr>
									</thead>
									<tbody>
										<?php
										$sql=mysqli_query($con,"select doctors.doctorName as docname,users.fullName as pname,appointment.*  from appointment join doctors on doctors.id=appointment.doctorId join users on users.id=appointment.userId ");
										$cnt=1;
										while($row=mysqli_fetch_array($sql))
										{
										?>
											<tr>
												<td class="center"><?php echo $cnt;?>.</td>
												<td class="hidden-xs"><?php echo $row['docname'];?></td>
												<td class="hidden-xs"><?php echo $row['pname'];?></td>
												<td><?php echo $row['doctorSpecialization'];?></td>
												<td><?php echo $row['consultancyFees'];?></td>
												<td>
													<?php echo $row['appointmentDate'];?> / 
													<?php echo $row['appointmentTime'];?>
												</td>
												<td><?php echo $row['postingDate'];?></td>
												<td>
													<?php 
													if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
														echo "Active";
													if(($row['userStatus']==0) && ($row['doctorStatus']==1))  
														echo "Cancel by Patient";
													if(($row['userStatus']==1) && ($row['doctorStatus']==0))  
														echo "Cancel by Doctor";
													?>
												</td>
												<td >
													<div class="visible-md visible-lg hidden-sm hidden-xs">
														<?php 
														if(($row['userStatus']==1) && ($row['doctorStatus']==1))  
															echo "No Action yet";
														else 
															echo "Canceled";
														?>
													</div>
													<div class="visible-xs visible-sm hidden-md hidden-lg">
														<div class="btn-group" dropdown is-open="status.isopen">
															<button type="button" class="btn btn-primary btn-o btn-sm dropdown-toggle" dropdown-toggle>
															<i class="fa fa-cog"></i>&nbsp;
															<span class="caret"></span>
															</button>
														</div>
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
