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
	<title>Update Theatres</title>
	<script src="xmlscript.js"></script>
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
		</ul>
	</nav>
</header>
<body>
	<div style="padding-left:20px;">
	<?php
		if (isset($_GET['action'])) {
			if ($_GET['action']=="finEdit") {
				$query = "UPDATE `theatre` SET `MaxSeat`='{$_POST['editSeats']}', 
				`ScreenSize`='{$_POST['editScreenSize']}'
				WHERE `TheatreNum`='{$_POST['editTheatreNum']}' 
				AND `CplName`='{$_POST['editTheatreComplexName']}';";
				$result=mysqli_query($db,$query);
				if ($result) {
					echo "Theatre info edited successfully!<br/>";
				}
			} else if ($_GET['action']=="finEditComplex") {
				$query = "UPDATE `theatre complex` SET `ComplName`='{$_POST['editComplexName']}', 
				`NumTheatres`='{$_POST['editComplexTheatreNum']}', `Street`='{$_POST['editComplexStreet']}',
				`City`='{$_POST['editComplexCity']}', `Province`='{$_POST['editComplexProvince']}',
				`Postal`='{$_POST['editComplexPostal']}', `PhoneNum`='{$_POST['editComplexPhone']}'
				WHERE `ComplName`='{$_POST['editComplexComplexName']}';";
				$result=mysqli_query($db,$query);
				if ($result) {
					echo "Complex info edited successfully!<br/>";
				} 
			} else if ($_GET['action']=="full") {
				echo "Unable to add theatre - complex has reached the defined number of theatres.<br/>";
			} else if ($_GET['action']=="finAdd") {
				$query = "INSERT INTO `theatre` (`TheatreNum`, `CplName`, `MaxSeat`, `ScreenSize`)
				VALUES ('{$_POST['addTheatreNum']}', '{$_POST['addTheatreComplexName']}',
				'{$_POST['addTheatreSeats']}','{$_POST['addTheatreScreenSize']}');";
				$result=mysqli_query($db,$query);
				if ($result) {
					echo "Theater added successfully!<br/>";
				} else {
					echo "Unable to add theatre.<br/>Please ensure that the theatre number does not already exist in the complex.<br/>";
				}
			}
		}	
	?>
	</div>
	<div id="complexDisplayEdit">
		<?php getComplexes("edittheatres"); ?>
	</div>
	<div id="theatreDisplayEdit"></div>
</body>
</html>