<?php

include_once "../config/db_connect.php";

if (isset($_POST["loginBtn"]))
{
    $loginName = filter_var($_POST["loginName"], FILTER_SANITIZE_EMAIL);
    $loginPassword = $_POST["loginPassword"];

    $login = $pdo->prepare(file_get_contents("../sql/login.sql"));
    $login->execute(array("email" => $loginName, "username" => $loginName));
    $user = $login->fetch();
    
    if(!empty($user) && password_verify($loginPassword, $user['password']))
    {
        $_SESSION['userId'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header("Location: ../index.php");
        exit;
    }
    else
    {
        header("Location: ../index.php?err=login");
        exit;
    }
}