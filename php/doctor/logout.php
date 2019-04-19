<?php
session_start();
include('../include_doctor/config.php');

$_SESSION['dlogin']=="";

session_unset();
$_SESSION['errmsg']="You have successfully logout";
?>
	<script language="javascript">
	document.location="index.php";
</script>
