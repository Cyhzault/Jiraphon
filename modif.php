<?php

/**
*@author Niark
**/

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
	$view->beginContainer();


//pour changer mdp
	if(isset($_GET['m']))
	{
		$valmdp=array("","","","");

		//si on a deja envoyer les infos pour changer mdp
		if (isset($_POST['pswd']))
		{
			//ancien mdp mauvais->vas pas plus loin
			if(!($model->verifOldMdp($_SESSION['pseudo'],$_POST['pswd'])))
			{
				$view->ShowErrorMdp();	
			}

			//ancien mdp correcte
			else
			{
				//verif que les deux entrée de new mpd sont idem (faux puis vrai) et le change le cas échéant
				if(!$model->changeMdp($_SESSION['pseudo'], $_POST['pswd_i'], $_POST['pswd_verif']))
				{
					$view->ShowModifFailed();
				}
				else
				{
					$view->ShowModifSuccess();
				}
			}
		}
		$view->ShowChangePassword($valmdp);
	}

//pour changer photo
	else if(isset($_GET['p'])){
		//demande changement éffectuée
		if (isset($_FILES['photo']))
		{
			//cas mauvais format
			if(!$model->verif_image($_FILES['photo'])){}
			else
			{
				if(!$model->changePhoto($_SESSION['pseudo'], $_FILES['photo']))
				{
					$view->ShowModifFailed();
				}
				else
				{
					$view->ShowModifSuccess();
				}
			}
		}
		$view->ShowChangePicture();
		
	}
	$view->endDiv();
}

$controler->endPage($view);
	
?>