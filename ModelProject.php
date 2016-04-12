<?php
//T0D0
/**
 * Author: Cyhzault
 */
require_once ('./Model.php');
require_once ('./Project.Class.php');
class ModelProject extends Model
{

    /**
     * @param $projectId
     * @return un tableau contenant les informations d'un projet
     *
     */
    public function getProjectById($projectId)
    {
        $projectId = (string) $projectId;
        $sql = "SELECT * FROM projet WHERE projet.id_projet=:projectId";
        $req = $this->db->prepare($sql);
        $req->bindParam(':projectId', $projectId, PDO::PARAM_STR);
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $donnees = $data;
        }
        $req->closeCursor();
        return $donnees;
    }

    /**
     * @param $pseudo de l'utilisateur
     * @return Un array de Projet
     * @see Project
     *
     */
    public function getAllProjectsByUsername($pseudo)
    {

        $pseudo = (string) $pseudo;
        $liste = array();
        $sql = "SELECT projet.id_projet,projet.nom_projet, projet.date_deb, projet.date_fin, projet.description, projet.id_chef FROM projet JOIN utilisateur_in_projet ON projet.id_projet = utilisateur_in_projet.id_projet JOIN utilisateur ON utilisateur_in_projet.id_utilisateur = utilisateur.id_utilisateur WHERE utilisateur.nom = :pseudo";
        $req = $this->db->prepare($sql);
        $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $req->execute();
        $i = 0;
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $i = $i +1;
            $liste[$i]= new Project($data);
        }
        $req->closeCursor();
        return $liste;
    }


    /**
     * @param $pseudo de l'utilisateur
     * @return Un array de Projet
     * @see Project
     *
     */
    public function getAllTeamInProject($projectId)
    {

        $projectId = (string) $projectId;
        $data = array();
        $liste = array();

        $sql = "SELECT * FROM equipe JOIN equipe_in_projet ON id_equipe = id_equipe JOIN projet ON id_projet = projet.id_projet WHERE id_projet =:projectId";
        $req = $this->db->prepare($sql);
        $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $req->execute();
        $i = 0;
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $i = $i +1;
            var_dump($data);
            $liste[$i]= new Team($data);
        }
        $req->closeCursor();
        return $liste;
    }

    public function getAllSprintByProjectId($projectId)
    {
        return null;
    }

}



?>