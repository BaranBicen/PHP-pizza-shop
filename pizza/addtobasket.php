<?php

require_once 'connection.php';

if (isset($_POST['add'])) {
    $nowPizza = $db->prepare("SELECT basketid FROM basket WHERE
pizza_id=:pizza_id AND userid=:userid
");
    // ilgili userda ilgili pizza sepette var ise count ++
    $nowPizza->execute(['pizza_id' => $_POST['pizza_id'], 'userid' => $_SESSION["id"]]);
    if (
        $nowPizza->rowCount() > 0
    ) {
        $kaydet = $db->prepare("UPDATE  basket set count=count + 1 WHERE
    pizza_id=:pizza_id AND
    userid=:userid
    ");
        $insert = $kaydet->execute(
            ['pizza_id' => $_POST['pizza_id'], 'userid' => $_SESSION["id"]]
        );
    } else {
        $kaydet = $db->prepare("INSERT into  basket set
    pizza_id=:pizza_id,
    userid=:userid,
    count=1
    ");
        $insert = $kaydet->execute(
            ['pizza_id' => $_POST['pizza_id'], 'userid' => $_SESSION["id"]]
        );
    }

    header("location:basket.php");



}


















?>