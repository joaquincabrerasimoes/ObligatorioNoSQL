<?php
    require './config/Database.php';

    $db = new Database();

    $db->connect();
    $db->createCollection('Test1');

?>