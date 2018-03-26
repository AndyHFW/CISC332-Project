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
	<title>Update user credit card information</title>
	<meta name="author" content="Andy Wang"/>
	<meta name="description" content="Updating user info for the OMTS system."/>
	<meta name="viewport" content="width=device-width" />
	<!--<link rel="stylesheet" href="reset.css">
	<link rel="stylesheet" href="flashcard.css">
	<script src="flashcardJS.js"></script>
	<script src="jquery-3.2.1.min.js"></script>-->
</head>
<header>
	<nav>
		<ul>
			<li><a href="./index.php">Back to profile</a></li>
			<!--<li><a href="./instructions.html">Instructions</a></li>-->
		</ul>
	</nav>
</header>
<body>
	<div class="header">
		<h2>Update credit card info</h2>
	</div>
	<form method="post">
		<?php echo displayError(); ?>
		<h3>Update credit card info</h3>
		<div class="input-group">
			<label>Credit card number</label>
			<input type="text" name="creditNum" value="">
		</div>
		<div class="input-group">
			<label>Credit card expiry</label>
			<input type="text" name="creditExpMonth" value="">
			/
			<input type="text" name="creditExpYear" value="">
		</div>
		<div class="input-group">
			<button type="submit" class="button" name="updateCCButton">Update info</button>
	</form>
</body>
</html>