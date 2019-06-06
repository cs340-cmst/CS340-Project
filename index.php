<!DOCTYPE html>
<?php
    session_start();
?>
<html>

    <head>
        <link rel="stylesheet" href="css/styles.css" />
        <link rel="stylesheet" href="css/home.css" />
        <title>Battlewatch</title>
    </head>

<body>

<?php include('includes/header.php') ?>

<div class="column">
    .
</div>

<div class="column">
    <div id="title-card">
        Battlewatch
    </div>

    <div id="site-brief">
        A turn based 1v1 fight simulator.
    </div>
</div>

<div class="column">
    <div id="top-3-boxes">
        <div class="top-3-box" id="front-page-most-kills">
            <div id="top-kills">Top Kills</div>
            <div id="most-kills-1"></div>
            <div id="most-kills-2"></div>
            <div id="most-kills-3"></div>
        </div>

        <div class="top-3-box" id="front-page-highest-level">
            <div id="highest-level">Highest Level</div>
            <div id="level-1"></div>
            <div id="level-2"></div>
            <div id="level-3"></div>
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
        var one = document.getElementById("most-kills-1");
        var two = document.getElementById("most-kills-2");
        var three = document.getElementById("most-kills-3");

        one.innerText = "1. " + obj[0].name + " " + obj[0].kills + " kills";
        two.innerText = "2. " + obj[1].name + " " + obj[1].kills + " kills";
        three.innerText = "3. " + obj[2].name + " " + obj[2].kills + " kills";
    }

    function fillHighestLevel(obj) {
        var one = document.getElementById("level-1");
        var two = document.getElementById("level-2");
        var three = document.getElementById("level-3");

        one.innerText = "1. " + obj[0].name + " " + "Level: " + obj[0].level;
        two.innerText = "2. " + obj[1].name + " " + "Level: " + obj[1].level;
        three.innerText = "3. " + obj[2].name + " " + "Level: " + obj[2].level;
    }
    
</script>

</body>

</html>