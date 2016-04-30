<?php

/**
 * Author: Ambre
 */
require_once('./View.php');
echo " <link href='./bootstrap/css/equipe.css' rel='stylesheet'>";

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
    	<h2> Projets </h2>";
    	$cmpt=0;
    	$nb_colonne=3;
    	$nb_ligne=ceil(sizeof($projects)/$nb_colonne);

        echo "
    	<TABLE width=70% border=0 class='table'>" ;
    	for($i=0; $i<$nb_ligne; $i++)
    	{
    		echo "<TR>";
			for($j=0; $j<$nb_colonne && $cmpt< sizeof($projects); $j++)
			{
				echo "<TD> <a class='list-group-item' href='#".$projects[$cmpt]->getId_projet()."'>".$projects[$cmpt]->getNom_projet()."</a></TD>";
				$cmpt++;
			}
			
			echo "</TR>";
    	}
		
		echo "
		</TABLE>
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

    public function showChefProjet($user,$id)
    {
    	echo "
    	<CENTER>
    	
    	<div style='position: relative;'>
    		<div style='width:20%'  onmousemove='Showinformations(".$id.")' onmouseout='Hideinformations(".$id. ")'>
    			<img id='image".$id."' src=". $user->getPhoto() . " alt='Photo chef de projet' class='img-rounded' style='max-width:100%;'>
    			<div class='informations_cp' id='".$id. "'>
				<center>
      				<ul>
      					<li><p>" . $user->getNom() . "</p></li>
      					<li><p>" . $user->getPrenom() . "</p></li>
      					<li><p>" . $user->getFonction() . "</p></li>
      				</ul>
      			</center>
    			</div>
    		</div>
	  	</div>
      <h4> Chef de projet </h4>
    	</CENTER>";
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


    public function showEquipe($equipe,$compteur,$id)
    {
    	echo "
  		<li style='clear:left;' class='list-group-item'><h3> Equipe ".$compteur.": ". $equipe->getNom_equipe() . "</h3>";

  		foreach($equipe->getUtilisateurs() as $membre)
  		{
        $id= $id. $membre->getId_utilisateur();
  			echo "
  			<div class='equipe' onmousemove='Showinformations(".$id.")' onmouseout='Hideinformations(".$id.")'>
  				<div style='width:100%' >
	      			<center><img id='image".$id. "' src=". $membre->getPhoto() . " alt='Photo membre' class='img-rounded' style='max-width: 70%;' ></center>

	      			<div id='". $id. "' class='informations_m'>
	      				
	      				<ul>
	      					<li><p>" . $membre->getNom() . "</p></li>
	      					<li><p>" . $membre->getPrenom() . "</p></li>
	      					<li><p>" . $membre->getFonction() . "</p></li>
	      				</ul>
	      				
	  			 	</div>
	  			 </div>
			</div>";
  		}
  		echo "<div class='spacer' style='clear: both;''></div></li>";
    }

}

?>
<script src='//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js'></script>
<script type="text/javascript">

function Showinformations(id) 
{
    document.getElementById("image"+id).style.opacity = "0.4"; 
    document.getElementById(id).style.visibility= "visible";
}

function Hideinformations(id)
{
	document.getElementById("image"+id).style.opacity =  "1";
  document.getElementById(id).style.visibility= "hidden";
	
}

</script>
