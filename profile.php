<!DOCTYPE html>
<?php
    session_start();
    // Check that a user is logged in within the $_SESSION variable.
    
    ?>
<html>

<head>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/forms.css" />
</head>

<body background="assets/ProfileBR.jpg" style="background-repeat: no-repeat; background-size: cover; background-color: black;">

<?php include('includes/header.php') ?>

<div id = "row">
    <div id="column">
    <div id = "Profile-title" style="color: white; text-shadow: 2px 2px #191919">
        <h1>Profile Overview</h1>
    </div>
    <div id="column">
        <div id = "stats"><p style="color: white;"> Legend: </p></div> 
        <button class="btn btnH" style="background-color: darkred; width: 60px;"> Hp. </button>
        <button class="btn btnM" style="background-color: lightskyblue; width: 60px;"> Def. </button>
        <button class="btn btnS" style="background-color: green; width: 60px;"> Atk. </button>
        <button class="btn btnX" style="background-color: mediumpurple; width: 60px;"> XP </button>        
    </div>
    </div>
</div>

<div id = "Characters">
<?php getChars(); ?>
</div>

</body>
</html>

<?php
    function getChars(){
        require('includes/dbconnection.php');
        $Username = $_SESSION['username'];
        
        $query = "SELECT * FROM ((Characters INNER JOIN (SELECT name AS wName, wID FROM Weapons) AS weapon ON Characters.wID = weapon.wID) INNER JOIN (SELECT name AS aName, aID FROM ArmorSets) AS armor ON Characters.aID = armor.aID) Where Characters.username = '$Username'";
        
        $result = $conn->query($query);
        
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $aVal = 0;
                $hVal = 0;
                $wVal = 0;
                getVals($aVal, $wVal, $hVal, $row["aID"], $row["wID"]);
                $toINSERT = '<div id="row" style="background-color: rgba(0,0,0,0.5); border: 3px solid black;">';
                $toINSERT = $toINSERT. '<div id="column">';
                $toINSERT = $toINSERT.'<p style="color: white;">';
                $toINSERT = $toINSERT. $row["name"] . '<br>';
                $toINSERT = $toINSERT. 'Weapon:  ' . $row["wName"] . '<br>';
                $toINSERT = $toINSERT. 'Armor:  ' . $row["aName"] . '</p>';    
                $toINSERT = $toINSERT.'</div>';
                $toINSERT = $toINSERT.'<div id="column"><div id = "stats"><p style="color: white;">Stats: <p><button class="btn btnH" style="background-color: darkred; width: 60px;">';
                $toINSERT = $toINSERT . (intval($row["health"]) + $hVal);
                $toINSERT = $toINSERT . '</button> <button class="btn btnM" style="background-color: lightskyblue; width: 60px;">';
                $toINSERT = $toINSERT . (intval($row["defense"]) + $aVal);
                $toINSERT = $toINSERT . '</button> <button class="btn btnS" style="background-color: green; width: 60px;">';
                $toINSERT = $toINSERT . (intval($row["attack speed"]) + $wVal);
                $toINSERT = $toINSERT. '</button>';
                $toINSERT = $toINSERT. '<button class="btn btnX" style="background-color: mediumpurple; width: 80px; left: 20px;">';
                $toINSERT = $toINSERT . $row["xp"];
                $toINSERT = $toINSERT . "/";
                $toINSERT = $toINSERT . $row["xpThreshold"];
                $toINSERT = $toINSERT. '</button></div></div></div>';
                echo $toINSERT;
            }
        } else {
            echo "No Characters to Show";
        }
        
        $conn->close();
    } 

    function getVals(&$aVal, &$wVal, &$hVal, $aID, $wID){
            require('includes/dbconnection.php');
            $query2 = "SELECT * FROM(((SELECT name as wName, damage FROM Weapons WHERE wID = '$wID') as weapon) JOIN ((SELECT * FROM ArmorSets WHERE aID = '$aID') AS armor))";
            $result2 = $conn->query($query2); 
            $row = $result2->fetch_assoc();
            $aVal = intval($row["helmet"]) + intval($row["legs"]) + intval($row["shield"]);
            $wVal = intval($row["damage"]);
            $conn->close();    
    }
    ?>
