<?php
require_once('./ViewEquipe.php');
require_once ('./ModelProject.php');
require_once ('./User.Class.php');

$model = new ModelProject();
$view = new ViewEquipe();

$db=$model->getDb();

//$equipe= $_GET['equipe'];


if(isset($_GET['equipe']))
{
	
	$nom = $_GET['term'];
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

else
{
	if(isset($_GET['nom']))
	{
		$nom=$_GET['nom'];
		$prenom=$_GET['prenom'];

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

	else
	{
		$nom = $_GET['term'];
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

}


?>








