<?php
	require_once("./Controler.php");
	require_once("./ModelEquipe.php");
	require_once("./ModelProject.php");
	require_once("./ViewEquipe.php");

	$ctrl = new Controler();
	$model = new ModelEquipe();
	$modelpro = new ModelProject();
	$view = new ViewEquipe();
	$ctrl->beginPage("Equipes","Apperçu des equipes");

	//////////////////////  Début contenu \\\\\\\\\\\\\\\\\\\\\\\\\\\\\

	$view->beginContainer();
	$view->showBar();
	$projects = $modelpro->getAllProjectsByUsername($_SESSION['pseudo']);
	$view->showProjectsList($projects);
	
	//var_dump($projects);
	foreach ($projects as $projet) {
		$view->ListeProjet(true,$projet);
		$view->showNomProject($projet);
		$user = $modelpro->getUtilisateurById($projet->getCommanditaire());
		$view->showChefProjet($user);
		$equipes= $modelpro->getAllTeamInProject($projet->getId_projet());
		//var_dump($equipes);
		$view->ListeEquipe(true);
		foreach ($equipes as $equipe) {
			$view->showEquipe($equipe);
		}
		$view->ListeEquipe(false);
		$view->ListeProjet(false,$projet);
	}

	//$chefprojet = $modelpro->
	
	

?>