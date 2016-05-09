<?php

/**
* @author Auroxy
*@author Niark
*/
class Task 
{
	private $idTache;
	private $nom;
	private $description;
	private $statut;
	private $dateDebut;
	private $dateFin;
	private $dureeEstimee;
	private $validation;
	private $idCreateur;
	private $idUtilisateur;
	private $dureeReele;
	private $idProjet;

	function __construct($data)
	{
		$this->hydrate($data);
	}
function getIdTache(){return $this->idTache;}
function getNom(){return $this->nom;}
function getDescription(){return $this->description;}
function getStatut(){return $this->statut;}
function getDateDebut(){return $this->dateDebut;}
function getDateFin(){return $this->dateFin;}
function getDureeEstimee(){return $this->dureeEstimee;}
function getValidation(){return $this->validation;}
function getIdCreateur(){return $this->idCreateur;}
function getIdUtilisateur(){return $this->idUtilisateur;}
function getDureeReele(){return $this->dureeReele;}
function getIdProjet(){return $this->idProjet;}

function setId_tache($tache){$this->idTache=$tache;}
function setNom($nom){$this->nom=$nom;}
function setDescription($desc){$this->description=$desc;}
function setEtat($statut){$this->statut=$statut;}
function setDate_deb($dateDeb){$this->dateDebut=$dateDeb;}
function setDate_fin($dateFin){$this->dateFin=$dateFin;}
function setDureeEstimee($dateDeb, $dateFin){$this->dureeEstimee=$dateDeb-$dateFin;}
function setId_createur($createur){$this->idCreateur=$createur;}
function setId_utilisateur($utilisateur){$this->idUtilisateur=$utilisateur;}
function setDureeReele($dur){$this->dureeReele=$dur;}
function setId_projet($projet){$this->idProjet=$projet;}

public function dataToArray()
	{

		$data = array('id_tache' => $this->idTache, 'nom' => $this->nom, 'desc'=>$this->description, 'etat'=>$this->statut, 'date_deb'=>$this->dateDebut, 'date_fin'=>$this->dateFin,
			'validation'=>$this->validation, 'id_createur'=>$this->idCreateur, 'id_utilisateur'=>$this->idUtilisateur, 'id_projet'=>$this->idProjet);
		
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