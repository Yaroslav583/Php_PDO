<?php

/* @var PDO $pdo*/
require 'pdo-config.php';

$id = $_GET['id'] ?? null;


$stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
$stmt->execute(['id' => $id]);
$user = $stmt->fetch();
if (!$user){
    header('Location: /404.php');
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="col-1 mt-3 mb-3">
    <div class="row">
        <a class="btn btn-secondary" href="index.php">Index</a>
    </div>
</div>
<h1>Read</h1>
<h4>ID:  <?php echo $user['id']?></h4>
<h4>NAME:  <?php echo $user['name']?></h4>
<h4>EMAIL:  <?php echo $user['email']?></h4>
<h4>PASSWORD:  <?php echo md5($user['password'])?></h4>
<h4>CREATED_AT:  <?php echo $user['created_at']?></h4>
<h4>UPDATED_AT:  <?php echo $user['updated_at']?></h4>
</body>
</html>
