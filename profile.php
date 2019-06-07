<!DOCTYPE html>
<?php
    session_start();
    // Check that a user is logged in within the $_SESSION variable.

?>
<html>

    <head> 
        <link rel="stylesheet" href="css/styles.css">
    </head>

<body>
   
<?php include('includes/header.php') ?>

<div id = "row">
<div id = "Profile-title">
<h1>Profile Overview</h1>
</div>
</div>

<div id = "Characters">
<?php getChars(); ?>
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
    
<button class="btn" style="background-color: lightgrey; position: relative; left: 300px; top: 20px; bottom: 20px; border-radius: 0px;" onclick="expandCreation();"> + </button>


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
    function getChars(){
        require('includes/dbconnection.php');
        $Username = $_SESSION['username'];
        
        $query = "SELECT * FROM Characters WHERE username = '$Username'";
        
        $result = $conn->query($query);
        
        
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $toINSERT = '<div id = "row">';
                $toINSERT = $toINSERT. '<div id = "column">';
                $toINSERT = $toINSERT.'<p>';
                $toINSERT = $toINSERT. $row["name"] . '<p>';
                $toINSERT = $toINSERT.'</div>';
                $toINSERT = $toINSERT.'<div id = "column"><div id = "stats">';
                $toINSERT = $toINSERT.'<p>Stats: <p><button class="btn btnH" style="background-color: darkred; width: 60px;">';
                $toINSERT = $toINSERT . $row["health"];
                $toINSERT = $toINSERT . '</button> <button class="btn btnM" style="background-color: lightskyblue; width: 60px;">';
                $toINSERT = $toINSERT . $row["defense"];
                $toINSERT = $toINSERT . '</button> <button class="btn btnS" style="background-color: green; width: 60px;">';
                $toINSERT = $toINSERT . $row["attack speed"];
                $toINSERT = $toINSERT. '</button>';
                $toINSERT = $toINSERT.'</div></div></div>';
                echo $toINSERT;
            }
        } else {
            echo "0 results";
        }
        $conn->close();
    }  
    ?>
