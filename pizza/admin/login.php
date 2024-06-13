<?php

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username == "admin" && $password == "admin") {
        session_start();
        $_SESSION['admin'] = 1;
        echo '<div class="alert alert-success" role="alert">
        GİRİŞ
      </div>';
        header("Refresh:2;url=/pizza/admin/admin.php");
    } else {
        echo '<div class="alert alert-danger" role="alert">
  GİRİŞ Başarısız
</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Panel</title>
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
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>

    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="login.php" method="post">
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>