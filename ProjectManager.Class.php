<?php

/**
 * @author Auroxy
 */
class ProjectManager
{
    private $db;

    public function __construct($db)
    {
        require_once("./Project.Class.php");
        $this->setDb($db);
    }

    public function setDb($db){$this->db = $db;}
    public function getDb(){return $this->db;}

    ///////////////////////////// Requests \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    public function addProject($data)
    {
    	$sql ="INSERT INTO projet (nom_projet, date_deb, date_fin, description,id_chef )VALUES (:nom, :date_deb, :date_fin, :descr,:idChef)";
        $req = $this->db->prepare($sql);
        $req->bindParam(':nom', $data['nom_projet'] , PDO::PARAM_STR);
        $req->bindParam(':date_deb', $data['date_deb'], PDO::PARAM_STR);
        $req->bindParam(':date_fin', $data['date_fin'], PDO::PARAM_STR);
        $req->bindParam(':descr', $data['description'], PDO::PARAM_STR);
        $req->bindParam(':idChef',$data['id_chef'],PDO::PARAM_INT);
        $req->execute();
    }

    public function addUserInProject($userId,$projectid)
    {
        $sql ="INSERT INTO utilisateur_in_projet (id_utilisateur, id_projet) VALUES (:userId,:projectId) ";
        $req = $this->db->prepare($sql);
        $req->bindParam(':userId', $userId , PDO::PARAM_INT);
        $req->bindParam(':projectId', $projectid, PDO::PARAM_INT);
        $req->execute();
    }

    public function getCurrentSprintByProjectId($projectId)
    {
        require_once ("./Sprint.Class.php");

        $sql = "SELECT * FROM sprint WHERE (date_deb,date_fin) OVERLAPS (current_date,current_date) AND sprint.id_projet =:projectId";
        $req = $this->db->prepare($sql);
        $req->bindParam(":projectId",$projectId,PDO::PARAM_INT);
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $donnees = $data;
        }
        return new Sprint($donnees);
    }

    public function getProjectByName($name)
    {
        $name = (string) $name;
        $sql = "SELECT * FROM projet WHERE projet.nom_projet=:nom";
        $req = $this->db->prepare($sql);
        $req->bindParam(':nom', $name, PDO::PARAM_STR);
        $req->execute();
        //Bon c'est crade mais osef
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $donnees = $data;
        }
        $req->closeCursor();
        return new Project($donnees);
    }

    public function getallProjectsName()// retourne un tableau de projet
    {
        $Liste=array();
        $sql="SELECT nom_projet FROM projet;";
        $req = $this->db->prepare($sql);
        $req->execute();
        $i=0;
        while($data=$req->fetch(PDO::FETCH_ASSOC))
        {
            $Liste[$i]=$data;
            $i = $i +1;
        }
        return $Liste;
    }
    
}
?>