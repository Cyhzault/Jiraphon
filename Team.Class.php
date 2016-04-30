<?php


/**
* @author Niark 
*/
class Team
{
	//attributs
	private $id_equipe;
	private $nom_equipe;
	private $specialite;
	private $utilisateurs;

	function __construct($data,$liste_u)
	{
		$this->hydrate($data,$liste_u);
	}

	public function getId_equipe(){return $this->id_equipe;}
	public function getNom_equipe(){return $this->nom_equipe;}
	public function getDescription(){return $this->description;}
	public function getSpecialite(){return $this->specialite;}
	public function getUtilisateurs(){return $this->utilisateurs;}

	private function setId_equipe($id_equipe){$this->id_equipe=$id_equipe;}
	private function setNom_equipe($nom_equipe){$this->nom_equipe=$nom_equipe;}
	private function setDescription($description){$this->description=$description;}
	private function setSpecialite($specialite){$this->specialite=$specialite;}
	private function setUtilisateurs($utilisateurs){$this->utilisateurs=$utilisateurs;}


//a modif
	public function dataToArray()
	{
		$data = array('id_equipe' => $this->idEquipe, 'nom_equipe' => $this->nomEquipe,'description' => $this->description, 'specialite' => $this->specialite, 
			'utilisateurs'=>$this->utilisateurs);
		return $data;
	}

	public function hydrate(array $donnees, array $utilisateurs)
	{
		// différents cas particuliers à traiter. Ici aucun.
		foreach ($donnees as $key => $value)
		{
			
			$method = 'set'.ucfirst($key);
						
			if (method_exists($this, $method))
			{
				$this->$method($value);
			}
		
		}

		$this->setUtilisateurs($utilisateurs);

	}
}

?>