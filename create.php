<!DOCTYPE html>
<?php
    session_start();
    // Check that a user is logged in within the $_SESSION variable.
    
    ?>
<html>

<head>
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/forms.css">
</head>

<body class="body-MK2" onload="CharSheild()">
    
<?php include('includes/header.php') ?>
<div id="Creation-Form">    
<form action="create.php" method="post">
<h1>Character Creation<br><?php echo getNumberChars();?>/5</h1>
<input class="text-box" type="text" name="CharName" maxlength="20" size="20" placeholder="Character Name" required><br>
<select name="CharClass" id="CharClass" class="Drop-Down" style="position: relative;" required>
    <option value="">Select Class</option>
    <option value="1">Warrior</option>
    <option value="2">Mage</option>
    <option value="3">Rogue</option>
    <option value="4">Necromancer</option>
    <option value="5">Priest</option>
</select><br>
<select name="CharWeapon" id="Weapon" class="Drop-Down" style="position: relative;" required>
    <?php getWeapons(); ?>
</select><br>
<select name="CharArmor" id="Armor"  class="Drop-Down" style="position: relative;" required>
    <?php getArmors(); ?>
</select><br>
<input type="submit" class="button" id="subButton" value="Submit" style="position: relative;">
</form>
<?php
    if(isset($_POST['CharName']) && isset($_POST['CharWeapon']) && isset($_POST['CharArmor']) && isset($_POST['CharClass'])){
        $outcome = createCharacter();
        if($outcome){
            echo "<p style=\"color: green\";>Character Created</p>";
        } else {
            echo "<p style=\"color: red\";>Im sorry, something went wrong<p>";
        }
    }
?>

   
</div>  
<script>
    function CharSheild() {
        var charCount = <?php echo getNumberChars();?>;
        var intChar = parseInt(charCount, 10);
        if(intChar < 5){
            document.getElementById("subButton").display = "block";
            document.getElementById("subButton").disabled = false;
        } else {
            document.getElementById("subButton").disabled = true;
            document.getElementById("subButton").value = "Max Chars";
            document.getElementById("subButton").display = "none";
        }
        
    }
</script>    
</body>
</html>
<?php
    function getNumberChars(){
        require('includes/dbconnection.php');
        $Username = $_SESSION['username'];
        
        $query = "SELECT COUNT('name') AS ct FROM Characters WHERE username = '$Username' GROUP BY username";
        
        $result = $conn->query($query);  
        $row = $result->fetch_assoc();
        return $row["ct"];
    }
    function getWeapons(){
        require('includes/dbconnection.php');
        $query = "SELECT * FROM Weapons";
        
        $result = $conn->query($query);  
        
        $toINSERT = '<option value=""> Select Weapon </option>';
        while($row = $result->fetch_assoc()){
            $toINSERT = $toINSERT . '<option value=';
            $toINSERT = $toINSERT . '"';      
            $toINSERT = $toINSERT . $row["wID"];
            $toINSERT = $toINSERT . '">';
            $toINSERT = $toINSERT . $row["name"];
            $toINSERT = $toINSERT . '</option>';
        }
        
        echo $toINSERT;             
        $conn->close();        
    }

    function getArmors(){
        require('includes/dbconnection.php');
        $query = "SELECT * FROM ArmorSets";
        
        $result = $conn->query($query);  
        
        $toINSERT = '<option value=""> Select Armor </option>';
        while($row = $result->fetch_assoc()){
            $toINSERT = $toINSERT . '<option value=';
            $toINSERT = $toINSERT . '"';
            $toINSERT = $toINSERT . $row["aID"];
            $toINSERT = $toINSERT . '">';
            $toINSERT = $toINSERT . $row["name"];
            $toINSERT = $toINSERT . '</option>';
        }
        
        echo $toINSERT;             
        $conn->close();  
    }

    function createCharacter(){
        if(isset($_POST['CharName'])){
            $Username = $_SESSION['username'];
            $CharName = $_POST['CharName'];
            $class = $_POST['CharClass'];
            $aID = $_POST["CharArmor"];
            $wID = $_POST["CharWeapon"]; 
            if($class == 1){
                    $Defense = 5;
                    $Attack = 10;
                    $Health = 120;
            } elseif($class == 2){
                    $Defense = 10;
                    $Attack = 5;
                    $Health = 90;                
            } elseif($class == 3){
                    $Defense = 11;
                    $Attack = 15;
                    $Health = 65;                
            } elseif($class == 4){
                    $Defense = 6;
                    $Attack = 18;
                    $Health = 60;                
            } elseif($class == 5){
                    $Defense = 10;
                    $Attack = 2;
                    $Health = 150;                
            }

            require('includes/dbconnection.php');
            $query = "INSERT INTO `Characters` (`cID`,`name`, `health`, `defense`, `attack speed`, `level`, `username`, `wID`, `aID`, `xp`, `xpThreshold`, `wins`, `losses`) VALUES ('', '$CharName', '$Health', '$Defense', '$Attack', '1', '$Username', '$wID', '$aID', '0', '100', '0', '0')";


            $stmt = mysqli_prepare($conn, $query);
            $result = mysqli_stmt_execute($stmt);
            mysqli_close($conn);
            return $result;
        }
    }
?>