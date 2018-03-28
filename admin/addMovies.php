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
	<title>Home</title>
	<link rel="stylesheet" href="../reset.css">
	<link rel="stylesheet" type="text/css" href="../OMTS.css">
</head>
<header>
	<nav>
		<ul>
			<li><a href="home.php">ADMIN HOMEPAGE</a></li>
			<li><a href="userView.php">USER VIEW</a></li>
			<li><a href="movieUpdate.php">UPDATE MOVIES</a></li>
			<li><a href="theatreUpdate.php">UPDATE THEATRES</a></li>
			<li><a href="popular.php">MOST POPULAR</a></li>
			<li><a href="<?php echo basename($_SERVER['PHP_SELF']); ?>?logout='1'">LOGOUT</a></li>
			<!--<li><a href="./instructions.html">Instructions</a></li>-->
		</ul>
	</nav>
</header>
<body>

<div class="header"><h1>Add Movie</h1></div>
<form method="post" action="movieUpdate.php?action=finAdd" class="content">
	<div class="input-group">
		<label>Title</label>
		<input name="addTitle">
	</div>
	<div class="input-group">
		<label>Runtime</label>
		<input name="addRuntime">
	</div>
	<div class="input-group">
		<label>Rating</label>
		<input name="addRating">
	</div>
	<div class="input-group">
		<label>Synopsis</label>
		<textarea name="addSynopsis" rows="5" style="min-width:100%;"></textarea>
	</div>
	<div class="input-group">
		<label>Director's First Name</label>
		<input name="addDirF">
	</div>
	<div class="input-group">
		<label>Director's Last Name</label>
		<input name="addDirL">
	</div>
	<div class="input-group">
		<label>Production Company</label>
		<input name="addProd">
	</div>
	<div class="input-group">
		<label>Supplier</label>
		<input name="addSupl">
	</div>	
	<input type="submit" name="addMovie">
</form>

