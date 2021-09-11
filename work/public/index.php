<?php

require_once(__DIR__ . '/../app/config.php');

$pdo = getPdoInstance();
$action = filter_input(INPUT_GET, 'action');
$_SESSION['message'] = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  switch ($action) {
    case 'add':
      addPost($pdo);
      break;
    case 'delete':
      deletePost($pdo);
      break;
    default;
      exit;
  }
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
  <form method="post" action="?action=add">
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
        <li>
          <form method="post" action="?action=delete">
            <input name="del_id" type="hidden" value="<?= $post->id ?>">
            <button>削除</button>
          </form>
        </li>
    </ul>
  <?php endforeach; ?>
</body>
</html>