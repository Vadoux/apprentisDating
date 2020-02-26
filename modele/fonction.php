<?php
	/*le fichier de fonction n'est pas protégé par la variable session car elle est appelé par les premier fichier avant d'en avoir une ( lors de l'authentification) inexploitable normalement via url (à voir)*/
		function connexionBD($serveur, $login, $mdp, $bd){
				$connexion=mysqli_connect($serveur,$login,$mdp) or die("Connexion impossible au serveur $serveur pour $login");
				mysqli_select_db($connexion,$bd)or die("Impossible d'accèder à la base de données");

				return $connexion;
			}/*fin connexionBD*/

		function cryptageMdp($mdp){
			return hash('sha512',$mdp);	/*possibilité de rajouté un sel*/			//$MdpChiff = crypt("weshlesang", '$2a$07$oin0dn20ikn2i0on20d$');
																					//$MdpChiff2 = crypt("noncmortla", '$2a$07$oin0dn20ikn2i0on20d$');
		}
		function gestionComptesEtudiants($file, $separateur){
				$fp=fopen("../uploadCSV/".$file,"r");
				$fp2=fopen("../ScriptGenereProf/infosEtudiants.csv","w+");
				$connexion = connexionBD("localhost","root","","test2");

				/*Préparation de la requete d'insertion des valeurs dans la table personne*/
				$reqInsertPers="INSERT into personne (NumeroEt, Nom, Prenom, Age)";
				$reqInsertPers.="VALUES(?,?,?,?)";
				$reqPreparePers = mysqli_prepare($connexion,$reqInsertPers);
				/*Préparation de la requete d'insertion des valeurs dans la table personne*/

				/*Préparation de la requete d'insertion des valeurs dans la table etudiant*/
				$reqInsertEt="INSERT into etudiant (NumeroEt, Formation)";
				$reqInsertEt.="VALUES(?,?)";
				$reqPrepareEt = mysqli_prepare($connexion,$reqInsertEt);
				/*Préparation de la requete d'insertion des valeurs dans la table etudiant*/

				/*Préparation de la requete d'insertion des valeurs dans la table compte*/
				$reqInsertCpt="INSERT into compte (identifiant, MDP, Role)";
				$reqInsertCpt.="VALUES(?,?,?)";
				$reqPrepareCpt = mysqli_prepare($connexion,$reqInsertCpt);
				/*Préparation de la requete d'insertion des valeurs dans la table compte*/

				while($var=fgetcsv($fp,2048,$separateur)){

					/*remplissage de la requete sql de personne par les valeurs*/
					mysqli_stmt_bind_param($reqPreparePers,'ssss', $var[0], $var[1], $var[2], $var[3]);
					mysqli_stmt_execute($reqPreparePers);
					/*remplissage de la requete sql de personne par les valeurs*/			

					/*remplissage de la requete sql de etudiant par les valeurs*/
					mysqli_stmt_bind_param($reqPrepareEt,'ss', $var[0], $var[4] );
					mysqli_stmt_execute($reqPrepareEt);
					/*remplissage de la requete sql de etudiant par les valeurs*/

					$NombAlea = Array();

					$NombreAlea = rand();
					
					$NombAlea[]= $var[0] .";". $NombreAlea .";". $var[1] .";". $var[2];

					fputcsv($fp2,$NombAlea,";"," ","");//rentrer le mot de passe en clair dans le fichier csv pour le responsable

					/*chiffrement du mot de passe*/
					$MdpChiff = cryptageMdp($NombreAlea);												
					/*chiffrement du mot de passe*/
					$role = "etudiant";//role attribué a tous les user contenue dans la liste csv donné
					/*remplissage de la requete sql de Compte par les valeurs*/
					mysqli_stmt_bind_param($reqPrepareCpt,'sss', $var[0], $MdpChiff, $role);
					mysqli_stmt_execute($reqPrepareCpt);
					/*remplissage de la requete sql de Compte par les valeurs*/

					}/*fin while*/
			}
		//recuperation du fichier csv du prof il est récupéré et placé dans le dossier uploadCSV
		function upload($dossier, $extension, $NomFormulaire, $session){
			$fichier = basename($_FILES[$NomFormulaire]['name']);
			$taille_maxi = 100000;
			$taille_maxiPDF = 40240000;
			$taille = filesize($_FILES[$NomFormulaire]['tmp_name']);
			$extensions = array($extension);
			$extension = strrchr($_FILES[$NomFormulaire]['name'], '.');
			//Début des vérifications de sécurité...
			if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
				{
			     $erreur = 'Vous devez uploader un fichier de type csv';
				}
			if($extension!='.pdf'){
				if($taille>$taille_maxi){
				     $erreur = 'Le fichier est trop gros...';
					}
			}
			else {
				if($taille>$taille_maxiPDF){
				     $erreur = 'Le fichier est trop gros...';
					}
			}

			if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
				{
			     //On formate le nom du fichier ici...
				if ($extension == '.pdf'){
					$fichier  = $session.'.pdf';
				}
				else{
					$fichier = strtr($fichier,
				          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
				          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
				    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
				}

			     if(move_uploaded_file($_FILES[$NomFormulaire]['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
			    	{
			        echo 'Upload effectué avec succès !<br>';
			        return $fichier;
			     	}
			     else //Sinon (la fonction renvoie FALSE).
			     	{
			        echo 'Echec de l\'upload !<br>';
			     	}
			}
			else
				{
			     echo $erreur;
				}
		}

		function ajoutUserBD($login, $mdp, $role, $formation){
			$connexion = connexionBD("localhost","root","","test2");

			$MdpChiff = cryptageMdp($mdp);

			$reqInsertCpt="INSERT into compte (identifiant, MDP, Role)";
			$reqInsertCpt.="VALUES(?,?,?)";
			$reqPrepareCpt = mysqli_prepare($connexion,$reqInsertCpt);

			/*Préparation de la requete d'insertion des valeurs dans la table etudiant*/
			$reqInsertEt="INSERT into etudiant (NumeroEt, Formation)";
			$reqInsertEt.="VALUES(?,?)";
			$reqPrepareEt = mysqli_prepare($connexion,$reqInsertEt);
			/*Préparation de la requete d'insertion des valeurs dans la table etudiant*/

			/*Préparation de la requete d'insertion des valeurs dans la table personne*/
			$reqInsertPers="INSERT into personne (NumeroEt)";
			$reqInsertPers.="VALUES(?)";
			$reqPreparePers = mysqli_prepare($connexion,$reqInsertPers);
			/*Préparation de la requete d'insertion des valeurs dans la table personne*/

			mysqli_stmt_bind_param($reqPrepareCpt,'sss',$login , $MdpChiff, $role);
			mysqli_stmt_execute($reqPrepareCpt);

			mysqli_stmt_bind_param($reqPrepareEt,'ss',$login , $formation);
			mysqli_stmt_execute($reqPrepareEt);

			mysqli_stmt_bind_param($reqPreparePers,'s',$login);
			mysqli_stmt_execute($reqPreparePers);
		}

?>