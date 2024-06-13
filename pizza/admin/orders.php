<?php

require_once "nav.php";

$orderSQL = $db->prepare("SELECT order_table.order_id, order_table.order_time,customer.username,address.address_delivery,order_table.delivery,sum(order2pizza.price * order2pizza.count) AS 'toplamTutar' FROM `order_table` 
JOIN customer on customer.customer_id=order_table.customer_id
JOIN address on address.address_id=order_table.adres_id
JOIN  order2pizza on order2pizza.order_id=order_table.order_id
GROUP BY order2pizza.order_id;");
$orderSQL->execute();
$orders = $orderSQL->fetchAll(PDO::FETCH_ASSOC);
?>
<style>
main section {
    display: flex;
    margin-bottom: 1rem
}

.itemName {
    width: 90%;
    height: 2rem;
    line-height: 2rem;
    text-align: center;
}
</style>
<main>
    <section>
        <h2 class="itemName">Orders</h2>
    </section>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Sipariş Zamanı</th>
                <th scope="col">Siparişi Veren Kullanıcı</th>
                <th scope="col">Sipariş Adresi</th>
                <th scope="col">Sipariş Durumu</th>
                <th scope="col">Toplam Sipariş Ücreti</th>
                <th scope="col">Operations</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($orders as $order) {
                ?>
            <tr>
                <th scope="row"><?php echo $i++ ?></th>
                <td><?php echo $order["order_time"] ?></td>
                <td><?php echo $order["username"] ?></td>
                <td><?php echo $order["address_delivery"] ?></td>
                <td><?php echo $order["delivery"] ?></td>
                <td><?php echo $order["toplamTutar"] ?></td>

                <td class="d-flex">
                    <a href="/pizza/admin/seemore.php?id=<?php echo $order["order_id"] ?>"
                        class="btn btn-primary mr-2">See More</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</main>
</body>

</html>