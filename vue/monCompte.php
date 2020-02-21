<?php
	session_start();
	if (!isset($_SESSION['login'])){
		header('Location:../index.php');
	}

?>
<html>
		<body>
			FICHIER CSV
			<form method="POST" action="../modele/importCSV_V2.php" enctype="multipart/form-data">	
				<input type="hidden" name="MAX_FILE_SIZE" value="100000">
     			Fichier : <input type="file" name="avatar">
     			<input type="submit" name="envoyer" value="Envoyer le fichier">
			</form>

			<br><br><br><br><br><br><br>

			FICHIER PDF
			<form method="POST" action="../modele/importCV.php" enctype="multipart/form-data">	
				<input type="hidden" name="MAX_FILE_SIZE" value="40240000">
     			CV : <input type="file" name="exportPDF">
     			<input type="submit" name="envoyer" value="Envoyer le fichier">
			</form>

			<br><br><br><br><br><br><br>

			<form method="POST" action="../vue/creationCompte.php" enctype="multipart/form-data">
				<input type="submit" name="envoyer" value="Créer un compte">
			</form>

			<form method="POST" action="../modele/rempCompte.php" enctype="multipart/form-data">
				<input type="submit" name="envoyer" value="Modifier mon compte">
			</form>

			<form method="POST" action="../vue/formAdmin.php" enctype="multipart/form-data">
					<input type="submit" name="envoyer" value="Formulaire Admin">
			</form>

			<form method="POST" action="../modele/deco.php" enctype="multipart/form-data">
				<input type="submit" name="envoyer" value="Deco">
			</form>

		</body>
</html>