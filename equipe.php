<?php
	require_once("./Controler.php");
	require_once("./ModelProject.php");
	require_once("./ViewEquipe.php");

	$ctrl = new Controler();
	$modelpro = new ModelProject();
	$view = new ViewEquipe();
	$ctrl->beginPage("Equipes","Apperçu des equipes");

	//////////////////////  Début contenu \\\\\\\\\\\\\\\\\\\\\\\\\\\\\

	$view->beginContainer();
	$view->showBar();
	$projects = $modelpro->getAllProjectsByUsername($_SESSION['pseudo']);
	$view->showProjectsList($projects);
	
	foreach ($projects as $projet) {

		$cmpt=0;
		//Affichage nom projet
		$view->ListeProjet(true,$projet);
		$view->showNomProject($projet);

		//Affichage info projet / chef projet
		$user = $modelpro->getUtilisateurById($projet->getId_chef());
		$id=$projet->getId_projet().$user->getId_utilisateur();
		$view->showProjet($user,$projet,$id);

		//Affichage equipe
		$equipes= $modelpro->getAllTeamInProject($projet->getId_projet());
		$view->ListeEquipe(true);
		foreach ($equipes as $equipe) {
			$cmpt=$cmpt+1;
			$id=$projet->getId_projet().$equipe->getId_equipe();
			$view->showEquipe($equipe,$cmpt,$id);
		}

		//Affichage utilisateurs qui n'appartiennent pas à une équipe
		$users=$modelpro->getUsersSoloInProject($projet->getId_projet(),$projet->getId_chef());
		if($users != null)
			$view->showUsers($users,$id);

		// Fin balise projet et equipe
		$view->ListeEquipe(false);
		$view->ListeProjet(false,$projet);
	}

	
	

?>