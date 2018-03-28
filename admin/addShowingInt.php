<?php
	include('../functions.php');
	global $db;
	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}
	if (isset($_POST['submitShowing'])) {
		$complex = $_POST['complexNameShowing'];
		$theatre = $_POST['theatreNumShowing'];
		$movie = $_POST['movieShowing'];
		$startDate = $_POST['startDateShowing'];
		$endDate = $_POST['endDateShowing'];
		$showTime = $_POST['showingTime'];
		$query = "INSERT INTO `showtime` (`MovTitle`, `ComplName`, `ThNum`, `ST`, `SD`, `ED`) 
				VALUES ('{$movie}','{$complex}','{$theatre}','{$showTime}','{$startDate}','{$endDate}');";
		$result = mysqli_query($db, $query);
		if (!$result) {
			echo "Insert failed<br/>";
			echo $query;
		} else {
			header('location: movieUpdate.php?action=finAddShowing');
		}
	}
?>