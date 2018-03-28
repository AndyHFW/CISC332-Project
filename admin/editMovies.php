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
<h2>Edit Movie</h2>
<?php 	
	$db = mysqli_connect('localhost', 'root', '', 'omts56');
	$title = '';
	$runtime = '';
	$rating = '';
	$synopsis = '';
	$dirfname= '';
	$dirlname= '';
	$prodcompname = '';
	$suplname = '';
	if (isset($_GET['id'])) {
		$query =  "SELECT * FROM `movie` where Title='{$_GET['id']}'";
		$result = mysqli_query($db, $query);
		if(mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			$id = $row ['Title'];
			$runtime = $row ['RunTime'];
			$rating = $row ['Rating'];
			$synopsis = $row ['Synopsis'];
			$dirfname = $row ['DirFName'];
			$dirlname= $row ['DirLName'];
			$prodcompname = $row ['ProdCompName'];
			$suplname = $row ['SuplName'];
		}
	}
?>

<form method="post" action="movieUpdate.php?action=finEdit">
	<table>
		<tr>
			<td>RunTime</td>
			<td><input name="txt_runtime" value="<?php echo $runtime;?>"></td>
		</tr>
		<tr>
			<td>Rating</td>
			<td><input name="txt_rating" value="<?php echo $rating;?>"></td>
		</tr>
		<tr>
			<td>Synopsis</td>
			<td><textarea name="txt_synopsis" rows="8" cols="40"><?php echo $synopsis;?></textarea></td>
		</tr>
		<tr>
			<td>DirFName</td>
			<td><input name="txt_dirfname" value="<?php echo $dirfname;?>"></td>
		</tr>
		<tr>
			<td>DirLName</td>
			<td><input name="txt_dirlname" value="<?php echo $dirlname;?>"></td>
		</tr>
		<tr>
			<td>ProdCompName</td>
			<td><input name="txt_prodcompname" value="<?php echo $prodcompname;?>"></td>
		</tr>
		<tr>
			<td>SuplName</td>
			<td><input name="txt_suplname" value="<?php echo $suplname;?>"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="btn_submit"></td>
		</tr>
	</table>
	<input type="hidden" name="title" value="<?php echo $_GET['id']; ?>">
</form>
</body>
</html>
