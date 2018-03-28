<?php
include('../functions.php');
if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
} else if (!isAdmin()) {
	$_SESSION['msg'] = "Insufficient permissions to access this page";
	header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update or delete movies</title>
	<link rel="stylesheet" href="../reset.css">
	<link rel="stylesheet" type="text/css" href="../OMTS.css">
</head>
<header>
	<nav>
		<ul>
			<li><a href="home.php">ADMIN HOMEPAGE</a></li>
			<li><a href="userView.php">USER VIEW</a></li>
			<li><a href="popular.php">MOST POPULAR</a></li>
			<li><a href="movieUpdate.php">UPDATE OR DELETE MOVIES</a></li>
			<li><a href="<?php echo basename($_SERVER['PHP_SELF']); ?>?logout='1'">LOGOUT</a></li>
			<!--<li><a href="./instructions.html">Instructions</a></li>-->
		</ul>
	</nav>
</header>
<body>
	
	<h2>Movie Lists</h2>
	<a href="addMovies.php"><h3>Add Movie</h3></a><br/>
<?php
	if (isset($_GET['action'])) {
		if ($_GET['action'] == "finEdit") {
			if (isset($_POST['btn_submit'])){
				$synopsis = mysqli_real_escape_string($db,$_POST['txt_synopsis']);
				$query = "update `movie` set `RunTime`='{$_POST['txt_runtime']}',
							`Rating`='{$_POST['txt_rating']}',
							`Synopsis`='{$synopsis}',
							`DirFName`='{$_POST['txt_dirfname']}',
							`DirLName`='{$_POST['txt_dirlname']}',
							`ProdCompName`='{$_POST['txt_prodcompname']}',
							`SuplName`='{$_POST['txt_suplname']}' 
							WHERE `Title`='{$_POST['title']}';";
				$result = mysqli_query($db, $query);
				if (!$result) {
					echo "broken";
				} else {
					echo "Edit successful!<br/>";
				
				}
				//echo $query;
			}
		} else if ($_GET['action'] == "finAdd") {
			if (isset($_POST['addMovie'])){
				$synopsis = mysqli_real_escape_string($db,$_POST['addSynopsis']);
				$query = "INSERT INTO `movie`(`Title`, `RunTime`, `Rating`, `Synopsis`, 
						`DirFName`, `DirLName`, `ProdCompName`, `SuplName`)
						VALUES ('{$_POST['addTitle']}','{$_POST['addRuntime']}','{$_POST['addRating']}',
						'{$synopsis}','{$_POST['addDirF']}','{$_POST['addDirL']}','{$_POST['addProd']}',
						'{$_POST['addSupl']}');";
				$result = mysqli_query($db, $query);
				if (!$result) {
					//echo "broken";
				} else {
					echo "Movie added successfully!<br/>";
				}
				//echo $query;
			}
		}
	}
?>
	<table border="1" cellspacing="0" cellpadding="5px">
	  <tr>
		<th>Title</th>
		<th>RunTime</th>
		<th>Rating</th>
		<th>Synopsis</th>
		<th>Director First Name</th>
		<th>Director Last Name</th>
		<th>Production Company Name</th>
		<th>Supplier Name</th>
		<th>Action</th>
	  </tr>
	  <?php
	  $query = "SELECT * FROM `movie`";
	  $result = mysqli_query($db, $query);
	  if (mysqli_num_rows($result)>0){
	  while($row = mysqli_fetch_array($result)) {
	  ?>
	  <tr>
	    <td><?=$row['Title']?></td>
		<td><?=$row['RunTime']?></td>
		<td><?=$row['Rating']?></td>
		<td><?=$row['Synopsis']?></td>
		<td><?=$row['DirFName']?></td>
		<td><?=$row['DirLName']?></td>
		<td><?=$row['ProdCompName']?></td>
		<td><?=$row['SuplName']?></td>
		<td class=\"tableLink\">
		    <a href="editMovies.php?id=<?php echo $row['Title'];?>">Edit</a>
			<a href="deleteMovies.php?id=<?php echo $row['Title'];?>">Delete</a>
		</td>
	  </tr>
	  <?php
	      }
		  
		 }
	  ?>
	 </table>
</body>
</html>
