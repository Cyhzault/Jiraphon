<?php
require_once('./ViewEquipe.php');
require_once ('./ModelProject.php');
require_once ('./User.Class.php');
require_once('TeamManager.Class.php');

$model = new ModelProject();
$db=$model->getDb();
$view = new ViewEquipe();
$tm = new TeamManager($db);


//Autocomplete
if(isset($_GET['equipe']))
{
	$nom = $_GET['nom_uti'];
	$user_n=array();

	$sql = "SELECT DISTINCT utilisateur.nom FROM utilisateur WHERE UPPER(utilisateur.nom) LIKE UPPER(:nom)";
	$req = $db->prepare($sql);
	$req->bindParam(':nom', $nom, PDO::PARAM_STR);
	$req->execute(array('nom' => '%'.$nom.'%'));

	while($data = $req->fetch(PDO::FETCH_ASSOC)){
	   	array_push($user_n,$data['nom']);
	}

	echo json_encode($user_n); 
}

//function ValidUti()
if(isset($_GET['nom_valid']))
{
	$nom=$_GET['nom_valid'];
	$prenom=$_GET['prenom_valid'];

	$sql = "SELECT * FROM utilisateur WHERE utilisateur.nom=:nom AND utilisateur.prenom=:prenom";
	$req = $db->prepare($sql);
	$req->bindParam(':nom', $nom, PDO::PARAM_STR);
	$req->bindParam(':prenom', $prenom, PDO::PARAM_STR);
	$req->execute();
	if($data = $req->fetch(PDO::FETCH_ASSOC))
	{
		$membre = $model->getUtilisateurById($data['id_utilisateur']);
		$id=$membre->getId_utilisateur();
		$data['html']=$view->showPictureHtml($id,$membre);
		echo json_encode($data);
	}
	else
		echo json_encode('');
}

//function ValidationNom()
if(isset($_GET['nom_u']))
{
	$nom = $_GET['nom_u'];
	$user_p=array();

	$sql = "SELECT utilisateur.prenom,utilisateur.nom FROM utilisateur WHERE utilisateur.nom=:nom";
	$req = $db->prepare($sql);
	$req->bindParam(':nom', $nom, PDO::PARAM_STR);
	$req->execute();

	while($data = $req->fetch(PDO::FETCH_ASSOC)){
	   	array_push($user_p,$data['prenom']);
	}

	echo json_encode($user_p); 
}

//function AddMembre()
if(isset($_GET['projet_id']))
{
	$projet_id = $_GET['projet_id'];
	//Récupère la chaine avec les noms d'équipe, la place dans un tableau en retirant le dernier élément vide
	$liste_equipe=explode(',',$_GET['liste_equipe']);
	array_splice($liste_equipe,-1);

	$liste_membre=explode(',',$_GET['liste_membre']);
	array_splice($liste_membre,-1);
	$err="ok";

	//Insertion équipe
	foreach ($liste_equipe as $equipe) 
	{
		//Récupération équipe
		$sql = "SELECT * FROM equipe WHERE nom_equipe=:nom_e";
		$req = $db->prepare($sql);
		$req->bindParam(':nom_e',$equipe, PDO::PARAM_STR);
	    $req->execute();

	    if($data = $req->fetch(PDO::FETCH_ASSOC))
	    {
	    	//Ajout de l'équipe au projet
			$sql = "INSERT INTO equipe_in_projet(id_equipe,id_projet) VALUES(:id_e,:id_p)";
			$req = $db->prepare($sql);
			$req->bindParam(':id_e', $data['id_equipe'], PDO::PARAM_STR);
	        $req->bindParam(':id_p', $projet_id, PDO::PARAM_STR);

			if($req->execute())
			{
				$array_user=array();

				//Ajout de chaque membre dans utilisateur_in_projet
				$array_user=$tm->getUsersFromTeamId($data['id_equipe']);
				foreach ($array_user as $user) {
					$sql = "INSERT INTO utilisateur_in_projet(id_utilisateur,id_projet) VALUES(:id_uti,:id_pro)";
					$req = $db->prepare($sql);
					$req->bindParam(':id_uti', $user->getId_utilisateur(), PDO::PARAM_STR);
			        $req->bindParam(':id_pro', $projet_id, PDO::PARAM_STR);

					if($req->execute())
						$err="";
				}
				
			}
			else
				$err = "Problème lors de l'insertion des équipes dans le projet";
		}
		else
		{
			$err="L'équipe". $equipe."n'existe pas";
		}
	}

	//Insertion membre solo
	foreach ($liste_membre as $membre) {

		$sql = "INSERT INTO utilisateur_in_projet(id_utilisateur,id_projet) VALUES(:id_u,:id_p)";
		$req = $db->prepare($sql);
		$req->bindParam(':id_u', $membre, PDO::PARAM_STR);
        $req->bindParam(':id_p', $projet_id, PDO::PARAM_STR);

		if($req->execute())
			$err="";
		else
			$err = "Problème lors de l'insertion des membres dans le projet ";
		
	}

	echo json_encode($err);

	

	
}


?>








