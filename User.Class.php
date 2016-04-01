<?php


/**
* @author Niark
*/
class User
{
	//attributs
	private $idUtilisateur;
	private $pseudo;
	private $motDePasse;
	private $courriel;

	function __construct($data)
	{
		$this->hydrate($data);
	}

	public function getIdUtilisateur(){return $this->idUtilisateur;}
	public function getNom(){return $this->pseudo;}
	public function getMotDePasse(){return $this->motDePasse;}
	public function getCourriel(){return $this->courriel;}

	private function setIdUtilisateur($idUtilisateur){$this->idUtilisateur=$idUtilisateur;}
	private function setPseudo($pseudo){$this->psuedo=$pseudo;}
	private function setMotDePasse($motDePasse){$this->pseudo=$pseudo;}
	private function setCourriel($courriel){$this->courriel=$courriel;}

	public function dataToArray()
	{

		$data = array('idUtilisateur' => $this->idUtilisateur, 'pseudo' => $this->pseudo, 'motDePasse' => $this->motDePasse, 'courriel'$this->courriel);
		
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