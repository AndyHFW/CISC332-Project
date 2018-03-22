<!DOCTYPE html>
<html>
<head>
	<script src="jquery-3.2.1.min.js"></script>
</head>

<?php
session_start();

$db = mysqli_connect('localhost', 'root', '', 'omts56');

$email = $street = $city = $postal = $phoneNum = "";
$errors = array();

if (isset($_POST['registerButton'])) {
	register();
}

function register() {
	global $db, $errors, $email, $street, $city, $postal, $phoneNum;
	
	$email = escape($_POST['email']);
	$password = escape($_POST['password']);
	$passwordConfirm = escape($_POST['password']);
	$street = escape($_POST['street']);
	$city = escape($_POST['city']);
	$province = escape($_POST['province']);
	$postal = escape($_POST['postal']);
	$phoneNum = escape($_POST['phoneNum']);
	$creditNum = escape($_POST['creditNum']);
	$creditExpMonth = escape($_POST['creditExpMonth']);
	$creditExpYear = escape($_POST['creditExpMonth']);
	
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($password)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password != $passwordConfirm) {
		array_push($errors, "The two passwords do not match");
	}
	if (empty($street)) { 
		array_push($errors, "Street is required"); 
	}
	if (empty($city)) { 
		array_push($errors, "City is required"); 
	}
	if (empty($province)) { 
		array_push($errors, "Province is required"); 
	}
	if (empty($postal)) { 
		array_push($errors, "Postal code is required"); 
	}
	if (empty($phoneNum)) { 
		array_push($errors, "Phone number is required"); 
	}
	if (empty($creditNum) || empty($creditExpMonth) || empty($creditExpYear)) { 
		array_push($errors, "Credit card information is required"); 
	}
	
	if (getUserByEmail($email)) {
		array_push($errors, "An account with this e-mail already exists."); 
	}
	
	if (count($errors) == 0) {
		$password = md5($password);
		$creditNum = md5($creditNum);
		$creditExp = md5($creditExpMonth . $creditExpYear);
		if (isset($_POST['userType'])) {
			$userType = escape($_POST['userType']);
			$query = "INSERT INTO `user`(`AccNum`, `PWD`, `Street`, `City`, `Province`, `Postal`, `PNum`, `Email`, `CrdCardNum`, `CrdCardExp`, `UserType`) VALUES (DEFAULT, '$password', '$street', '$city', '$province', '$postal', '$phoneNum', '$email', '$creditNum', '$creditExp', '$userType')";
			mysqli_query($db, $query);
			$_SESSION['success'] = "New administrator successfully created!";
			header('location: home.php');
		} else {
			$query = "INSERT INTO `user`(`AccNum`, `PWD`, `Street`, `City`, `Province`, `Postal`, `PNum`, `Email`, `CrdCardNum`, `CrdCardExp`, `UserType`) VALUES (DEFAULT, '$password', '$street', '$city', '$province', '$postal', '$phoneNum', '$email', '$creditNum', '$creditExp', 'user')";
			$result = mysqli_query($db, $query);
			echo $creditNum;
			if(!$result){
				echo mysqli_error($db);
			}
			$loggedInUser = $email;
			$_SESSION['user'] = getUserByEmail($loggedInUser);
			$_SESSION['success'] = "New user successfully created!\n You are now logged in.";
			header('location: index.php');
		}
	}
}

function getUserByEmail($email) {
	global $db;
	$query = "SELECT * FROM user WHERE Email='$email'";
	$result = mysqli_query($db, $query);
	if ($result) {
		$user = mysqli_fetch_assoc($result);
	} else {
		$user = false;
	}
	return $user;
}

function escape($val) {
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function displayError() {
	global $errors;
	if (count($errors) > 0) {
		echo '<div class="error">';
			foreach($errors as $error) {
				echo $error . '<br>';
			}
		echo '</div>';
	}
}

function isLoggedIn() {
	if (isset($_SESSION['user'])) {
		return true;
	} else {
		return false;
	}
}

if (isset($_POST['loginButton'])) {
	login();
}

function login() {
	global $db, $email, $errors;
	
	$email = escape($_POST['email']);
	$password = escape($_POST['password']);
	if (empty($email)) {
		array_push($errors, "Email is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}
	
	if (count($errors) == 0) {
		$password = md5($password);
		$query = "SELECT * FROM user WHERE Email='$email' AND PWD='$password' LIMIT 1";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 1) {
			$loggedInUser = mysqli_fetch_assoc($results);
			if ($loggedInUser['UserType'] == 'admin') {
				$_SESSION['user'] = $loggedInUser;
				$_SESSION['success'] = "You are now logged in";
				header('location: admin/home.php');
			} else {
				echo "logged in";
				$_SESSION['user'] = $loggedInUser;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}
		} else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['USER']);
	header("location: login.php");
}

function getComplexes() {
	global $db;
	
	$query = "SELECT * FROM `theatre complex`";
	$result = mysqli_query($db, $query);
	$complexName = "";
	$complexNum = 0;
	echo "
	<table>
		<tr>
		<th>Complex Name</th>
		<th>Number of Theatres</th>
		<th>Address</th>
		<th>Phone Number</th>
		</tr>";
		while($row = mysqli_fetch_array($result)) {
			$complexName = $row[0];
			echo "<tr>";
			echo "<td>" . $row[0] . "</td>";
			echo "<td>" . $row['NumTheatres'] . "</td>";
			echo "<td>" . $row['Street'] . "<br/> " . $row['City'] . ", " . $row['Province'] . "<br/> " . $row['Postal'] . "</td>";
			echo "<td>" . $row['PhoneNum'] . "</td>";
			echo "<td><button type=\"button\" name=\"complex" . $complexNum . "\" onclick=\"showMovies('" . $complexName . "')\">Select Complex</button></td>";
			echo "</tr>";
			$complexNum++;
		}
	echo "</table>";
}

function showMovies($complexName) {
	global $db;
	
	$query = "SELECT s.MovTitle, s.ThNum, s.ST, s.ED, t.MaxSeat, t.ScreenSize FROM showtime AS s JOIN theatre AS t ON 
			s.ComplName = t.CplName AND s.ThNum = t.TheatreNum WHERE s.ComplName= '" . $complexName . "' AND ED>='" . date("Y-m-d") . "'";
	$result = mysqli_query($db, $query);
	//$complexNum = 0;
	if (!$result) {
		echo "No movies are currently scheduled at this complex! Please select another complex.";
	} else {
		echo "
		<caption>" . $complexName . "</caption>
		<table>
			<tr>
			<th>Theatre Number</th>
			<th>Movie</th>
			<th>Showtime</th>
			<th>Max Seating</th>
			<th>Screen Size</th>
			<th>Shows until</th>
			</tr>";
			while($row = mysqli_fetch_array($result)) {
				echo "<tr>";
				echo "<td>" . $row['ThNum'] . "</td>";
				echo "<td>" . $row['MovTitle'] . "</td>";
				echo "<td>" . $row['ST'] . "</td>";
				echo "<td>" . $row['MaxSeat'] . "</td>";
				echo "<td>" . $row['ScreenSize'] . "</td>";
				echo "<td>" . $row['ED'] . "</td>";
				//echo "<td><button type=\"button\" name=\"complex" . $complexNum . " onclick=\"complexSelect(" . $complexNum . ")\"\">Select Complex</button></td>";
				echo "</tr>";
			}
		echo "</table>";
		}
}
?>
</html>