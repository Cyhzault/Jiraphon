<?php

/**
* 
*/
require_once("./Model.php");
class ModelLogin extends Model
{
	function connexion($pseudo,$pswd)
	{
		$pseudo = htmlspecialchars($pseudo);
		$pswd = htmlspecialchars($pswd);

		$sql = "SELECT login,mdp FROM utilisateur WHERE login=:pseudo";
		$req = $this->db->prepare($sql);
        $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $req->execute();

		if($data = $req->fetch(PDO::FETCH_ASSOC))
		{
			//Utilisation de Trim pour enlever les espaces (255 caractères dans la base certains sont vides suivant l'encodage)
			if(password_verify($pswd,Trim($data['mdp'])))
			{
				$_SESSION['id']= md5(rand());
				$_SESSION['pseudo']=htmlspecialchars($_POST['pseudo']);
				return true;		
			}

			else
				return false;	
		}
		else
		{
			return false;
		}
	}

	//Vérification image est correcte
	function verif_image($file_photo)
	{
		$err="";

		//Vérification de la taille
		if ($file_photo['size'] > 1048576)  ///Limite fixée à 1 Mo
			$err = "La taille du fichier selectionné est trop importante";

		//Vérification de l'extension
		else
		{
			$extensions_valides = array( 'jpg' , 'jpeg' , 'png' );
			$extension_upload = strtolower(  substr(  strrchr($file_photo['name'], '.')  ,1)  );

			if ( in_array($extension_upload,$extensions_valides) == false) 
				$err="Extension de l'image incorrecte, extensions autorisées : jpg, jpeg, png";	

			else
			{
				// Vérification autres erreurs
				if ($file_photo['error'] > 0) 
					$err = "Erreur lors du transfert";
			}
		}

		return $err;
	}

	function insertion_donnees($nom,$prenom,$pseudo,$pswd,$fonction,$photo)
	{
		//Création d'une clé de hashage
		$pswd_hash=password_hash($pswd,PASSWORD_DEFAULT);

		//Requête d'insertion des données d'inscription dans base Utilisateur
		$sql = "INSERT INTO utilisateur(nom,prenom,fonction,statut,photo,mdp,login) VALUES(:nom,:prenom,:fonction,FALSE,:photo,:pswd,:pseudo)";
		$req = $this->db->prepare($sql);
		$req->bindParam(':nom', $nom, PDO::PARAM_STR);
        $req->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $req->bindParam(':pswd', $pswd_hash, PDO::PARAM_STR);
        $req->bindParam(':fonction', $fonction, PDO::PARAM_STR);
        $req->bindParam(':photo', $photo, PDO::PARAM_STR);

		if($req->execute())
			$err="";
		else
			$err = "Problème lors de l'insertion des données dans la BDD";

		return $err;
	}

	function inscription($nom,$prenom,$pseudo_i,$pswd_i,$pswd_verif,$fonction,$file_photo)
	{
		//Initialisation : Convertit les caractères spéciaux en entités HTML 
		$nom = htmlspecialchars($nom);
		$prenom = htmlspecialchars($prenom);
		$pseudo = htmlspecialchars($pseudo_i);
		$pswd = htmlspecialchars($pswd_i);
		$pswd_verif = htmlspecialchars($pswd_verif);
		$fonction = htmlspecialchars($fonction);
		$erreur="";

		//Vérification tout les champs obligatoires ont été rentrés
		if( ($nom && $prenom && $pseudo && $pswd && $pswd_verif && $fonction) != "")
		{
			//Vérification (nom,prenom) pas déjà présents dans base Utilisateur
			$sql = "SELECT nom,prenom FROM utilisateur WHERE nom=:nom AND prenom=:prenom";
			$req = $this->db->prepare($sql);
			$req->bindParam(':nom', $nom, PDO::PARAM_STR);
	        $req->bindParam(':prenom', $prenom, PDO::PARAM_STR);
	        $req->execute();

	        if($data = $req->fetch(PDO::FETCH_ASSOC))
	  		{
				$erreur="Il existe déjà un compte pour l'utilisateur " . $prenom . " " . $nom;
				$nom="";
				$prenom="";
	  		}
			else
			{
				//Vérification pseudo pas déjà présents dans la base Utilisateur
				$sql = "SELECT login FROM utilisateur WHERE login=:pseudo";
				$req = $this->db->prepare($sql);
				$req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
		        $req->execute();

		        if($data = $req->fetch(PDO::FETCH_ASSOC))
		        {
					$erreur="Le pseudo que vous avez choisi est déjà utilisé.";
					$pseudo="";
		        }
				else
				{
					//Vérification que les deux pswd entrés sont identiques
					if(strcmp($pswd,$pswd_verif)==0)
					{
						//Si une image a été selectionnée
						if(strcmp($file_photo['name'],"") != 0 )
						{
							$erreur=$this->verif_image($file_photo);

							//Si pas d'erreur sur le fichier uploadé
							if(strcmp($erreur, "") == 0)
							{
								//Placement de la photo dans dossier stockage
								$photo = 'photo/'.$file_photo['name']; //Url de stockage des photos

								if(move_uploaded_file($file_photo['tmp_name'],$photo))
									$erreur=$this->insertion_donnees($nom,$prenom,$pseudo,$pswd,$fonction,$photo);

								else
									$erreur = "Erreur lors de l'enregistrement de l'image";
							}
						}
						//Si pas d'image sélectionnée
						else
						{
							$photo = 'photo/inconnu.png';
							$erreur=$this->insertion_donnees($nom,$prenom,$pseudo,$pswd,$fonction,$photo);
						}
					}

					else
						$erreur="Veuillez entrer deux fois le même mot de passe.";
				}
			}
		}
		
		else
			$erreur="Les champs * sont obligatoires.";

		$array = array($erreur,$nom,$prenom,$pseudo,$fonction);
		return $array;
	}
}
		

?>