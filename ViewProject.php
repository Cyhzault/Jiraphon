<?php

/**
 * Author: Cyhzault
 */
require_once('./View.php');
class ViewProject extends View
{
    /**
     * @param $projects une liste de projets
     * Affiche une liste de projets que l'on peut selectionner.
     */
    public function showProjectsList($projects)
    {
        $str = "<div class=list-group>";
        foreach ($projects as $project) {
            $str.="<a class='list-group-item' href='./project.php?projectId=".$project->getId_projet()."'>".$project->getNom_projet()."</a>";
        }

        $str.="</div>";

        echo $str;
    }

    public function addScript()
    {
        echo "
            <script type='text/javascript' src='./bootstrap/js/jquery.js'></script>
            <script type='text/javascript' src='./bootstrap/js/bootstrap.min.js'></script>
            <script type='text/javascript' src='./bootstrap/js/jquery-ui.min.js'></script>
            <script type='text/javascript' src='./bootstrap/js/kanban.js'></script>


        ";
    }

    public function showProjectData($project)
    {
        echo""; //TODO
    }

    /**
     * @param $name
     * @param $list
     * @param $class string null or editable
     * @return string
     */
    private function getTaskListHTML($name,$list,$class)
    {
        $str="<div id='".$name."' class='taskList col-md-4 todolist'>";
        $str.="<h2 class='kanbanTitle'>$name</h2>";
        $str.="<hr/>";
        foreach ($list as $task)
        {
            $data = explode('-',$task->getNom(),2);
            $str.= "<div id='".$task->getIdTache()."' class='".$data[0]."  task ".$class." col-md-12'>".$data[1]."</div>";
        }
        $str.="</div>";
        return $str;
    }


    /**
     * @param $user User.Class qui représente l'utilisateur connecté
     * @param $todoList Liste de task à réaliser
     * @param $inProgress Liste de tâche en cours de réalisation
     * @param $done Liste de tâches déjà effectuées.
     * @param $active string active si doit être affiché, vide sinon.
     */
    public function showKanban($user,$todoList,$inProgress,$done,$active)
    {
        $str="<div id='".$user->getNom()."' class='kanban ".$active."'>";
            $str.= "<p> Liste des tâches de l'utilisateur ".$user->getNom()."</p>";
            $str.="<div class='jumbotron col-md-12 userTaskList'>";
                $str.=$this->getTaskListHTML("TODO",$todoList,"");
                $str.=$this->getTaskListHTML("IN PROGRESS",$inProgress,"");
                $str.=$this->getTaskListHTML("DONE",$done,"");
            $str.="</div>";
        $str.="</div>";
        echo $str;
    }

    /**
     * @param $user User.Class qui représente l'utilisateur connecté
     * @param $todoList Liste de task à réaliser
     * @param $inProgress Liste de tâche en cours de réalisation
     * @param $done Liste de tâches déjà effectuées.
     * @param $active string active si doit être affiché, vide sinon.
     */
    private function showEditableKanban($user, $todoList, $inProgress, $done,$active)
    {
        $str="<div id='".$user->getNom()." class='kanban ".$active."'>";
            $str.= "<p> Liste des tâches de l'utilisateur ".$user->getNom()."</p>";
            $str.="<div class='jumbotron col-md-12 userTaskList'>";
                $str.=$this->getTaskListHTML("TODO",$todoList,"editable");
                $str.=$this->getTaskListHTML("IN PROGRESS",$inProgress,"editable");
                $str.=$this->getTaskListHTML("DONE",$done,"editable");
            $str.="</div>";
        $str.="</div>";
        echo $str;
    }


    /**
     * @param $user User Current user
     * @param $team array List of User
     * @param $tm TaskManager
     * @param $project Project
     */
    public function displayAllKanbans($user, $team, $tm,$project)
    {

        foreach ($team as $usr)
        {
            //récupération des tâches de l'utilisateur.
            $todo = $tm->getTasksToDo($usr->getIdUtilisateur(),$project->getId_projet());
            $inProgress =$tm->getTasksInProgress($usr->getIdUtilisateur(),$project->getId_projet());
            $done = $tm->getTasksDone($usr->getIdUtilisateur(),$project->getId_projet());

            if($user->getIdUtilisateur() == $usr->getIdUtilisateur())
            {
                $this->showEditableKanban($user,$todo,$inProgress,$done,"active"); //kanban de l'utilisateur
            }else{
                $this->showKanban($usr,$todo,$inProgress,$done,"");
            }
        }
    }

    public function showTeamListDropdown($user,$team)
    {
        $str="
            <div class='dropdown'>
                <button class='btn btn-default dropdown-toggle' type='button' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>
                    ".$user->getNom()."
                    <span class='caret'></span>
                </button>
                <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>";
                foreach ($team as $user)
                {
                    $str.="<li><a href='#'>".$user->getNom()."</a></li>";
                }
                $str.="</ul>
            </div>";
        echo $str;
    }


}