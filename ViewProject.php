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
        var_dump($projects);
    }
}