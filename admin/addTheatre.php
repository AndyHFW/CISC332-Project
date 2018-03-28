<?php
include('../functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
} else if (!isAdmin()) {
	$_SESSION['msg'] = "Insufficient permissions to access this page";
	header('location: ../index.php');
}
global $db;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit theatre info</title>
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
	if (isset($_POST['addTheatreButtonInFunc'])){
		$query = "SELECT `NumTheatres` FROM `theatre complex` WHERE `ComplName`='{$_POST['addTheatreName']}';";
		$result = mysqli_query($db,$query);
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$numTheatres=$row['NumTheatres'];
			}
		}
		$query = "SELECT `TheatreNum` FROM `theatre` WHERE `CplName`='{$_POST['addTheatreName']}';";
		$result = mysqli_query($db,$query);
		$currentTheatres=array();
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				array_push($currentTheatres, $row['TheatreNum']);
			}
		}
	}
?>
<div class="header">
<h2>Add Theatre - <?php echo "{$_POST['addTheatreName']}" ?></h2>
</div>
<form method="post" action="theatreUpdate.php?action=finAdd" class="content">
	
	<?php 
	if (count($currentTheatres)>=$numTheatres) {
		header('location: theatreUpdate.php?action=full');
	}
	echo "Existing theatres include: ";
	foreach($currentTheatres as $value) {
		echo "({$value})";
	}
	?>
	<div class="input-group">
		<label>Theatre Number</label>
		<input type="number" name="addTheatreNum" max="<?php echo $numTheatres; ?>">
	</div>
	<div class="input-group">
		<label>Max Seats</label>
		<input name="addTheatreSeats">
	</div>
	<div class="input-group">
		<label>Screen Size</label>
		<select name="addTheatreScreenSize">
			<option value="S">Small</option>
			<option value="M">Medium</option>
			<option value="L">Large</option>
		</select>
	</div>
	<input type="submit" name="addTheatreButton">	
	<input type="hidden" name="addTheatreComplexName" value="<?php echo $_POST['addTheatreName']; ?>">
</form>
</body>
</html>
