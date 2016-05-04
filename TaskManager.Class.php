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


    public function getTaskById($taskId)
    {
        //toutes les taches de l'utilisateur
        $tacheId = (string) $taskId;
        $sql = "SELECT * FROM tache WHERE tache.id_tache=:taskId";
        $req = $this->db->prepare($sql);
        $req->bindParam(':taskId', $taskId, PDO::PARAM_INT);
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $donnees = $data;
        }
        $req->closeCursor();
        return new Task($donnees);
    }

//Dans un projet donné

    /**
     * @param $userId
     * @param $projectId
     * @return mixed
     */
    public function getTasksToDo($userId, $projectId)
    {
        $userId = (string) $userId;
        $projectId=(string) $projectId;
        $list = array();
        $i = 0;
        $sql = "SELECT tache.id_tache,tache.nom,tache.desc,tache.date_deb,tache.date_fin FROM tache JOIN tache_in_sprint ON tache.id_tache = tache_in_sprint.id_tache JOIN sprint ON tache_in_sprint.id_sprint = sprint.id_sprint WHERE tache.id_utilisateur=:userId AND tache.etat='TODO' AND sprint.id_projet=:projectId AND tache.validation=TRUE ";
        $req = $this->db->prepare($sql);
        $req->bindParam(':userId', $userId, PDO::PARAM_STR);
        $req->bindParam(':projectId', $projectId, PDO::PARAM_STR);
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $i++;
            $donnees = new Task($data);
            $list[$i] = $donnees;
        }
        $req->closeCursor();
        return $list;
    }

    public function getTasksInProgress($userId, $projectId)
    {
        $userId = (string) $userId;
        $projectId=(string) $projectId;
        $list = array();
        $i = 0;
        $sql = "SELECT tache.id_tache,tache.nom,tache.desc,tache.date_deb,tache.date_fin FROM tache JOIN tache_in_sprint ON tache.id_tache = tache_in_sprint.id_tache JOIN sprint ON tache_in_sprint.id_sprint = sprint.id_sprint WHERE tache.id_utilisateur=:userId AND tache.etat='INPG' AND sprint.id_projet=:projectId AND tache.validation=TRUE ";
        $req = $this->db->prepare($sql);
        $req->bindParam(':userId', $userId, PDO::PARAM_INT);
        $req->bindParam(':projectId', $projectId, PDO::PARAM_INT);
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $i++;
            $donnees = new Task($data);
            $list[$i] = $donnees;
        }
        $req->closeCursor();
        return $list;
    }


    public function getTasksDone($userId, $projectId)
    {
        $userId = (string) $userId;
        $projectId= (string) $projectId;
        $list = array();
        $sql = "SELECT tache.id_tache,tache.nom,tache.desc,tache.date_deb,tache.date_fin FROM tache JOIN tache_in_sprint ON tache.id_tache = tache_in_sprint.id_tache JOIN sprint ON tache_in_sprint.id_sprint = sprint.id_sprint WHERE tache.id_utilisateur=:userId AND tache.etat='DONE' AND sprint.id_projet=:projectId AND tache.validation=TRUE ";
        $req = $this->db->prepare($sql);
        $req->bindParam(':userId', $userId, PDO::PARAM_INT);
        $req->bindParam(':projectId', $projectId, PDO::PARAM_INT);
        $req->execute();
        $i = 0;
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $i++;
            $donnees = new Task($data);
            $list[$i] = $donnees;
        }
        $req->closeCursor();
        return $list;
    }

    public function addTask($data)
    {
        $sql ="INSERT INTO tache ('duree_est', 'description' )VALUES (:duree, :descr)";
        $req = $this->db->prepare($sql);
        $req->bindParam(':descr', $data['description'], PDO::PARAM_STR);
        $req->bindParam(':duree', $data['duree_est'], PDO::PARAM_STR);
        $req->execute();
    }

}