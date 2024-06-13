<?php
require_once 'connection.php';
if (!isset($_SESSION["id"])) {
    header("Location:login.php");
    exit();
}
include "header.php";
?>

<?php echo isset($_GET["order"]) && $_GET["order"] == "on" ? "<h2 width='100%' style='text-align:center;color:green;'> Siparişiniz alınmıştır </h2>" : "" ?>

<?php include "footer.php" ?>