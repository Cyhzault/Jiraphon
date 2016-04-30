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
	
	foreach ($projects as $projet) {

		$cmpt=0;
		//Affichage nom projet
		$view->ListeProjet(true,$projet);
		$view->showNomProject($projet);

		//Affichage chef projet
		$user = $modelpro->getUtilisateurById($projet->getCommanditaire());
		$id=$projet->getId_projet().$user->getId_utilisateur();
		$view->showChefProjet($user,$id);

		//Affichage equipe
		$equipes= $modelpro->getAllTeamInProject($projet->getId_projet());
		$view->ListeEquipe(true);
		foreach ($equipes as $equipe) {
			$cmpt=$cmpt+1;
			$id=$projet->getId_projet().$equipe->getId_equipe();
			$view->showEquipe($equipe,$cmpt,$id);
		}

		//Affichage utilisateur in projet (qui n'appartiennent pas à une équipe)

		// Fin balise projet et equipe
		$view->ListeEquipe(false);
		$view->ListeProjet(false,$projet);
	}

	
	

?>