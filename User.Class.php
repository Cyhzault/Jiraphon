<?php


/**
* @author Niark
*/
class User
{
	//attributs
	private $id_utilisateur;
	private $login;
	private $mdp;
	private $statut;
	private $nom;
	private $prenom;
	private $photo;
	private $fonction;

	function __construct($data)
	{
		$this->hydrate($data);
	}

	public function getId_utilisateur(){return $this->id_utilisateur;}
	public function getLogin(){return $this->login;}
	public function getMdp(){return $this->mdp;}
	public function getFonction(){return $this->fonction;}
	public function getStatut(){return $this->statut;}
	public function getNom(){return $this->nom;}
	public function getPrenom(){return $this->prenom;}
	public function getPhoto(){return $this->photo;}


	private function setId_utilisateur($id_utilisateur){$this->id_utilisateur=$id_utilisateur;}
	private function setLogin($login){$this->login=$login;}
	private function setMdp($mdp){$this->mdp=$mdp;}
	private function setFonction($fonction){$this->fonction=$fonction;}
	private function setStatut($statut){$this->statut=$statut;}
	private function setNom($nom){$this->nom = $nom;}
	private function setPrenom($prenom){$this->prenom = $prenom;}
	private function setPhoto($photo){$this->photo= $photo;}


	public function dataToArray()
	{

		$data = array('id_utilisateur' => $this->id_utilisateur, 'pseudo' => $this->pseudo, 'mdp' => $this->mdp, 'fonction' => $this->fonction, 'statut' => $this->statut, 'nom' => $this->nom, 'prenom' => $this->prenom, 'photo' => $this->photo);
		
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