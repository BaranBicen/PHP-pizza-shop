<?php
require_once 'connection.php';
if (!isset($_SESSION["id"])) {
    header("Location:login.php");
    exit();
}
include "header.php";

if (isset($_GET["method"])) {
    $method = $_GET["method"];
    if ($method == "username") {
        $username = $_POST["username"];

        // Veritabanı sorgusunu düzeltelim
        $questening = $db->prepare('SELECT * FROM customer WHERE username= ?');
        $questening->execute([
            $username
        ]);
        $count = $questening->rowCount();
        $outcomes = $questening->fetch(PDO::FETCH_ASSOC);

        if ($count == 1) {
            header("Location: profile.php?durum=1");
        }
        $questening = $db->prepare('UPDATE  customer SET username=:username WHERE customer_id = :customer_id');
        $questening->execute([
            "username" => $username,
            "customer_id" => $_SESSION["id"]
        ]);
        $_SESSION["username"] = $username;
        header("Location: profile.php?durum=2");
    } else if ($method == "password") {
        $oldpassword = $_POST["oldpassword"];
        $newpassword = $_POST["newpassword"];
        // Veritabanı sorgusunu düzeltelim
        $questening = $db->prepare('UPDATE  customer SET password=:password WHERE customer_id= :customer_id AND password= :oldpassword');
        $questening->execute([
            "password" => $newpassword,
            "customer_id" => $_SESSION["id"],
            "oldpassword" => $oldpassword
        ]);
        header("Location: profile.php?durum=3");
    }



}
if (isset($_GET['durum'])) {
    if ($_GET['durum'] == '1') {
        echo '<div class="alert alert-danger" role="alert">
    Bu kullanıcı adına sahip başka bir kullanıcı mevcuttur.
  </div>';
    }
    if ($_GET['durum'] == '2') {
        echo '<div class="alert alert-success" role="alert">
    Kullanıcı adı başarı ile güncellendi
  </div>';
    }
    if ($_GET['durum'] == '3') {
        echo '<div class="alert alert-success" role="alert">
    Kullanıcı şifresi başarı ile güncellendi
  </div>';
    }
}


?>
<style>
    main {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .profileSections {}

    .profileDataSection {}

    form {
        display: flex;
        flex-direction: column;
    }

    form>div {
        display: flex;
        flex-direction: column;
    }

    #profileNameInput {}

    .profileSaveNameButton {}

    .profilePasswordSection {
        margin-top: 50px;
    }

    #profileOldPasswordInput {}

    #profileNewPasswordInput {}

    .profileSavePasswordButton {}

    .pastorders {
        width: 10%;
        height: 2rem;
        margin-right: 5rem;
        font-size: 1.5rem;
        color: black;
        text-decoration: none;
    }

    .pastorders:hover {
        color: rgb(128, 128, 128);
    }
</style>
<main>
    <section style="width:100%; text-align:end;"><a href="pastorders.php" class="pastorders">Siparişlerim</a></section>

    <br><br>
    <section class="profileSections profileDataSection">
        <form action="profile.php?method=username" method="post" class="form">
            <div class="form-group">
                <input type="text" id="profileNameInput" class=" form-control" name="username"
                    value="<?php echo $_SESSION["username"] ?>">
            </div>
            <button type="submit" class="profileSaveNameButton btn btn-primary mt-3">Save New
                Name</button>
        </form>
    </section>
    <section class="profileSections profilePasswordSection">
        <form action="profile.php?method=password" method="post" class="form">
            <div class="form-group">
                <input type="text" id="profileOldPasswordInput" name="oldpassword" class=" form-control"
                    placeholder="Old Password">
                <input type="text" id="profileNewPasswordInput" name="newpassword" class=" form-control mt-3"
                    placeholder="New Password">
            </div>
            <button type="submit" class="profileSavePasswordButton btn btn-primary mt-3">Save New Password</button>
        </form>
    </section>
    <br><br>

</main>

<?php include "footer.php" ?>