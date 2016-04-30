<?php

/**
* 
*/
class Model
{
	protected $db;

	function __construct()
	{
		$this->db = $this->getDb();
	}

	//Renvoie le pdo pour la base de données.
	public function getDb()
	{
		try {

			$bdd = new PDO('pgsql:host=localhost;dbname=Jiraphon','postgres','2j\'apgsql2'); //remplacer MOT_DE_PASSE par votre mdp db.
			return $bdd;

		} catch (PDOException $e) {
			die("Connexion à la base de donnée impossible:".$e->getMessage());

		}
	}
	public function disconnect()
	{
		if(isset($_SESSION["id"]))
		{
			session_destroy();
		}
	}

}





?>