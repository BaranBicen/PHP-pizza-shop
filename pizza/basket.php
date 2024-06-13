<?php
require_once 'connection.php';
if (!isset($_SESSION["id"])) {
    header("Location:login.php");
    exit();
}
// Pizza bilgilerini veritabanından çekmek için PDO prepare ve execute metotlarını kullanıyoruz
$baskets = $db->prepare("SELECT * FROM `basket` where userid=:userid");
$baskets->execute(["userid" => $_SESSION["id"]]);
$basket = $baskets->fetchAll(PDO::FETCH_ASSOC);

include "header.php";
?>
<link rel="stylesheet" href="css/basket.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<style>
#addressInput {
    width: 100%;
    height: 20vh;
}
</style>
<div class="container padding-bottom-3x mb-1">
    <!-- Alert-->
    <div class="alert alert-info alert-dismissible fade show text-center" style="margin-bottom: 30px;">
        <span class="alert-close" data-dismiss="alert">
        </span>
    </div>
    <!-- Shopping Cart-->
    <div class="table-responsive shopping-cart">
        <?php if (count($basket) > 0) { ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Subtotal</th>
                    <th class="text-center">Discount</th>
                    <th class="text-center"><a class="btn btn-sm btn-outline-danger"
                            href="deletetobasket.php?method=all">Clear Cart</a></th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $tottalPrice = 0;

                    foreach ($basket as $basket1) { ?>
                <?php $pizza = $db->prepare("SELECT * FROM `pizzas` where pizza_id=:pizza_id");
                        $pizza->execute(["pizza_id" => $basket1["pizza_id"]]);
                        $pizza = $pizza->fetch(PDO::FETCH_ASSOC);
                        ?>
                <tr>
                    <td>
                        <div class="product-item">
                            <a class="product-thumb" href="#"><img src="images/<?php echo $pizza["pizza_image"] ?>"
                                    alt="Product">
                            </a>

                            <div class="product-info">
                                <h4 class="product-title">
                                    <a href="#"><?php echo $pizza["pizza_name"] ?></a>
                                </h4>
                                <span>
                                    <em>Description:</em>
                                    <?php echo $pizza["pizza_description"] ?>
                                </span>

                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <!--
                            <div class="count-input">
                                <select class="form-control">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        -->
                        <p><?php echo $basket1["count"] ?></p>
                    </td>
                    <td class="text-center text-lg text-medium"><?php $subPrice = $pizza["pizza_price"] * $basket1["count"];
                            $tottalPrice += $subPrice;
                            echo $subPrice ?>
                        ₺
                    </td>
                    <td class="text-center text-lg text-medium"><?php echo $pizza["pizza_price"] ?> ₺</td>
                    <td class="text-center">
                        <a class="remove-from-cart"
                            href="deletetobasket.php?method=one&pizzaid=<?php echo $basket1["pizza_id"] ?>"
                            data-toggle="tooltip" title="" data-original-title="Remove item">
                            <i class="fa fa-trash">
                            </i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="shopping-cart-footer">
        <!--<div class="column">
            <form class="coupon-form" method="post">
                <input class="form-control form-control-sm" type="text" placeholder="Coupon code" required="">
                <button class="btn btn-outline-primary btn-sm" type="submit">Apply Coupon</button>
            </form>
        </div>-->
        <div class="column text-lg">Subtotal: <span class="text-medium"><?php echo $tottalPrice; ?> ₺</span></div>
    </div>
    <?php } else {
            echo "<div> Sepetinizde Ürün Bulunamadı </div>";
        } ?>
    <div class="shopping-cart-footer">
        <div class="column"><a class="btn btn-outline-secondary" href="/pizza"><i class="icon-arrow-left"></i>&nbsp;Back
                to
                Shopping</a></div>
        <div class="column">
            <!-- <a class="btn btn-primary" href="#" data-toast="" data-toast-type="success" data-toast-position="topRight"
                data-toast-icon="icon-circle-check" data-toast-title="Your cart"
                data-toast-message="is updated successfully!">Update Cart</a>-->
            <a class="btn btn-success" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Checkout</a>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Sipariş Adresi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="order.php" method="POST">
                <div class="modal-body">
                    <textarea name="address" id="addressInput" placeholder="Lütfen adresinizi giriniz.."
                        required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Siparişi Onayla</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include "footer.php" ?>