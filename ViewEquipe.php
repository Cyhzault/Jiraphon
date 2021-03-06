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
      echo "<div class='spacer' style='clear: both'></div></li>";
    }

      public function showAddMembre($projects, $curr_proj,$equipes)
      {
        $id_p=$curr_proj->getId_projet();

        echo "

        <div id='addMembre'> 
          <button id='button_add' type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#modalCrea".$id_p."'> Ajouter des membres </button>
        </div>

        <div id='modalCrea".$id_p."' class='modal fade' role='dialog'>
          <div class='modal-dialog'>
            <div class='modal-content'>
              <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'> &times;</button>
                <h4 class='modal-title'> Ajout de membres </h4>
              </div>
              <div class='modal-body'>

                  <div class='champ'>
                    <label> Nom du projet : </label>
                    <select name='projet_addm' id='projet_addm".$id_p."' size= '1' class='form-control'>";
                    foreach ($projects as $value) 
                    {
                      if($value->getId_projet()==$id_p)
                        echo "<option selected='selected' value='".$value->getId_projet()."'>".$value->getNom_projet()."</option>";
                      else
                        echo "<option value='".$value->getId_projet()."' >".$value->getNom_projet()."</option>";
                    }
                    echo "
                    </select>
                  </div>

                  <div id='membres".$id_p."' style='display:none; margin:15px;' class='row' style='width:100%'>
                    <label> Membres </label>
                  </div>

                   <div id='equipes".$id_p."' style='display:none; margin:15px;' class='row' style='width:100%'>
                    <label> Equipes </label>
                  </div>

                  <div class='champ'>
                    <input class='btn btn-default' type='button' value='Ajouter un membre' onclick='AjoutUtilisateur(".$id_p.")'>";
                    $this->addUserSolo($id_p);
                  echo "
                  </div>

                  <div class='champ'>
                    <input class='btn btn-default' type='button' value='Ajouter une équipe' onclick='AjoutEquipe(".$id_p.")'>
                    <div style='display:none; margin-top:15px;' id='form_equipeadd".$id_p."' name='formulaire'>
                      <label> Nom de l'équipe </label>
                      <select id='equipe_addm".$id_p."' style='margin-bottom:15px;' size='1' class='form-control'>";
                       foreach ($equipes as $equ) 
                       {
                            echo "<option>".$equ."</option>";
                       }

                       echo"
                       </select>
                       <input type='hidden' name='liste_equipe".$id_p."' id='liste_equipe".$id_p."'> </input>
                       <input type='button' class='btn btn-primary' onclick='ValidEquipe(".$id_p.")' value='Valider'>
                    </div>
                  </div>

                  <center><input type='button' data-dismiss='modal' name='button_addm' class='btn btn-primary' onclick='AddMembre(".$id_p.")' value='Ajouter les membres'></center>

              </div>

              <div class='modal-footer'> 
                <button type='button' class='btn btn-default' data-dismiss='modal'> Fermer </button>
              </div>
            </div>
          </div>
        </div>
     

        <div class='spacer' style='clear: both;''></div>";
      }
  


    public function showEquipeFormulary($id)
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

          <div id='membres".$id."' class='row' style='width:100%; display:none;'>
           <label> Membres </label>
          </div>

          <img src='./bootstrap/img/plus.png' id='plus' alt='Plus ajout' height='35' width='35' onclick='AjoutUtilisateur(".$id.")'>
          <p id='legende'> Ajouter un membre </p>
        </div>";

        $this->addUserSolo($id);

        echo "<center><button id='crea_button' name='crea_button' class='btn btn-primary' type='submit' value='création_eq'>Créer l'équipe</button></center>
      </form>";
    }

  public function addUserSolo($id)
  {
    echo"
        <div class='form-group' style='display:none' id='utilisateur_form".$id."' name='formulaire'>
          <div style='display:none' id='erreur_uti".$id."' class='alert alert-danger'>Le membre n'existe pas</div>
          <div class='champ' id='nom_uti' name='champ_uti'>
            <label>Nom utilisateur: </label>
            <input type='text' name='nom_u' id='nom_u".$id."' class='form-control' onblur='ValidationNom(".$id.")' >
          </div>
          <div class='champ' name='champ_uti'>
            <label> Prénom utilisateur : </label>
            <select class='form-control' id='prenom_u".$id."' size='1'>
            </select>
          </div>
          <input type='hidden' name='liste_membre".$id."' id='liste_membre".$id."'> </input>
          <input type='button' class='btn btn-primary' onclick='ValidUti(".$id.")' value='Valider'>
        </div>";
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