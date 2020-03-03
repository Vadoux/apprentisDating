<?php
/*----------------------------------------------| INFOS |----------------------------------------*/
	/* ce fichier import et rempli une base de données crée au préalable du nom de test2 avec un login root sans mdp sur un serveur local
	2 tables pour l'instant : personne avec les champs NumeroEt, Nom, Prenom, Age,
							: etudiant avec les champs NumeroEt, Formation,
							: compte avec les champs identifiant, MDP */

	/* voir pour créer des vues pour attribuer des drotis spécifique a chaque utilisateurs, un admin doit pouvoir modifier les mots de passes des élèves, un élève doit pouvoir uniquement modifier son propre mot de passe dans la basse de données*/
/*----------------------------------------------| /INFOS |----------------------------------------*/
	include "fonction.php";
	/*protection face a l'accès par lien lorsque la personne n'est pas connecté en tant que user admin ou etudiant*/
	session_start();
	if (isset($_SESSION['login'])){//si la variable de session existe (connecté) le programme s'excute, sinon on retourne sur page de connection

		$fichier = upload('../uploadCSV/','.csv','avatar',$_SESSION['login']);
		gestionComptesEtudiants($fichier, ";");
	}
	else{
		header('location:../index.php');
	}
?>