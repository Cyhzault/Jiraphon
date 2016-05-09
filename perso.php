
<?php

/**
*@author Niark
*/

	require_once("./Controler.php");
	require_once("./ViewPerso.php");
	require_once("./Model.php");

	$controler=new Controler();
	$view= new ViewPerso();
	$model= new Model();

	$title="Page perso";


	$controler->beginPage("Perso",$title);

//page accessible uniquement si déjà connecté
if (!isset($_SESSION['pseudo'])){
	$str="<meta http-equiv='refresh' content='0;URL=login.php' />";
	echo $str;
}

else{
	require_once("./UserManager.Class.php");
	$um= new UserManager($model->getDb());
	$user= $um->getUserByPseudo($_SESSION['pseudo']);
	//chemin par défaut déjà dans la base de données

	$prenom=$user->getPrenom();
	$nom=$user->getNom();
	$pseudo=$user->getLogin();
	$fonction=$user->getFonction();
	$photo=$user->getPhoto();

	$view->beginContainer();
	$view->ShowInfoPerso($prenom, $nom, $pseudo, $fonction, "./photo/inconnu.png");
	$view->ShowLienPerso();
	$view->endDiv();
}

$controler->endPage($view);

?>
