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
			// Création des managers
			require_once("./UserManager.Class.php");
			require_once("./TaskManager.Class.php");
            require_once("./TeamManager.Class.php");
			$um = new UserManager($model->getDb());
			$tm = new TaskManager($model->getDb());
			$cm = new TeamManager($model->getDb());

			//Affichage des infos du projet
			$view->showProjectData($project);

			$sprints = $model->getAllSprintByProjectId($project->getId_projet());

			//récupération de l'utilisateur courant
			$user = $um->getUserByPseudo($_SESSION['pseudo']); //devrait passer par l'id mais osef



			//récupération de l'équipe de l'utilisateur.
			$teamId = $cm->getTeamIdFromUserId($user->getIdUtilisateur());
            $team = $cm->getUsersFromTeamId($teamId);

            $view->showTeamListDropdown($user,$team);

			$view->displayAllKanbans($user,$team,$tm,$project);

		}else{
			
			$projects =  $model->getAllProjectsByUsername($_SESSION['pseudo']);
			$view->showProjectsList($projects);
            
		}



	}



	$view->endDiv();

	$ctrl->endPage($view);
?>







