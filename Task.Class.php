<?php

/**
* @author Auroxy
*@author Niark
*/
class Task 
{
	private $idTache;
	private $nom;
	private $desciption;
	private $statut;
	private $dateDebut;
	private $dateFin;
	private $dureeEstimee;
	private $validation	
	private $idCreateur;
	private $idUtilisateur
	private $dureeReele;

	function __construct($data)
	{
		$this->hydrate($data);
	}
function getIdTache(){return $this->idTache}
function getNom(){return $this->nom}
function getDescription(){return $this->desciption}
function getStatut(){return $this->statut}
function getDateDebut(){return $this->dateDebut}
function getDateFin(){return $this->dateFin}
function getDureeEstimee(){return $this->dureeEstimee}
function getValidation(){return $this->validation}
function getIdCreateur(){return $this->idCreateur}
function getIdUtilisateur(){return $this->idUtilisateur}
function getDureeReele(){return $this->dureeReele}

function setId_tache($tache){$this->idTache=$tache}
function setNom($nom){$this->nom=$nom}
function setDesc($desc){$this->desciption=$desc}
function setEtat($statut){$this->statut=$statut}
function setDate_deb($dateDeb){$this->dateDebut=$dateDeb}
function setDate_fin($dateFin){$this->dateFin=$dateFin}
function setDureeEstimee($dateDeb, $dateFin){$this->dureeEstimee=$dateDeb-$dateFin}
function setId_createur($createur){$this->idcreateur=$createur}
function setId_utilisateur($utilisateur){$this->idUtilisateur=$utilisateur}
function setDureeReele($dur){$this->dureeReele=$dur}

public function dataToArray()
	{

		$data = array('id_tache' => $this->idtache, 'nom' => $this->nom, 'desc'=>$this->desciption, 'etat'=>$this->statut, 'date_deb'=>$this->dateDebut, 'date_fin'=>$this->dateFin, 
			'validation'=>$this->validation, 'Id_createur'=>$this->idCreateur, 'Id_utilisateur'=>$this->idUtilisateur);
		
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