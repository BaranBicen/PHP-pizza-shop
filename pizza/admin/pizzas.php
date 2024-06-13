<?php

require_once "nav.php";

if (isset($_POST["delete"])) {
    $id = $_POST["delete"];
    $sql = "DELETE FROM `pizzas` WHERE pizza_id=:pizza_id";

    $pizzaSQL = $db->prepare($sql);
    $pizzaSQL->execute(["pizza_id" => $id]);
}

$pizzaSQL = $db->prepare("SELECT * FROM `pizzas`");
$pizzaSQL->execute();
$pizzas = $pizzaSQL->fetchAll(PDO::FETCH_ASSOC);
?>
<style>
    .pizzaImage {
        width: 100px;
    }

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
        <h2 class="itemName">Pizzas</h2><a href="/pizza/admin/addpizza.php" class="addItem btn btn-success">+</a>
    </section>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pizza Resim</th>
                <th scope="col">Pizza adı</th>
                <th scope="col">Pizza Açıklama</th>
                <th scope="col">pizza Fiyatı</th>
                <th scope="col">Operations</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach ($pizzas as $pizza) {
                ?>
                <tr>
                    <th scope="row"><?php echo $i++ ?></th>
                    <td><img src="../images/<?php echo $pizza["pizza_image"] ?>" alt="" class="pizzaImage"></td>
                    <td><?php echo $pizza["pizza_name"] ?></td>
                    <td><?php echo $pizza["pizza_description"] ?></td>
                    <td><?php echo $pizza["pizza_price"] ?></td>
                    <td class="d-flex">
                        <button class="btn btn-danger mr-2" data-bs-toggle="modal" data-bs-target="#exampleModal"
                            data-id="<?php echo $pizza["pizza_id"] ?>" onclick="setModalData(this)">Delete</button>
                        <a href="/pizza/admin/updatepizza.php?id=<?php echo $pizza["pizza_id"] ?>"
                            class="btn btn-warning">Update</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Pizzayı silme</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <p>Bu pizzayı silmek istediğinize emin misiniz?<br>Bu işlem Geri alınamaz</p>
                <div class="modal-footer">
                    <input type="hidden" name="delete" value="" id="deleteModalDeleteHiddenIDInput">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">KAPAT</button>
                    <button type="submit" class="btn btn-primary">Pizzayı Sil</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function setModalData(element) {
        let dataID = element.getAttribute("data-id");
        console.log(dataID);
        document.getElementById("deleteModalDeleteHiddenIDInput").setAttribute("value", dataID);
    }
</script>
</body>

</html>