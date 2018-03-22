<?php
	include('functions.php');
	$q = $_GET['q'];
	if ($q[0] == "c") {
		showMovies(substr($q, 1));
	}
?>