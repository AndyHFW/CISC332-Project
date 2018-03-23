<?php
include('functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

confirmCancellation();
echo "
<p>
	<a href=\"./showPurchases.php\">Back to purchase history</a> <br/>
	<a href=\"./booking.php\">Reserve tickets</a> </br>
	<a href=\"./index.php\">Return to homepage</a>
</p>
";


?>