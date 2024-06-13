<?php

require_once 'connection.php';
if (!isset($_SESSION["id"])) {
    header("Location:login.php");
    exit();
}

if (isset($_POST["address"])) {
    $address = $_POST["address"];
    echo $address;
    $addressSQL = $db->prepare("INSERT INTO `address` (address_delivery) VALUES (:address_delivery)");
    $addressSQL->execute(["address_delivery" => $address]);

    $addressSQL = $db->prepare("SELECT * FROM `address` WHERE address_delivery=:address_delivery");
    $addressSQL->execute(["address_delivery" => $address]);
    $addressID = $addressSQL->fetch(PDO::FETCH_ASSOC);

    $basketsql = $db->prepare("SELECT * FROM `basket` where userid=:userid");
    $basketsql->execute(["userid" => $_SESSION["id"]]);
    $baskets = $basketsql->fetchAll(PDO::FETCH_ASSOC);

    $orderSQL = $db->prepare("INSERT INTO `order_table`(`adres_id`, `customer_id`, `delivery`) 
    VALUES (:addressID,:customer_id, FALSE)");
    $orderSQL->execute(["addressID" => $addressID["address_id"], "customer_id" => (int) $_SESSION["id"]]);

    $orderSQL = $db->prepare("SELECT * FROM `order_table` WHERE adres_id=:addressID AND customer_id=:customer_id ORDER BY order_id DESC");
    $orderSQL->execute(["addressID" => $addressID["address_id"], "customer_id" => (int) $_SESSION["id"]]);
    $orderID = $orderSQL->fetch(PDO::FETCH_ASSOC);

    foreach ($baskets as $basket) {
        $pizzaSQL = $db->prepare("SELECT pizza_price FROM `pizzas` WHERE pizza_id=:pizza_id");
        $pizzaSQL->execute(["pizza_id" => $basket["pizza_id"]]);
        $pizza_price = $pizzaSQL->fetch(PDO::FETCH_ASSOC);

        $orderSQL = $db->prepare("INSERT INTO `order2pizza`(`pizza_id`, `order_id`, `count`, `price`) VALUES (:pizzaID,:orderID,:count,:price)");
        $orderSQL->execute([
            "pizzaID" => $basket["pizza_id"],
            "orderID" => (int) $orderID["order_id"],
            "count" => $basket["count"],
            "price" => $pizza_price["pizza_price"],
        ]);
    }
    $basketsql = $db->prepare("DELETE FROM `basket` WHERE userid=:userid");
    $basketsql->execute(["userid" => (int) $_SESSION["id"]]);
    header("Location:orderstatus.php?order=on");

}