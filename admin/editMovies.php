<?php 
	include('../functions.php');
	if (!isLoggedIn()) {
		$loggedIn = false;
	} else {
		$loggedIn = true;
	}
	
	$db = mysqli_connect('localhost', 'root', '', 'omts56');
	if (isset($_POST['btn_submit'])){
       $query = "update `movie` set RunTime = '".$_POST['txt_runtime']."',
	                                Rating = '".$_POST['txt_rating']."',
									Synopsis = '".$_POST['txt_synopsis']."',
									DirFName = '".$_POST['txt_dirfname']."',
									DirLName = '".$_POST['txt_dirlname']."',
									ProdCompName= '".$_POST['txt_prodcompname']."',
									SuplName = '".$_POST['txt_suplname']."',
	   ";
	}
	$title = '';
	$runtime = '';
	$rating = '';
	$synopsis = '';
	$dirfname= '';
	$dirlname= '';
	$prodcompname = '';
	$suplname = '';
	if (isset($_GET['id'])) {
		$query =  "SELECT * FROM `movie` where Title=" .$_GET['id'];
		$result = mysqli_query($db, $query);
		if(mysqli_num_rows($result) > 0) {
			$row = mysqlifetch_assoc($result);
			$id = $row ['Title'];
			$runtime = $row ['RunTime'];
			$rating = $row ['Rating'];
			$synopsis = $row ['Synopsis'];
			$dirfname = $row ['DirFName'];
			$dirlname= $row ['DirLName'];
			$prodcompname = $row ['ProdCompName'];
			$suplname = $row ['SuplName'];
		}
	}
?>

<h2>Edit Movie</h2>
<form action="" method="post">
	<table>
		<tr>
			<td>RunTime</td>
			<td><input name="txt_runtime" value="<?=$runtime?>"></td>
		</tr>
		<tr>
			<td>Rating</td>
			<td><input name="txt_rating" value="<?=$rating?>"></td>
		</tr>
		<tr>
			<td>Synopsis</td>
			<td><input name="txt_synopsis" value="<?=$synopsis?>"></td>
		</tr>
		<tr>
			<td>DirFName</td>
			<td><input name="txt_dirfname" value="<?=$dirfname?>"></td>
		</tr>
		<tr>
			<td>DirLName</td>
			<td><input name="txt_dirlname" value="<?=$dirlname?>"></td>
		</tr>
		<tr>
			<td>ProdCompName</td>
			<td><input name="txt_prodcompname" value="<?=$prodcompname?>"></td>
		</tr>
		<tr>
			<td>SuplName</td>
			<td><input name="txt_suplname" value="<?=$suplname?>"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="btn_submit"></td>
		</tr>
	</table>
</form>

