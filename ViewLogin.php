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


	function beginContainer(){echo "<div class='container-fluid login-container'>";}// (Auroxy) : petite modif pour le css

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


	function showInscriptionSuccess()
	{
		echo"
		<div class='alert alert-success'>Inscription <strong>réussie</strong></div>
		";
	}
	
	function showInscriptionFailed($erreur)
	{
		echo"
		<div class='alert alert-danger'> $erreur </div>
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
					<a class='link-inscription' href='login.php?inscription=5'>Pas de compte ? Cliquez ici pour vous inscrire</a>
				</div>
			</form>
		";

	}

	function showInscriptionFormulary($array)
	{
		echo"
			<form action='' method='POST' enctype='multipart/form-data'>
				<div class='form-group'>
					<label>Nom * : </label><input type='text' name='nom' class='form-control' placeholder='Votre nom' value='$array[1]'>
					<label>Prenom * : </label><input type='text' name='prenom' class='form-control' placeholder='Votre prenom' value='$array[2]'>
					<label>Pseudo * : </label><input type='text' name='pseudo_i' class='form-control' placeholder='Entrez votre pseudo' onblur='verifPseudo(this)' value='$array[3]'>
					<label>Mot de passe * : </label><input type='password' name='pswd_i' class='form-control' placeholder='Votre mot de passe'>
					<label>Verification mot de passe * : </label><input type='password' name='pswd_verif' class='form-control' placeholder='Veuillez retaper votre mot de passe'>
					<label>Fonction * : </label><input type='text' name='fonction' class='form-control' placeholder='Votre fonction' value='$array[4]'/>
					<label>Photo : </label> <input name='photo' id='photo' type='file' class='form-control' placeholder='Votre photo'/>
					<label>* Champ obligatoires </label>
				</div>
				<button class='btn btn-primary' type='submit'>Inscription</button>
				<hr>
			</form>
		";

	}
};


?>

<script src='//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js'></script>
<script type="text/javascript">
function surligne(champ,erreur)
	{
	   if(erreur)
	      champ.style.backgroundColor = "#FA2A3F";
	   else
	      champ.style.backgroundColor = "";
	}

	function verifPseudo(champ)
	{
	   if(champ.value.length < 2 || champ.value.length > 25)
	   {
	      surligne(champ, true);
	      return false;
	   }
	   else
	   {
	      surligne(champ, false);
	      return true;
	   }
	}

</script>

