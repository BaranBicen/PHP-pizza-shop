<?php
require_once 'connection.php';
if (!isset($_SESSION["id"])) {
    header("Location:login.php");
    exit();
}
include "header.php";
$orderSQL = $db->prepare("SELECT * FROM `order_table` WHERE customer_id=:customer_id ORDER BY order_id DESC");
$orderSQL->execute(["customer_id" => (int) $_SESSION["id"]]);
$orders = $orderSQL->fetchAll(PDO::FETCH_ASSOC);
?>
<section style="width:60%;margin-left:20%;margin-top:10%;">
    <?php if (count($orders) > 0) { ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Sipariş Zamanı</th>
                    <th class="text-center">Durum</th>
                    <th class="text-center">Toplam Tutar</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $tottalPrice = 0;

                foreach ($orders as $order) { ?>
                    <tr>
                        <td class="text-center">
                            <p><?php echo $order["order_time"] ?></p>
                        </td>
                        <td class="text-center text-lg text-medium">
                            <p><?php echo $order["delivery"] ? "<span style='color:green;'>Teslim Edildi</span>" : "<span style='color:red;'>Teslim Edilmedi</span>" ?>
                            </p>
                        </td>

                        <td class="text-center">
                            <?php
                            $order2pizzaSQL = $db->prepare("SELECT sum((count*price)) AS 'totalPrice' FROM `order2pizza` WHERE order_id=:orderid;                                ");
                            $order2pizzaSQL->execute(["orderid" => (int) $order["order_id"]]);
                            $order2pizza = $order2pizzaSQL->fetch(PDO::FETCH_ASSOC);
                            echo $order2pizza["totalPrice"]
                                ?>
                        </td>
                    </tr>
                <?php }
    } ?>
        </tbody>
    </table>
</section>

<?php include "footer.php" ?>