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
        //$sql = "SELECT tache.id_tache,tache.nom,tache.desc,tache.date_deb,tache.date_fin FROM tache JOIN tache_in_sprint ON tache.id_tache = tache_in_sprint.id_tache JOIN sprint ON tache_in_sprint.id_sprint = sprint.id_sprint WHERE tache.id_utilisateur=:userId AND tache.etat='TODO' AND sprint.id_projet=:projectId AND tache.validation=TRUE ";
        $sql = "SELECT * FROM tache WHERE tache.id_utilisateur=:userId AND tache.id_projet=:projectId AND tache.etat='TODO'";
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
       // $sql = "SELECT tache.id_tache,tache.nom,tache.desc,tache.date_deb,tache.date_fin FROM tache JOIN tache_in_sprint ON tache.id_tache = tache_in_sprint.id_tache JOIN sprint ON tache_in_sprint.id_sprint = sprint.id_sprint WHERE tache.id_utilisateur=:userId AND tache.etat='INPG' AND sprint.id_projet=:projectId AND tache.validation=TRUE ";
        $sql = "SELECT * FROM tache WHERE tache.id_utilisateur=:userId AND tache.id_projet=:projectId AND tache.etat='INPG'";
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
        //$sql = "SELECT tache.id_tache,tache.nom,tache.desc,tache.date_deb,tache.date_fin FROM tache JOIN tache_in_sprint ON tache.id_tache = tache_in_sprint.id_tache JOIN sprint ON tache_in_sprint.id_sprint = sprint.id_sprint WHERE tache.id_utilisateur=:userId AND tache.etat='DONE' AND sprint.id_projet=:projectId AND tache.validation=TRUE ";
        $sql = "SELECT * FROM tache WHERE tache.id_utilisateur=:userId AND tache.id_projet=:projectId AND tache.etat='DONE'";
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
        $sql ="INSERT INTO tache (duree_est,description,id_projet,nom,etat, validation, id_createur)VALUES (:duree, :descr, :idproj, :nom, :etat, FALSE ,:idcrea)";
        $req = $this->db->prepare($sql);
        $req->bindParam(':descr', $data['desc'], PDO::PARAM_STR);
        $req->bindParam(':duree', $data['duree_est'], PDO::PARAM_STR);
        $req->bindParam(':idproj', $data['id_projet'], PDO::PARAM_INT);
        $req->bindParam(':nom', $data['nom'], PDO::PARAM_STR);
        $req->bindParam(':etat', $data['etat'], PDO::PARAM_STR);
        $req->bindParam(':idcrea', $data['id_createur'], PDO::PARAM_INT);
        $req->execute();

    }
 public function updateTaskWithId($taskId, $dateDeb, $dateFin, $newS)
    {
        if($dateDeb != "same")
            $sql = "UPDATE tache SET etat=:newS,date_deb=:dateDeb, date_fin=:dateFin WHERE tache.id_tache=:taskId";
        else
            $sql = "UPDATE tache SET etat=:newS,date_fin=:dateFin WHERE tache.id_tache=:taskId";

        $req = $this->db->prepare($sql);
        $req->bindParam(":newS", $newS, PDO::PARAM_STR);
        if($dateDeb != "same")
            $req->bindParam(":dateDeb", $dateDeb, PDO::PARAM_STR);
        $req->bindParam(":dateFin", $dateFin, PDO::PARAM_STR);
        $req->bindParam(":taskId", $taskId, PDO::PARAM_INT);
        $req->execute();

    }

    public function getTaskToManage($projectId)
    {
        $projectId= (string) $projectId;
        $list = array();
        //$sql = "SELECT * FROM tache JOIN tache_in_sprint ON tache.id_tache = tache_in_sprint.id_tache JOIN sprint ON tache_in_sprint.id_sprint = sprint.id_sprint WHERE tache.validation=FALSE AND sprint.id_projet=:projectId";
        $sql = "SELECT * FROM tache WHERE tache.id_projet =:projectId AND tache.validation = FALSE";
        $req = $this->db->prepare($sql);
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

    public function assignUserToTask($taskId, $idUser)
    {
        $taskId = (int) $taskId;
        $idUser = (int) $idUser;
        $sql = "UPDATE tache SET id_utilisateur=:idUser, validation=TRUE WHERE tache.id_tache=:taskId";

        $req = $this->db->prepare($sql);
        $req->bindParam(":idUser", $idUser, PDO::PARAM_INT);
        $req->bindParam(":taskId", $taskId, PDO::PARAM_INT);
        if($req->execute())
            echo "success";
        else
            var_dump($req->errorInfo());

    }


}