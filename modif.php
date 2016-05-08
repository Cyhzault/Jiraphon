<?php

/**
*@author Niark
*/

	require_once("./Controler.php");
	require_once("./ViewModif.php");
	require_once("./ModelModif.php");

	$controler=new Controler();
	$view= new ViewModif();
	$model= new ModelModif();
 
 	$title="Modifications";


	$controler->beginPage("Modifications","Vos Modifications");


//page accessible uniquement si déjà connecté
	if (!isset($_SESSION['pseudo'])){
	$str="<meta http-equiv='refresh' content='0;URL=login.php' />";
	echo $str;
}
else
{
	require_once("./UserManager.Class.php");
	$um= new UserManager($model->getDb());
	$user= $um->getUserByPseudo($_SESSION['pseudo']);
	
	if(isset($_GET['m']))
	{
		if (isset($_POST['pswd'])){
			
			$view->beginContainer();
			$view->ShowChangePassword($valmdp);
			$view->endDiv();
		}
		else
		{
			$valmdp=array("","","","");
			$view->beginContainer();
			$view->ShowChangePassword($valmdp);
			$view->endDiv();
		}
	}

	else if(isset($_GET['p'])){
		$phot;
		$view->beginContainer();
		$view->ShowChangePicture($phot);
		$view->endDiv();
	}

}

$controler->endPage($view);
	
?>