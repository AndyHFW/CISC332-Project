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
	<title>Booking</title>
	<script src="xmlscript.js"></script>
	<link rel="stylesheet" type="text/css" href="reset.css">
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
	<div id="bookingInfo">
	</div>
	<div id="complexDisplay">
		<?php getComplexes(); ?>
	</div>
	<div id="movieDisplay"></div>
	<div id="chooseDate"></div>
	<div id="buyTickets"></div>
</body>
</html>