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
    function beginClassDiv($class){echo"<div class=".$class.">";}


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

    function setCharset($charset)
    {
        echo "<meta charset='".$charset."'/>";
    }


    function authentificationRequired()
    {   //TODO
        echo"
            <div class='alert alert-danger'>Zêtes pas co!</div>
        ";
    }

    function addScript()
    {

        echo"
            <script type='text/javascript' src='./bootstrap/js/jquery.js'></script>
            <script type='text/javascript' src='./bootstrap/js/bootstrap.min.js'></script>
        ";        

    }

    function navBar($isConnected)
    {

        echo'
        <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
         <!-- span class="icon-bar" pour l\'icone de passage en colonne quand zoom -->
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="./index.php">
                    <img alt="logo" src="./bootstrap/img/logotempo.png">
        </a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

      <!-- menu projets-->
      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Projets <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Safari</a></li>
            <li><a href="#">Croisiere</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Nouveau Projet</a></li>
          </ul>
        </li>

        <!-- menu equipe -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Equipe <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Membres</a></li>
            <li><a href="#">Chefs de projet</a></li>
            <li><a href="#">Infos equipes</a></li>
          </ul>
        </li>
      </ul>

      <!-- menu perso-->
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Maman Jiraphe <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Perso</a></li>
            <li><a href="./index.php?d=5">Deconnection</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>';

       
        

        
        if (false){
        //partie s'affichant dans tous les cas
        //utilise un navbar-default plutôt. En tout cas pour l'instant. ça marchera mieux.
        echo"
            <nav class='navbar navbar-default'>
            <div class='container'>
                <a class='navbar-brand' href='#!'>
                    <img alt='logo' src='./bootstrap/img/logotempo.png'>
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
        else {
         //ajouter les liens
            echo"
            <ul role='presentation' class='dropdown'>
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
            </li>
            </ul>
          <li role='presentation' class='dropdown'>
          <a class='dropdown-toggle' data-toggle='collapse' role='button' 
            aria-haspopup='true' aria-expanded='false'>Equipe <span class='caret'></span></a>
          <ul class='dropdown-menu'>
            <li><a href='#'>Membres</a></li>
            <li><a href='#'>Chefs de projet</a></li>
            <li><a href='#'>Informations</a></li>
            </ul>
            </li>

             <li role='presentation' class='dropdown'>
             <a class='dropdown-toggle navbar-right' data-toggle='dropdown' role='button' 
            aria-haspopup='true' aria-expanded='false'>";/*'$_SESSION['pseudo']'*/echo"Maman Jiraphe<span class='caret'></span></a>
          <ul class='dropdown-menu'>
            <li><a href='#'>perso</a></li>
            <li><a href='./login.php'>deconnexion</a></li>
            </ul>
            </li>

        </li>";
        }
        echo"</nav>";
    }}

}



?>