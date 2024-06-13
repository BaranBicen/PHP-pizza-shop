<?php
session_start();
try {

    $db = new PDO("mysql:host=localhost;dbname=pizza;charset=utf8", 'root', '');



} catch (PDOExpception $e) {

    echo $e->getMessage();

}

?>