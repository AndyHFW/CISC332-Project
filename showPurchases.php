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
	<link rel="stylesheet" href="reset.css">
	<link rel="stylesheet" href="reset.css">
	<link rel="stylesheet" type="text/css" href="OMTS.css">
</head>
<header>
	<nav>
		<ul>
			<li><a href="./index.php">HOME</a></li>
			<li><a href="./booking.php">BOOKINGS</a></li>
			<li><a href="./showPurchases.php">PURCHASE HISTORY</a></li>
			<li><a href="<?php echo basename($_SERVER['PHP_SELF']); ?>?logout='1'">LOGOUT</a></li>
			<!--<li><a href="./instructions.html">Instructions</a></li>-->
		</ul>
	</nav>
</header>
<body>
	<div class="purchaseDiv"><?php showPurchases() ?></div>
</body>
</html>