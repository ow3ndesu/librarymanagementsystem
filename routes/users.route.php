<?php
include_once("../process/users.process.php");
$process = new Process();

if (isset($_POST["action"]) && $_POST["action"] == "LoadUsers") {
    $process->LoadUsers();
}
