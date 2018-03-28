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
			<li><a href="popular.php">MOST POPULAR</a></li>
			<li><a href="movieUpdate.php">UPDATE OR DELETE MOVIES</a></li>
			<li><a href="<?php echo basename($_SERVER['PHP_SELF']); ?>?logout='1'">LOGOUT</a></li>
			<!--<li><a href="./instructions.html">Instructions</a></li>-->
		</ul>
	</nav>
</header>
<body>

<h2>Add Movie</h2>
<form method="post" action="movieUpdate.php?action=finAdd">
	<table>
		<tr>
			<td>Title</td>
			<td><input name="addTitle"></td>
		</tr>
		<tr>
			<td>RunTime</td>
			<td><input name="addRuntime"></td>
		</tr>
		<tr>
			<td>Rating</td>
			<td><input name="addRating"></td>
		</tr>
		<tr>
			<td>Synopsis</td>
			<td><textarea name="addSynopsis" rows="8" cols="40"></textarea></td>
		</tr>
		<tr>
			<td>DirFName</td>
			<td><input name="addDirF"></td>
		</tr>
		<tr>
			<td>DirLName</td>
			<td><input name="addDirL"></td>
		</tr>
		<tr>
			<td>ProdCompName</td>
			<td><input name="addProd"></td>
		</tr>
		<tr>
			<td>SuplName</td>
			<td><input name="addSupl"></td>
		</tr>
		<tr>
			<td class=\"tableLink\"></td>
			<td class=\"tableLink\"><input type="submit" name="addMovie"></td>
		</tr>
	</table>
</form>

