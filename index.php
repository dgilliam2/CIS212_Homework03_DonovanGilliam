<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<header class="bg-dark text-white py-4 text-center">
    <div class="container">
        <h1>Home</h1>
        <div>
            <a href="index.php" class="btn btn-primary me-2">Home</a>
            <a href="register.php" class="btn btn-secondary">Register</a>
            <a href="scores.php" class="btn btn-secondary">Scores</a>
        </div>
    </div>
</header>

<div class="container mt-4">
    <div class="card border-2 shadow rounded-4 mb-2">
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control"  name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control"  name="password" required>
                </div>
                <button type="submit" name="loginButton" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>

<?php
require "DBHelper.php";

if (isset($_POST['loginButton']))
{
    if (checkIfUserExists($_POST['username']))
    {
        if (checkEnteredPassword($_POST['username'], $_POST['password']))
        {
            $username = $_POST['username'];
            setLoggedInUser($username);
            //ok to use js like this?
            echo '<script type="text/javascript">
                        window.location.replace("game.php");
                  </script>';
        }
        else
        {
            // wrong password
            echo '<script type="text/javascript">
                        alert("Incorrect password.");
                  </script>';
        }
    }
    else
    {
        //username doesn't exist
        echo '<script type="text/javascript">
                        alert("User does not exist.");
                  </script>';
    }
}
?>
</body>
</html>