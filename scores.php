<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<header class="bg-dark text-white py-4 text-center">
    <div class="container">
        <h1>Scores</h1>
        <div>
            <a href="index.php" class="btn btn-secondary">Home</a>
            <a href="register.php" class="btn btn-secondary">Register</a>
            <a href="scores.php" class="btn btn-primary me-2">Scores</a>
        </div>
    </div>
</header>

<div class="container mt-4">
    <div class="card border-2 shadow rounded-4 mb-2">
        <div class="card-body">
            <form method="post" class="mb-3">
                <button type="submit" name="sortHighScores" class="btn btn-primary"">By Top 10 Highest Scores</button>
                <button type="submit" name="sortLowestScores" class="btn btn-primary"">By Lowest Scores</button>
                <button type="submit" name="sortMyScores" class="btn btn-primary"">My Scores</button>
            </form>
            <table class="table table-dark">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Total Clicks</th>
                    <th>Clicks Per Second</th>
                    <th>Date Achieved</th>
                </tr>
                </thead>
                <tbody id="scoreTable">
                    <?php
                    require 'DBHelper.php';

                    $currentUser = getLoggedInUser();

                    // fill table with top ten scores by default
                    sortByTopTen();

                    if (isset($_POST['sortHighScores']))
                    {
                        //this JS empties out the table on each button press, prevents neq query from being
                        //appended to the default fill
                        echo "<script>document.getElementById('scoreTable').innerHTML = '';</script>";
                        sortByTopTen();
                    }

                    if (isset($_POST['sortLowestScores']))
                    {
                        echo "<script>document.getElementById('scoreTable').innerHTML = '';</script>";
                        sortByLowestScore();
                    }

                    if (isset($_POST['sortMyScores']))
                    {
                        echo "<script>document.getElementById('scoreTable').innerHTML = '';</script>";
                        sortByMyScores($currentUser);
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>