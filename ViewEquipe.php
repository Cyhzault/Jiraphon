<?php

/**
 * Author: Ambre
 */
require_once('./View.php');

class ViewEquipe extends View
{

  /**
     * @param $projects une liste de projets
     * Affiche une liste de projets que l'on peut selectionner.
     */
    public function showProjectsList($projects)
    {
      echo "
      <div class='tableau_proj'>
        <CENTER>
        <h2> Projets </h2>
        <hr class='JiraphonBAR'>
        <div class='row' style='width:100%'>
              ";
    
      foreach($projects as $projet)
      {
        echo "
             <div class='col-md-4'>
                 <a  class='thumbnail' href='#".$projet->getId_projet()."'>".$projet->getNom_projet()."</a>
              </div>
            ";
      }
   
    echo "
        </div>
    </CENTER>
    </div>
    <ul>";
    }

    /**
     * @param $projects une liste de projets
     * Affiche le projet et les membres travaillant sur le projet
     */
    public function showNomProject($projet)
    {
        echo "<div class='panel-heading'> Projet " . $projet->getNom_projet() . " </div>";  
    }


    public function showProjet($user,$projet,$id)
    {
      echo "
    
      <div class='panel-body'>
        <CENTER>

        <div class='temps_projet'>
          <div class='date_deb'>". $projet->getDate_deb() . "</div>
          <div class='date_fin'>". $projet->getDate_fin() . "</div>
          <img id='schema_temps' src='bootstrap/img/projet_duree.png' alt='schema temps' style='width:95%; margin-left:15px;' >
        </div>

        <div class='description'>
          <p>" . $projet->getDescription() ."<p>
        </div>

        <div style='position: relative;'>
          <div style='width:20%'  onmousemove='Showinformations(".$id.")' onmouseout='Hideinformations(".$id. ")'>
            <img id='image".$id."' src=". $user->getPhoto() . " alt='Photo chef de projet' class='img-rounded' style='max-width:100%;'>
            <div class='informations' name='cp' id='".$id. "'>
              <center>
                <ul>
                  <li><p>" . $user->getNom() . "</p></li>
                  <li><p>" . $user->getPrenom() . "</p></li>
                  <li><p>" . $user->getFonction() . "</p></li>
                </ul>
              </center>
            </div>
          </div>
          <h4> Chef de projet </h4>
        </div>
        </CENTER>
      </div>";
    }

    public function ListeEquipe($etat)
    {
      if($etat)
        echo "<ul class='list-group'>";
      else
        echo"</ul>";
    }

     public function ListeProjet($etat,$projet)
    {
      if($etat)
        echo "<li style='clear:left;'><div class='panel panel-default' id=" . $projet->getId_projet() . ">";
      else
        echo"</div></li>";
    }

     public function showPicture($id,$membre)
    {
      $id= $id. $membre->getId_utilisateur();
        echo "
        <div class='equipe' onmousemove='Showinformations(".$id.")' onmouseout='Hideinformations(".$id.")'>
          <div style='width:100%' >
              <center><img id='image".$id. "' src=". $membre->getPhoto() . " alt='Photo membre' class='img-rounded' style='max-width: 70%;' ></center>

              <div id='". $id. "' class='informations' name='membre'>
                
                <ul>
                  <li><p>" . $membre->getNom() . "</p></li>
                  <li><p>" . $membre->getPrenom() . "</p></li>
                  <li><p>" . $membre->getFonction() . "</p></li>
                </ul>
                
              </div>
          </div>
        </div>";
    }

    public function showPictureHtml($id,$membre)
    {
       $id= $id. $membre->getId_utilisateur();
        return "
        <div class='equipe' onmousemove='Showinformations(".$id.")' onmouseout='Hideinformations(".$id.")'>
          <div style='width:100%' >
              <center><img id='image".$id. "' src=". $membre->getPhoto() . " alt='Photo membre' class='img-rounded' style='max-width: 70%;' ></center>

              <div id='". $id. "' class='informations' name='membre'>
                
                <ul>
                  <li><p>" . $membre->getNom() . "</p></li>
                  <li><p>" . $membre->getPrenom() . "</p></li>
                  <li><p>" . $membre->getFonction() . "</p></li>
                </ul>
                
              </div>
          </div>
        </div>";
    }


    public function showEquipe($equipe,$compteur,$id)
    {
      echo "
      <li style='clear:left;' class='list-group-item'>
      <h3> Equipe ".$compteur.": ". $equipe->getNom_equipe() . "</h3>";

      if($equipe->getSpecialite() != null)
        echo "<div class='spec'> Spécialité : " .$equipe->getSpecialite(). "</div>";

      foreach($equipe->getUtilisateurs() as $membre)
      {
        $this->showPicture($id,$membre);
      }
      echo "<div class='spacer' style='clear: both;''></div></li>";
      
    }

    public function showUsers($users,$id)
    {
      echo "
      <li style='clear:left;' class='list-group-item'>
      <h3> Autres membres </h3>";
      foreach($users as $membre)
      {
        $this->showPicture($id,$membre);
      }
      echo "<div class='spacer' style='clear: both;''></div></li>";
    }


    public function showEquipeFormulary()
    {
      echo"
      <form action='' method='POST' enctype='multipart/form-data' >
        <div class='form-group' id='equipe_form' name='formulaire'>
          <div class='champ'>
            <label>Nom d'équipe * : </label>
            <input type='text' id='nom_e' name='nom_e' class='form-control' >
          </div>
          <div class='champ'>
            <label>Spécialité de l'équipe : </label>
            <input type='text' id='spec' name='spec' class='form-control' >
          </div>

          <div id='membres' class='row' style='width:100%'>
           <label> Membres </label>
          </div>

          <img src='./bootstrap/img/plus.png' id='plus' alt='Plus ajout' height='35' width='35' onclick='AjoutUtilisateur()'>
          <p id='legende'> Ajouter un membre </p>
        </div>

        <div class='form-group' id='utilisateur_form' name='formulaire'>
          <div class='champ' id='nom_uti' name='champ_uti'>
            <label>Nom utilisateur: </label>
            <input type='text' id='nom_u' class='form-control' onblur='ValidationNom()' >
          </div>
          <div class='champ' name='champ_uti'>
            <label> Prénom utilisateur : </label>
            <select class='form-control' id='prenom_u' size='1'>
            </select>
          </div>
          <input type='hidden' name='liste_membre'> </input>
          <input type='button' class='btn btn-primary' onclick='ValidUti()' value='Valider'>
        </div>

      <center><button id='crea_button' class='btn btn-primary' type='submit' value='création_eq'>Créer l'équipe</button></center>
      </form>";
    }

  public function showCreationFailed($erreur)
  {
    echo"
    <div class='alert alert-danger'> $erreur </div>
    ";
  }

  public function showCreationSuccess()
  {
    echo"
    <div class='alert alert-success'>Création d'équipe <strong>réussie</strong></div>
    ";
  }

  public function addScript()
    {

        echo"
            <script type='text/javascript' src='./bootstrap/js/jquery.js'></script>
            <script type='text/javascript' src='./bootstrap/js/bootstrap.min.js'></script>       
            <script src='./bootstrap/js/jquery-ui.min.js'></script>‌​
            <script type='text/javascript' src='./bootstrap/js/equipe.js'></script>
        ";        

    }
}


?>