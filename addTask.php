<?php
include "clases/database.php";
if($_GET) {
    if(!isset($_GET['text'])){
        $state = $_GET['state'];
        $id = $_GET['id'];
        var_dump($_GET);
        $result2 = $mysqli->query("UPDATE tasks SET state='$state' WHERE id='$id'");
        if ($result2 == 'TRUE') {
            echo 'ok';
        } else {
            echo 'bad';
        }
    }
    else
    {
        $task = $_GET['text'];
        $id = $_GET['id'];
        var_dump($_GET);
        $result2 = $mysqli->query("UPDATE tasks SET task='$task' WHERE id='$id'");
        if ($result2 == 'TRUE') {
            echo 'ok';
        } else {
            echo 'bad';
        }
    }
}
echo 'hi';