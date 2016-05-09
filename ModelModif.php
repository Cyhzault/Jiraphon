<?php

/**
* 
*/
require_once("./ModelLogin.php");
class ModelModif extends ModelLogin
{
	function verifOldMdp($pseudo, $mdp)
	{

		$pseudo = (string) $pseudo;
		$mdp = (string) $mdp;

		$sql="SELECT mdp FROM utilisateur WHERE login=:pseudo";
		$req=$this->db->prepare($sql);
		$req->bindParam(':pseudo', $pseudo,PDO::PARAM_STR);
		$req->execute();
		while($data = $req->fetch(PDO::FETCH_ASSOC))
		{
			if(password_verify($mdp,Trim($data['mdp'])))
			{
				return true;		
			}
		}
			return false;
	}

	function changeMdp($pseudo, $newMdp, $mdp)
	{
		$mdp = (string) $mdp;
		$newMdp = (string) $newMdp;
		//Vérification que les deux pswd entrés sont identiques
		if(strcmp($mdp,$newMdp)==0)
		{
			$sql="UPDATE utilisateur SET mdp=:newMdp WHERE login=:pseudo";
			$req=$this->db->prepare($sql);
			$req->bindParam(':newMdp',$newMdp,PDO::PARAM_STR);
			$req->bindParam(':pseudo', $pseudo,PDO::PARAM_STR);
			if($req->execute())
				return true;
		}
		return false;
	}



	function changePhoto($pseudo, $photo)
	{
		$pseudo = (string) $pseudo;
		$name = "photo/".$photo['name'];
		move_uploaded_file($photo['tmp_name'],$name);
		$sql="UPDATE utilisateur SET photo=:photo WHERE login=:pseudo";
		$req=$this->db->prepare($sql);
		$req->bindParam(':photo', $name);
		$req->bindParam(':pseudo', $pseudo);
		return ($req->execute());


	}
}

?>