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



$app -> get('/user/:id', function($req, $resp) {
    
});



$app -> post('/user', function($req, $resp) {

});



$app -> put('/user/:id', function($req, $resp) {

});



$app -> patch('/user/:id', function($req, $resp) {

});



$app -> delete('/user/:id', function($req, $resp) {

});


$app -> run();

?>