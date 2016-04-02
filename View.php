<?php

/**
* 
*/
class View
{
	
	function __construct()
	{
		# code...
	}

	    /////////////////////////////////// Fonctions basiques //////////////////////////////////////////////////////


	// ouvertures de balises simples
	function beginDiv(){echo "<div>";}
    function beginHTML(){echo "<html>";}
    function beginList(){echo "<ul>";}
    function beginPoint(){echo "<li>";}
    function beginBody(){echo "<body>";}
    function beginHead(){echo "<head>";}
    function beginTable(){echo "<table class ='table'>";}
    function beginLine(){echo "<tr>";}
    function beginColumn(){echo "<td>";}
    function beginTitleColumn(){echo "<th>";}
    function showBar(){echo "<hr class='msdbBar'>";}


    //fermetures de balises simples
    function endHead(){echo "</head>";}
    function endBody(){echo "</body>";}
    function endList(){echo "</ul>";}
    function endPoint(){echo "</li>";}
    function endDiv(){echo "</div>";}
    function endHTML(){echo "</html>";}
    function endTable(){echo "</table>";}
    function endLine(){echo "</tr>";}
    function endColumn(){echo "</td>";}
    function endTitleColumn(){echo "<th>";}
    
    //Ouverture ou gestion d'élément bootstrap simple
    function beginContainer(){echo "<div class='container-fluid'>";}
    function beginJumbotron(){echo "<div class ='jumbotron col-md-12'>";}
    function beginWrapper(){echo "<div id=wrapper>";}
    function beginPageWrapper(){echo "<div id='page-wrapper' class='container-fluid'>";}
    function beginPageHeader($data){echo "<h1 class='page-header'>".$data."</h1>";}
    function title($data){echo "<title>".$data."</title>";}


    ////////////////////////////////// fonction d'affichage complexes \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

    function addCSS()
    {
    	echo "

    	<!-- Bootstrap Core CSS -->
        <link href='./bootstrap/css/bootstrap.min.css' rel='stylesheet'>

        <!-- Custom CSS -->
        <link href='./bootstrap/css/perso.css' rel='stylesheet'>

        <!-- Custom Fonts -->
        <link href='./bootstrap/font-awesome/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
		";

    }

    function navBar($isConnected)
    {
        //partie s'affichant dans tous les cas
        echo"
            <nav class='navbar navbar-fixed-top'>
            <div class='container'>
                <a class='navbar-brand' href='#!'>
                    <img alt='logo' src='logotempo.png'>
                </a>
                ";

        //cas ou l'utilisateur ne s'est pas encore connecté
        if(/*!$isConnected*/false){
    echo"
                <a class='btn btn-primary navbar-right' href='./login.php'>Se connecter</a>
            </div>
    	";
        }


        //Cas où l'utilisateur est connecté
        else if (/*$isConnected*/ true) {
         //ajouter les liens
            echo"
            <li class='dropdown'>
            <a href='# class='dropdown-toggle' data-toggle='collapse' role='button' 
            aria-haspopup='true' aria-expanded='false'>Projets <span class='caret'></span></a>
          <ul class='dropdown-menu'>";
         /* while($User->projet){
            echo"<li><a href='#'>$User->projet</a></li>";
        }*/
        echo"
        <li><a href='#'>creer projet</a></li>
            </ul>
          <a href='#' class='dropdown-toggle' data-toggle='collapse' role='button' 
            aria-haspopup='true' aria-expanded='false'>Equipe <span class='caret'></span></a>
          <ul class='dropdown-menu'>
            <li><a href='#'>Membres</a></li>
            <li><a href='#'>Chefs de projet</a></li>
            <li><a href='#'>Informations</a></li>
            </ul>

             <a href='#' class='dropdown-toggle navbar-right' data-toggle='collapse' role='button' 
            aria-haspopup='true' aria-expanded='false'>";/*'$_SESSION['pseudo']'*/echo"Maman Jiraphe<span class='caret'></span></a>
          <ul class='dropdown-menu'>
            <li><a href='#'>perso</a></li>
            <li><a href='./login.php'>deconnexion</a></li>
            </ul>

        </li>";
        }
        echo"</nav>";
    }

}



?>