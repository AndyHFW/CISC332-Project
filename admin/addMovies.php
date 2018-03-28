<?php 
	include('../functions.php');
	if (!isLoggedIn()) {
		$loggedIn = false;
	} else {
		$loggedIn = true;
	}
	
	$db = mysqli_connect('localhost', 'root', '', 'omts56');
	if (isset($_POST['btn_submit'])){
		$sql = "insert into movie(Title, RunTime, Rating, Synopsis, DirFName, DirLName, ProdCompName, SuplName)
		         values ('".$_POST['txt_title']."', '".$_POST['txt_runtime']."', '".$_POST['txt_rating']."','".$_POST['txt_synopsis']."','".$_POST['txt_dirfname']."', '".$_POST['txt_dirlname']."', '".$_POST['txt_prodcompname']."', '".$_POST['txt_suplname']."')";
		
	}
?>

<h2>Add Movie</h2>
<form action="" method="post">
	<table>
		<tr>
			<td>Title</td>
			<td><input name="txt_title"></td>
		</tr>
		<tr>
			<td>RunTime</td>
			<td><input name="txt_runtime"></td>
		</tr>
		<tr>
			<td>Rating</td>
			<td><input name="txt_rating"></td>
		</tr>
		<tr>
			<td>Synopsis</td>
			<td><input name="txt_synopsis"></td>
		</tr>
		<tr>
			<td>DirFName</td>
			<td><input name="txt_dirfname"></td>
		</tr>
		<tr>
			<td>DirLName</td>
			<td><input name="txt_dirlname"></td>
		</tr>
		<tr>
			<td>ProdCompName</td>
			<td><input name="txt_prodcompname"></td>
		</tr>
		<tr>
			<td>SuplName</td>
			<td><input name="txt_suplname"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="btn_submit"></td>
		</tr>
	</table>
</form>

