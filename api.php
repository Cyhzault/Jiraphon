<?php
/**
 * Created by PhpStorm.
 * User: Cyhzault
 * Date: 07/05/2016
 * Time: 17:53
 */
require_once('./Controler.php');
require_once('./Model.php');

$ctrl = new Controler();
$model = new Model();

if(isset($_SESSION['pseudo']))
{
    if(isset($_GET['requestType']))
    {
        switch ($_GET['requestType'])
        {
            case "taskInfo":
                if(isset($_POST['json']))
                {
                    require_once('TaskManager.Class.php');
                    $taskId = json_decode(htmlspecialchars($_POST['json']));
                    $tm = new TaskManager($model->getDb());
                    $task = $tm->getTaskById($taskId);
                    echo json_encode($task->dataToArray());
                }
                break;
            case "taskUpdate":
                if(isset($_POST['json']))
                {
                    require_once('TaskManager.Class.php');
                    $data = json_decode($_POST['json'],true);
                    $taskId = htmlspecialchars($data['taskId']);
                    $oldS = htmlspecialchars($data['OldS']);
                    $newS = htmlspecialchars($data['NewS']);
                    $date = date("Y-m-d");
                    $tm = new TaskManager($model->getDb());
                    $dateDeb = "same";
                    $dateFin = NULL;
                    $status="";
                    switch($newS)
                    {
                        case "TODO":
                                    $status = "TODO";
                                    $dateDeb = NULL;
                                break;
                        case "IN PROGRESS":
                                    $status = "INPG";
                                    if($oldS == "TODO")
                                        $dateDeb = $date;
                                break;
                        case "DONE":
                                    $status = "DONE";
                                    if($oldS == "TODO")
                                        $dateDeb=$date;
                                    $dateFin = $date;
                                break;
                        default:

                    }
                    $tm->updateTaskWithId($taskId,$dateDeb,$dateFin,$status);
                }
                break;
            case "taskAttribution":
                if(isset($_POST['json']))
                {
                    require_once('TaskManager.Class.php');
                    require_once('UserManager.Class.php');
                    $tm = new TaskManager($model->getDb());
                    $um = new UserManager($model->getDb());

                    $data = json_decode($_POST['json'],true);
                    $user = $um->getUserByPseudo(htmlspecialchars($data['pseudo']));
                    $taskId = htmlspecialchars($data['taskId']);
                    $tm->assignUserToTask($taskId,$user->getId_utilisateur());
                }
                break;
            default:
                echo "Failure.";
        }
    }

}

?>