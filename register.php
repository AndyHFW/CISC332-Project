<!DOCTYPE html>
<?php include('functions.php') ?>
<html lang="en-US">
<html>
<head>
	<meta charset="UTF-8">
	<title>User registration</title>
	<meta name="author" content="Andy Wang"/>
	<meta name="description" content="User registration for the OMTS system."/>
	<meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" href="reset.css">
	<link rel="stylesheet" href="OMTS.css">
	<!--<link rel="stylesheet" href="reset.css">
	<link rel="stylesheet" href="flashcard.css">
	<script src="flashcardJS.js"></script>
	<script src="jquery-3.2.1.min.js"></script>-->
</head>
<header>
</header>
<body>
	<div class="header">
		<h1>Register</h1>
	</div>
	<form method="post" action="register.php" class="content">
		<?php echo displayError(); ?>
		<div class="input-group">
			<label>E-mail address</label>
			<input type="text" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password" value="">
		</div>
		<div class="input-group">
			<label>Confirm password</label>
			<input type="password" name="passwordConfirm" value="">
		</div>
		<h2>Address</h2>
		<div class="input-group">
			<label>Street</label>
			<input type="text" name="street" value="<?php echo $street; ?>">
		</div>
		<div class="input-group">
			<label>City</label>
			<input type="text" name="city" value="<?php echo $city; ?>">
		</div>
		<div class="input-group">
			<label>Province</label>
			<input list="provinces" name="province">
			<datalist id="provinces">
				<option value="AB">
				<option value="BC">
				<option value="MB">
				<option value="NB">
				<option value="NL">
				<option value="NS">
				<option value="NT">
				<option value="NU">
				<option value="ON">
				<option value="PE">
				<option value="QC">
				<option value="SK">
				<option value="YT">
			</datalist>
		</div>
		<div class="input-group">
			<label>Postal code</label>
			<input type="text" name="postal" value="<?php echo $postal; ?>">
		</div>
		<div class="input-group">
			<label>Phone number</label>
			<input type="text" name="phoneNum" value="<?php echo $phoneNum; ?>">
		</div>
		<h2>Credit card info</h2>
		<div class="input-group">
			<label>Credit card number</label>
			<input type="text" name="creditNum" value="">
		</div>
		<div class="input-group">
			<label>Credit card expiry month</label>
			<input type="text" name="creditExpMonth" value="">
			<label>Credit card expiry year</label>
			<input type="text" name="creditExpYear" value="">
		</div>
		<div class="input-group">
			<button type="submit" class="button" name="registerButton">Register</button>
		</div>
	<p>
		Already a member? <a href="login.php">Sign in</a>
	</p>
	</form>
</body>
</html>