<?php

/**
* @author Auroxy
*/
require_once("./View.php");
require_once("./Model.php");
require_once("./ProjectManager.Class.php");
class ViewCreation extends View
{
	
	function __construct()
	{
		
	}

	function showProjectFormulary()//
	{
		echo"<form action='CreationProject.php' method='POST'>
				<div class='form-group'>
					<label>Nom: </label><input type='text' name='nom_projet' class='form-control' placeholder='Entrez le nom du projet'>
					<label>date début: </label><input type='date' name='date_deb' class='form-control' placeholder='debut du projet'>
					<label>date fin: </label><input type='date' name='date_fin' class='form-control' placeholder='fin du projet'>
					<label>description: </label><input type='text' name='description' class='form-control' placeholder='votre description ici'>
				</div>
				<button class='btn btn-primary' type='submit'>Création</button>
			</form>
		";
	}
	function showTaskFormulary()
	{
		$model = new Model();
		$pm= new ProjectManager($model->getDb());
		$projects= $pm->getallProjectsName(); 
		$str="<form action='CreationTask.php' method='POST'>
				<div class='form-group'>
					<label>nom:</label><input type='text' name='nom' class='form-control' placeholder='inscrire nom ici'>
					<label>type: </label> 
					<br>
					<SELECT name='type' size= '1'>
					<OPTION>DEV
					<OPTION>BUG
					</SELECT>
					<br>
					<label>description: </label><input type='text' name='description' class='form-control' placeholder='votre description ici'>
					<label>durée estimée: </label><input type='date_diff()' name='duree_est' class='form-control' placeholder='durée éstimée'>	
					<label>projet: </label>
					<br>
					<SELECT name='projet' size= '1'>";
		foreach ($projects as $value) 
		{
			$str.="<OPTION>".$value['nom_projet'];
		}
		$str.=	"</SELECT>
				</div>
				<button class='btn btn-primary' type='submit'>Création</button>
			</form>
		";
		echo $str;
	}

	public function displaySuccessMessage($string)
	{
		echo "<div class='alert alert-success'>".$string."</div>";
	}

	public function displayErrorMessage($string)
	{
		echo "<div class='alert alert-danger'>".$string."</div>";
	}
};


?>