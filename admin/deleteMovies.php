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
	<link rel="stylesheet" type="text/css" href="../OMTS.css">
</head>
<header>
	<nav>
		<ul>
			<li><a href="home.php">Admin homepage</a></li>
			<li><a href="userView.php">User view</a></li>
			<li><a href="popular.php">Most popular</a></li>
			<li><a href="movieUpdate.php">Update or delete movies</a></li>
			<!--<li><a href="./instructions.html">Instructions</a></li>-->
		</ul>
	</nav>
</header>
<body>

<?php 	
	$db = mysqli_connect('localhost', 'root', '', 'omts56');
	
	if (isset ($_GET['id'])){
		$query = "DELETE from `movie` WHERE Title='{$_GET ['id']}';";
		$result = mysqli_query($db,$query);
		if (!$result) {
			echo "Unable to delete movie";
			<a href="movieUpdate.php">Return</a><
		} else {
			header("Location: movieUpdate.php?action=finDel");
		}
		
	}
?>