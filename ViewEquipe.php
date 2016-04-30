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
    	echo "<CENTER><h2> Projets </h2>";
    	$cmpt=0;
    	$nb_colonne=3;
    	$nb_ligne=ceil(sizeof($projects)/$nb_colonne);

        echo "
    	<TABLE width=70% border=0>" ;
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
		
		echo "</TABLE></CENTER>
		<ul>";
    }

    /**
     * @param $projects une liste de projets
     * Affiche le projet et les membres travaillant sur le projet
     */
    public function showNomProject($projet)
    {
    		echo "<li> <h2> Projet " . $projet->getNom_projet() . " </h2> </li>";	
    }

    public function showChefProjet($user)
    {
    	echo "
    	<CENTER>
    	<h4> Chef de projet </h4>
    	<img src=". $user->getPhoto() . " alt='Photo chef de projet' class='img-rounded' style='max-width:20%'>
    	</CENTER>";
    }

    public function ListeEquipe($etat)
    {
    	if($etat)
    		echo "<ul class=equipe>";
    	else
    		echo"</ul>";
    }

     public function ListeProjet($etat,$projet)
    {
    	if($etat)
    		echo "<div id=" . $projet->getId_projet() . ">";
    	else
    		echo"</div>";
    }


    public function showEquipe($equipe)
    {
    	echo "
  		<li><h3> Equipe: ". $equipe->getNom_equipe() . "</h3></li>";
  		//var_dump($equipe->getUtilisateurs());
  		foreach($equipe->getUtilisateurs() as $membre)
  		{
  			
  			echo " <img src=". $membre->getPhoto() . " alt='Photo membre ' class='img-rounded' style='max-width: 15%; margin: 20px;'>";
  		}
    }

}

?>