<?php
session_start();
include('../include_admin/config.php');
include('../include_admin/checklogin.php');
check_login();


if(isset($_GET['del']))
{
    mysqli_query($con,"delete from doctors where id = '".$_GET['id']."'");
    $_SESSION['msg']="data deleted !!";
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
					<div class="container-fluid container-fullw bg-white">
						<div class="row">
							<div class="col-md-12">
								<h5 class="over-title margin-bottom-15"><span class="text-bold">Manage Docter details</span></h5>
								<p style="color:red;">
									<?php echo htmlentities($_SESSION['msg']);?>
									<?php echo htmlentities($_SESSION['msg']="");?>
								</p>	
								<table class="table table-hover" id="sample-table-1">
									<thead>
										<tr>
											<th class="center">#</th>
											<th>Specialization</th>
											<th class="hidden-xs">Doctor Name</th>
											<th>Creation Date </th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql=mysqli_query($con,"select * from doctors");
										$cnt=1;
										while($row=mysqli_fetch_array($sql))
										{
										?>

											<tr>
												<td class="center"><?php echo $cnt;?>.</td>
												<td class="hidden-xs"><?php echo $row['specilization'];?></td>
												<td><?php echo $row['doctorName'];?></td>
												<td><?php echo $row['creationDate'];?></td>
												<td >
													<div class="visible-md visible-lg hidden-sm hidden-xs">
														<a href="edit-doctor.php?id=<?php echo $row['id'];?>" class="btn btn-transparent btn-xs" tooltip-placement="top" tooltip="Edit">
															<i class="fa fa-pencil"></i>
														</a>
														
														<a href="manage-doctors.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove">
															<i class="fa fa-times fa fa-white"></i>
														</a>
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
