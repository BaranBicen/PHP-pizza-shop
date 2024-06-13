<?php

require_once "nav.php";

if (isset($_POST["deliveredID"])) {
    $pizzaSQL = $db->prepare("UPDATE order_table SET delivery=:delivered WHERE order_id=:id;");
    $pizzaSQL->execute(["id" => $_GET["id"], "delivered" => 1]);
}

$orderSQL = $db->prepare("SELECT order_table.order_id, order_table.order_time,customer.username,order_table.delivery,
sum(order2pizza.price * order2pizza.count) AS 'toplamTutar' FROM `order_table` 
JOIN customer on customer.customer_id=order_table.customer_id
JOIN  order2pizza on order2pizza.order_id=order_table.order_id
WHERE order_table.order_id=:id
GROUP BY order2pizza.order_id;");
$orderSQL->execute(["id" => $_GET["id"]]);
$order = $orderSQL->fetch(PDO::FETCH_ASSOC);

$pizzaSQL = $db->prepare("SELECT order2pizza.count,order2pizza.price,pizzas.pizza_name,order2pizza.count*order2pizza.price
 AS 'subTotal' FROM order2pizza JOIN pizzas on order2pizza.pizza_id=pizzas.pizza_id WHERE order2pizza.order_id=:id;");
$pizzaSQL->execute(["id" => $_GET["id"]]);
$pizzas = $pizzaSQL->fetchAll(PDO::FETCH_ASSOC);

?>
<link rel="stylesheet" href="/pizza/admin/css/seemore.css">
<style>
main {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    position: relative;
}

form {
    width: 50%;
}
</style>
<main>
    <section class="orderDetails">
        <div class="dataDivs">
            <p class="orderLabels">Sipariş ID</p>
            <p class="orderDatas"><?php echo $order["order_id"] ?></p>
        </div>
        <div class="dataDivs">
            <p class="orderLabels">Sipariş Tarihi</p>
            <p class="orderDatas"><?php echo $order["order_time"] ?></p>
        </div>
        <div class="dataDivs">
            <p class="orderLabels">Siparişi Veren Müşteri</p>
            <p class="orderDatas"><?php echo $order["username"] ?></p>
        </div>
        <div class="dataDivs">
            <p class="orderLabels">Sipariş Durumu</p>
            <p class="orderDatas">
                <?php echo $order["delivery"] == 1 ? "Sipariş Teslim Edildi" : "Sipariş Hazırlanıyor"; ?>
            </p>
        </div>
        <div class="dataDivs">
            <p class="orderLabels">Toplam Tutar</p>
            <p class="orderDatas"><?php echo $order["toplamTutar"] ?></p>
        </div>
    </section>
    <form action="" method="post" class="d-flex justify-content-center mt-3 mb-5">
        <input type="hidden" name="deliveredID" value="<?php echo $order["order_id"] ?>">
        <button type="submit" class="btn btn-primary ">Siparişi Tamamla</button>
    </form>
    <section>
        <h2 class="orderPizzasH2">Sipariş İçeriği</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Pizza Adı</th>
                    <th scope="col">Miktar</th>
                    <th scope="col">Pizza Fiyatı</th>
                    <th scope="col">Ara toplam</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($pizzas as $pizza) { ?>
                <tr>
                    <td><?php echo $pizza["pizza_name"]; ?></td>
                    <td><?php echo $pizza["count"]; ?></td>
                    <td><?php echo $pizza["price"]; ?></td>
                    <td><?php echo $pizza["subTotal"]; ?></td>
                </tr>
                <?php } ?>

            </tbody>
        </table>
    </section>
</main>