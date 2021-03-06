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
	<title>Update user e-mail</title>
	<meta name="author" content="Andy Wang"/>
	<meta name="description" content="Updating user info for the OMTS system."/>
	<meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" href="reset.css">
	<link rel="stylesheet" href="OMTS.css">
	<!--<link rel="stylesheet" href="reset.css">
	<link rel="stylesheet" href="flashcard.css">
	<script src="flashcardJS.js"></script>
	<script src="jquery-3.2.1.min.js"></script>-->
</head>
<header>
	<nav>
		<ul>
			<li><a href="./index.php">HOME</a></li>
			<li><a href="./booking.php">BOOKINGS</a></li>
			<li><a href="./showPurchases.php">PURCHASE HISTORY</a></li>
			<li><a href="<?php echo basename($_SERVER['PHP_SELF']); ?>?logout='1'">LOGOUT</a></li>
			<!--<li><a href="./instructions.html">Instructions</a></li>-->
		</ul>
	</nav>
</header>
<body>
	<div class="header">
		<h2>Update e-mail</h2>
	</div>
	<form method="post" class="content">
		<?php echo displayError(); ?>
		<div class="input-group">
			<label>E-mail address</label>
			<input type="text" name="email" value="<?php echo $email; ?>">
			<label><br></label>
			<button type="submit" class="button" name="updateEmailButton">Update info</button>
		</div>
	</form>
</body>
</html>