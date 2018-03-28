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
	if (isset($_POST['editTheatreButtonInFunc'])){
		$query = "SELECT `MaxSeat`, `ScreenSize` FROM `theatre` WHERE `TheatreNum`='{$_POST['theatreEditNum']}' AND `CplName`='{$_POST['theatreEditComplex']}';";
		$result = mysqli_query($db,$query);
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$maxSeats=$row['MaxSeat'];
				$screenSize=$row['ScreenSize'];
			}
		}
	}
?>
<div class="header">
<h2>Edit Theatre Info - <?php echo "{$_POST['theatreEditComplex']} (theatre {$_POST['theatreEditNum']})"; ?></h2>
</div>
<form method="post" action="theatreUpdate.php?action=finEdit" class="content">
	<div class="input-group">
		<label>Max Seats</label>
		<input name="editSeats" value="<?php echo $maxSeats;?>">
	</div>
	<div class="input-group">
		<label>Screen Size</label>
		<select name="editScreenSize">
			<option value="S" <?php if ($screenSize=="S") echo "selected=\"selected\""; ?>>Small</option>
			<option value="M" <?php if ($screenSize=="M") echo "selected=\"selected\""; ?>>Medium</option>
			<option value="L" <?php if ($screenSize=="L") echo "selected=\"selected\""; ?>>Large</option>
		</select>
	</div>
	<input type="submit" name="editTheatreButton">	
	<input type="hidden" name="editTheatreComplexName" value="<?php echo $_POST['theatreEditComplex']; ?>">
	<input type="hidden" name="editTheatreNum" value="<?php echo $_POST['theatreEditNum']; ?>">
</form>
</body>
</html>
