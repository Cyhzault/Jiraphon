<?php

/**
*@author Niark
*/

require_once("./View.php");
class ViewPerso extends View
{
	function ShowInfoPerso($prenom, $nom, $pseudo, $fonction, $photo)
	 {
	 	echo "<section style='width:80%;'><center><a href='modif.php?p=2'><img src='".$photo."' alt='photo de profil' style='width:40%; float:right;'></a>";
	 	$str="<h2>".$prenom." ".$nom."</h2><p> dit ".$pseudo."</p>";
	 	$str.="<a href='modif.php?m=1'>Changer de mot de passe</a></center></section>";
	 	echo $str;
	 	
	 }

	 function ShowLienPerso()
	 {
	 	echo "
	 		<section>
				<center><div style='margin : 60px;'>
					<a class='btn btn-primary' href='equipe.php' style='margin-top:5px;'>Mes projets</a>
					<a class='btn btn-primary' href='project.php' style='margin-top:5px;'>Mes taches</a>
					<a class='btn btn-primary' href='CreationProject.php' style='margin-top:5px;'>Créer projet</a>

				</div></center>
				<div style='margin-top:40px; margin-left:500px; float:right;'>
			
				</div>
			</section>";
	 }
}

?>