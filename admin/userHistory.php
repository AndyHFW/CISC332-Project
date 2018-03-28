<?php
include('../functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
} else if (!isAdmin()) {
	$_SESSION['msg'] = "Insufficient permissions to access this page";
	header('location: ../index.php');
}
$userNum = "";
if (isset($_GET['user'])) {
	$userNum = $_GET['user'];
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Purchase history for user <?php echo $userNum; ?></title>
	<link rel="stylesheet" type="text/css" href="../OMTS.css">
</head>
<header>
	<nav>
		<ul>
			<li><a href="home.php">Admin homepage</a></li>
			<li><a href="userView.php">User view</a></li>
			<li><a href="popular.php">Most popular</a></li>
			<li><a href="movieUpdate.php">Update or delete movies</a></li>
			<li><a href="<?php echo basename($_SERVER['PHP_SELF']); ?>?logout='1'">Logout</a></li>
			<!--<li><a href="./instructions.html">Instructions</a></li>-->
		</ul>
	</nav>
</header>
<body>
	<div class="purchaseDiv"><?php showPurchases($userNum) ?></div>
</body>
</html>
