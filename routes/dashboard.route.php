<?php
include_once("../process/dashboard.process.php");
$process = new Process();

if (isset($_POST["action"]) && $_POST["action"] == "LoadDashboard") {
    $process->LoadDashboard();
}
