<?php
	include "fonction.php";/*include du fichier de fonction*/
	session_start();
	if (isset($_SESSION['login'])){
		if(isset($_POST['crealogin'], $_POST['creamdp'], $_POST['creamdp2'])){
			if(!empty($_POST['crealogin']) && !empty($_POST['creamdp']) && !empty($_POST['creamdp2'])){

				$login = $_POST['crealogin'];
				$mdp = $_POST['creamdp'];
				$confirmation = $_POST['creamdp2'];
				$role=$_POST['role'];
				
				
				if($mdp != $confirmation ){
					header('location:../vue/creationCompte.php?err0');
				}
				else if(preg_match('^(?=.[A-Z])(?=.[a-z])(?=.\d)(?=.[-+!$@%_])([-+!$@%_\w]{8,15})$^', $_POST['creamdp'])){
				    header('location:../vue/creationCompte.php?err1');
				}
				else{
					//inscription du nouveau compte
					ajoutUserBD($login, $mdp, $role);
				}
			}
		}
	}
	else{
		header("Location:../index.php");
	}
?>