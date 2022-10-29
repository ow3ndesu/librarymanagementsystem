<?php
include_once("../process/auth.process.php");
$process = new Process();

if (isset($_POST["action"]) && $_POST["action"] == "Login") {
    $process->Login($_POST);
}

if (isset($_POST["action"]) && $_POST["action"] == "LoadProfile") {
    $process->LoadProfile($_POST);
}

if (isset($_POST["action"]) && $_POST["action"] == "Logout") {
    $process->Logout();
}

if (isset($_POST["action"]) && $_POST["action"] == "Register") {
    $process->Register($_POST);
}
