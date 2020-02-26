<?php
/*Problème lors de l'autentification lorsuqe le login est une chaine de caractère l'autentification ne se fait pas */
/*dés que ya de la chaine de charactère dans l'identifiant la connection ne se fait pas*/
	include "fonction.php";
		if (isset($_POST["login"], $_POST["mdp"])){//regarde si les champs login et mdp sont initialisé et la condition renvoie vrai si ils existent
			if( !empty($_POST["login"]) && !empty( $_POST["mdp"])){// si login et mdp sont rempli alors renvoie vrai
				foreach($_POST as $k => $v){//initialise les variables login et mdp
					$$k=$v;
				}//fin foreach initialisation des variables login et mdp
			$login = htmlentities($login);
			$mdp = htmlentities($mdp);

			$connexion = connexionBD("localhost","root","","test2");// connexion a la bd

			$requete="SELECT MDP,Role FROM compte where identifiant = '$login'"; // requete qui recupère le mdp de la bd en fonction de l'id rentré
			$resultat=mysqli_query($connexion,$requete); // recupére les resultat sous forme de ligne
			$ligne=mysqli_fetch_row($resultat);// transforme le resultat obtenue en qq chose d'utilisable

			if( cryptageMdp($mdp) == $ligne[0]){ // compare les mdp chiffré
				if($ligne[1] == 'etudiant') {
					session_start();
					$_SESSION['login']=$login;
					header("Location:../vue/monCompte.php");
					exit(0);
				}//fin if verification role
				else if($ligne[1] == 'admin'){
					session_start();
					$_SESSION['login']=$login;
					header("Location:../ccool.php");
					exit(0);
				}//fin else if verification role
				else{
					session_start();
					$_SESSION['login']=$login;
					header("Location:ccool.php");
					exit(0);
				}//fin else verification role

				
			}//fin if comparaison mdp
			else{
				header("Location:../vue/Accueil.php?err");
				exit(0);
			}//fin else comparaison mdp
			}//fin if login et mdp !empty


		}//fin if variable existes
		header("Location:../index.php");// tant que pas d'identifiant ni mdp on reste sur index
		exit(0);

?>