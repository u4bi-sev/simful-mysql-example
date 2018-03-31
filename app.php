<?php

require_once 'vendor/SimFul.php';
require_once 'config/db.php';

$app = new SimFul();

$db = new db();
$db = $db->connect();


$app -> get('/users', function ($req, $resp) {

    $sql = 'SELECT * FROM user';

    try {

        global $db;

        $sth = $db->prepare($sql);
        $sth->execute();

        $users = $sth->fetchAll(PDO::FETCH_OBJ);

        echo json_encode($users, JSON_UNESCAPED_UNICODE);

    } catch(PDOEception $e) {
        echo '{ "error" : { "text" : ' . $e->getMessage() . ' }';
    }

});



$app -> get('/user/:id', function ($req, $resp) {

    $id = $req['params']['id'];

    $sql = 'SELECT * FROM user WHERE id = :id';

    try {

        global $db;

        $sth = $db->prepare($sql);

        $sth->bindParam(':id', $id);

        $sth->execute();

        $user = $sth->fetch(PDO::FETCH_OBJ);

        echo json_encode($user, JSON_UNESCAPED_UNICODE);

    } catch(PDOEception $e) {
        echo '{ "error" : { "text" : ' . $e->getMessage() . ' }';
    }

});



$app -> post('/user', function ($req, $resp) {

    $name = $req['body']['name'];
    $pay = $req['body']['pay'];
    $age = $req['body']['age'];

    $sql = 'INSERT INTO user (name, pay, age) VALUES(:name, :pay, :age)';

    try {

        global $db;

        $sth = $db->prepare($sql);

        $sth->bindParam(':name', $name);
        $sth->bindParam(':pay', $pay);
        $sth->bindParam(':age', $age);

        $sth->execute();

        echo '{ "notice" : { "text" : "added successfully" }';

    } catch(PDOEception $e) {
        echo '{ "error" : { "text" : ' . $e->getMessage() . ' }';
    }

});



$app -> put('/user/:id', function($req, $resp) {

});



$app -> patch('/user/:id', function($req, $resp) {

});



$app -> delete('/user/:id', function($req, $resp) {

});


$app -> run();

?>