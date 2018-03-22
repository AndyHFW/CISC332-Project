<?php
	include('functions.php');
	$q = $_GET['q'];
	if ($q[0] == "c") {
		showMovies(substr($q, 1));
	} else if ($q[0] == "t") {
		$q = explode('~', $q);
		showTickets(array_slice($q, 1));
	}
?>