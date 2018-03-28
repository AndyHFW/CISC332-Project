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
			<!--<img src="images/user_profile.png"  >-->

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['Email']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['UserType']); ?>)</i> 
						<br>
							<?php
							if (isset($_GET['update'])) {
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
							} else if (isset($_GET['action'])) {
								if ($_GET['action'] == 'finReview') {
									finishReview();
								}
							}
							?>
							<a href="./updateEmail.php">Update e-mail</a><br/>
							<a href="./updatePWD.php">Change password</a><br/>
							<a href="./changeAddress.php">Update address</a><br/>
							<a href="./updateCC.php">Update credit card info</a><br/>
						<br>
						<a href="index.php?logout='1'" style="color: red;">logout</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>
</body>
</html>