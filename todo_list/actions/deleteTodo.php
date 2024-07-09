<?php
include_once "../config/db_connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

    $deleteTodo = $pdo->prepare(file_get_contents("../sql/deleteTodo.sql"));
    $deleteTodo->execute(array("id" => $id, "user_id" => $_SESSION['userId']));
}