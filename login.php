<?php
    session_start();
    if (isset($_SESSION["user"])) {
        header("Location: contact.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Naig</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link rel="icon" type="image/png" href="colinIcon.png">
</head>
<body>
    <div class="container mt-3">
    <?php 
        if (isset($_POST["Login"])){
            $email = $_POST["email"];
            $password = $_POST["password"];
                require_once "database.php";
                $sql = "SELECT * FROM naiguser WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($user) {
                    $hashedPassword = $user["password"];
                    if (password_verify($password, $hashedPassword)) {
                        $_SESSION["user"] = "yes";
                        header("Location: contact.php");
                        die();
                    } else {
                        echo "<div class = 'alert alert-danger'> Password does not match </div>";
                    }
                } else {
                    echo "<div class = 'alert alert-danger'> Email does not match </div>";
                }
            }
    ?>

        <form action="login.php" method="post">
            <div class="row jumbotron box8">

                <h5><a href="index.php">Cancel</a></h5>

                <div class="col-sm-12 mx-t3 mb-4">
                    <h2 class="text-center text-info"><b>LOGIN</b></h2>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="col-sm-12">
                    <p class="d-inline">Not registered yet? <a href="registration.php"> Register here</a></p>
                </div>

                <div class="col-sm-12 form-group mb-0">
                    <input type= "submit" class="btn btn-primary float-right" name="Login" value="Login">
                </div>

            </div>
        </form>

    </div>
    <script src="script.js"></script>
</body>
</html>