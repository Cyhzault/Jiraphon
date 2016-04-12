<?php


/**
* @author Niark 
*/
class Team
{
	//attributs
	private $idEquipe;
	private $nomEquipe;
	private $description;
	private $specialite;
	private $utilisateurs;

	function __construct($data)
	{
		$this->hydrate($data);
	}

	public function getIdEquipe(){return $this->idEquipe;}
	public function getNomEquipe(){return $this->nomEquipe;}
	public function getdescription(){return $this->description;}
	public function getSpecialite(){return $this->specialite;}
	public function getUtilisateurs(){return $this->utilisateurs;}

	private function setIdEquipe($idEquipe){$this->idEquipe=$idEquipe;}
	private function setNomEquipe($nomEquipe){$this->nomEquipe=$nomEquipe;}
	private function setDescription($description){$this->description=$description;}
	private function setSpecialite($specialite){$this->specialite=$specialite;}
	private function setUtilisateurs($utilisateurs){$this->utilisateurs=$utilisateurs;}


//a modif
	public function dataToArray()
	{
		$data = array('idEquipe' => $this->idEquipe, 'nomEquipe' => $this->nomEquipe,'description' => $this->description, 'specialite' => $this->specialite, 
			'utilisateurs'=>$this->utilisateurs);
		return $data;
	}

	public function hydrate(array $donnees)
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

	}
}

?>