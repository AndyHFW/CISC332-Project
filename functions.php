<!DOCTYPE html>
<html>
<head>
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
	
	$query = "SELECT s.MovTitle, s.ThNum, s.ST, s.ED, t.MaxSeat, t.ScreenSize
				FROM showtime AS s 
				JOIN theatre AS t ON s.ComplName = t.CplName AND s.ThNum = t.TheatreNum 
				JOIN reservation AS r ON s.MovTitle = r.MovTitle AND s.ComplName = r.CplName 
					AND s.ThNum = r.ThrNum AND s.ST = r.ST AND s.SD<=r.Date AND s.ED>=r.Date
				WHERE s.ComplName= '" . $complexName . "' AND ED>='" . date("Y-m-d") . "'
				GROUP BY s.MovTitle;";
	$result = mysqli_query($db, $query);
	//$complexNum = 0;
	if (!$result) {
		echo "No movies are currently scheduled at this complex! Please select another complex.";
		echo $query;
	} else {
		echo "
		<caption>" . $complexName . "</caption>
		<table>
			<tr>
			<th>Theatre Number</th>
			<th>Movie</th>
			<th>Showtime</th>
			<th>Capacity per showing</th>
			<th>Screen Size</th>
			<th>Shows until</th>
			</tr>";
			while($row = mysqli_fetch_array($result)) {
				$showingInfo = $row['MovTitle'] . '~' . $complexName . '~' . $row['ThNum'] . '~' . $row['ST'] . '~' . $row['ED'] . '~' . $row['MaxSeat'];
				echo "<tr>";
				echo "<td>" . $row['ThNum'] . "</td>";
				echo "<td>" . $row['MovTitle'] . "</td>";
				echo "<td>" . $row['ST'] . "</td>";
				echo "<td>" . $row['MaxSeat'] . "</td>";
				echo "<td>" . $row['ScreenSize'] . "</td>";
				echo "<td>" . $row['ED'] . "</td>";
				echo "<td><button type=\"button\" class=\"buyTicket\" onclick=\"buyTicket('" . $showingInfo . "')\"\">Buy Tickets</button></td>";
				echo "</tr>";
			}
		echo "</table>";
		}
}

function showTickets($showingInfo, $infoString) {
	//showingInfo[0] = MovTitle
	//showingInfo[1] = CplName
	//showingInfo[2] = ThNum
	//showingInfo[3] = ST
	//showingInfo[4] = End Date
	//showingInfo[5] = Tickets Remaining
	
	global $db;
	echo "
	<div id=\"buyTicketInfo\">
		Movie: " . $showingInfo[0] . "<br/>
		Complex: " . $showingInfo[1] . "<br/>
		Theatre Number: " . $showingInfo[2] . "<br/>
		Start Time: " . $showingInfo[3] . "<br/>
		Max Capacity: " . $showingInfo[5] . "<br/>
	</div>
	<form onsubmit=\"return false;\" method=\"post\" name=\"dateForm\">
		<label>Choose Date: </label>
		<input type=\"date\" id=\"chosenDate\" name=\"date\" value=\"" . date("Y-m-d") . "\" max=\"" . $showingInfo[4] . "\">
		<input type=\"hidden\" id=\"hideShowingInfo\" name=\"hideShowingInfo\" value=\"{$infoString}\">
		<button type=\"submit\" name=\"chooseDateButton\" onclick=\"chooseDateFunction()\">Choose Date</button>
	</form>";
}

function buyTickets($showingInfo) {
	global $db;
	$query = "SELECT NumTickets, Date
				FROM reservation
				WHERE Date='{$showingInfo[6]}' AND MovTitle='{$showingInfo[0]}' AND CplName='{$showingInfo[1]}' AND ThrNum='{$showingInfo[2]}' AND ST='{$showingInfo[3]}';";
	$result = mysqli_query($db, $query);
	$row = mysqli_fetch_array($result);
	$seatsRemaining = $showingInfo[5] - $row['NumTickets'];
	echo "Showing on {$showingInfo[6]} <br/>Seats Remaining: {$seatsRemaining}<br/>";
	echo "<form method=\"post\" action=\"ticketConfirm.php\">
		<label>Number of tickets</label>
		<input type=\"number\" name=\"numTickets\" min=\"1\" max=\"{$seatsRemaining}\">
		<input type=\"hidden\" name=\"dateHidden\" value=\"{$showingInfo[6]}\">
		<input type=\"hidden\" name=\"MovTitle\" value=\"" . $showingInfo[0] . "\">
		<input type=\"hidden\" name=\"CplName\" value=\"" . $showingInfo[1] . "\">
		<input type=\"hidden\" name=\"ThNum\" value=\"" . $showingInfo[2] . "\">
		<input type=\"hidden\" name=\"ST\" value=\"" . $showingInfo[3] . "\">
		<input type=\"hidden\" name=\"EndDate\" value=\"" . $showingInfo[4] . "\">
		<button type=\"submit\" class=\"button\" name=\"bookMovie\">Reserve Tickets!</button>
	</form>
	";
}

function confirmBooking() {
	global $db;
	$accNum = $_SESSION['user']['AccNum'];
	$movie = $_POST['MovTitle'];
	$complex = $_POST['CplName'];
	$theatreNum = $_POST['ThNum'];
	$start = $_POST['ST'];
	$date = $_POST['dateHidden'];
	$numTickets = $_POST['numTickets'];
	$plural = "{$numTickets} tickets";
	$pluralTwo = "have";
	
	$query = "INSERT INTO `reservation`(`NumTickets`, `MovTitle`, `AccNum`, `ThrNum`, `CplName`, `ST`, `Date`) 
			VALUES ('$numTickets', '$movie', '$accNum', '$theatreNum', '$complex', '$start', '$date')";
	$result = mysqli_query($db, $query);
	if ($result) {
		if ($numTickets == 1) {
			$plural = "A ticket";
			$pluralTwo = "has";
		}
		echo "
		{$complex}: Theatre {$theatreNum} <br/>
		{$plural} for {$movie} starting at {$start} on {$date} {$pluralTwo} been purchased.
		";
	} else {
		echo "Purchase failed. Please try again later.";
	}
}

function showPurchases() {
	global $db;
	$query = "SELECT * FROM reservation WHERE AccNum={$_SESSION['user']['AccNum']}";
	$result = mysqli_query($db, $query);
	$today = DateTime::createFromFormat('Y-m-d', date("Y-m-d"));
	$disabled = "";
	$buttonNum = 0;
	if (!$result) {
		echo "Something went wrong. Please try again later!";
		echo $query;
	} else {
		echo "
		<caption>Purchase history by {$_SESSION['user']['Email']}:</caption>
		<table>
			<tr>
			<th>Movie</th>
			<th>Date</th>
			<th>Showtime</th>
			<th>Number of Tickets</th>
			<th>Theatre Complex</th>
			<th>Theatre</th>
			</tr>";
			while($row = mysqli_fetch_array($result)) {
				$showingDate = DateTime::createFromFormat('Y-m-d', $row['Date']);
				$checkDate = $today < $showingDate ? true : false;
				if ($checkDate == true) {
					$disabled = "disabled";
				}
				$buttonInfo[$buttonNum] = "<form method=\"post\" action=\"cancelPurchase.php\" id=\"cancelPurchase{$buttonNum}\">
					<input type=\"hidden\" name=\"MovTitle[{$buttonNum}]\" value=\"{$row['MovTitle']}\">
					<input type=\"hidden\" name=\"date[{$buttonNum}]\" value=\"{$row['Date']}\">
					<input type=\"hidden\" name=\"CplName[{$buttonNum}]\" value=\"{$row['CplName']}\">
					<input type=\"hidden\" name=\"ThNum[{$buttonNum}]\" value=\"{$row['ThrNum']}\">
					<input type=\"hidden\" name=\"ST[{$buttonNum}]\" value=\"{$row['ST']}\">
					<input type=\"hidden\" name=\"numTickets[{$buttonNum}]\" value=\"{$row['NumTickets']}\">
					<input type=\"hidden\" name=\"userID[{$buttonNum}]\" value=\"{$_SESSION['user']['AccNum']}\">
				<button type=\"submit\" class=\"button\" name=\"cancelPurchase{$buttonNum}\" {$disabled}>Cancel Reservation</button></form>";
				echo "<tr>";
				echo "<td>" . $row['MovTitle'] . "</td>";
				echo "<td>" . $row['Date'] . "</td>";
				echo "<td>" . date("Y-m-d"). "</td>";
				echo "<td>" . $row['ST'] . "</td>";
				echo "<td>" . $row['NumTickets'] . "</td>";
				echo "<td>" . $row['CplName'] . "</td>";
				echo "<td>" . $row['ThrNum'] . "</td>";
				echo "<td>" . $buttonInfo[$buttonNum] . "</td>";
				echo "</tr>";
				$buttonNum++;
			}
		echo "</table>";
		}
}

function confirmCancellation() {
	global $db;
	$variables = array('movie', 'date', 'complex', 'theatre', 'start', 'tickets', 'userID');
	$i = 0;
	foreach($_POST as $values) {
		${$variables[$i]} = $values[0];
		$i++;
		if ($i == 7) break;
	}
	echo $movie;
	var_dump($_POST);
	$query = "DELETE FROM `reservation` WHERE NumTickets=\"{$tickets}\" 
		AND MovTitle=\"{$movie}\" AND AccNum=\"{$userID}\" AND ThrNum=\"{$theatre}\"
		AND CplName=\"{$complex}\" AND ST=\"{$start}\" AND Date=\"{$date}\"";
	$result = mysqli_query($db, $query);
	if ($result) {
		echo "
		{$complex}: Theatre {$theatre} <br/>
		Cancelled reservation for {$movie} starting at {$start} on {$date}
		";
	} else {
		echo "Request failed. Please try again later.";
		echo $query;
	}
}
?>
</html>