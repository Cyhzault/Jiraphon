<?php
	require_once("./Controler.php");
	require_once("./ModelProject.php");
	require_once("./ViewProject.php");

	$ctrl = new Controler();
	$model = new ModelProject();
	$view = new ViewProject();


	$title = "Projets";
	$header = "Selection d'un projet";

	///////////////////// Gestion de l'entête \\\\\\\\\\\\\\\\\\\\\\\\\\\

	if(!isset($_SESSION['pseudo']))
	{
		$header = "Connexion requise";
	}else if(isset($_GET['projectId']))
	{
		$project = new Project($model->getProjectById($_GET['projectId']));
		$header = $project->getNomProjet();
	}

	$ctrl->beginPage($title,$header);









	//////////////////////  Début contenu \\\\\\\\\\\\\\\\\\\\\\\\\\\\\
	if(!isset($_SESSION['pseudo']))
	{
		$view->authentificationRequired();
	}else{
		$view->beginContainer();
		$view->showBar();
		if(isset($project))
		{
			$view->showProjectData();
			$sprints = $model->getAllSprintByProjectId($project->getIdProjet());


		}else{

			$projects =  $model->getAllProjectsByUsername($_SESSION['pseudo']);
			$view->showProjectsList($projects);




		}


	}



	$view->endDiv();

	$ctrl->endPage($view);
?>







?>