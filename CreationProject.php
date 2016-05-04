<?php
/**
* @author Auroxy
*/
	require_once("./Controler.php");
	require_once("./ViewCreation.php");
	require_once("./Model.php");
	require_once("./ProjectManager.Class.php");


	$ctrl = new Controler();
	$view = new ViewCreation();
	$model = new Model();
	$pm = new ProjectManager($model->getDb());

	$ctrl->beginPage("Projet","Création de projet");

	///début contenu\\\
	if(isset($_SESSION['pseudo']))
		if(isset($_POST['nom_projet'])&&isset($_POST['date_deb'])&&isset($_POST['date_fin'])&&isset($_POST['description']))
			if(($_POST['nom_projet']!=null)&&($_POST['date_deb']!=null)&&($_POST['date_fin']!=null)&&($_POST['description']!=null))
			{
			require_once("./Project.Class.php");
			$data = $_POST;
			$project = new project($data);
			$pm->addProject($project->dataToArray());
			}
			else
			{
				$view->showProjectformulary();
			}
		else
		{
			$view->showProjectformulary();
		}
	else
	{
		echo"<p> t'est pas co<p>" ;
	}
		
	$ctrl->endPage($view);
?>