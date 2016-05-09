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
	{
		if(isset($_POST['nom_projet'])&&isset($_POST['date_deb'])&&isset($_POST['date_fin'])&&isset($_POST['description']))
		{
			if(($_POST['nom_projet']!=null)&&($_POST['date_deb']!=null)&&($_POST['date_fin']!=null)&&($_POST['description']!=null))
			{
				require_once("./Project.Class.php");
				require_once("./UserManager.Class.php");
				$um = new UserManager($model->getDb());
				$data = $_POST;
				$user = $um->getUserByPseudo($_SESSION['pseudo']);
				$project = new project($data);
				$project->setId_chef($user->getId_utilisateur());
				$pm->addProject($project->dataToArray());
				$project = $pm->getProjectByName($project->getNom_projet());
				$pm->addUserInProject($user->getId_utilisateur(),$project->getId_projet());

				$view->displaySuccessMessage("Projet créé avec succès.");
			}else{
				$view->displayErrorMessage("Veuillez remplir tout les champs.");
			}
		}
		$view->showProjectformulary();
	}
	else
	{
		$view->authentificationRequired();
	}
		
	$ctrl->endPage($view);
?>