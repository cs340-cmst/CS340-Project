<!DOCTYPE html>
<?php
    session_start();
?>
<html>

    <head>
        <link rel="stylesheet" href="css/styles.css">
    </head>

<?php include('includes/header.php') ?>

<?php
    $Arena = "";
    $Arena = $_SESSION['mapName'];
    
    $map_Name = "http://web.engr.oregonstate.edu/~pemblec/CS340-Project/assets/arena-";
    $map_Name .= $Arena;
    $map_Name .= ".jpg";
    //echo $map_Name;
    
    $map = "<body background=";
    $map .= $map_Name;
    echo $map;
?>

<div class="row">

    <div class="column" style="background-color: rgba(235, 235, 235, .5);" >
        <?php get_Char1Stats(); ?>
    </div>

    <div class="column" style="background-color: rgba(235, 235, 235, .4);" >
        <?php get_Char2Stats(); ?>
    </div>

    <div style="background-color: rgba(235, 235, 235, .3);" >
        <?php fightTillDeath(); ?>
    </div>

</div>



</body>
</html>


<?php
    $char1ID = $char1Name = $char1Health = $char1Defense = $char1AttackSp = $char1WeapDam = $char1ArmDef = "";
    $char2ID =$char2Name = $char2Health = $char2Defense = $char2AttackSp = $char2WeapDam = $char2ArmDef = "";
    $Winner = $Loser = "";
    $NoChar1 = $NoChar2 = 0;
    
    function get_Char1Stats(){
        require('includes/dbconnection.php');
        
        //$CharID = '3';          // -- Godd Howard is just for testing -- //
        $CharID = $_POST['character'];
        $user = $_SESSION['username'];
        
        global $char1ID, $char1Name, $char1Health, $char1Defense, $char1AttackSp, $char1WeapDam, $char1ArmDef, $NoChar1;
        
        $query = "SELECT * FROM Characters WHERE name = '$CharID' and username = '$user'";
        //$query = "SELECT * FROM Characters WHERE name = '$CharID'";
        $result = $conn->query($query);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $char1ID = $row["cID"];
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
            echo "No Character Selected <br> ";
            $NoChar1 = 1;
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
        
        //$Username = $_SESSION['username'];
        //$CharID = '11';          // -- Hodor is just for testing -- //
        $CharID = $_SESSION['enemy'];
        
        global $char2ID, $char2Name, $char2Health, $char2Defense, $char2AttackSp, $char2WeapDam, $char2ArmDef, $NoChar2;
        
        $query = "SELECT * FROM Characters WHERE cID = '$CharID'";
        $result = $conn->query($query);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $char2ID = $row["cID"];
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
            echo "No Character Selected <br> ";
            $NoChar2 = 1;
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
        global $char1ID, $char1Name, $char1Health, $char1Defense, $char1AttackSp, $char1WeapDam, $char1ArmDef, $NoChar1;
        global $char2ID, $char2Name, $char2Health, $char2Defense, $char2AttackSp, $char2WeapDam, $char2ArmDef, $NoChar12;
        global $Winner, $Loser;
 
        if($NoChar1 == 0 && $NoChar1 == 0){
        
        while (True){
            
            if($char1AttackSp >= $char2AttackSp){       // Faster attack speed goes first
                
                // Character 1's Turn
                if($char2ArmDef >= $char1WeapDam){
                    $char2ArmDef = $char2ArmDef - ($char1WeapDam);       // Ware on the armor
                }
                else{
                    $char2Health = $char2Health - $char1WeapDam;          // When armor is broken, do damage
                    if($char2Health <= 0){
                        echo "<b> <center> $char1Name Wins!!! </center> </b>";
                        $Winner = $char1ID;
                        $Loser = $char2ID;
                        break;
                    }
                }
                
                // Character 2's Turn
                if($char1ArmDef >= $char2WeapDam){
                    $char1ArmDef = $char1ArmDef - ($char2WeapDam);       // Ware on the armor
                }
                else{
                    $char1Health = $char1Health - $char2WeapDam;          // When armor is broken, do damage
                    if($char1Health <= 0){
                        echo "<b> <center>  $char2Name Wins!!! </center> </b>";
                        $Winner = $char2ID;
                        $Loser = $char1ID;
                        break;
                    }
                }

            }
            
            
            else{
                // Character 2's Turn
                if($char1ArmDef >= $char2WeapDam){
                    $char1ArmDef = $char1ArmDef - ($char2WeapDam);       // Ware on the armor
                }
                else{
                    $char1Health = $char1Health - $char2WeapDam;          // When armor is broken, do damage
                    if($char1Health <= 0){
                        echo "<b> <center>  $char2Name Wins!!! </center> </b>";
                        $Winner = $char2ID;
                        $Loser = $char1ID;
                        break;
                    }
                }
                
                // Character 1's Turn
                if($char2ArmDef >= $char1WeapDam){
                    $char2ArmDef = $char2ArmDef - ($char1WeapDam);       // Ware on the armor
                }
                else{
                    $char2Health = $char2Health - $char1WeapDam;          // When armor is broken, do damage
                    if($char2Health <= 0){
                        echo "<b> <center> $char1Name Wins!!!</center> </b>";
                        $Winner = $char1ID;
                        $Loser = $char2ID;
                        break;
                    }
                }
                
                
            }
            
        }
            
        echo "<br> <center> FINAL RESULTS </center> <br>";
        echo "<center> $char1Name : Health = $char1Health, Armor Def = $char1ArmDef <br> $char2Name : Health = $char2Health, Armor Def = $char2ArmDef <br> <br> </center>";
            
            
            updateBattles();
        }
            
        else{
            echo " <br> <center> Missing a Fighter... </center> <br> ";
        }
        
    }
    

    
    function updateBattles(){
        global $Winner, $Loser, $Arena;
        
        require('includes/dbconnection.php');
        $query = "INSERT INTO `Battles` (`bID`,`winner`, `loser`, `arena`) VALUES ('', '$Winner', '$Loser', '$Arena')";
        
        $stmt = mysqli_prepare($conn, $query);
        $result = mysqli_stmt_execute($stmt);
        mysqli_close($conn);
        return $result;
        
    }
    
    
?>
