<?php
@session_start();

if (!isset($_SESSION['admin_id'])) {
	echo "<script>window.location='../'</script>";
} else {
	$adminid = $_SESSION['admin_id'];
}


?>