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
	<title>Delete movie</title>
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