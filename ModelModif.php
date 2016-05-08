<?php

/**
* 
*/
require_once("./Model.php");
class ModelModif extends Model
{
	function verifmdp($pseudo, $mdp)
	{

		$pseudo = htmlspecialchars($pseudo);
		$mdp = htmlspecialchars($mdp);

		$sql="SELECT mdp FROM utilisateur WHERE login=:pseudo";
		$req=$this->$db->prepare($sql);
		$req->bindParam(':pseudo', $pseudo);
		$req->execute();

		if($data = $req->fetch(PDO::FETCH_ASSOC))
		{
			if(password_verify($pswd,Trim($data['mdp'])))
			{
				$_SESSION['id']= md5(rand());
				$_SESSION['pseudo']=$_POST['pseudo'];
				return true;		
			}

			else
				return false;	
		}
		else
		{
			return false;
		}
	}

	function changemdp($pseudo, $newMdp, $mdp)
	{
		$pseudo = htmlspecialchars($pseudo);
		$mdp = htmlspecialchars($newMdp);

		$sql="UPDATE utilisateur SET mdp=:newMdp FROM utilisateur WHERE login=:pseudo AND mdp=:mdp ";
		$req=$this->$db->prepare($sql);
		$req->bindParam(':newMdp',$newMdp,':pseudo', $pseudo, ':mdp', $mdp);
		$req->execute();

		if($data = $req->fetch(PDO::FETCH_ASSOC))
		{
			if(password_verify($pswd,Trim($data['mdp'])))
			{
				$_SESSION['id']= md5(rand());
				$_SESSION['pseudo']=$_POST['pseudo'];
				return true;		
			}

			else
				return false;	
		}
		else
		{
			return false;
		}
	}
}

?>