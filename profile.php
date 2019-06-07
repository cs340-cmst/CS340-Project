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
<h1>Profile Overview</h1>
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
    function addChars(){
        
    }
    
    function getTupleCount(){
        require('includes/dbconnection.php');
        $Username = $_SESSION['username'];
        
        $query = "SELECT COUNT(*) AS ct FROM Characters WHERE username = '$Username' GROUP BY username";
        
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        echo $row["ct"];
        mysqli_close($conn);
        return $row["ct"];
        
    }
    function micCheck(){
        require('includes/dbconnection.php');
        $Username = $_SESSION['username'];
        $query = "SELECT name FROM Characters WHERE username = '$Username'";
        
        $result = $conn->query($query);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "<p>" . $row["name"] . "</p>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
    }
    ?>
