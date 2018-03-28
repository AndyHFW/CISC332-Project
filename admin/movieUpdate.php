
<?php 
	include('../functions.php');
	if (!isLoggedIn()) {
		$loggedIn = false;
	} else {
		$loggedIn = true;
	}
	
	$db = mysqli_connect('localhost', 'root', '', 'omts56');
?>
	
	<h2>Movie Lists</h2>
	<a href="addMovies.php">Add New</a><br/><br/>
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
		<td>
		    <a href="editMovies.php?id=<?=$row['Title']?>">Edit</a>
			<a href="deleteMovies.php?id=$row['Title']?>">Delete</a>
		</td>
	  </tr>
	  <?php
	      }
		  
		 }
	  ?>
	 </table>

