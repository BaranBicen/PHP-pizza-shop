<?php

require_once 'connection.php';

if (isset($_POST['login'])) {
    session_start();
    $mail = $_POST["username"];
    $sifre = $_POST["password"];

    // Veritabanı sorgusunu düzeltelim
    $questening = $db->prepare('SELECT * FROM customer WHERE username=:username AND password=:password');
    $questening->execute([
        "username" => $mail,
        "password" => $sifre
    ]);
    $count = $questening->rowCount();
    $outcomes = $questening->fetch(PDO::FETCH_ASSOC);

    if ($count == 1) {
        $_SESSION['username'] = $outcomes["username"];
        $_SESSION['id'] = $outcomes["customer_id"];
        // Session'a kullanıcı bilgilerini kaydedelim
        // setcookie("msutafa", "mustafa", 10); // Veritabanındaki kullanıcı adını kaydediyoruz
        // set_time_limit(3000);
        header("Location: index.php");
        exit();
    } else {
        header("Location: login.php?durum=no");
        exit();
    }
}
if (isset($_GET["method"])) {
    $method = $_GET["method"];
    if ($method == "logout") {
        if (isset($_SESSION['username'])) {
            unset($_SESSION['username']);
            unset($_SESSION['id']);
            session_destroy();
            header("Location: index.php");
            exit();
        }
    } elseif ($method == "signin") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Veritabanı sorgusunu düzeltelim
        $questening = $db->prepare('SELECT * FROM customer WHERE username= ?');
        $questening->execute([
            $username
        ]);
        $count = $questening->rowCount();
        $outcomes = $questening->fetch(PDO::FETCH_ASSOC);

        if ($count == 1) {
            header("Location: login.php?durum=1");
        }
        $questening = $db->prepare('INSERT INTO customer (username,password) VALUES (:username , :password)');
        $questening->execute([
            "username" => $username,
            "password" => $password
        ]);
        /******************************************* */
        $questening = $db->prepare("SELECT * FROM customer WHERE username = :username AND password = :password ");
        $questening->execute([
            "username" => $username,
            "password" => $password
        ]);
        $count = $questening->rowCount();
        $outcomes = $questening->fetch(PDO::FETCH_ASSOC);

        if ($count == 1) {
            $_SESSION['username'] = $outcomes["username"];
            $_SESSION['id'] = $outcomes["customer_id"];
            header("Location: index.php");
            exit();
        } else {
            header("Location: login.php?durum=no");
            exit();
        }
    }
}
?>