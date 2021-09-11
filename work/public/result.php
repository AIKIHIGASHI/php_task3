<?php

require_once(__DIR__ . '/../app/config.php');

$message = $_SESSION['message'] 

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>掲示板 - 投稿完了</title>
</head>
<body>
  <h1><?= $message ?></h1>
  <button onclick="location.href='index.php'">投稿一覧に戻る</button>
</body>
</html>