<?php
	/*transmition des variable de session puis supression de la session et donc de ses variables puis redirection vers la page de log*/
	session_start();
	unset($_SESSION['login']);
	header('Location:../index.php');
?>