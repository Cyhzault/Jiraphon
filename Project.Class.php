<?php
/**
* @author Niark
**/
class Project
{
	//attributs
	private $idProjet;
	private $nomProjet;
	private $deadline;
	private $dateDebut;
	private $descriptif;
	private $commanditaire;


	function __construct($data)
	{
		$this->hydrate($data);
	}

	public function getIdProjet(){return $this->idProjet;}
	public function getNomProjet(){return $this->nomProjet;}
	public function getDeadline(){return $this->deadline;}
	public function getDateDebut(){return $this->dateDebut;}
	public function getDescriptif(){return $this->descriptif;}
	public function getCommanditaire(){return $this->commanditaire;}

	private function setIdProjet($idProjet){$this->idProjet=$idProjet;}
	private function setNomProjet($nomProjet){return $this->nomProjet=$nomProjet;}
	private function setDeadline($deadline){$this->deadline=$deadline;}
	private function setDateDebut($dateDebut){$this->dateDebut=$dateDebut;}
	public function setDescriptif($descriptif){$this->descriptif=$descriptif;}
	private function setCommanditaire($commanditaire){$this->commanditaire=$commanditaire;}


	public function dataToArray()
	{
		$data = array('idProjet' => $this->idProjet, 'nomProjet' => $this->nomProjet, 'deadline' => $this->deadline, 'dateDebut' => $this->dateDebut, 
			'descriptif'=>$this->descriptif, 'commanditaire'=>$this->commanditaire);
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