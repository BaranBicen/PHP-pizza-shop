<?php
require_once 'connection.php';
if (!isset($_SESSION["id"])) {
    header("Location:login.php");
    exit();
}
if (isset($_GET["method"])) {
    $method = $_GET["method"];
    if ($method == "one") {

        if (isset($_GET["pizzaid"])) {
            $pizza_id = $_GET["pizzaid"];

            $baskets = $db->prepare("DELETE FROM `basket` where userid=:userid AND pizza_id=:pizza_id");
            $baskets->execute(["userid" => $_SESSION["id"], "pizza_id" => $pizza_id]);
        }


    } elseif ($method == "all") {
        $baskets = $db->prepare("DELETE FROM `basket` where userid=:userid");
        $baskets->execute(["userid" => $_SESSION["id"]]);
    }
    header("Location:basket.php");
}