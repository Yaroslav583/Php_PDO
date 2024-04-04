<?php
session_start();

/* @var PDO $pdo */
require 'pdo-config.php';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => md5($_POST['password'])
    ];


    if ($data['name'] === '') {
        $errors['name'] = 'Name required';
    }

    $nameLength = mb_strlen($data['name']);

    if ($nameLength < 3) {
        $errors['name'] = 'The name must be more than 3 characters';
    }
    if ($nameLength > 255) {
        $errors['name'] = 'The name must be less than 255 characters';
    }


    /*
     * EMAIL
     */

    if ($data['email'] === '') {
        $errors['email'] = 'Email required';
    }

    $emailLength = mb_strlen($data['email']);

    if ($emailLength < 3) {
        $errors['email'] = 'The email must be more than 3 characters';
    }
    if ($emailLength > 255) {
        $errors['email'] = 'The email must be less than 255 characters';
    }
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email mast be valid email';
    }
    if (!preg_match('/^\S+@\S+\.\S+$/', $data['email'])) {
        $errors['email'] = 'Email must contain @ and .';
    }

    /*
    * PASSWORD
    */

    if ($data['password'] === '') {
        $errors['password'] = 'Password required';
    }


    if (mb_strlen($data['password']) < 8) {
        $errors['password'] = 'The password must be more than 8 characters';
    }
    if (!preg_match('/^[a-zA-Z0-9]+$/', $data['password'])) {
        $errors['password'] = 'The password must contain letters and numbers';
    }


    if (empty(array_filter($errors))) {

        $_POST['name'] = '';
        $_POST['email'] = '';
        $_POST['password'] = '';

    }
    if (empty($errors)) {
        $sql = "INSERT INTO users(name,email,password) VALUES (:name,:email,:password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);

        $createdSuccess = true;
        $_SESSION['created_success'] = true;

        header('Location: /index.php');
        exit();
    }
    $sql_check_email = "SELECT COUNT(*) FROM users WHERE email = :email";
    $stmt_check_email = $pdo->prepare($sql_check_email);
    $stmt_check_email->execute(['email' => $data['email']]);
    $count = $stmt_check_email->fetchColumn();

    if ($count > 0) {
        $errors['email'] = 'Email already exists';
    }
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
        <a class="btn btn-success" href="index.php">Index</a>
    </div>
</div>
<h1>Create</h1>

<form method="POST" action="create.php">
    <div class="form-group mt-5">
        <label for="name">Name</label>
        <input type="text" class="form-control <?= !empty($errors['name']) ? 'is-invalid' : '' ?>" id="name"
               name="name" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>">
        <div class="invalid-feedback"><?= $errors['name'] ?></div>
    </div>
    <div class="form-group mt-3">
        <label for="email">Email</label>
        <input type="email" class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?>" id="email"
               name="email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
        <div class="invalid-feedback"><?= $errors['email'] ?></div>

    </div>
    <div class="form-group mt-3">
        <label for="password">Password</label>
        <input type="password" class="form-control <?= !empty($errors['password']) ? 'is-invalid' : '' ?>"
               id="password" name="password">
        <div class="invalid-feedback"><?= $errors['password'] ?></div>
    </div>

    <div class="col-12 mt-5">
        <button class="btn btn-primary" type="submit">Create user</button>
    </div>
</form>
</body>
</html>

