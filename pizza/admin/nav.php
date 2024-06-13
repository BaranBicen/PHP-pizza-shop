<?php
require_once '../connection.php';
if (!isset($_SESSION["admin"]) && $_SESSION["admin"] != 1) {
    header("Location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza Admin</title>
    <link rel="stylesheet" href="css/nav.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        id="bootstrap-css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <nav>
        <section class="siteName">
            <a href="/pizza/admin/admin.php" class="siteNameH2">Biçen Pizza</a>
        </section>
        <section class="links">
            <!-- <a href="/pizza/admin/users.php" class="linkDivs">Users</a> -->
            <a href="/pizza/admin/pizzas.php" class="linkDivs">Pizzas</a>
            <a href="/pizza/admin/orders.php" class="linkDivs">Orders</a>
        </section>
    </nav>