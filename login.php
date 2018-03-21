<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>OMTS User Login</title>
	<meta name="author" content="Andy Wang"/>
	<meta name="description" content="User login for the OMTS system."/>
	<meta name="viewport" content="width=device-width" />
</head>
<body>
	<div class="header">
		<h2>Login</h2>
	</div>
	<form method="post" action="login.php">

		<?php echo displayError(); ?>

		<div class="input-group">
			<label>Email</label>
			<input type="text" name="email" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="loginButton">Login</button>
		</div>
		<p>
			Not yet a member? <a href="register.php">Sign up</a>
		</p>
	</form>
</body>
</html>