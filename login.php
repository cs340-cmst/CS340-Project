<?php
    session_start();

    $usernameError = "";
    $passwordError = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        handle_login($usernameError, $passwordError);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/styles.css">
    </head>
<body>
    <?php include('includes/header.php'); ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        
        Username: <input name="username" type="text" />
        <span class="error"><?php echo "$usernameError"; ?></span>
        <br><br>
        Password: <input name="password" type="password" />
        <span class="error"><?php echo "$passwordError"; ?></span>
        <br><br>
             
        <input name="submit" type="submit" value="Login" />
            
    </form>
</body>
</html>

<?php
    function handle_login(&$usernameError, &$passwordError) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        require('includes/dbconnection.php');

        $query = "SELECT * FROM Accounts WHERE username = '$username'";

        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {               // Username found. Check password.
            $row = mysqli_fetch_assoc($result);

            $hash = $row['hash'];
            $salt = $row['salt'];

            if (hash('sha256', $password . $salt) == $hash) {
                // Valid login.
                // Assign session variables;
            
                $_SESSION['username'] = $username;
                $_SESSION['type'] = $row['type'];

                header('Location: index.php');
            }
            else {
                $usernameError = "Incorrect username or password.";
                $passwordError = "Incorrect username or password.";
            }
        }
        else {                                              // Username not found in the database.
            $usernameError = "Incorrect username or password.";
            $passwordError = "Incorrect username or password.";
        }
    }
?>