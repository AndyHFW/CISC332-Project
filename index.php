<?php 
	include('functions.php');
	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" href="reset.css">
	<link rel="stylesheet" type="text/css" href="OMTS.css">
</head>
<header>
	<nav>
		<ul>
			<li><a href="./index.php">HOME</a></li>
			<li><a href="./booking.php">BOOKINGS</a></li>
			<li><a href="./showPurchases.php">PURCHASE HISTORY</a></li>
			<li><a href="<?php echo basename($_SERVER['PHP_SELF']); ?>?logout='1'">LOGOUT</a></li>
			<!--<li><a href="./instructions.html">Instructions</a></li>-->
		</ul>
	</nav>
</header>
<body>
	<div class="header">
		<h2>Home Page</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<!-- logged in user information -->
		<div class="profile_info">
			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<h1><?php echo $_SESSION['user']['Email']; ?></h1>
					<h3><i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['UserType']); ?>)</i></h3>
						<br>
							<?php
							if (isset($_GET['update'])) {
								echo "<div class=\"error\">";
								if ($_GET['update'] == 'address') {
									echo "Address successfully updated!<br/>";
								} else if ($_GET['update'] == 'cc') {
									echo "Credit card info successfully updated!<br/>";
								} else if ($_GET['update'] == 'pwd') {
									echo "Password successfully changed!<br/>";
								} else if ($_GET['update'] == 'email') {
									echo "E-mail address successfully updated!<br/>";
								} else if ($_GET['update'] == 'review') {
									echo "New review added!<br/>";
								}
								echo "</div>";
							} else if (isset($_GET['action'])) {
								echo "<div class=\"error\">";
								if ($_GET['action'] == 'finReview') {
									finishReview();
								}
								echo "</div>";
							}
							?>
							
							<div class="links">
							<a href="./updateEmail.php">Update e-mail</a><br/>
							<a href="./updatePWD.php">Change password</a><br/>
							<a href="./changeAddress.php">Update address</a><br/>
							<a href="./updateCC.php">Update credit card info</a><br/>
							</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</body>
</html>