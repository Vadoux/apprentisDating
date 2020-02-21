<?php

	include "fonction.php";
	/*protection face a l'accès par lien lorsque la personne n'est pas connecté en tant que user admin ou etudiant*/
	session_start();
	$session = $_SESSION['login'];//recupération de la variable de session qui contient le login que la personne a utilisé pour se conencter (numET normalement)

	if (isset($_SESSION['login'])){//si la variable de session existe (connecté) le programme s'excute, sinon on retourne sur page de connection
		$connexion = connexionBD("localhost","root","","test2");// connexion a la bd

		$requete="SELECT * FROM compte,personne,etudiant where compte.Identifiant=personne.NumeroEt and etudiant.NumeroEt = compte.Identifiant and compte.Identifiant='$session'"; // requete qui recupère le mdp de la bd en fonction de l'id rentré
		$resultat=mysqli_query($connexion,$requete); // recupére les resultat sous forme de ligne
		$ligne=mysqli_fetch_row($resultat);// transforme le resultat obtenue en qq chose d'utilisable


		echo"<form method='post' action='rempCompte.php'>

			<h2>login : $ligne[0]</h2> 
			
			<h2>mdp : ********</h2>
			<input type='password' name='mdp' />

			<h2>Nom : $ligne[4]</h2>
			<input type='text' name='nom' />

			<h2>Prenom : $ligne[5]</h2>
			<input type='text' name='prenom' />

			<h2>Age : $ligne[6]</h2>
			<input type='text' name='age' />

			<h2>Formation : $ligne[11]</h2>
			<input type='text' name='formation' />

			<h2>Universite : $ligne[12]</h2>
			<input type='text' name='universite' />

			<h2>Date de Naissance : $ligne[7]</h2>
			<input type='text' name='datedenaissance' />

			<h2>Telephone : $ligne[8]</h2>
			<input type='tel' name='telephone' />

			<h2>Adresse email : $ligne[9]</h2>
			<input type='mail' name='email' />

			<input type='submit' name='ok' value='GO'/>
		</form>";
		echo"<form method='POST' action='../vue/monCompte.php' enctype='multipart/form-data'>
				<input type='submit' name='envoyer' value='Plus envie'>
			</form>";

		if (isset( $_POST["mdp"], $_POST["nom"], $_POST["prenom"], $_POST["age"], $_POST["formation"], $_POST["universite"], $_POST["datedenaissance"], $_POST["telephone"], $_POST["email"])){//si toutes les variables existes
			
			if(!empty( $_POST["mdp"])){//si variable pleine
				$mdpC = cryptageMdp($_POST["mdp"]);
				$requete="UPDATE compte SET MDP= '$mdpC' where Identifiant = '$session'"; // requete qui recupère le mdp de la bd en fonction de l'id rentré
				mysqli_query($connexion,$requete); 
				
			}//fin if empty
			
			if(!empty( $_POST["nom"])){//si variable pleine
				$requete="UPDATE personne SET Nom= '$_POST[nom]' where NumeroEt = '$session'"; 
				mysqli_query($connexion,$requete); 
				
			}//fin if empty
			if(!empty( $_POST["prenom"])){//si variable pleine
				$requete="UPDATE personne SET Prenom= '$_POST[prenom]' where NumeroEt = '$session'"; 
				mysqli_query($connexion,$requete); 
				
			}//fin if empty
			if(!empty( $_POST["age"])){//si variable pleine
				$requete="UPDATE personne SET Age= '$_POST[age]' where NumeroEt = '$session'"; 
				mysqli_query($connexion,$requete); 
				
			}//fin if empty
			if(!empty( $_POST["datedenaissance"])){//si variable pleine
				$requete="UPDATE personne SET DateNaissance= '$_POST[datedenaissance]' where NumeroEt = '$session'"; 
				mysqli_query($connexion,$requete); 
				
			}//fin if empty
			//preg_match ne fonctionne pas ca me ji
			if(!empty( $_POST["telephone"])){//si variable pleine //&& !preg_match("#^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$#", $_POST["telephone"])){
				$requete="UPDATE personne SET Telephone= '$_POST[telephone]' where NumeroEt = '$session'"; 
				mysqli_query($connexion,$requete); 
				
			}//fin if empty
			if(!empty( $_POST["email"])){//si variable pleine
				$requete="UPDATE personne SET Mail= '$_POST[email]' where NumeroEt = '$session'"; 
				mysqli_query($connexion,$requete); 
				
			}//fin if empty
			if(!empty( $_POST["formation"])){//si variable pleine
				$requete="UPDATE etudiant SET Formation= '$_POST[formation]' where NumeroEt = '$session'"; 
				mysqli_query($connexion,$requete); 
				
			}//fin if empty
			if(!empty( $_POST["universite"])){//si variable pleine
				$requete="UPDATE etudiant SET Universite= '$_POST[universite]' where NumeroEt = '$session'"; 
				mysqli_query($connexion,$requete); 
				
			}//fin if empty
			
		}//fin if de variable existante
	}//fin if de protection 
	else{
		header('location:../index.php');
	}//fin else protection
?>

