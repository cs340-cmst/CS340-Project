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
<input class="drop">
</form>


<div class="row">
<div class="column">
<h1 class="test"> Your Character </h1>
<form>
<select class="drop">
<option value="pick">Select Your Character</option>
<?php
    include 'dbconnection.php';
    $Username = $_SESSION['username'];
    $sql = mysqli_query($connection, "SELECT name FROM Characters WHERE username= \"$Username\"");
    
    ?>



</select>
</form>
<h1 class="test"> Stats </h1>
<ul>
<li>Health:</li>
<li>Attack:</li>
<li>Speed:</li>
<li>Armor:</li>
<li>Weapon:</li>
</ul>
</div>

<div class="column">
<h1 class="test"> VS </h1>
<button class="block"> FIGHT </button>
</div>

<div class="column">
<h1 class="test"> Enemy Character </h1>
<form>
<input class="drop">
<!-- <select class="drop"><center></center>
</select> -->
</form>
<h1 class="test"> Stats </h1>
<ul>
<li>Health:</li>
<li>Attack:</li>
<li>Speed:</li>
<li>Armor:</li>
<li>Weapon:</li>
</ul>
</div>


</div>



</body>
</html>
