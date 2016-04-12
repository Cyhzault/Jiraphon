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
		$project = new Project($model->getProjectById(htmlspecialchars($_GET['projectId'])));
		$header = $project->getNom_projet();
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
			require_once("./UserManager.Class.php");
			$um = new UserManager($model->getDb());
			$view->showProjectData($project);
			$sprints = $model->getAllSprintByProjectId($project->getId_projet());
			$user = $um->getUserByPseudo($_SESSION['pseudo']); //devrait passer par l'id mais osef
			$todo = ""; //Il faut créer un TaskManager qui permet de récuperer les données des projets
			$inProgress = "";
			$done = "";
			$view->showKanban($user,$todo,$inProgress,$done);

		}else{
			
			$projects =  $model->getAllProjectsByUsername($_SESSION['pseudo']);
			$view->showProjectsList($projects);




		}


	}



	$view->endDiv();

	$ctrl->endPage($view);
?>







?>