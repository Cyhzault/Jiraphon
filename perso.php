
<?php

/*
*@author Niark
*/


	require_once("./Controler.php");
	require_once(/*"./ViewPerso.php"*/"/view.php");
	require_once("./Model.php");

	$controler=new Controler();
	$view= new View()/*ViewPerso()*/ ;
	$model= new Model();

	$title="Page perso";


	$controler->beginPage("Perso","Page perso");

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

	$str=$user->getPrenom()." ".$user->getNom();
	$str.=$user->getFonction();

	$str.="<a href='' ><img src='".$user->getphoto()."' alt='photo de profil'></a>

	<a href=''>Mon equipe</a>
	<a href='project.php'>Mes projets</a>
	<a href='creationProject.php'>Creer projet</a>
	<a href=''>Archives</a>";

	echo $str;
}

?>
