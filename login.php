<?php
include 'configdb.php';
session_start();
    

?>
<!doctype html>
<html lang="en">
    <head>
        <title>Login</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>
    <style>
        body {
            background-color: #f0f2f5; /* สีพื้นหลัง */
        }
        .login-container {
            margin-top: 100px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .login-header {
            background-color: #4267B2; /* สีพื้นหลังของส่วนหัว */
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 20px;
            text-align: center;
        }
        .btn-facebook {
            background-color: #4267B2;
            color: white;
        }
    </style>
    <body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 login-container">
                <div class="login-header">
                    <h5>Log in HHHHH</h5>
                </div>
                <div class="p-4">
                    <form action="login_checkC.php" method="POST">
                        <input type="text" name="username" class="form-control mb-3" required
                            placeholder="Email or Phone number">
                        <input type="password" name="password" class="form-control mb-3" required
                            placeholder="Password">
                            <?php
                           if(isset($_SESSION['Error'])){
                                echo "<div class='text-danger'>";
                                echo $_SESSION['Error'];
                                session_destroy();
                                echo "</div>";
                            }
                            $_SESSION['Error'] 
                            ?>
                        <input type="submit" name="submit" value="Log In" class="btn btn-facebook w-100">
                    </form>
                   
                </div>
            </div>
        </div>
    </div>





        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
