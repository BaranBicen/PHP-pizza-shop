<?php
require_once 'connection.php';

// Pizza bilgilerini veritabanından çekmek için PDO prepare ve execute metotlarını kullanıyoruz
$slider = $db->prepare("SELECT * FROM `pizzas`");
$slider->execute();


$pizzas = $slider->fetchAll(PDO::FETCH_ASSOC);

include "header.php";

?>
<style>
    .slider {
        width: 100%;
        height: calc(100vh - 80px);
    }

    .sliderImage {
        height: 100%;
    }
</style>
<div class="slider">
    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner slider">
            <div class="carousel-item active sliderImage">
                <img src="images/pizza1.jpg" class="d-block w-100 sliderImage" alt="...">
            </div>
            <div class="carousel-item sliderImage">
                <img src="images/pizza2.jpg" class="d-block w-100 sliderImage" alt="...">
            </div>
            <div class="carousel-item sliderImage">
                <img src="images/pizza3.jpg" class="d-block w-100 sliderImage" alt="...">
            </div>
            <div class="carousel-item sliderImage">
                <img src="images/pizza4.jpg" class="d-block w-100 sliderImage" alt="...">
            </div>
            <div class="carousel-item sliderImage">
                <img src="images/d99c90a1ffcb925c7f60f356e0529c718263f94cb64542b3f236a4afeacf1c67.jpg"
                    class="d-block w-100 sliderImage" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<div class="container  mt-5 mb-5">
    <div class="justify-content-between row row-cols-2 row-cols-lg-5 g-2 g-lg-3">
        <?php foreach ($pizzas as $row) {
            ?>
            <div class="card" style="width: 18rem;">
                <img src="images/<?php echo $row["pizza_image"] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"> <?php echo $row["pizza_name"] ?></h5>
                    <p class="card-text"><?php echo $row["pizza_description"] ?></p>
                    <form action="addtobasket.php" method="post">
                        <input type="hidden" name="pizza_id" value="<?php echo $row["pizza_id"]; ?>">
                        <button type="submit" name="add" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>

            <?php
        } ?>
    </div>
</div>


<?php include "footer.php" ?>