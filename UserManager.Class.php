<?php

/**
 * @author: Cyhzault
 * Date: 11/04/2016
 * Time: 14:33
 */
class UserManager
{
    private $db;

    function __construct($db)
    {
        require_once("./User.Class.php");
        $this->setDb($db);
    }

    public function setDb($db){$this->db = $db;}
    public function getDb(){return $this->db;}

    ///////////////////////////// Requests \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


    public function getUserById($userId)
    {
        $userId = (string) $userId;
        $sql = "SELECT * FROM utilisateur WHERE utilisateur.id_utilisateur=:userId";
        $req = $this->db->prepare($sql);
        $req->bindParam(':userId', $userId, PDO::PARAM_STR);
        $req->execute();
        //Bon c'est crade mais osef
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $donnees = $data;
        }
        $req->closeCursor();
        return new User($donnees);
    }

    public function getUserByPseudo($pseudo)
    {
        $pseudo = (string) $pseudo;
        $sql = "SELECT * FROM utilisateur WHERE utilisateur.login=:pseudo";
        $req = $this->db->prepare($sql);
        $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $req->execute();
        //Bon c'est crade mais osef
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $donnees = $data;
        }
        $req->closeCursor();
        return new User($donnees);
    }

    public function getUserInProject($projectId)
    {
        $projectId = (int) $projectId;
        $sql = "SELECT * FROM utilisateur JOIN utilisateur_in_projet ON utilisateur.id_utilisateur=utilisateur_in_projet.id_utilisateur WHERE utilisateur_in_projet.id_projet=:idProjet";
        $list = array();
        $i = 0;
        $req = $this->db->prepare($sql);
        $req->bindParam(':idProjet', $projectId, PDO::PARAM_INT);
        $req->execute();
        //Bon c'est crade mais osef
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $donnees = new User($data);
            $list[$i]= $donnees;
            $i++;
        }
        $req->closeCursor();
        return $list;
    }
}