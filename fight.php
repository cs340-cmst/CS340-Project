<!DOCTYPE html>
<?php
    session_start();
    ?>
<html>


<head>
<link rel="stylesheet" href="css/styles.css">
</head>

<body>

<?php include('includes/header.php') ?>

</body>

<body>
<h2 class="arena"> ARENA NAME </h2>
<form>
<?php getMap(); ?>
</form>


<div class="row">
<div class="column">
<h1 class="test"> Your Character </h1>
<form>
<?php getChars(); ?>
</form>
</div>

<div class="column">
<h1 class="test"> VS </h1>
<form action="/arena.php" target="_blank" method="POST">
<input type="submit" value="FIGHT" class="block">
</form>
</div>

<div class="column">
<h1 class="test"> Enemy Character </h1>
<form>
<?php getEnemyChar(); ?>
</form>
</div>


</div>



</body>
</html>

<?php
    function getChars(){
        require('includes/dbconnection.php');
        $Username = $_SESSION['username'];
        
        $query = "SELECT * FROM Characters WHERE username = '$Username'";
        
        $result = $conn->query($query);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $toINSERT = '<input type="radio" name="character">';
                $toINSERT = $toINSERT. $row["name"];
                $toINSERT = $toINSERT. '<br>';
                $toINSERT = $toINSERT. 'Health:'. $row["health"]. ' ';
                $toINSERT = $toINSERT. 'Defense:'. $row["defense"]. ' ';
                $toINSERT = $toINSERT. 'Attack Speed:'. $row["attack speed"]. ' ';
                $toINSERT = $toINSERT. 'Level:'. $row["level"]. ' ';
                $toINSERT = $toINSERT. 'cID:'. $row["cID"].'<br>';
                $toINSERT = $toINSERT. '<br>';
                
                echo $toINSERT;
            }
            
            
        } else {
            echo "0 results";
            
        }
        $conn->close();
    }
    
    function getMap(){
        require('includes/dbconnection.php');
        $Username = $_SESSION['username'];
        
        $query = "SELECT * FROM Arenas ORDER BY RAND() LIMIT 1";
        
        $result = $conn->query($query);
        
        $row = $result->fetch_assoc();
        $toINSERT = '<input name = "areanaMap" class="drop" value="'.$row["name"].'">';
        echo $toINSERT;
        
        $conn->close();
        
    }
    
    function getEnemyChar(){
        require('includes/dbconnection.php');
        $Username = $_SESSION['username'];
        
        $query = "SELECT * FROM Characters WHERE username <> '$Username' ORDER BY RAND() LIMIT 1" ;
        
        $result = $conn->query($query);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $toINSERT = '<input name = "enemyCharacter" class="drop" value="'.$row["name"].'">';
            $toINSERT = $toINSERT. '<br>';
            $toINSERT = $toINSERT. 'Health:'. $row["health"]. ' ';
            $toINSERT = $toINSERT. 'Defense:'. $row["defense"]. ' ';
            $toINSERT = $toINSERT. 'Attack Speed:'. $row["attack speed"]. ' ';
            $toINSERT = $toINSERT. 'Level:'. $row["level"]. ' ';
            $toINSERT = $toINSERT. 'cID:'. $row["cID"].'<br>';
            
            echo $toINSERT;
        }
        else {
            echo "no enemies available";
        }
        $conn->close();
        
        
    }
    
    
    
    
    ?>
