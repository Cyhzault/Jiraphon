<?php
/*
*@author Niark
*/

class Projet
{
	//attributs
	private $idProjet;
	private $nomProjet;
	private $deadline;
	private $dateDebut;
	private $descriptif:
	private $commanditaire;


	function __construct($data)
	{
		$this->hydrate($data)
	}

	public getIdProjet(){return $this->idProjet;}
	public getNomProjet(){return $this->nomProjet;}
	public getDeadline(){return $this->deadline;}
	public getDateDebut(){return $this->dateDebut;}
	public getDescriptif(){return $this->descriptif;}
	public getCommanditaire(){return $this->commanditaire;}

	private setIdProjet($idProjet){$this->idProjet=$idProjet;}
	private setNomProjet($nomProjet){return $this->nomProjet=$nomProjet;}
	private setDeadline($deadline){$this->deadline=$deadline;}
	private setDateDebut($dateDebut){$this->dateDebut=$dateDebut;}
	public setDescriptif($descriptif){$this->descriptif=$descriptif;}
	private setCommanditaire($commanditaire){$this->commanditaire=$commanditaire;}


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