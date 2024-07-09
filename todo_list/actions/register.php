<?php
include_once "../config/db_connect.php";

if (isset($_POST["registerBtn"])) {
    $registerUsername = htmlspecialchars($_POST["registerUsername"]);
    $registerEmail = filter_var($_POST["registerEmail"], FILTER_SANITIZE_EMAIL);
    $registerPassword = $_POST["registerPassword"];
    $repeatRPassword = $_POST["repeatRPassword"];

    if (!filter_var($registerEmail, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../index.php?err=email");
        exit;
    }

    if ($registerPassword !== $repeatRPassword) {
        header("Location: ../index.php?err=pw");
        exit;
    }

    if (
        filter_var($registerUsername, FILTER_SANITIZE_SPECIAL_CHARS)
        && filter_var($registerEmail, FILTER_VALIDATE_EMAIL)
    ) {
        $checkEmailAndUsername = $pdo->prepare(file_get_contents("../sql/checkEmailAndUsername.sql"));
        $checkEmailAndUsername->execute(array("email" => $registerEmail, "username" => $registerUsername));
        $user = $checkEmailAndUsername->fetch();

        if (!empty($user)) {
            header("Location: ../index.php?err=taken");
            exit;
        }
    }

    if (
        filter_var($registerUsername, FILTER_SANITIZE_SPECIAL_CHARS)
        && filter_var($registerEmail, FILTER_VALIDATE_EMAIL)
        && $registerPassword == $repeatRPassword
    ) {
        $password_hash = password_hash($registerPassword, PASSWORD_DEFAULT);

        $register = $pdo->prepare(file_get_contents("../sql/register.sql"));
        $register->execute(array("email" => $registerEmail, "password" => $password_hash, "username" => $registerUsername));
        $success = true;

        if ($success) {
            $login = $pdo->prepare(file_get_contents("../sql/login.sql"));
            $login->execute(array("email" => $registerEmail, "username" => $registerUsername));
            $user = $login->fetch();

            $_SESSION['userId'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: ../index.php");
            exit;
        }
    }
}
