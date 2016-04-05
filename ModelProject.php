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
        return null;
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
        $data = array();
        $liste = array();

        $sql = "SELECT * FROM projet JOIN utilisateur_in_projet ON projet.id_projet = utilisateur_in_projet.id_projet JOIN utilisateur ON utilisateur_in_projet.id_utilisateur = utilisateur.id_utilisateur WHERE nom = :pseudo";
        $req = $this->db->prepare($sql);
        $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $req->execute();
        $i = 0;
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $i = $i +1;
            var_dump($data);
            $liste[$i]= new Project($data);
        }
        $req->closeCursor();
        return $liste;
    }


}



?>