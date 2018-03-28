<?php
	include('../functions.php');
	// technically super inefficient and poorly coded but it works
	if (isset($_GET['q'])){
		$q = $_GET['q'];
		if ($q[0] == "c") {
			showMovies(substr($q, 1));
		} else if ($q[0] == "t") {
			$qString = substr($q, 2);
			$q = explode('~', $q);
			showTickets(array_slice($q, 1),$qString);
		} else if ($q[0] == "d") {
			$q = explode('~', $q);
			buyTickets(array_slice($q, 1));
		}else if ($q[0] == "s") {
			$q = explode('~', $q);
			addShowing(array_slice($q, 1));
		}
	} else if (isset($_GET['t'])) {
		$t = $_GET['t'];
		showTheatres($t);
	} else if (isset($_GET['t2'])) {
		$t = $_GET['t2'];
		showTheatres($t,"editTheatre");
	}
	
?>