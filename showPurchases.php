<?php
include('functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<!--<link rel="stylesheet" type="text/css" href="style.css">-->
</head>
<header>
	<nav>
		<ul>
			<li><a href="./index.php">Profile</a></li>
			<li><a href="./booking.php">Bookings</a></li>
			<!--<li><a href="./instructions.html">Instructions</a></li>-->
		</ul>
	</nav>
</header>
<body>
	<div id="purchaseDiv"><?php showPurchases() ?></div>
</body>
</html>