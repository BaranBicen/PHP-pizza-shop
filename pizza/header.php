<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Pizzaria</title>
    <style>
    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    </style>
</head>

<body>
    <?php
    $PAGEURL = explode("/", $_SERVER["REQUEST_URI"])[2];
    ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/pizza">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $PAGEURL == "" ? "active" : ""; ?> " aria-current="page"
                            href="/pizza">Home</a>
                    </li>
                    <!--  
                    <li class="nav-item">
                        <a class="nav-link <?php echo $PAGEURL == "help.php" ? "active" : ""; ?> " href="#">Help</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link <?php echo $PAGEURL == "contact.php" ? "active" : ""; ?> "
                            href="#">Contact</a>
                    </li> -->
                    <?php
                    if (isset($_SESSION["id"])) { ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $PAGEURL == "basket.php" ? "active" : ""; ?> "
                            href="basket.php">Sepet
                            <!-- <i class="fa-solid fa-cart-shopping"></i> -->
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo $PAGEURL == "profile.php" ? "active" : ""; ?>"
                            href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="loginapplication.php?method=logout">Logout</a>
                    </li>
                    <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <?php } ?>
                    <!--
                    <li class="nav-item">
                        <a class="nav-link " href="#">
                            <i class="fa-solid fa-cart-shopping" data-bs-toggle="modal"
                                data-bs-target="#exampleModal"></i>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </li>-->
                </ul>
            </div>
        </div>
    </nav>