<?php

/**
* 
*/
require_once("./Model.php");
class ModelLogin extends Model
{
	
	function __construct()
	{
		
	}

	function connexion($pseudo,$pswd)
	{
		$pseudo = htmlspecialchars($pseudo);
		$pswd = htmlspecialchars($pswd);

		if($pswd=='truc')
		{
			$_SESSION['id']= md5(rand());
			$_SESSION['pseudo']=$_POST['pseudo'];
			return true;
		}
		else
		{
			return false;
		}
	}
}



?>