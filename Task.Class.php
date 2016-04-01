<?php

/**
* @author Auroxy
*/
class Task 
{
	private $idtache;
	private $idprojet;
	private $statut;
	private $idcreateur;
	private $desciption;
	private $dureeestimee;
	private $dureereele;

	function __construct($data)
	{
		$this->hydrate($data);
	}
function getIdTache(){return $this->$idtache}
function getIdProjet(){return $this->$idprojet}
function getStatut(){return $this->$statut}
function getIdCreateur(){return $this->$idcreateur}
function getDescription(){return $this->$desciption}
function getDureeEstimee(){return $this->$dureeestimee}
function getDureeReele(){return $this->dureereele}

function setIdTache($tache){$this->$idtache=$tache}
function setIdTache($projet){$this->$idprojet=$projet}
function setIdTache($statut){$this->$statut=$statut}
function setIdTache($createur){$this->$idcreateur=$createur}
function setDescription($desc){$this->$desciption=$desc}
function setDureeEstimee($due){$this->$dureeestimee=$due}
function setDescription($dur){$this->$dureereele=$dur}

public function dataToArray()
	{

		$data = array('idtache' => $this->idtache, 'idprojet' => $this->idprojet, 'statut' => $this->statut, 'idcreateur' => $this->idcreateur, 
			'desciption' => $this->$desciption, 'dureeestimee' => $this->$dureeestimee, 'dureereele' => $this->$dureereele);
		
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