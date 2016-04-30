<?php

	require_once("./Controler.php");
	require_once("./ViewLogin.php");
	require_once("./ModelLogin.php");


	$ctrl = new Controler();
	$view = new ViewLogin();
	$model = new ModelLogin();
	$ctrl->beginPage("Login","Page de connexion");
	//////////////////////  Début contenu \\\\\\\\\\\\\\\\\\\\\\\\\\\\\

	$view->beginContainer();
	$view->showBar();

	if(isset($_POST['pseudo']))
	{

		if(!($model->connexion($_POST['pseudo'],$_POST['pswd'])))
		{

			$view->showConnectionFailed();

		}else{

			$view->showConnectionSuccess();

		}
	}

	if(isset($_SESSION['pseudo']))
		$view->showIsConnected($_SESSION['pseudo']);

	elseif (isset($_GET['inscription'])) 
	{
		$array=array("","","","","","");
		if(isset($_POST['nom']))
		{
			$array=$model->inscription($_POST['nom'],$_POST['prenom'],$_POST['pseudo_i'],$_POST['pswd_i'],$_POST['pswd_verif'],$_POST['fonction'],$_FILES["photo"]);

			if(strcmp($array[0],"")==0)
				$view->showInscriptionSuccess();

			else{
				$view->showInscriptionFailed($array[0]);
				$view->showInscriptionFormulary($array);
			}

		}
		else
			$view->showInscriptionFormulary($array);
	}

	else
		$view->showConnectionFormulary();	

	$view->endDiv();
	
	$ctrl->endPage($view);
?>