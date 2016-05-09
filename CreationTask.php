<?php
/**
* @author Auroxy
*/
	require_once("./Controler.php");
	require_once("./ViewCreation.php");
	require_once("./Model.php");
	require_once("./TaskManager.Class.php");
	require_once("./UserManager.Class.php");

	$ctrl = new Controler();
	$view = new ViewCreation();
	$model = new Model();
	$tm = new TaskManager($model->getDb());
	$um = new UserManager($model->getDb());

	$ctrl->beginPage("Tâche","Création de Tâche");
	///début contenu\\\
	if(isset($_SESSION['pseudo']))
	{
		if(isset($_POST['description'])&&isset($_POST['duree_est'])&&isset($_POST['projet'])&&isset($_POST['nom'])&&isset($_POST['type']))
		{
			if(($_POST['duree_est']!=null)&&($_POST['description']!=null)&&($_POST['projet']!=null)&&($_POST['nom']!=null)&&($_POST['type']!=null))
			{
				require_once("./Task.Class.php");
				require_once ("./ProjectManager.Class.php");
				$pm = new ProjectManager($model->getDb());

				$project = $pm->getProjectByName(htmlspecialchars($_POST['projet']));


				$data = $_POST;
				$data['nom'] = $_POST['type'].'-'.htmlspecialchars($_POST['nom']);
				$data['id_createur']=$um->getUserByPseudo($_SESSION['pseudo'])->getId_utilisateur();
				$data['etat']='TODO';
				$data['desc']=htmlspecialchars($_POST['description']);

				$task = new task($data);
				$task->setId_projet($project->getId_projet());
				$tm->addTask($task->dataToArray());
				$view->displaySuccessMessage("Tâche créée avec succès.");
			}
			else
			{
				$view->displayErrorMessage("Veuillez remplir tout les champs.");
			}
		}
		$view->showTaskformulary();
	}
	else 
	{
		$view->authentificationRequired();
	}	
	


	
	$ctrl->endPage($view);
?>