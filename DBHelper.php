<?php
// start session to store logged-in user
session_start();

function connectToDB()
{
    $conn = new mysqli("localhost", "donovan", "password", "clicksite");
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function checkIfUserExists($username): bool
{
    $conn = connectToDB();
    $sql = "SELECT username FROM Users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        return true;
    }
    else {
        return false;
    }
}

function checkEnteredPassword($username, $password): bool
{
    $conn = connectToDB();
    $sql = "SELECT password FROM Users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}

//could not figure out how to get sessionStorage data to PHP in a non-roundabout way, so did this instead
function setLoggedInUser($username)
{
    $_SESSION['username'] = $username;
}

function getLoggedInUser()
{
    return $_SESSION['username'];
}

function insertUser($username, $firstname, $lastname, $password): bool
{
    $conn = connectToDB();
    $sql = "INSERT INTO Users (username, firstname, lastname, password) VALUES ('$username', '$firstname', '$lastname', '$password')";
    if ($conn->query($sql) === TRUE)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function insertScore($username,$clicktotal, $clickspersecond, $date)
{
    $conn = connectToDB();
    $sql = "INSERT INTO Scores (username, clicktotal, clickspersecond, date) VALUES ('$username', $clicktotal, $clickspersecond, '$date')";
    if ($conn->query($sql) === TRUE)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function sortByTopTen()
{
    $conn = connectToDB();
    $sql = "SELECT Users.firstname, Users.lastname, Scores.* FROM Users JOIN Scores ON Users.username = Scores.username ORDER BY clicktotal DESC LIMIT 10";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
        while($row = $result->fetch_assoc())
        {
            echo "<tr>";
            echo "<td>" . $row["firstname"] . "</td>";
            echo "<td>" . $row["lastname"] . "</td>";
            echo "<td>" . $row["clicktotal"] . "</td>";
            echo "<td>" . $row["clickspersecond"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "</tr>";
        }
}

function sortByLowestScore()
{
    $conn = connectToDB();
    $sql = "SELECT Users.firstname, Users.lastname, Scores.* FROM Users JOIN Scores ON Users.username = Scores.username ORDER BY clicktotal ASC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
        while($row = $result->fetch_assoc())
        {
            echo "<tr>";
            echo "<td>" . $row["firstname"] . "</td>";
            echo "<td>" . $row["lastname"] . "</td>";
            echo "<td>" . $row["clicktotal"] . "</td>";
            echo "<td>" . $row["clickspersecond"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "</tr>";
        }
}

function sortByMyScores($username)
{
    $conn = connectToDB();
    $sql = "SELECT Users.firstname, Users.lastname, Scores.* FROM Users JOIN Scores ON Users.username = Scores.username WHERE Scores.username='$username' ORDER BY clicktotal DESC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            echo "<tr>";
            echo "<td>" . $row["firstname"] . "</td>";
            echo "<td>" . $row["lastname"] . "</td>";
            echo "<td>" . $row["clicktotal"] . "</td>";
            echo "<td>" . $row["clickspersecond"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "</tr>";
        }
    }
}
?>