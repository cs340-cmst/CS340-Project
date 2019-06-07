<!DOCTYPE html>
<?php
    session_start();
?>
<html>

    <head>
        <link rel="stylesheet" href="css/styles.css">
    </head>

<body style="background-color: grey;">

<?php include('includes/header.php') ?>

<div>
    <?php get_Char1Stats(); ?>
    <?php get_Char2Stats(); ?>
    <?php fightTillDeath(); ?>
</div>


</body>
</html>


<?php
    $char1Name = $char1Health = $char1Defense = $char1AttackSp = $char1WeapDam = $char1ArmDef = "";
    $char2Name = $char2Health = $char2Defense = $char2AttackSp = $char2WeapDam = $char2ArmDef = "";
 
    
    function get_Char1Stats(){
        require('includes/dbconnection.php');
        
        $Username = $_SESSION['username'];
        $Charname = 'Fred';  // -- Fred is just for testing -- //
        
        global $char1Name, $char1Health, $char1Defense, $char1AttackSp, $char1WeapDam, $char1ArmDef;
        
        $query = "SELECT * FROM Characters WHERE username = '$Username' AND name = '$Charname'";
        $result = $conn->query($query);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $char1Name = $row["name"];
                $char1Health = $row["health"];
                $char1Defense = $row["defense"];
                $char1AttackSp = $row["attack speed"];
                
                $char1wepID = $row["wID"]; // Will be used in second SQL query
                $char1armID = $row["aID"]; // Will be used in third SQL query
                
                $toINSERT = '<div id = "row">';
                $toINSERT = $toINSERT . '<br>' . $row["name"] . '\'s ';
                $toINSERT = $toINSERT . ' Stats: ';
                $toINSERT = $toINSERT . ' <br> Health  = ';
                $toINSERT = $toINSERT . $row["health"];
                $toINSERT = $toINSERT . ' <br> Defense = ';
                $toINSERT = $toINSERT . $row["defense"];
                $toINSERT = $toINSERT . ' <br> Attack Speed = ';
                $toINSERT = $toINSERT . $row["attack speed"];
                $toINSERT = $toINSERT . '</div>';
                echo $toINSERT;
            }
        } else {
            echo "No Character Selected";
        }
        
        //----------- Weapon SQL ----------- //
        
        $queryWeapon = "SELECT * FROM Weapons WHERE wID = '$char1wepID'";
        $resultWeapon = $conn->query($queryWeapon);
        
        if($resultWeapon->num_rows > 0){
            while($row2 = $resultWeapon->fetch_assoc()){
                $char1WeapDam = $row2["damage"];
            }
        } else {
            echo "No Weapon <br>";
        }
        
        //---------- Armor SQL ----------- //
        
        $queryArmor = "SELECT * FROM ArmorSets WHERE aID = '$char1armID'";
        $resultArmor = $conn->query($queryArmor);
        
        if($resultArmor->num_rows > 0){
            while($row3 = $resultArmor->fetch_assoc()){
                $char1ArmDefa = $row3["helmet"];
                $char1ArmDefb = $row3["chest"];
                $char1ArmDefc = $row3["legs"];
                $char1ArmDefd = $row3["shield"];
            }
        } else {
            echo "No Armor <br>";
        }
        
        //echo "$char1ArmDefa + $char1ArmDefb + $char1ArmDefc + $char1ArmDefd <br> ";
        $char1ArmDef = $char1ArmDefa + $char1ArmDefb + $char1ArmDefc + $char1ArmDefd;
        
        
        
        echo "Attack Damage = $char1WeapDam <br>";
        echo "Armor Defence = $char1ArmDef <br>";
        
    }
    
    
    function get_Char2Stats(){
        require('includes/dbconnection.php');
        
        $Username = $_SESSION['username'];
        $Charname = 'Picard-io';  // -- Picard-io is just for testing -- //
        
        global $char2Name, $char2Health, $char2Defense, $char2AttackSp, $char2WeapDam, $char2ArmDef;
        
        $query = "SELECT * FROM Characters WHERE username = '$Username' AND name = '$Charname'";
        $result = $conn->query($query);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $char2Name = $row["name"];
                $char2Health = $row["health"];
                $char2Defense = $row["defense"];
                $char2AttackSp = $row["attack speed"];
                
                $char2wepID = $row["wID"]; // Will be used in second SQL query
                $char2armID = $row["aID"]; // Will be used in third SQL query
                
                $toINSERT = '<div id = "row">';
                $toINSERT = $toINSERT . '<br>' . $row["name"] . '\'s ';
                $toINSERT = $toINSERT . ' Stats: ';
                $toINSERT = $toINSERT . ' <br> Health  = ';
                $toINSERT = $toINSERT . $row["health"];
                $toINSERT = $toINSERT . ' <br> Defense = ';
                $toINSERT = $toINSERT . $row["defense"];
                $toINSERT = $toINSERT . ' <br> Attack Speed = ';
                $toINSERT = $toINSERT . $row["attack speed"];
                $toINSERT = $toINSERT . '</div>';
                echo $toINSERT;
            }
        } else {
            echo "No Character Selected";
        }
        
        //----------- Weapon SQL ----------- //
        
        $queryWeapon = "SELECT * FROM Weapons WHERE wID = '$char2wepID'";
        $resultWeapon = $conn->query($queryWeapon);
        
        if($resultWeapon->num_rows > 0){
            while($row2 = $resultWeapon->fetch_assoc()){
                $char2WeapDam = $row2["damage"];
            }
        } else {
            echo "No Weapon <br>";
        }
        
        //---------- Armor SQL ----------- //
        
        $queryArmor = "SELECT * FROM ArmorSets WHERE aID = '$char2armID'";
        $resultArmor = $conn->query($queryArmor);
        
        if($resultArmor->num_rows > 0){
            while($row3 = $resultArmor->fetch_assoc()){
                $char2ArmDefa = $row3["helmet"];
                $char2ArmDefb = $row3["chest"];
                $char2ArmDefc = $row3["legs"];
                $char2ArmDefd = $row3["shield"];
            }
        } else {
            echo "No Armor <br>";
        }
        
        //echo "$char2ArmDefa + $char2ArmDefb + $char2ArmDefc + $char2ArmDefd <br> ";
        $char2ArmDef = $char2ArmDefa + $char2ArmDefb + $char2ArmDefc + $char2ArmDefd;
        
        $conn->close(); // Now we are done with the database
        
        echo "Attack Damage = $char2WeapDam <br>";
        echo "Armor Defence = $char2ArmDef <br>";
        
    }
    
    
    function fightTillDeath() {
        global $char1Name, $char1Health, $char1Defense, $char1AttackSp;
        global $char2Name, $char2Health, $char2Defense, $char2AttackSp;
 
        //while ($char1Health > 0 or $char2Health > 0){
            //$char1Health = $char1Health - $char2......
        //}
        
        echo "<br>";
        //echo "$char1Name, $char1Health, $char1Defense, $char1AttackSp, $char2Name, $char2Health, $char2Defense, $char2AttackSp <br>";
        
    }
    

    ?>


