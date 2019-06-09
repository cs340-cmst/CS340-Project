<!DOCTYPE html>
<?php
    session_start();
    // Check that a user is logged in within the $_SESSION variable.
?>

<html>

    <head>
        <link rel="stylesheet" href="css/styles.css">
    </head>

<body id="about-background">

<?php include('includes/header.php') ?>

<p>
    <center id="about-header"><b> About the Developers </b></center>
</p>

<center>
    <div id="about-text">
        This website was created by the following four Oregon State students Timothy O’Rourke, Carson Pemble, Manuel Ochoa-Botello, and Sean Spink. The game was created as a project for the undergraduate course CS 340: Databases. This projects tests the ability to design and implement a web-based relational database system, using both php and an open-source database development system such as SQL. This project started with a project proposal and moved towards the creation of an ER diagram, relational schema, website layout and implementation, and finally to a peer review and class presentation.
    </div>
</center>

</body>
</html>
