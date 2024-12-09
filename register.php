<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<header class="bg-dark text-white py-4 text-center">
    <div class="container">
        <h1>Register</h1>
        <div>
            <a href="index.php" class="btn btn-secondary">Home</a>
            <a href="register.php" class="btn btn-primary me-2">Register</a>
            <a href="scores.php" class="btn btn-secondary">Scores</a>
        </div>
    </div>
</header>

<div class="container mt-4">
    <div class="card border-2 shadow rounded-4 mb-2">
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="fname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname" required>
                </div>
                <div class="mb-3">
                    <label for="lname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lname" name="lname" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" name="registerButton" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</div>

<?php
require 'DBHelper.php';

if (isset($_POST['registerButton']))
{
    if (!checkIfUserExists($_POST['username']))
    {
        if (insertUser($_POST['username'], $_POST['fname'], $_POST['lname'],  $_POST['password']))
        {
            echo '<script type="text/javascript">
                        alert("User added.");
                  </script>';

            echo '<script type="text/javascript">
                        window.location.replace("index.php");
                  </script>';
        }
        else
        {
            echo '<script type="text/javascript">
                        alert("Unable to add user?");
                  </script>';
        }
    }
    else
    {
        echo '<script type="text/javascript">
                        alert("User already exists.");
                  </script>';
    }
}
?>
</body>
</html>