<?php
include('../functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
} else if (!isAdmin()) {
	$_SESSION['msg'] = "Insufficient permissions to access this page";
	header('location: ../index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Most popular</title>
	<link rel="stylesheet" type="text/css" href="../OMTS.css">
</head>
<header>
	<nav>
		<ul>
			<li><a href="home.php">Admin homepage</a></li>
			<li><a href="userView.php">User view</a></li>
			<li><a href="popular.php">Most popular</a></li>
			<!--<li><a href="./instructions.html">Instructions</a></li>-->
		</ul>
	</nav>
</header>
<body>
	<div class="header">
		<h2>Most popular movie and theatre complex</h2>
	</div>
	<div class="content2">
		<?php popularMovie();
		popularComplex(); ?>
	</div>
</body>
</html>