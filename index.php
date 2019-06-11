<!DOCTYPE html>
<?php
    session_start();
?>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/styles.css" />
        <link rel="stylesheet" href="css/home.css" />
        <title>Battlewatch</title>
    </head>

<body>

<?php include('includes/header.php') ?>

<div class="row">
    <div id="title-card">
        Battlewatch
    </div>

    <div id="site-brief">
        A truly epic 1v1 fight simulator.
    </div>
</div>

<div class="row">
    <div class="top-3">
        <div class="top-3-box" id="front-page-most-kills">
            <div class="top-3-header">Top Kills</div>
            <div class="top-3-row number-one" id="kills-1">
                <div class="top-3-label-1">#1</div>
                <div id="most-kills-name-1"></div>
                <div id="most-kills-kills-1"></div>
            </div>
            <div class="top-3-row number-two" id="kills-2">
                <div class="top-3-label-2">#2</div>
                <div id="most-kills-name-2"></div>
                <div id="most-kills-kills-2"></div>
            </div>
            <div class="top-3-row number-three" id="kills-3">
                <div class="top-3-label-3">#3</div>
                <div id="most-kills-name-3"></div>
                <div id="most-kills-kills-3"></div>
            </div>
        </div>
    </div>

    <div class="top-3">
        <div class="top-3-box" id="front-page-highest-level">
            <div class="top-3-header">Highest Level</div>
            <div class="top-3-row number-one" id="level-1">
                <div class="top-3-label-1">#1</div>
                <div id="highest-level-name-1"></div>
                <div id="highest-level-level-1"></div>
            </div>
            <div class="top-3-row number-two" id="level-2">
                <div class="top-3-label-2">#2</div>
                <div id="highest-level-name-2"></div>
                <div id="highest-level-level-2"></div>
            </div>
            <div class="top-3-row number-three" id="level-3">
                <div class="top-3-label-3">#3</div>
                <div id="highest-level-name-3"></div>
                <div id="highest-level-level-3"></div>
            </div>
        </div>
    </div>
</div>


<script>
    
    window.onload = function() {
        getMostKills();
        getHighestLevel();
    }

    function getMostKills() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var obj = JSON.parse(this.responseText);
                fillMostKills(obj);
            }
        };
        xhttp.open("GET", "server/getMostKills.php", true);
        xhttp.send();
    }

    function getHighestLevel() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var obj = JSON.parse(this.responseText);
                fillHighestLevel(obj);
            }
        };
        xhttp.open("GET", "server/getHighestLevel.php", true);
        xhttp.send();
    }

    function fillMostKills(obj) {
        var nameOne = document.getElementById("most-kills-name-1");
        var nameTwo = document.getElementById("most-kills-name-2");
        var nameThree = document.getElementById("most-kills-name-3");
        var killsOne = document.getElementById("most-kills-kills-1");
        var killsTwo = document.getElementById("most-kills-kills-2");
        var killsThree = document.getElementById("most-kills-kills-3");

        nameOne.innerText = obj[0].name;
        nameTwo.innerText = obj[1].name;
        nameThree.innerText = obj[2].name;
        killsOne.innerText = obj[0].kills;
        killsTwo.innerText = obj[1].kills;
        killsThree.innerText = obj[2].kills;
    }

    function fillHighestLevel(obj) {
        var nameOne = document.getElementById("highest-level-name-1");
        var nameTwo = document.getElementById("highest-level-name-2");
        var nameThree = document.getElementById("highest-level-name-3");
        var levelOne = document.getElementById("highest-level-level-1");
        var levelTwo = document.getElementById("highest-level-level-2");
        var levelThree = document.getElementById("highest-level-level-3");

        nameOne.innerText = obj[0].name;
        nameTwo.innerText = obj[1].name;
        nameThree.innerText = obj[2].name;
        levelOne.innerText = obj[0].level;
        levelTwo.innerText = obj[1].level;
        levelThree.innerText = obj[2].level;
    }
    
</script>

</body>

</html>
