<?php
	include "fonction.php";/*include du fichier de fonction*/
	session_start();
	if (isset($_SESSION['login'])){
		if(isset($_POST['crealogin'], $_POST['creamdp'], $_POST['creamdp2'], $_POST['formation'])){
			if(!empty($_POST['crealogin']) && !empty($_POST['creamdp']) && !empty($_POST['creamdp2'])){
				if(empty($_POST['formation'])){
					$formation = "Non renseigne";		
				}
				else{
					$formation = $_POST['formation'];
				}
				$login = $_POST['crealogin'];
				$mdp = $_POST['creamdp'];
				$confirmation = $_POST['creamdp2'];
				$role=$_POST['role'];
				
				
				if($mdp != $confirmation){
					header('location:../vue/creationCompte.php');
				}
				else{
					//inscription du nouveau compte
					ajoutUserBD($login, $mdp, $role, $formation);
				}
			}
		}
	}
	else{
		header("Location:../index.php");
	}
?>