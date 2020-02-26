<?php
	session_start();
	if (!isset($_SESSION['login'])){
		header('Location:../index.php');
	}

?>
<html>
	<form method='post' action='../modele/compte.php'>

		<h2>Identifiant</h2>
		<input type='text' name='crealogin' required/>

		<h2>Mot de passe</h2>
		<input type='password' name='creamdp' required/>

		<h2>Confirmer le Mot de passe</h2>
		<input type='password' name='creamdp2' required/>

		<h2>Role</h2>
		<INPUT TYPE='radio' NAME= 'role' VALUE='admin' CHECKED>Admin<br>
		<INPUT TYPE='radio' NAME= 'role' VALUE='responsable'>Responsable<br>
		<INPUT TYPE='radio' NAME= 'role' VALUE='etudiant'>Etudiant<br>

		<input type='submit' name='ok' value='Créer'/>
	</form>
	<form method='POST' action='../vue/monCompte.php' enctype='multipart/form-data'>
		<input type='submit' name='envoyer' value='Plus envie'>
	</form>
    <?php
        if (isset($_GET["err0"])){
            echo"Les mots de passes ne correspondent pas";
        }
        if (isset($_GET["err1"])){ //
            echo"le mot de passe ne respecte pas les règles imposé";
        }
    ?>

</html>