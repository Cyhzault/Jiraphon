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

    	$sql ="INSERT INTO projet (nom_projet, date_deb, date_fin, description )VALUES (:nom, :date_deb, :date_fin, :descr)";
        $req = $this->db->prepare($sql);
        $req->bindParam(':nom', $data['nom_projet'] , PDO::PARAM_STR);
        $req->bindParam(':date_deb', $data['date_deb'], PDO::PARAM_STR);
        $req->bindParam(':date_fin', $data['date_fin'], PDO::PARAM_STR);
        $req->bindParam(':descr', $data['description'], PDO::PARAM_STR);
        $req->execute();
    }
}
?>