<!DOCTYPE html>
<?php 
include('functions.php');
if (isset($_GET['title'])) {
	$movie = $_GET['title'];
}
?>
<html lang="en-US">
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $movie; ?> info</title>
	<meta name="author" content="Andy Wang"/>
	<meta name="description" content="Information about <?php echo $movie; ?>"/>
	<meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" href="OMTS.css">
	<!--<link rel="stylesheet" href="reset.css">
	<script src="flashcardJS.js"></script>
	<script src="jquery-3.2.1.min.js"></script>-->
</head>
<header>
</header>
<body>
	<div id="columnContainer">
		<?php movieInfo($movie); ?>
	</div>
</body>
</html>