<?php

require_once "nav.php";
if (isset($_POST["pizza_name"])) {
    if (!isset($_FILES['pizza_image']) || $_FILES['pizza_image']['error'] == UPLOAD_ERR_NO_FILE) {

        $orderSQL = $db->prepare("UPDATE pizzas SET pizza_name=:pizzaName,pizza_description=:pizzaDescripe,pizza_price=:pizzaPrice WHERE pizza_id=:pizza_id ");
        $orderSQL->execute([
            "pizzaName" => $_POST["pizza_name"],
            "pizzaDescripe" => $_POST["pizza_description"],
            "pizzaPrice" => $_POST["pizza_price"],
            "pizza_id" => (int) $_GET["id"],
        ]);
        echo '<div class="alert alert-success position-absolute top-0 end-50" role="alert">
           Pizza Başarı İle Güncellendi.
         </div>';
    } else {
        $target_dir = "../images/"; // Dosyanın yükleneceği dizin
        $target_file = hash("sha256", uniqid() . basename($_FILES["pizza_image"]["name"]));
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo(basename($_FILES["pizza_image"]["name"]), PATHINFO_EXTENSION));
        // Dosyanın bir görüntü dosyası olup olmadığını kontrol etme
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["pizza_image"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Dosya boyutunu kontrol etme (Örneğin, 5MB limit)
        if ($_FILES["pizza_image"]["size"] > 5 * 1024 * 1024) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Belirli dosya formatlarına izin verme
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // $uploadOk değeri 0 ise yükleme durdurulacak
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // Her şey yolundaysa, dosya yüklenecek
        } else {
            if (move_uploaded_file($_FILES["pizza_image"]["tmp_name"], $target_dir . $target_file . "." . $imageFileType)) {
                // echo "The file " . htmlspecialchars(basename($_FILES["pizza_image"]["name"])) . " has been uploaded.";
                $orderSQL = $db->prepare("UPDATE pizzas SET pizza_name=:pizzaName,
                pizza_description=:pizzaDescripe,pizza_price=:pizzaPrice,pizza_image=:pizzaImage 
                WHERE pizza_id=:pizza_id");
                $orderSQL->execute([
                    "pizzaName" => $_POST["pizza_name"],
                    "pizzaDescripe" => $_POST["pizza_description"],
                    "pizzaPrice" => $_POST["pizza_price"],
                    "pizzaImage" => $target_file . "." . $imageFileType,
                    "pizza_id" => $_GET["id"]
                ]);
                echo '<div class="alert alert-success position-absolute top-0 end-50" role="alert">
                Pizza Başarı İle Güncellendi.
              </div>';
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}
$pizzaSQL = $db->prepare("SELECT * FROM pizzas WHERE pizza_id=:pizza_id");
$pizzaSQL->execute(["pizza_id" => (int) $_GET["id"]]);
$pizza = $pizzaSQL->fetch(PDO::FETCH_ASSOC);

?>
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
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Pizza Name</label>
            <input type="text" class="form-control" name="pizza_name" required
                value="<?php echo $pizza["pizza_name"]; ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Pizza Description</label>
            <textarea class="form-control" name="pizza_description"
                required><?php echo $pizza["pizza_description"]; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Pizza Price</label>
            <input type="number" class="form-control" name="pizza_price" required
                value="<?php echo $pizza["pizza_price"]; ?>">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Pizza Image</label>
            <input type="file" name="pizza_image" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <img src="/pizza/images/<?php echo $pizza["pizza_image"]; ?>" alt="" style="width:20%;">
</main>