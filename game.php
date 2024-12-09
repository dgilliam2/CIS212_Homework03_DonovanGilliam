<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="game.js"></script>
</head>
<body>
<header class="bg-dark text-white py-4 text-center">
    <div class="container">
        <h1>Game</h1>
        <div>
            <a href="index.php" class="btn btn-secondary">Home</a>
            <a href="scores.php" class="btn btn-secondary">Scores</a>
        </div>
    </div>
</header>

<!-- send the score data to database via hidden form - found ajax via searching but not sure how to use that? -->
<form id="sendScore" name="sendScore" method="post">
    <input type="hidden" name="totalClicks" id="totalClicks">
    <input type="hidden" name="clicksPerSecond" id="clicksPerSecond">
</form>

<div class="container mt-4">
    <div class="card border-2 shadow rounded-4 mb-2">
        <div class="card-body text-center">
            <div class="mb-3">
                <p id="clickCounter">Clicks: 0</p>
                <button class="btn btn-primary btn-lg" id ="clickButton" onclick="gameClickButton()" disabled>Click!</button>
                <button class="btn btn-success btn-sm" id="startButton" onclick="gameStart()">Start Game</button>
                <button class="btn btn-danger btn-sm" id="restartButton" onclick="gameRestart()" disabled>Restart</button>
            </div>
        </div>
    </div>
</div>

<?php
require "DBHelper.php";
//only execute if the hidden inputs have values
if (isset($_POST['totalClicks']) && isset($_POST['clicksPerSecond']))
{
    $username = getLoggedInUser();
    $clicktotal = $_POST['totalClicks'];
    $clickspersecond = $_POST['clicksPerSecond'];
    $date = date("m/d/Y");

    if(insertScore($username, $clicktotal, $clickspersecond, $date))
    {
        echo '<script type="text/javascript">
                        alert("Score submitted!");
                  </script>';
    }
    else
    {
        //this should never happen, but just in case
        echo '<script type="text/javascript">
                        alert("Score submission failed.");
                  </script>';
    }
}

?>
</body>
</html>