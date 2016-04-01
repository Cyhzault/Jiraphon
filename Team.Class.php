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

	public getIdEquipe(){return $this->idEquipe;}
	public getNomEquipe(){return $this->nomEquipe;}
	public getdescription(){return $this->description;}
	public getSpecialite(){return $this->specialite;}
	public getUtilisateurs(){return $this->utilisateurs;}

	private setIdEquipe($idEquipe){$this->idEquipe=$idEquipe;}
	private setNomEquipe($nomEquipe){$this->nomEquipe=$nomEquipe;}
	private setDescription($description){$this->description=$description;}
	private setSpecialite($specialite){$this->specialite=$specialite;}
	private setUtilisateurs($utilisateurs){$this->utilisateurs=$utilisateurs;}


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