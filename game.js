var numClicks = 0;
var gameTimer;

function gameStart()
{
    document.getElementById("clickButton").disabled = false;
    document.getElementById("startButton").disabled = true;

    gameTimer = setInterval(function ()
        {
            document.getElementById("clickButton").disabled = true;
            document.getElementById("restartButton").disabled = false;
            clearInterval(gameTimer);
            alert("Game finished. # of clicks: " + numClicks +". Clicks per second: " + calcClicksPerSecond())
            sendDataToInputs()
        }, 5000)
}

function gameRestart()
{
    numClicks = 0;
    clickCounterUpdate()
    gameStart()
}
function gameClickButton()
{
    numClicks++;
    clickCounterUpdate();
}

function clickCounterUpdate()
{
    document.getElementById("clickCounter").innerText = "Clicks: " + numClicks;
}

function calcClicksPerSecond()
{
    // replaces characters in string with empty, then parses the number as an int
    let numClicks = parseInt(document.getElementById("clickCounter").innerText.replace(/\D/g, ""))
    // # of clicks divided by 5 seconds
    return (numClicks / 5);
}

function sendDataToInputs()
{
    document.getElementById("totalClicks").value = parseInt(document.getElementById("clickCounter").innerText.replace(/\D/g, ""));
    document.getElementById("clicksPerSecond").value = calcClicksPerSecond();

    document.getElementById("sendScore").submit();
}