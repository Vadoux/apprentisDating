<?php
	//Quand un élève met son cv sur le site internet le nom doit être changé en fonction des données de sa session :
	// si vadim derrien met son cv sur le site alors sont cv doit être renommé genre VadimDERRIEN.pdf ou qq chose comme ca
	include "fonction.php";
	/*protection face a l'accès par lien lorsque la personne n'est pas connecté en tant que user admin ou etudiant*/
	session_start();
	if (isset($_SESSION['login'])){//si la variable de session existe (connecté) le programme s'excute, sinon on retourne sur page de connection
		$fichier = upload('../uploadCV/','.pdf','exportPDF');
	}//fin if protection
	else{
		header('location:../index.php');
	}//fin else protection


?>