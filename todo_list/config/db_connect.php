<?php

session_start();

try {
  $pdo = new PDO("mysql:host=localhost;dbname=todo_list", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "<script>console.log('Connected successfully.');</script>";
} catch (PDOException $error) {
  echo "Connection failed: " . $error->getMessage();
}
