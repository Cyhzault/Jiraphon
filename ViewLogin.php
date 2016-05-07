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
			<form action='' method='POST' enctype='multipart/form-data' >
				<div class='form-group' id='inscription_form'>
					<div class='champ_ins'>
						<label>Nom * : </label>
						<input type='text' name='nom' class='form-control' placeholder='Votre nom' value='$array[1]'>
					</div>
					<div class='champ_ins'>
						<label>Prenom * : </label>
						<input type='text' name='prenom' class='form-control' placeholder='Votre prenom' value='$array[2]'>
					</div>
					<div class='champ_ins'>
						<label>Pseudo * : </label>
						<input type='text' name='pseudo_i' class='form-control' placeholder='Entrez votre pseudo' value='$array[3]'>
					</div>
					<div class='champ_ins'>
						<label>Mot de passe * : </label>
						<input type='password' name='pswd_i' id='pswd_ins' class='form-control' placeholder='Votre mot de passe' onblur='VerifMdp(this)' data-toggle='tooltip' data-placement='right'>
					</div>
					<div class='champ_ins'>
						<label>Verification mot de passe * : </label>
						<input type='password' name='pswd_verif' id='pswd_v' class='form-control' placeholder='Veuillez retaper votre mot de passe'  onblur='MdpIdentique(this)' data-toggle='tooltip' data-placement='right'>
					</div>
					<div class='champ_ins'>
						<label>Fonction * : </label>
						<input type='text' name='fonction' class='form-control' placeholder='Votre fonction' value='$array[4]'/>
					</div>
					<div class='champ_ins'>
						<label>Photo : </label>
						<input name='photo' id='photo' type='file' class='form-control' placeholder='Votre photo'/>
					</div>
					<p>* Champ obligatoires </p>
					<button id='ins_button' class='btn btn-primary' type='submit'>Inscription</button>
				</div>
				
				<hr>
			</form>
		";

	}
};


?>

<script src='//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js'></script>
<script type="text/javascript">

function VerifMdp(champ)
{
	if(document.getElementById('pswd_v').value != '')
		MdpIdentique(document.getElementById('pswd_v'));

	$('[name="pswd_i"]').tooltip("destroy");

	//vérification taille du mdp
	if (champ.value.length < 8)
	{
		if(!$('[name="pswd_i"]').title)
		{
			$('[name="pswd_i"]').tooltip({
    		title: 'Votre mot de passe doit contenir au moins 8 caractères',
    		trigger: 'hover'
			});
		}
		ShowError(champ,true,$('[name="pswd_i"]'));
	}
	else
	{
		//vérification contenance mdp
		if (!(/\W/.test(champ.value) && /\d/.test(champ.value)))
		{

			if(!$('[name="pswd_i"]').title)
			{
				$('[name="pswd_i"]').tooltip({
	    		title: 'Votre mot de passe doit contenir au moins un chiffre et un caractère spécial',
	    		trigger: 'hover'
				});	
			}	
			ShowError(champ,true,$('[name="pswd_i"]'));
		}
		else
		{
			ShowError(champ,false,$('[name="pswd_i"]'));
		}	
	}
}



function MdpIdentique(champ)
{
	if(!(champ.value==document.getElementById('pswd_ins').value))
	{
		$('[name="pswd_verif"]').tooltip({
	    		title: 'Les deux mots de passe doivent être identiques',
	    		trigger: 'hover'
		});	

		ShowError(champ,true,$('[name="pswd_verif"]'));
	}
	else
		ShowError(champ,false,$('[name="pswd_verif"]'));
}

function ShowError(champ,erreur,input)
{

	   if(erreur)
	   {
	   		champ.style.backgroundColor = "#FA2A3F";
	   		input.tooltip("show");
	   }
	   else
	   {
	   		champ.style.backgroundColor = "";
	   		input.tooltip("destroy");
	   }
}

</script>

