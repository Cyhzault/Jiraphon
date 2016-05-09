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
		$project = $model->getProjectById(htmlspecialchars($_GET['projectId']));
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
			require_once ('./ProjectManager.Class.php');
			$um = new UserManager($model->getDb());
			$tm = new TaskManager($model->getDb());
			$cm = new TeamManager($model->getDb());
			$pm = new ProjectManager($model->getDb());

			//$sprint = $pm->getCurrentSprintByProjectId($project->getId_projet());


			//Affichage des infos du projet
			//$view->showProjectData($project,$sprint);
			$view->showProjectData($project);


			//récupération de l'utilisateur courant
			$user = $um->getUserByPseudo($_SESSION['pseudo']); //devrait passer par l'id mais osef

			//vue chef de projet
			if($project->getId_chef() == $user->getId_utilisateur())
			{
				//récupération de l'équipe de l'utilisateur.
				$teamList = $cm->getAllTeamInProject($project->getId_projet());
				$users = $cm->getUsersSoloInProject($project->getId_projet(),$user->getId_utilisateur());
				$view->showAdminToolbar($teamList,$users);

				foreach ($teamList as $team) {
					$view->displayAllKanbansWithSudo($user,$team->getUtilisateurs(),$users,$tm,$project);
				}
				$view->displayTaskToManage($tm->getTaskToManage($project->getId_projet()),$um);
				$view->displayModalFormulary($teamList,$users);
			}else{
				
				//récupération de l'équipe de l'utilisateur.
				$teamId = $cm->getTeamIdFromUserId($user->getId_utilisateur());
				$team = $cm->getUsersFromTeamId($teamId);

				$view->showTeamListDropdown($user,$team);

				$view->displayAllKanbans($user,$team,$tm,$project);

			}

			$view->displayModalTaskInfo();
		}else{
			$projects =  $model->getAllProjectsByUsername($_SESSION['pseudo']);
			$view->showProjectsList($projects);
            
		}



	}

	$view->endDiv();

	$ctrl->endPage($view);
?>







