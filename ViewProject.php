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

    /**
     * @param $project
     * @param $sprint Sprint
     */
    public function showProjectData($project,$sprint)
    {
        echo"<div id='sprint_".$sprint->getId_sprint()."' class='sprint-info' >
   
        </div>";
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
        $str="<div id='".$user->getLogin()."_kbn' class='kanban ".$active."'>";
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
        $str="<div id='".$user->getLogin()."_kbn' class='kanban ".$active."'>";
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
            $todo = $tm->getTasksToDo($usr->getId_utilisateur(),$project->getId_projet());
            $inProgress =$tm->getTasksInProgress($usr->getId_utilisateur(),$project->getId_projet());
            $done = $tm->getTasksDone($usr->getId_utilisateur(),$project->getId_projet());

            if($user->getId_utilisateur() == $usr->getId_utilisateur())
            {
                $this->showEditableKanban($user,$todo,$inProgress,$done,"active"); //kanban de l'utilisateur
            }else{
                $this->showKanban($usr,$todo,$inProgress,$done,"");
            }
        }
    }

    /**
     * @param $user User Current user
     * @param $team array List of User
     * @param $tm TaskManager
     * @param $project Project
     */
    public function displayAllKanbansWithSudo($user, $team, $tm,$project)
    {

        foreach ($team as $usr)
        {
            //récupération des tâches de l'utilisateur.
            $todo = $tm->getTasksToDo($usr->getId_utilisateur(),$project->getId_projet());
            $inProgress =$tm->getTasksInProgress($usr->getId_utilisateur(),$project->getId_projet());
            $done = $tm->getTasksDone($usr->getId_utilisateur(),$project->getId_projet());

            if($user->getId_utilisateur() == $usr->getId_utilisateur())
            {
                $this->showEditableKanban($user,$todo,$inProgress,$done,"active"); //kanban de l'utilisateur
            }else{
                $this->showEditableKanban($usr,$todo,$inProgress,$done,"");
            }
        }
    }

    public function showTeamListDropdown($user,$team)
    {
        $str="
            <div class='dropdown'>
                <button class='btn btn-default dropdown-toggle' type='button' id='teamDropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>
                    ".$user->getLogin()."
                    <span class='caret'></span>
                </button>
                <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>";
                foreach ($team as $user)
                {
                    $str.="<li id='".$user->getLogin()."_drp' class='teamMember'><a href='#kanban'>".$user->getLogin()."</a></li>";
                }
                $str.="</ul>
            </div>";
        echo $str;
    }

    public function showMultipleTeamsListDropdown($teamlist)
    {
        $str="
            <div class='dropdown'>
                <button class='btn btn-default dropdown-toggle' type='button' id='teamDropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>
                    -- select --
                    <span class='caret'></span>
                </button>
                <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>";
        foreach ($teamlist as $team)
        {
            $str.="<li class='dropdown-header'>".$team->getNom_equipe()."</li>";
            foreach ($team->getUtilisateurs() as $user)
            {
                $str.="<li id='".$user->getLogin()."_drp' class='teamMember'><a href='#kanban'>".$user->getLogin()."</a></li>";

            }
        }
        $str.="</ul>
            </div>";
        echo $str;
    }


    public function displayModalTaskInfo()
    {
        $str="
            <div id='taskInfo' class='taskInfoBackground'>
                <div class='container taskInfoModal '>
                    <div class='taskInfoHeader row'>
                        <span class='closeBtn'>×</span>
                        <h2 id='task-name'></h2>
                    </div>
                    <div class='taskInfoBody row'>
                        <p id='task-desc'></p>
                        <div class='col-md-12'>
                            <div class='col-md-6'>
                                <p>Date de début: <input id='task-deb'type='date' value=''/></p>
                            </div>
                            <div class='col-md-6'>
                                <p>Date de fin: <input id='task-fin' type='date' value=''/></p>
                            </div>
                        </div>
                    </div>
                    <div class='taskInfoFooter row'>
                        <a href='./#' class='right btn btn-info'>EDIT</a>
                    </div>
                </div>
            </div>
        
        ";
        echo $str;

    }


    public function displayModalFormulary($teamList)
    {
        $str="
            <div id='taskFormulary' class='taskInfoBackground'>
                <div class='container taskFormularyModal '>
                    <div class='taskInfoHeader row'>
                        <span class='closeBtn'>×</span>
                        <h2 id='taskFormulary-name'></h2>
                        <div id='taskFormulary-id' style='display:none'></div>
                    </div>
                    <div class='taskInfoBody row'>
                        <div id='formularyError' class='alert alert-danger' style='display:none'></div>
                        <p id='taskFormulary-desc'></p>";
                        $str.=$this->getTeamListDropDownHTML($teamList);

                    $str.="</div>
                    <div class='taskInfoFooter row'>
                        <a id='deleteBtn' href='#kanban' class='left btn btn-danger'>SUPPRIMER</a>
                        <a id='submitBtn' href='#kanban' class='right btn btn-info'>VALIDER</a>
                    </div>
                </div>
            </div>
        
        ";
        echo $str;

    }


    public function showAdminToolbar($teamList)
    {
        echo "<div class='container col-md-12'>
            <div class='col-md-3'>";
                $this->showMultipleTeamsListDropdown($teamList);
            echo "</div>
            <div class='col-md-3'>
               <a id='taskToManageBtn' href='#taskToManage' class='btn btn-info'>Tâche à traiter</a>
            </div>
        </div>";

    }

    /**
     * @param $taskList
     * @param $um UserManager
     */
    public function displayTaskToManage($taskList,$um)
    {
        $str="
            <div id='taskToManage' class='taskToManage'>
            <p>Tableau de getion des tâches non attribuées.</p>
            <div class='panel panel-default'>
            <div class='panel-heading'>Tâches à administrer</div>
            <table class='table'>
            <thead><tr><th>#</th><th>Type</th><th>Nom</th><th>Créateur</th><th>Priorité</th></tr></thead>
            <tbody>";
            foreach ($taskList as $task)
            {
                $creator = $um->getUserById($task->getIdCreateur());
                $data = explode("-",$task->getNom());
                $str.="<tr id='".$task->getIdtache()."'class='manageableTask'><th>".$task->getIdtache()."</th><th>".$data[0]."</th><th>".$data[1]."</th><th>".$creator->getLogin()."</th> <th>HIGH</th></tr>";
            }
        $str.="</tbody>
            </table>
            </div>
        </div>";
        echo $str;
    }

    private function getTeamListDropDownHTML($teamList)
    {
        $str="
            <div class='dropdown'>
                <button class='btn btn-default dropdown-toggle' type='button' id='assignmentDropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>
                -- select --
                    <span class='caret'></span>
                </button>
                <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'>";
            foreach ($teamList as $team)
            {
                $str.="<li class='dropdown-header'>".$team->getNom_equipe()."</li>";
                foreach ($team->getUtilisateurs() as $user)
                {
                    $str.="<li id='".$user->getLogin()."_frm' class='formulary-teamMember'><a href='#kanban'>".$user->getLogin()."</a></li>";

                }
            }
        $str.="</ul>
            </div>";
        return $str;
    }

}