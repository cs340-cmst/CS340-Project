<!DOCTYPE html>
<?php
    session_start();
    // Check that a user is logged in within the $_SESSION variable.
    
    ?>
<html>

<head>
<link rel="stylesheet" href="css/styles.css">
</head>

<body style="background-color: grey;">

<?php include('includes/header.php') ?>
<div id = "row">
<div id = "Profile-title">
<h1>Character Creation</h1>
</div>
</div>
<div id = "CharCreation" style = "position: relative; bottom: 10px; display: none;">
      <div id = "row" style = "position: relative; top: 20px;">
        <div id="column">
            Character Name: <input type="text" name="CharName" maxlength="20" size="20"><br>
        </div>
        <div id="column">
            <select id="CharClass" style="position: relative; left: 1px;">
                <option value="Select Class">Select Class</option>
                <option value="Warrior">Warrior</option>
                <option value="Mage">Mage</option>
                <option value="Rogue">Rogue</option>
                <option value="Necromancer">Necromancer</option>
                <option value="Priest">Priest</option>
            </select>
           <select id="Weapon" style="position: relative; left: 5px;">
                <option value="Select Weapon"> Select Weapon </option>
                <?php getWeapons(); ?>
            </select>
            <select id="Armor" style="position: relative; left: 5px;">
                <option value="Select Armor"> Select Armor </option>
                <?php getArmors(); ?>
            </select>
            <button id="CharSub" style="position: relative; left: 5px;">Submit</button>
        </div>   
        </div>      
</div>    
<script>
    function expandCreation(){
        var toggle = document.getElementById("CharCreation");
        if(toggle.style.display == "block"){
            toggle.style.display = "none";
        } else {
            toggle.style.display = "block";
        }
    }
</script> 
</body>
</html>
<?php
    function getWeapons(){
        require('includes/dbconnection.php');
        $query = "SELECT * FROM Weapons";
        
        $result = $conn->query($query);  
        
        while($row = $result->fetch_assoc()){
            $toINSERT = $toINSERT . '<option value=';
            $toINSERT = $toINSERT . '"';            
            $toINSERT = $toINSERT . $row["name"];
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
        
        while($row = $result->fetch_assoc()){
            $toINSERT = $toINSERT . '<option value=';
            $toINSERT = $toINSERT . '"';
            $toINSERT = $toINSERT . $row["name"];
            $toINSERT = $toINSERT . '">';
            $toINSERT = $toINSERT . $row["name"];
            $toINSERT = $toINSERT . '</option>';
        }
        
        echo $toINSERT;             
        $conn->close();  
    }
?>