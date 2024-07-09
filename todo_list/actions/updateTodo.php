<?php
include_once "../config/db_connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $todo = htmlspecialchars($_POST['todo']);
    $comment = htmlspecialchars($_POST['comment']);

    $updateTodo = $pdo->prepare(file_get_contents("../sql/updateTodo.sql"));
    $updateTodo->execute(array("todo" => $todo, "comment" => $comment, "id" => $id, "user_id" => $_SESSION['userId']));
}