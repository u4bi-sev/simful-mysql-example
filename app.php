<?php

require_once 'vendor/SimFul.php';
require_once 'config/db.php';

$app = new SimFul();

$app -> header('Access-Control-Allow-Origin', '*');

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



$app -> put('/user/:id', function ($req, $resp) {

    $id = $req['params']['id'];

    $name = $req['body']['name'];
    $pay = $req['body']['pay'];
    $age = $req['body']['age'];

    $sql = 'UPDATE user SET name = :name, pay = :pay, age = :age WHERE id = :id';

    try {

        global $db;

        $sth = $db->prepare($sql);

        $sth->bindParam(':id', $id);

        $sth->bindParam(':name', $name);
        $sth->bindParam(':pay', $pay);
        $sth->bindParam(':age', $age);

        $sth->execute();

        echo '{ "notice" : { "text" : "updated successfully" }';

    } catch(PDOEception $e) {
        echo '{ "error" : { "text" : ' . $e->getMessage() . ' }';
    }

});



$app -> patch('/user/:id', function ($req, $resp) {

    $id = $req['params']['id'];

    $sql = 'UPDATE user SET ';

    $sql .= substr(
        array_reduce(
            $bodies = array_map(function($key, $val) { 
                return array('key' => $key, 'val' => $val); 
            }, 
                array_keys($req['body']),
                array_values($req['body'])
            ),
            function($str, $v) {
                return $str .= $v['key'] . '=:' . $v['key'] . ',';
            }
        )
    , 0, -1);

    $sql .= ' WHERE id = :id';

    try {

        global $db;

        $sth = $db->prepare($sql);

        $sth->bindParam(':id', $id);

        foreach ($bodies as $v) {

            $sth->bindParam(':' . $v['key'], $v['val']);

        }

        $sth->execute();

        echo '{ "notice" : { "text" : "assigned successfully" }';

    } catch(PDOEception $e) {
        echo '{ "error" : { "text" : ' . $e->getMessage() . ' }';
    }

});



$app -> delete('/user/:id', function ($req, $resp) {

    $id = $req['params']['id'];

    $sql = 'DELETE FROM user WHERE id = :id';

    try {

        global $db;

        $sth = $db->prepare($sql);

        $sth->bindParam(':id', $id);

        $sth->execute();

        echo '{ "notice" : { "text" : "deleted successfully" }';

    } catch(PDOEception $e) {
        echo '{ "error" : { "text" : ' . $e->getMessage() . ' }';
    }

});


$app -> run();

?>