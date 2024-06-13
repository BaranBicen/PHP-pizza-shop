<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    #forms {
        position: relative;
        width: 100%;
        height: 100%;
    }

    #login {
        width: 100%;
        position: absolute;
        z-index: 2;
    }

    .panel {
        position: absolute;
        z-index: 1;
        width: 100%;
        height: 100%;
        background-color: white;
    }


    #signin {
        width: 100%;
        position: absolute;
        z-index: 0;
    }

    #tasformer {
        position: absolute;
        z-index: -99;
        visibility: visible;
    }

    #tasformer:checked~#signin {
        z-index: 2;
    }

    #tasformer:checked+#login {
        z-index: 0;
    }

    label {
        cursor: pointer;
    }

    button {
        min-width: 30%;
    }
</style>

<body>
    <?php
    session_start();
    if (isset($_GET['durum'])) {
        if ($_GET["durum"] == "no") {
            echo '<div class="alert alert-danger" role="alert">
  GİRİŞ Başarısız
</div>';
        } elseif ($_GET['durum'] == '1') {
            echo '<div class="alert alert-danger" role="alert">
            Bu kullanıcı adına sahip başka bir kullanıcı mevcuttur.
          </div>';
        }


    }
    if (isset($_SESSION["id"])) {
        header("Refresh:2;url=index.php");
        echo "<div> You Are Loggined </div>";
        exit();
    }
    ?>
    <div id="forms">
        <input type="checkbox" name="tasformer" id="tasformer" <?php echo (isset($_GET['durum']) && $_GET["durum"] == '1') ? "checked" : ""; ?>>
        <div id="login">
            <h3 class="text-center text-white pt-5">Login form</h3>
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" action="loginapplication.php" method="post">
                                <h3 class="text-center text-info">Login</h3>
                                <div class="form-group">
                                    <label for="username" class="text-info">Username:</label><br>
                                    <input type="text" name="username" id="username" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-info">Password:</label><br>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                <button type="submit" name="login" class="btn btn-primary">Login</button>
                                <label for="tasformer">Hesap oluşturun</label>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel"> </div>
        <div id="signin">
            <h3 class="text-center text-white pt-5">Sign-in form</h3>
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">
                            <form id="login-form" class="form" action="loginapplication.php?method=signin"
                                method="post">
                                <h3 class="text-center text-info">Sign-in</h3>
                                <div class="form-group">
                                    <label for="username" class="text-info">Username:</label><br>
                                    <input type="text" name="username" id="username" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-info">Password:</label><br>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                                <button type="submit" name="sign-in" class="btn btn-primary">Sign-in</button>
                                <label for="tasformer">Hesabınıza Giriş Yapın</label>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>