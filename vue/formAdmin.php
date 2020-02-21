<?php
	session_start();
	if (!isset($_SESSION['login'])){
		header('Location:../index.php');
	}

?>
<html>
	<form method='post' action='../modele/rempCompteAdmin.php'>
			<h2>Quel etudiant voulez-vous modifer</h2> 
			<input type='text' name='login' />
			<input type='submit' name='ok' value='GO'/>
	</form>
	<form method="POST" action="../vue/monCompte.php" enctype="multipart/form-data">
			<input type="submit" name="envoyer" value="Plus envie">
	</form>
</html>