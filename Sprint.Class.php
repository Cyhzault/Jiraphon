<?php

/**
* @author Auroxy
*/
class Sprint
{
	private $idsprint;
	private $tab_taches;
	private $duree;
	private $debut;


	function __construct($data)
	{
		$this->hydrate($data);
	}
function getIdSprint(){return $this->$idsprint}
function getTab_Taches(){return $this->$tab_taches}
function getDuree(){return $this->$duree}
function getDebut(){return $this->$debut}

function setIdSprint($sprint){$this->$idsprint=$sprint}
function setTab_Taches($taches){$this->$idprojet=$taches}
function setDuree($duree){$this->$statut=$duree}
function setDebut($debut){$this->$idcreateur=$debut}


public function dataToArray()
	{

		$data = array('idsprint' => $this->idsprint, 'Taches' => $this->tab_taches, 'duree' => $this->duree, 'debut' => $this->debut);
		
		return $data;
	}
private function hydrate(array $donnees)
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






>