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
    $char1Name = $char1Health = $char1Defense = $char1AttackSp = $char1WeapDam = $char1ArmDef = $char1wepID = $char1armID = "";
    $char2Name = $char2Health = $char2Defense = $char2AttackSp = $char2WeapDam = $char2ArmDef = $char2wepID = $char2armID = "";
 
    
    function get_Char1Stats(){
        require('includes/dbconnection.php');
        $Username = $_SESSION['username'];
        $Charname = 'Fred';  //Fred is just for testing
        
        global $char1Name, $char1Health, $char1Defense, $char1AttackSp, $char1WeapDam, $char1ArmDef, $weapID, $armID;
        
        $query = "SELECT * FROM Characters WHERE username = '$Username' AND name ='$Charname'";
        $result = $conn->query($query);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $char1Name = $row["name"];
                $char1Health = $row["health"];
                $char1Defense = $row["defense"];
                $char1AttackSp = $row["attack speed"];
                
                $char1wepID = $row["wID"];
                $char1armID = $row["aID"];
                
                $toINSERT = '<div id = "row">';
                $toINSERT = $toINSERT . '<br>' . $row["name"];
                $toINSERT = $toINSERT .' <br> Stats: ';
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
        $conn->close();
        
        echo "$char1Name, $char1Health, $char1Defense, $char1AttackSp, $char1wepID, $char1armID <br>";
        
        getWeaponDamage($char1wepID);
        
        echo "$char1Name, $char1Health, $char1Defense, $char1AttackSp, $char1WeapDam, $char1ArmDef <br>";
        
    }
    
    
    function get_Char2Stats(){
        require('includes/dbconnection.php');
        $Username = $_SESSION['username'];
        $Charname = 'Picard-io';  //Picard-io is just for testing
        
        global $char2Name, $char2Health, $char2Defense, $char2AttackSp;
        
        $query = "SELECT * FROM Characters WHERE username = '$Username' AND name='$Charname'";
        $result = $conn->query($query);
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $char2Name = $row["name"];
                $char2Health = $row["health"];
                $char2Defense = $row["defense"];
                $char2AttackSp = $row["attack speed"];
                
                $toINSERT = '<div id = "row">';
                $toINSERT = $toINSERT . '<br>' . $row["name"];
                $toINSERT = $toINSERT .' <br> Stats: ';
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
        $conn->close();
    }
    
    
    
    function getWeaponDamages(){
        require('includes/dbconnection.php');
        global $char1WeapDam, $char1wepID;
        
        echo "This is weapon id: $char1wepID";
        
        $query = "SELECT * FROM Weapons WHERE wID = '$char1wepID'";
        $result = $conn->query($query);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $char1WeapDam = $row["damage"];
            }
        } else {
            echo "No Weapon <br>";
        }
        
        echo "This is weapon Dam: $char1WeapDam";
        
        $conn->close();
        
    }
    
    
    
    
    function fightTillDeath() {
        global $char1Name, $char1Health, $char1Defense, $char1AttackSp;
        global $char2Name, $char2Health, $char2Defense, $char2AttackSp;
 
        //while ($char1Health > 0 or $char2Health > 0){
            //$char1Health = $char1Health - $char2......
        //}
        
        echo "<br>";
        echo "$char1Name, $char1Health, $char1Defense, $char1AttackSp, $char2Name, $char2Health, $char2Defense, $char2AttackSp <br>";
        
    }
    

    ?>


