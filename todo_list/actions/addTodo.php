<?php
include_once "../config/db_connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $todo = htmlspecialchars($_POST['todo']);
    $comment = htmlspecialchars($_POST['comment']);

    $addTodo = $pdo->prepare(file_get_contents("../sql/addTodo.sql"));
    $addTodo->execute(array("user_id" => $_SESSION['userId'], "todo" => $todo, "comment" => $comment));
}