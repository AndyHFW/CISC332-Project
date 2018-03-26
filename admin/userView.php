<?php
include('../functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
} else if (!isAdmin()) {
	$_SESSION['msg'] = "Insufficient permissions to access this page";
	header('location: ../index.php');
}
echo $_SERVER['DOCUMENT_ROOT']."/CISC332-Project/login.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>User View</title>
	<!--<link rel="stylesheet" type="text/css" href="style.css">-->
</head>
<header>
	<nav>
		<ul>
			
			<!--<li><a href="./instructions.html">Instructions</a></li>-->
		</ul>
	</nav>
</header>
<body>
	<div class="header">
		<h2>User View</h2>
	</div>
	<div id="userDisplay">
		<?php
			if (isset($_GET['action'])) {
					if ($_GET['action'] == 'delete') {
						deleteUser();
						echo "User successfully deleted.<br/>";
					}
			}
		?>
		<?php getUsers(); ?>
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
						<a href="home.php?logout='1'" style="color: red;">logout</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>
</body>
</html>