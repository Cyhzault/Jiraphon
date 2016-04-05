<?php
session_start();
/**
* 
*/
class Controler
{
	private $view;
	private $model;
	function __construct()
	{
		require_once("./View.php");
		require_once("./Model.php");
		$this->view = new View();
		$this->model = new Model();
	}


	///////////////////// Foncions publiques \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

	//Génère le début de la page, incluant la navBar et le wrapper du contenu
	function beginPage($tabTitle,$heading)
	{
		$this->beginHTMLStructure($tabTitle);
		$this->manageBeginWrapper($heading);

	}

	//Génère la end de la page, incluant le footer et la fermeture du contenu
	function endPage($view)
	{
		$this->manageEndWrapper();
		$this->endHTMLStructure($view);
	}

	///////////////////// Fonctions privées concernants la mise en place des pages du site \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


	// Gère le début du HTML généré jusqu'a l'ouverture de la balise body.
	private function beginHTMLStructure($tabTitle)
	{
		$this->view->beginHTML();
		$this->view->beginHead();
		$this->view->title($tabTitle);
		$this->view->addCSS();
		$this->view->setCharset("UTF-8");
		$this->view->endHead();
		$this->view->beginBody();

	}

	// Termine le document html.
	private function endHTMLStructure($view)
	{
		$view->addScript();
		$view->endBody();
		$view->endHTML();
	}

	private function head()
	{
            
			/*old 
            //vérifie si l'utilisateur est connecté
            if (isset($_SESSION['pseudo']))
            {
				$this->view->navBar($_SESSION['pseudo']);
            }
            else
            {
       			//$this->view->navBar(null);
            }
            */




	}

	private function manageBeginWrapper($heading)
	{
		$this->view->beginWrapper();
		$this->view->navBar(isset($_SESSION['pseudo']));
		$this->view->beginPageWrapper();
		$this->view->beginJumbotron();
		$this->view->beginPageHeader($heading);
		$this->view->showBar();
		
	}

	private function manageEndWrapper()
	{
		
		$this->view->endDiv(); //Container
		$this->view->endDiv(); //PageWrapper
		$this->view->endDiv(); //Wrapper
		//$this->view->footer(); //footer
	}
}






?>