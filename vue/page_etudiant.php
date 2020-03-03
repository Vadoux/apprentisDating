<!DOCTYPE html>
<html pageEtudiant lang="fr">
	<head>

		<!-- Titre De la page -->
		<title>Etudiant | Apprentis Dating</title>

		<!-- Encodage -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="icon" href="../img/favicon.ico">
		<link rel="stylesheet" href="../css2/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		<script>$(document).ready(function(){
			$(".form_deconnexion").hover(function(){
				$(".icone-deconnexion").attr('src','../img/ico-deconnexion.png');
		},
   function () {
      $(".icone-deconnexion").attr('src','../img/ico-deconnexionBlanc.png');  
   }
		);});
</script>
	</head>

	<body>
		
			

		
		<h1 class="titre"> APPRENTIS DATING </h1>
		<div class="logo-centrer">
			<img class="logo-uvsq" src="../img/logo-uvsq.jpg" alt="Logo UVSQ">
		</div>
		<div class="entete-bouton">
			<form class="form_depot_cv" method="POST" action="A_VOIR">
				<input class='bouton_depot_cv' type="submit" value="Dépot CV" name="depot_cv_button">
	    	</form>
			<form class="form_deconnexion" method="POST" action="../modele/deco.php">

				<input class='bouton_deconnexion' type="submit" value="Harry Potter" name="deconnexion_button">
				<a id="lien-deconnexion-ico" href="../modele/deco.php" ><img class="icone-deconnexion" src="../img/ico-deconnexionBlanc.png" alt="Icone déconnexion"></a>
	    	</form>
	    </div>

		<div class="barre_menu">
			<ul>
				<li><a>Mon Profil</a></li>
				<li><a>Mes offres</a></li>
				<li><a>Mon planning</a></li>
				<li><a>Informations</a></li>			
			</ul>
		</div>
		
		<div class="contenu"></div>
		
	</body>
</html>


<?php
	session_start();
	if (isset($_SESSION['login'])){
		echo " Bonjour";
	}
	
	else {
		header("Accueil.php");
	}
?>