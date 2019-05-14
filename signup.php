<?php
    session_start();

    $usernameError = "";
    $passwordError = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        handle_signup($usernameError, $passwordError);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/styles.css">
    </head>
<body>
    <?php include('includes/header.php'); ?>

    <p><span class="error">* required</span></p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        
        Username: <input name="username" type="text" />
        <span class="error">* <?php echo "$usernameError"; ?></span>
        <br><br>
        Password: <input name="password" type="password" />
        <span class="error">* <?php echo "$passwordError"; ?></span>
        <br><br>
             
        <input name="submit" type="submit" value="Signup" />

    </form>
</body>
</html>

<?php
    function handle_signup(&$usernameError, &$passwordError) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        require('includes/dbconnection.php');

        $query = "SELECT * FROM Accounts WHERE username = '$username'";

        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 0) {                  // Username not found.
        
            // Check username and password for valid characters.
            if (validate($username, $password, $usernameError, $passwordError)) {
                // Hash password.
                $salt = generate_salt();
                $hash = hash("sha256", $password . $salt);

                // Insert new user into the database.
                insert_user_into_database($conn, $username, $hash, $salt);

                // Log the user in.
                $_SESSION['username'] = $username;
                $_SESSION['type'] = 'user';

                header('Location: index.php');
            }
    
        }
        else {                                              // Username found in the database.
            $usernameError = "That username is taken.";
        }
    }

    function generate_salt() {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $saltLength = 32;

        $salt = "";
        for ($i = 0; $i < $saltLength; $i++) {
            $salt .= $chars[mt_rand(0, strlen($chars) - 1)];
        }

        return $salt;
    }

    function insert_user_into_database(&$conn, $username, $hash, $salt) {
        $query = "INSERT INTO Accounts(username, hash, salt) VALUES('$username', '$hash', '$salt')";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Failed to signup");
        }
    }

    function validate($username, $password, &$usernameError, &$passwordError) {
        // TODO ...
        return true;
    }
?>