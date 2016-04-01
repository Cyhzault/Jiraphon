<?php

	require_once("./Controler.php");
	require_once("./ViewLogin.php");
	require_once("./ModelLogin.php");


	$ctrl = new Controler();
	$view = new ViewLogin();
	$model = new ModelLogin();

	$ctrl->beginPage("Login","Page de connection");
	//////////////////////  Début contenu \\\\\\\\\\\\\\\\\\\\\\\\\\\\\

	$view->beginContainer();
	$view->showBar();

	if(isset($_POST['pseudo'])){

		if(!($model->connection($_POST['pseudo'],$_POST['pswd']))){

			$view->showConnectionFailed();

		}else if (isset($_POST['pseudo'])) {

			$view->showConnectionSuccess();

		}else{

			$view->showIsConnected($_SESSION['pseudo']);

		}

	}else{

		$view->showConnectionFormulary();

	}
	$view->endDiv();
	
	$ctrl->endPage($view);
?>