<?php

/**
 * User: Cyhzault
 * Date: 03/05/2016
 * Time: 11:55
 */
class TeamManager
{

    private $db;

    function __construct($db)
    {
        require_once("./Team.Class.php");
        $this->setDb($db);
    }

    public function setDb($db){$this->db = $db;}
    public function getDb(){return $this->db;}


    ///////////////////////////// Requests \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


    public function getUsersFromTeamId($idTeam)
    {
        require_once('./User.Class.php');
        $list = array();
        $i = 0;
        $sql = "SELECT utilisateur.id_utilisateur, utilisateur.nom, utilisateur.prenom,utilisateur.fonction FROM utilisateur JOIN membre_equipe ON utilisateur.id_utilisateur = membre_equipe.id_utilisateur WHERE membre_equipe.id_equipe=:idTeam";
        $req = $this->db->prepare($sql);
        $req->bindParam(':idTeam',$idTeam,PDO::PARAM_INT);
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $donnees = new User($data);
            $list[$i] = $donnees;
            $i++;
        }
        $req->closeCursor();
        return $list;


    }

    //TODO Handle exception if request return null
    public function getTeamIdFromUserId($idUser)
    {
        $sql = "SELECT id_equipe FROM membre_equipe WHERE id_utilisateur=:idUser";
        $req = $this->db->prepare($sql);
        $req->bindParam(":idUser",$idUser,PDO::PARAM_INT);
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
           $result = $data['id_equipe'];
        }
        $req->closeCursor();
        return $result;

    }

    public function getAllTeamInProject($projectId)
    {
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

    /**
     * @param $projectId du projet, $id_chef du chef de projet
     * @return Un array d'utilisateur qui n'appartiennent pas à une équipe
     * @see Project
     *
     */
    public function getUsersSoloInProject($projectId,$id_chef)
    {
        $i=0;
        $liste = array();

        $sql = "SELECT u.id_utilisateur,u.nom,u.prenom,u.fonction,u.statut,u.photo,u.login,u.mdp FROM utilisateur u NATURAL JOIN utilisateur_in_projet WHERE id_projet =:projectId AND id_utilisateur <> :id_chef
                EXCEPT 
                SELECT u.id_utilisateur,u.nom,u.prenom,u.fonction,u.statut,u.photo,u.login,u.mdp FROM utilisateur u NATURAL JOIN membre_equipe NATURAL JOIN equipe NATURAL JOIN equipe_in_projet WHERE id_projet =:projectId";
        $req = $this->db->prepare($sql);
        $req->bindParam(':projectId', $projectId, PDO::PARAM_INT);
        $req->bindParam(':id_chef', $id_chef, PDO::PARAM_INT);
        $req->execute();

        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $liste[$i]= new User($data);
            $i = $i +1;
        }

        return $liste;

    }
}