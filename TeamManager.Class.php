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
}