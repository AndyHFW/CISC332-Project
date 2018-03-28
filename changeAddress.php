<!DOCTYPE html>
<?php 
include('functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}
?>
<html lang="en-US">
<html>
<head>
	<meta charset="UTF-8">
	<title>Update user address and phone number</title>
	<meta name="author" content="Andy Wang"/>
	<meta name="description" content="Updating user address for the OMTS system."/>
	<meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" href="OMTS.css">
	<!--<link rel="stylesheet" href="reset.css">
	<script src="flashcardJS.js"></script>
	<script src="jquery-3.2.1.min.js"></script>-->
</head>
<header>
	<nav>
		<ul>
			<li><a href="./index.php">Home</a></li>
			<li><a href="./booking.php">Bookings</a></li>
			<li><a href="./showPurchases.php">Purchase history</a></li>
			<li><a href="<?php echo basename($_SERVER['PHP_SELF']); ?>?logout='1'">Logout</a></li>
			<!--<li><a href="./instructions.html">Instructions</a></li>-->
		</ul>
	</nav>
</header>
<body>
	<div class="header">
		<h2>Update user address</h2>
	</div>
	<form method="post">
		<?php echo displayError(); ?>
		<h3>Update Address</h3>
		<div class="input-group">
			<label>Street</label>
			<input type="text" name="street" value="<?php echo $street; ?>">
		</div>
		<div class="input-group">
			<label>City</label>
			<input type="text" name="city" value="<?php echo $city; ?>">
		</div>
		<div class="input-group">
			<label>Province</label>
			<input list="provinces" name="province">
			<datalist id="provinces">
				<option value="AB">
				<option value="BC">
				<option value="MB">
				<option value="NB">
				<option value="NL">
				<option value="NS">
				<option value="NT">
				<option value="NU">
				<option value="ON">
				<option value="PE">
				<option value="QC">
				<option value="SK">
				<option value="YT">
			</datalist>
		</div>
		<div class="input-group">
			<label>Postal code</label>
			<input type="text" name="postal" value="<?php echo $postal; ?>">
		</div>
		<div class="input-group">
			<label>Phone number</label>
			<input type="text" name="phoneNum" value="<?php echo $phoneNum; ?>">
		</div>
		<div class="input-group">
			<button type="submit" class="button" name="updateAddressButton">Update info</button>
	</form>
</body>
</html>