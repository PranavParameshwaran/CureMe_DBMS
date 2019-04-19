<?php
session_start();
include('../include_patient/config.php');
$_SESSION['login']=="";
session_unset();
$_SESSION['errmsg']="You have successfully logout";
?>

<script language="javascript">
	document.location="./user-login.php";
</script>
