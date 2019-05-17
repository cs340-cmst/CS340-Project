<!DOCTYPE html>
<?php
    session_start();
?>
<html>

    <head>
        <link rel="stylesheet" href="css/styles.css">
    </head>

<body>

<?php if (isset($_SESSION['username'])) { echo "User: " . $_SESSION['username']; } ?>   <!-- Testing -->
<?php if (isset($_SESSION['type'])) { echo "  Type: " . $_SESSION['type']; } ?>

<div id="front-page-most-wins">

</div>

<div id="front-page-best-ratio">

</div>

<?php include('includes/header.php') ?>

</body>
</html>