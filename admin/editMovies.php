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
	<title>Edit movie</title>
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
<div class="header">
<h2>Edit Movie - <?php echo $row ['Title']; ?></h2>
</div>
<form method="post" action="movieUpdate.php?action=finEdit" class="content">
	<div class="input-group">
		<label>Runtime</label>
		<input name="txt_runtime" value="<?php echo $runtime;?>">
	</div>
	<div class="input-group">
		<label>Rating</label>
		<input name="txt_rating" value="<?php echo $rating;?>">
	</div>
	<div class="input-group">
		<label>Synopsis</label>
		<textarea name="txt_synopsis" rows="5" style="min-width:100%;"><?php echo $synopsis;?></textarea>
	</div>
	<div class="input-group">
		<label>Director's First Name</label>
		<input name="txt_dirfname" value="<?php echo $dirfname;?>">
	</div>
	<div class="input-group">
		<label>Director's Last Name</label>
		<input name="txt_dirlname" value="<?php echo $dirlname;?>">
	</div>
	<div class="input-group">
		<label>Production Company</label>
		<input name="txt_prodcompname" value="<?php echo $prodcompname;?>">
	</div>
	<div class="input-group">
		<label>Supplier</label>
		<input name="txt_suplname" value="<?php echo $suplname;?>">
	</div>	
	<input type="submit" name="btn_submit">	
	<input type="hidden" name="title" value="<?php echo $_GET['id']; ?>">
</form>
</body>
</html>
