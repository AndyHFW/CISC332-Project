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
	<!--<link rel="stylesheet" type="text/css" href="style.css">-->
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
	<?php getComplexes(); ?>
</body>
</html>