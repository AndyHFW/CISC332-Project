<?php
include('functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}
if (isset($_POST['bookMovie'])) {
	confirmBooking();
	echo "
	<a href=\"./booking.php\">Reserve more tickets</a> </br>
	<a href=\"./index.php\">Return to homepage</a>
	";
}

?>