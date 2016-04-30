<?php
//T0D0
/**
 * Author: Cyhzault
 */
require_once ('./Model.php');
require_once ('./Project.Class.php');
require_once ('./User.Class.php');
require_once ('./Team.Class.php');
class ModelProject extends Model
{

    /**
     * @param $projectId
     * @return Objet projet
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
            $projet = new Project($data);
        }
        $req->closeCursor();
        return $projet;
    }

    /**
     * @param Id de l'utilisateur
     * @return Objet utilisateur
     *
     */
    public function getUtilisateurById($utilisateurId)
    {
        $sql = "SELECT * FROM utilisateur WHERE utilisateur.id_utilisateur=:utilisateurId";
        $req = $this->db->prepare($sql);
        $req->bindParam(':utilisateurId', $utilisateurId, PDO::PARAM_STR);
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $user = new User($data);
        }
        $req->closeCursor();
        return $user;
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

        //Si l'utilisateur n'appartient pas à une équipe
        $sql = "SELECT projet.id_projet,projet.nom_projet, projet.date_deb, projet.date_fin, projet.description, projet.commanditaire FROM projet NATURAL JOIN utilisateur_in_projet NATURAL JOIN utilisateur WHERE utilisateur.nom = :pseudo";
        $req = $this->db->prepare($sql);
        $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $req->execute();
        $i = 0;

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $liste[$i]= new Project($data);
            $i = $i +1;
        }

        //Si l'utilisateur appartient à une équipe
        $sql = "SELECT projet.id_projet,projet.nom_projet, projet.date_deb, projet.date_fin, projet.description, projet.commanditaire FROM projet NATURAL JOIN equipe_in_projet NATURAL JOIN membre_equipe NATURAL JOIN utilisateur WHERE utilisateur.nom = :pseudo";
        $req = $this->db->prepare($sql);
        $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $req->execute();

         while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $liste[$i]= new Project($data);
             $i = $i +1;
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
        $data = array();
        $liste = array();

        $sql = "SELECT * FROM equipe NATURAL JOIN equipe_in_projet NATURAL JOIN projet WHERE id_projet =:projectId";
        $req = $this->db->prepare($sql);
        $req->bindParam(':projectId', $projectId, PDO::PARAM_INT);
        $req->execute();
        $i = 0;

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
              
            $sql_membre = "SELECT * FROM utilisateur NATURAL JOIN membre_equipe NATURAL JOIN equipe WHERE id_equipe=:equipeId";
            $req_membre = $this->db->prepare($sql_membre);
            $req_membre->bindParam(':equipeId', $data['id_equipe'], PDO::PARAM_INT);
            $req_membre->execute();
            $j=0;

            while($data_membre = $req_membre->fetch(PDO::FETCH_ASSOC))
            {
                $utilisateur[$j]=new User($data_membre);
                $j=$j+1;

            }

            $liste[$i]= new Team($data,$utilisateur);
            $i = $i+1;
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