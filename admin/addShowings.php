<?php 
	include('../functions.php');
	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: ../login.php');
	} else if (!isAdmin()) {
		$_SESSION['msg'] = "Insufficient permissions to access this page";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Booking</title>
	<script src="xmlscript.js"></script>
	<link rel="stylesheet" type="text/css" href="../reset.css">
	<link rel="stylesheet" type="text/css" href="../OMTS.css">
</head>
<header>
	<nav>
		<ul>
			<li><a href="home.php">ADMIN HOMEPAGE</a></li>
			<li><a href="userView.php">USER VIEW</a></li>
			<li><a href="popular.php">MOST POPULAR</a></li>
			<li><a href="movieUpdate.php">UPDATE OR DELETE MOVIES</a></li>
			<li><a href="<?php echo basename($_SERVER['PHP_SELF']); ?>?logout='1'">LOGOUT</a></li>
			<!--<li><a href="./instructions.html">Instructions</a></li>-->
		</ul>
	</nav>
</header>
<body>
	<div id="bookingInfoAdmin">
	</div>
	<div id="complexDisplayAdmin">
		<?php getComplexes("theatres"); ?>
	</div>
	<div id="movieDisplayAdmin"></div>
	<div id="showingDisplayAdmin"></div>
</body>
</html>