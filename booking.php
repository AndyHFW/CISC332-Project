<?php 
	include('functions.php');
	if (!isLoggedIn()) {
		$loggedIn = false;
	} else {
		$loggedIn = true;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<script src="xmlscript.js"></script>
	<<link rel="stylesheet" type="text/css" href="OMTS.css">
</head>
<header>
	<nav>
		<ul>
			<li><a href="./index.php">Home</a></li>
			<!--<li><a href="./instructions.html">Instructions</a></li>-->
		</ul>
	</nav>
</header>
<body>
	<div id="bookingInfo">
		<?php
			
		?>
	</div>
	<div id="complexDisplay">
		<?php getComplexes(); ?>
	</div>
	<div id="movieDisplay"></div>
	<div id="chooseDate"></div>
	<div id="buyTickets"></div>
</body>
</html>