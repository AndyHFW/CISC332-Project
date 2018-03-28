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
	if (isset($_POST['editComplexButton'])){
		$query = "SELECT `NumTheatres`, `Street`, `City`, `Province`, `Postal`, `PhoneNum`
				FROM `theatre complex` WHERE `ComplName`='{$_POST['complexEditName']}';";
		$result = mysqli_query($db,$query);
		if ($result) {
			while ($row = mysqli_fetch_assoc($result)) {
				$numTheatres=$row['NumTheatres'];
				$street=$row['Street'];
				$city=$row['City'];
				$province=$row['Province'];
				$postal=$row['Postal'];
				$phoneNum=$row['PhoneNum'];
			}
		} else {echo "broke"; echo $query;}
	}
?>
<div class="header">
<h2>Edit Theatre Complex - <?php echo "{$_POST['complexEditName']}"; ?></h2>
</div>
<form method="post" action="theatreUpdate.php?action=finEditComplex" class="content">
	<div class="input-group">
		<label>Theatre Complex Name</label>
		<input name="editComplexName" value="<?php echo $_POST['complexEditName'];?>">
	</div>
	<div class="input-group">
		<label>Number of Theatres</label>
		<input type="number" name="editComplexTheatreNum" value="<?php echo $numTheatres;?>">
	</div>
	<h2>Address</h2>
	<div class="input-group">
		<label>Street</label>
		<input name="editComplexStreet" value="<?php echo $street;?>">
	</div>
	<div class="input-group">
		<label>City</label>
		<input name="editComplexCity" value="<?php echo $city;?>">
	</div>
	<div class="input-group">
		<label>Province</label>
		<input list="provinces" name="editComplexProvince" value="<?php echo $province ?>" autocomplete="off">
			<datalist id="provinces">
				<option value="AB">Alberta</option>
				<option value="BC">British Columbia</option>
				<option value="MB">Manitoba</option>
				<option value="NB">New Brunswick</option>
				<option value="NL">Newfoundland and Labrador</option>
				<option value="NS">Nova Scotia</option>
				<option value="NT">Northwest Territories</option>
				<option value="NU">Nunavut</option>
				<option value="ON">Ontario</option>
				<option value="PE">Prince Edward Island</option>
				<option value="QC">Quebec</option>
				<option value="SK">Sasketchewan</option>
				<option value="YT">Yukon</option>
			</datalist>
	</div>
	<div class="input-group">
		<label>Postal Code</label>
		<input name="editComplexPostal" value="<?php echo $postal;?>">
	</div>
	<div class="input-group">
		<label>Phone Number</label>
		<input name="editComplexPhone" value="<?php echo $phoneNum;?>">
	</div>
	<input type="hidden" name="editComplexComplexName" value="<?php echo $_POST['complexEditName']; ?>">
	<input type="submit" name="editComplexButton2">
</form>
</body>
</html>
