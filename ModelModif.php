<?php

/**
* 
*/
require_once("./Model.php");
class ModelModif extends Model
{
	function verifOldMdp($pseudo, $mdp)
	{

		$pseudo = htmlspecialchars($pseudo);
		$mdp = htmlspecialchars($mdp);

		$sql="SELECT mdp FROM utilisateur WHERE login=:pseudo";
		$req=$this->db->prepare($sql);
		$req->bindParam(':pseudo', $pseudo);
		$req->execute();

		if($data = $req->fetch(PDO::FETCH_ASSOC))
		{
			if(password_verify(Trim($mdp),Trim($data['mdp'])))
			{
				return true;		
			}
		}
			return false;
	}

	function changeMdp($pseudo, $newMdp, $mdp)
	{
		$mdp = htmlspecialchars($mdp);
		$newMdp = htmlspecialchars($newMdp);
		//Vérification que les deux pswd entrés sont identiques
		if(strcmp($mdp,$newMdp)==0)
		{
			$sql="UPDATE utilisateur SET mdp=:newMdp FROM utilisateur WHERE login=:pseudo AND mdp=:mdp ";
			$req=$this->$db->prepare($sql);
			$req->bindParam(':newMdp',$newMdp,':pseudo', $pseudo, ':mdp', $mdp);
			$req->execute();

	//si on a bien récup l'utilisateur
			if($data = $req->fetch(PDO::FETCH_ASSOC))
			{
				if(password_verify($pswd,Trim($data['mdp'])))
				{
					return true;		
				}	
			}	
		}
		return false;
	}


//TODO
	function changePhoto($pseudo, $photo)
	{
		$pseudo = htmlspecialchars($pseudo);
	}
}

?>