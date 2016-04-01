<?php

/**
* @author Cyhzault
*/
require_once("./View.php");
class ViewLogin extends View
{
	
	function __construct()
	{
		
	}

	function showIsConnected($data){echo "Vous êtes connecté en tant que ".$data.".";}

	function showConnectionSuccess()
	{
		echo"
		<div class='alert alert-success'>Connexion <strong>réussie</strong></div>
		";
	}
	
	function showConnectionFailed()
	{
		echo"
		<div class='alert alert-danger'>Connexion impossible, erreur dans l'identifiant ou dans le mot de passe</div>
		";
	}

	function showConnectionFormulary()
	{
		echo"
			<form action='login.php' method='POST'>
				<div class='form-group'>
					<label>Pseudo : </label><input type='text' name='pseudo' class='form-control' placeholder='Entrez votre pseudo'>
					<label>Mot de passe : </label><input type='password' name='pswd' class='form-control' placeholder='Votre mot de passe'>
				</div>
				<button class='btn btn-primary' type='submit'>Connexion</button>
				<hr>
				<div class='text-center'>
					<a href='inscription.php'>Pas de compte ? Cliquez ici pour vous inscrire</a>
				</div>
			</form>
		";

	}

	function showInscriptionFormulary()
	{
		echo"
			<form action='login.php' method='POST'>
				<div class='form-group'>
					<label>Pseudo : </label><input type='text' name='pseudo' class='form-control' placeholder='Entrez votre pseudo'>
					<label>Mot de passe : </label><input type='password' name='pswd' class='form-control' placeholder='Votre mot de passe'>
				</div>
				<button class='btn btn-primary' type='submit'>Inscription</button>
				<hr>
			</form>
		";

	}
};


?>