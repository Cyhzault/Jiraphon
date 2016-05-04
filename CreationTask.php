<?php
/**
* @author Auroxy
*/
	require_once("./Controler.php");
	require_once("./ViewCreation.php");
	require_once("./Model.php");


	$ctrl = new Controler();
	$view = new ViewCreation();
	$model = new Model();

	$ctrl->beginPage("Tâche","Création de Tâche");

	///début contenu\\\
	if(isset($_POST['description'])&&isset($_POST['duree_est']))
	{

	}
	$view->showTaskformulary();


	
	$ctrl->endPage($view);
?>