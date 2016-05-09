<?php
	require_once("./Controler.php");
	require_once("./View.php");
	require_once("./Model.php");


	$ctrl = new Controler();
	$view = new View();
	$model = new Model();


	//Gère la déconnexion d'une personne
	if(isset($_GET['d']))
		{
			$model->disconnect();
			header('Location:./index.php');
		}


	$ctrl->beginPage("Jiraphon","Jiraphon V0.1");
	//////////////////////  Début contenu \\\\\\\\\\\\\\\\\\\\\\\\\\\\\

	
	$view->beginContainer();
	$view->displayWelcomeMessage();

	$view->endDiv();
	
	
	$ctrl->endPage($view);
?>