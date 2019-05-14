<!DOCTYPE html>
<?php
    session_start();
?>
<html>

    <head>
        <link rel="stylesheet" href="css/styles.css">
    </head>

<body>

<?php if (isset($_SESSION['username'])) { echo "User: " . $_SESSION['username']; } ?>
<?php if (isset($_SESSION['type'])) { echo "  Type: " . $_SESSION['type']; } ?>


<?php include('includes/header.php') ?>

</body>
</html>