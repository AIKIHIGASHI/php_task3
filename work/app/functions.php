<?php

function h($value) {
  return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function getPdoInstance() {
  try {
    $pdo = new PDO(
      DSN,
      DB_USER,
      DB_PASS,
      [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_EMULATE_PREPARES => false,
      ]
    );
  } catch (PDOException $e) {
    echo $e->getMessage();
    exit;
  }
  return $pdo;
}

function addPost($pdo) {
  $name = trim(filter_input(INPUT_POST, 'name'));
  $text = trim(filter_input(INPUT_POST, 'text'));
  if (empty($name & $text)) return;
  $stmt = $pdo->prepare("INSERT INTO posts (name, text) VALUES (:name, :text)");
  $stmt->bindValue('name', $name, PDO::PARAM_STR);
  $stmt->bindValue('text', $text, PDO::PARAM_STR);
  $stmt->execute();
  header('Location: ' . SITE_URL . '/result.php');
}

function getPosts($pdo) {
  $stmt = $pdo->query("SELECT * FROM posts ORDER BY id ASC");
  $posts = $stmt->fetchALL();
  return $posts;
}

