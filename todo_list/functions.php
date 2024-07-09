<?php

function logout()
{
    session_start();
    session_destroy();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'logout') {
    logout();
}
