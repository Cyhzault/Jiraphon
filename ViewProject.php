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
    public function showProjectData($project)
    {
        echo""; //TODO
    }

    /**
     * @param $user User.Class qui représente l'utilisateur connecté
     * @param $todoList Liste de task à réaliser
     * @param $inProgress Liste de tâche en cours de réalisation
     * @param $done Liste de tâches déjà effectuées.
     */
    public function showKanban($user,$todoList,$inProgress,$done)
    {
        $str= "<p> Liste des tâches de l'utilisateur ".$user->getNom()."</p>";
        $str.="<table class='table'>";
        $str.="<tr>    <th>TODO</th>   <th>IN PROGRESS</th>   <th>DONE</th>   </tr>";
        $str.="<tr>    <td>Tache Lamba</td>   <td></td>   <td>Test</td>   </tr>";
        $str.="</table>";
        echo $str;
    }
}