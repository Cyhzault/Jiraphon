<?php
/**
* @author Niark Modifié par cyhzault.
 * Le bureau des plaintes est fermé.
**/
class Project
{
	//attributs
	private $id_projet;
	private $nom_projet;
	private $date_fin;
	private $date_deb;
	private $description;
	private $commanditaire;


	function __construct($data)
	{
		$this->hydrate($data);
	}

	public function getId_projet(){return $this->id_projet;}
	public function getNom_projet(){return $this->nom_projet;}
	public function getDate_fin(){return $this->date_fin;}
	public function getDate_deb(){return $this->date_deb;}
	public function getDescription(){return $this->description;}
	public function getCommanditaire(){return $this->commanditaire;}

	private function setId_projet($id_projet){$this->id_projet=$id_projet;}
	private function setNom_projet($nom_projet){$this->nom_projet=$nom_projet;}
	private function setDate_fin($date_fin){$this->date_fin=$date_fin;}
	private function setDate_deb($date_deb){$this->date_deb=$date_deb;}
	public function setDescription($description){$this->description=$description;}
	private function setCommanditaire($commanditaire){$this->commanditaire=$commanditaire;}


	public function dataToArray()
	{
		$data = array('id_projet' => $this->id_projet, 'nom_projet' => $this->nomProjet, 'date_fin' => $this->date_fin, 'date_deb' => $this->date_deb,
			'description'=>$this->description, 'commanditaire'=>$this->commanditaire);
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