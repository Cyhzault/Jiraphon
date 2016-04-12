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
        $sql = "SELECT * FROM utilisateur WHERE utilisateur.nom=:pseudo";
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


}