<?php
include_once("../process/borrowals.process.php");
$process = new Process();

if (isset($_POST["action"]) && $_POST["action"] == "LoadBorrowals") {
    $process->LoadBorrowals();
}

if (isset($_POST["action"]) && $_POST["action"] == "LoadBorrowal") {
    $process->LoadBorrowal($_POST);
}

if (isset($_POST["action"]) && $_POST["action"] == "EditBorrowalStatus") {
    $process->EditBorrowalStatus($_POST);
}

if (isset($_POST["action"]) && $_POST["action"] == "DeleteBorrowal") {
    $process->DeleteBorrowal($_POST);
}
