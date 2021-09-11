<?php

require_once(__DIR__ . '/../app/config.php');

$pdo = getPdoInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  addPost($pdo);
}

$posts = getPosts($pdo);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>掲示板 - 新規投稿</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <h1>掲示板</h1>
  <h2>新規投稿</h2>
  <form method="post">
    name: <input type="text" name="name"><br>
    投稿内容:<br>
    <textarea name="text" cols="30" rows="10"></textarea><br>
    <button>投稿</button>
  </form>
  <h2>投稿内容一覧</h2>
  
  <?php foreach($posts as $post): ?>
    <ul>
      <li>No : <?= h($post->id) ?></li>
      <li>名前 : <?= h($post->name) ?></li>
      <li>投稿内容 : <?= h($post->text) ?></li>
    </ul>
  <?php endforeach; ?>
</body>
</html>