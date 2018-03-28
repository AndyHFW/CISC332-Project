<?php 
	include('../functions.php');
	if (!isLoggedIn()) {
		$loggedIn = false;
	} else {
		$loggedIn = true;
	}
	
	$db = mysqli_connect('localhost', 'root', '', 'omts56');
	
	if (isset ($_GET['id'])){
		$query = "delete from `movie` where Title =".$_GET ['id'];
		
	}
?>