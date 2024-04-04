<?php

$host = 'db';
$db   = 'php-app';
$user = 'hillel';
$pass = 'secret';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
$pdo = new PDO($dsn, $user, $pass, $opt);


//$data = $pdo->query('SELECT * FROM users')->fetchAll();
//foreach ($data as $row) {
//    echo json_encode($row). "<br/>";
//}

//while ($row = $stmt->fetch())
//{
////    echo json_encode($row). "<br/>";
//}






//$stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
//$stmt->execute(['id' => 7]);
//$data = $stmt->fetchAll();
//
//foreach ($data as $row) {
//    echo json_encode($row). "<br/>";
//}


//$id = $_GET['id'];
//var_dump($id);
//$smtp = $pdo->query("SELECT * FROM users WHERE id = " . $id);
////SELECT * FROM users WHERE id = 2 or 1=1
//$data = $smtp->fetchAll();



//$name = "%test%";
//$stm  = $pdo->prepare("SELECT * FROM users WHERE name LIKE ?");
//$stm->execute([$name]);
//$data = $stm->fetchAll();
//
//foreach ($data as $row) {
//    echo json_encode($row). "<br/>";
//}





//$data = [
//    'name' => 'insert user ' . time(),
//];
//$sql = "INSERT INTO users (name) VALUES (:name)";
//$stmt= $pdo->prepare($sql);
//$stmt->execute($data);







//$data = [
//    'name' => 'updated',
//    'id' => 8
//];
//$stmt= $pdo->prepare("UPDATE users SET name=:name WHERE id=:id");
//$stmt->execute($data);


//$data = [
//    'id' => 5,
//];
//$sql = "DELETE FROM users WHERE id = :id";
//$stmt= $pdo->prepare($sql);
//$stmt->execute($data);

