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
        
        $sql = "SELECT projet.id_projet,projet.nom_projet, projet.date_deb, projet.date_fin, projet.description, projet.id_chef FROM projet NATURAL JOIN utilisateur_in_projet NATURAL JOIN utilisateur WHERE utilisateur.nom = :pseudo";
        $req = $this->db->prepare($sql);
        $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $req->execute();
        $i = 0;

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

    public function creationEquipe($nom,$spec,$liste_membre)
    {
        $membre_array=array();
        $nom = htmlspecialchars($nom);
        $spec = htmlspecialchars($spec);
        $membre_array=explode(',',$liste_membre);
        $err="";
        var_dump($membre_array);

        if(empty($nom))
        {
            $err="Vous devez entrer un nom d'équipe";
        }
        else
        {
              //Vérification equipe pas déjà présente dans base 
            $sql = "SELECT nom_equipe FROM equipe WHERE nom_equipe=:nom";
            $req = $this->db->prepare($sql);
            $req->bindParam(':nom', $nom, PDO::PARAM_STR);
            $req->execute();

            if($data = $req->fetch(PDO::FETCH_ASSOC))
            {
                $err="Il existe déjà une equipe portant le nom : " . $nom;
            }
            else
            {
                $sql = "INSERT INTO equipe(nom_equipe,specialite) VALUES(:nom,:spec)";
                $req = $this->db->prepare($sql);
                $req->bindParam(':nom', $nom, PDO::PARAM_STR);
                $req->bindParam(':spec', $spec, PDO::PARAM_STR);

                if($req->execute())
                {
                    $sql = "SELECT nom_equipe,id_equipe FROM equipe WHERE nom_equipe=:nom";
                    $req = $this->db->prepare($sql);
                    $req->bindParam(':nom', $nom, PDO::PARAM_STR);
                    $req->execute();

                    if($data_e = $req->fetch(PDO::FETCH_ASSOC))
                    {

                        foreach ($membre_array as $id_membre) {

                            if(!(empty($id_membre)))
                            {
                                echo $id_membre;
                                echo $data_e['id_equipe'];
                                $sql = "INSERT INTO membre_equipe(id_utilisateur,id_equipe) VALUES(:id_membre,:id_eq)";
                                $req = $this->db->prepare($sql);
                                $req->bindParam(':id_membre', $id_membre, PDO::PARAM_INT);
                                $req->bindParam(':id_eq', $data_e['id_equipe'], PDO::PARAM_INT);

                                 if(!($req->execute()))
                                    $err = $this->db->errorInfo()[2];
                            }
                           
                        }
                    }
                    else
                        $err = "Problème d'insertion du nom et de la spécialité dans la BDD";
                }

                else
                    $err = "Problème d'insertion du nom et de la spécialité dans la BDD";
            }
            
        }
        return $err;
    }


}



?>