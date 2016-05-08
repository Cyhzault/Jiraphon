<?php

/**
*@author Niark
*/

require_once("../Jiraphon/ViewLogin.php");
class ViewModif extends ViewLogin
{
	function ShowModifSuccess()
	{
		echo"
			<div class='alert alert-success'>Modification effectuée avec succés.</div>
		";
	}

	function ShowErrorMdp()
	{
		echo"
			<div class='alert alert-danger'>Erreur dans la saisie de votre mot de passe</div>
		";
	}

	function ShowModifFailed()
	{
		echo"
			<div class='alert alert-danger'>Votre modification n'a pas pu être prise en compte</div>
		";
	}

	function ShowChangePassword($valmdp)
	{
		echo"
			<h2>Changement de mot de passe</h2>
			<form action='' method='POST' enctype='multipart/form-data' >
				<div class='form-group'>
				<div class='champ_ins'>
						<label>Mot de passe actuel : </label>
						<input type='password' name='pswd' class='form-control' placeholder='Votre mot de passe actuel' value='$valmdp[1]'>
					</div>
					<div class='champ_ins'>
						<label>Nouveau mot de passe : </label>
						<input type='password' name='pswd_i' class='form-control' placeholder='Veuillez entrer votre nouveau mot de passe'
							onblur='verifMdp(this)' data-toggle='tooltip' data-placement='right' value='$valmdp[2]'>
					</div>
					<div class='champ_ins'>
						<label>Confirmation : </label>
						<input type='password' name='pswd_verif' class='form-control' placeholder='Confirmez votre nouveau mot de passe' value='$valmdp[3]'>
					</div>
					<button id='mdp_button' class='btn btn-primary' type='submit' style='float:right; margin:5px;'>Modifier</button>
				</div>
			</form>
		";
	}

	function ShowChangePicture($valphot)
	{	
		echo"
			<h2>Modification photo de profil</h2>
			<form action='' method='POST' enctype='multipart/form-data' >
				<div class='form-group'>
					<label>Photo : </label>
						<input name='photo' id='photo' type='file' class='form-control' placeholder='Choisissez votre photo' value='$valphot'>
					</div>
					<button id='photo_button' class='btn btn-primary' type='submit' style='float:right; margin:5px'>Confirmer</button>
				</div>
			</form>
		";
	}
}

?>