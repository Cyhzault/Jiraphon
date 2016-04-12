<?php

/**
 * @author Niark
 */
class TaskManager
{
    private $db;

    function __construct($db)
    {
        require_once("./Task.Class.php");
        $this->setDb($db);
    }

    public function setDb($db){$this->db = $db;}
    public function getDb(){return $this->db;}

    ///////////////////////////// Requests \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


    public function getUserById($userId)
    {
        //toutes les taches de l'utilisateur
        $userId = (string) $userId;
        $sql = "SELECT * FROM tache WHERE tache.id_utilisateur=:userId";
        $req = $this->db->prepare($sql);
        $req->bindParam(':userId', $userId, PDO::PARAM_STR);
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $donnees = $data;
        }
        $req->closeCursor();
        return new Task($donnees);
    }

//Dans un projet donné

    public function getTasksToDo($userId, $projectId)
    {
        $userId = (string) $userId;
        $projectId=(string) $projectId;
        $sql = "SELECT * FROM tache NATURAL JOIN tache_in_sprint NATURAL JOIN sprint WHERE tache.id_utilisateur=:userId AND tache.etat=:to_do AND sprint.id_projet=:projectId AND tache.validation=TRUE ";
        $req = $this->db->prepare($sql);
        $req->bindParam(':userId', $userId, PDO::PARAM_STR);
        $req->bindParam(':projectId', $projectId, PDO::PARAM_STR);
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $donnees = $data;
        }
        $req->closeCursor();
        return new User($donnees);
    }

    public function getTasksDoing($userId, $projectId)
    {
        $userId = (string) $userId;
        $projectId=(string) $projectId;
        $sql = "SELECT * FROM tache NATURAL JOIN tache_in_sprint NATURAL JOIN sprint WHERE tache.id_utilisateur=:userId AND tache.etat=:doing AND sprint.id_projet=:projectId AND tache.validation=TRUE ";
        $req = $this->db->prepare($sql);
        $req->bindParam(':userId', $userId, PDO::PARAM_STR);
        $req->bindParam(':projectId', $projectId, PDO::PARAM_STR);
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $donnees = $data;
        }
        $req->closeCursor();
        return new User($donnees);
    }


public function getTasksDone($userId, $projectId)
    {
        $userId = (string) $userId;
        $projectId=(string) $projectId;
        $sql = "SELECT * FROM tache NATURAL JOIN tache_in_sprint NATURAL JOIN sprint WHERE tache.id_utilisateur=:userId AND tache.etat=:done AND sprint.id_projet=:projectId AND tache.validation=TRUE ";
        $req = $this->db->prepare($sql);
        $req->bindParam(':userId', $userId, PDO::PARAM_STR);
        $req->bindParam(':projectId', $projectId, PDO::PARAM_STR);
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $donnees = $data;
        }
        $req->closeCursor();
        return new User($donnees);
    }



}