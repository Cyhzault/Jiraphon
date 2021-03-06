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
  function showBar(){echo "<hr class='JiraphonBAR'>";}


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

        <!-- Bootstrap Core CSS -->
        <link href='./bootstrap/css/bootstrap.css' rel='stylesheet'>

        <!-- Custom CSS -->
        <link href='./bootstrap/css/perso.css' rel='stylesheet'>
        
        <link href='./bootstrap/css/equipe.css' rel='stylesheet'>

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
            <div class='alert alert-danger'>Vous n'êtes pas connecté.</div>
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
            $str="
            <nav class='navbar navbar-default'>
      <div class='container-fluid'>
        <div class='navbar-header'>
          <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1' aria-expanded='false'>
            <span class='sr-only'>Toggle navigation</span>
             <!-- span class='icon-bar' pour l\'icone de passage en colonne quand zoom -->
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
          </button>
          <a class='navbar-brand' href='./index.php'>
                        <b>JIRAPHON</b>
            </a>
        </div>

        <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>";

          if(isset($_SESSION['pseudo']) ){
            $str.="
            <ul class='nav navbar-nav'>
          <!-- menu projets-->
          <li class='dropdown'>
              <a href='./project.php' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Projet<span class='caret'></span></a>
              <ul class='dropdown-menu'>
               <li><a href='./equipe.php'>Mes projets</a></li>
                <li role='separator' class='divider'></li>
                <li><a href='./CreationProject.php'>Nouveau projet</a></li>
                <li><a href='./equipe.php?creation=5'>Nouvelle équipe</a></li>
                
              </ul>
            </li>

            <!-- menu equipe -->
            <li class='dropdown'>
              <a href='./project.php' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>Tâches<span class='caret'></span></a>
              <ul class='dropdown-menu'>
               <li><a href='./project.php'>Mes tâches</a></li>
                <li role='separator' class='divider'></li>
                <li><a href='./CreationTask.php'>Nouvelle tâche</a></li>
                
              </ul>
            </li>
          </ul>

          <!-- menu perso-->
          <ul class='nav navbar-nav navbar-right'>
            <li class='dropdown'>
              <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>".$_SESSION['pseudo']."<span class='caret'></span></a>
              <ul class='dropdown-menu'>
                <li><a href='./perso.php'>Perso</a></li>
                <li><a href='./index.php?d=5'>Deconnexion</a></li>
              </ul>
            </li>
          </ul>";
        }

        else{
          $str.="
          <ul class='nav navbar-nav pull-right'>
                <a class='btn btn-primary pull-right' href='./login.php'>Se connecter</a>
               </ul>";
            }

        $str.=" </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>";

    echo $str; 

  }
  
  function footer()
  {
    $str="<div class='footer'>
      <p class='left'>Jiraphon©</p>
      <a class='right'>nous Contacter</a>
    </div>";
    echo $str;
  }

  public function displayWelcomeMessage()
  {
    $str="<div class='jumbotron col-md-12'> 
            <div class='container col-md-8 col-md-offset-2'>
                <img src='./logo2.png'class='logo'>
                <hr class='JiraphonBar'/>
                <p>Bienvenue sur Jiraphon! Avec nous finis les post-it, nous te proposons un service de gestion de projets afin de suivre l'avancement de tes travaux où de ceux de ton équipe!</p>
            </div>
            <div class='row'>
                <a class='btn btn-primary col-xs-4 col-xs-offset-1 col-md-4 col-md-offset-1 col-lg-3 col-lg-offset-2' href='./login.php'>Sign in</a>
                <a class='btn btn-primary col-xs-4 col-xs-offset-1 col-md-4 col-md-offset-2 col-lg-3 col-lg-offset-2' href='./login.php?inscription=2'>Get started!</a>
            </div>
        </div>'";

    echo $str;

  }


}





?>