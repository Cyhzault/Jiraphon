<?php

/**
* @author Auroxy
*/
class Sprint
{
	private $id_sprint;
	private $tab_taches;
	private $fin;
	private $debut;
	private $id_projet;

	function __construct($data)
	{
		$this->hydrate($data);
	}
function getId_sprint(){return $this->id_sprint;}
function getId_projet(){return $this->id_projet;}
function getFin(){return $this->fin;}
function getDebut(){return $this->debut;}

function setId_sprint($sprint){$this->id_sprint=$sprint;}
function setFin($fin){$this->fin = $fin;}
function setId_projet($idProjet){$this->id_projet=$idProjet;}
function setDebut($debut){$this->idcreateur=$debut;}


public function dataToArray()
	{

		$data = array('SprintId' => $this->id_sprint, 'date_fin' => $this->fin, 'date_deb' => $this->debut,'ProjectId'=>$this->id_projet);
		
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






?>