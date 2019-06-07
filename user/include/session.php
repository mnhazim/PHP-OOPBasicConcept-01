<?php
@session_start();

if (!isset($_SESSION['user_id'])) {
	echo "<script>window.location='../'</script>";
} else {
	$customerid = $_SESSION['user_id'];
	$cart = $ctrl->getCart($conn, $customerid);
$totalcart = $ctrl->getSumCart($conn, $customerid);
}


?>