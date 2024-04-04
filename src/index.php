<?php
session_start();

/* @var PDO $pdo */
require 'pdo-config.php';

$users = $pdo->query('SELECT id, name FROM users')->fetchAll();

if (!empty($_SESSION['created_success'])) {
    $message = 'User created success';
    $_SESSION['created_success'] = null;
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


<div class="container">
    <div class="col-6  mt-4 d-flex justify-content-between align-items-center">
        <div class="row">
            <a class="btn btn-primary me-3" href="create.php">create</a>
        </div>
        <?php if (isset($message)):?>
            <div class="col-6">
                <?php echo $message;?>
            </div>
        <?php endif;?>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <th><?php echo $user['id'] ?></th>
                        <th><a href="read.php?id=<?php echo $user['id'] ?>"><?php echo $user['name'] ?></a></th>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
