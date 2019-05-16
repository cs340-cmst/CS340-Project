<?php
    session_start();

    $error_field = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        handle_signup($error_field);
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
        <span class="error">* <?php echo "$error_field"; ?></span>
        <br><br>
        Password: <input name="password" type="password" />
        <br><br>
             
        <input name="submit" type="submit" value="Signup" />

    </form>
</body>
</html>

<?php
    function handle_signup(&$error_field) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = search_db_for_user($username);

        if (user_not_found($result)) {
            if (valid_characters($username, $password, $error_field)) {
                // Hash password.
                $salt = generate_salt();
                $hash = hash('sha256', $password . $salt);

                $success = insert_user_into_database($username, $hash, $salt);

                if (!$success) {
                    $error_field = "Error occurred in registering user.";
                }
                else {
                    login_user($username, 'user');
                    header('Location: index.php');
                }
            }
        }
        else {
            $error_field = "That username is taken.";
        }
    }

    function search_db_for_user($username) {
        require('includes/dbconnection.php');

        $query = "SELECT * FROM Accounts WHERE username = ?";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    function user_not_found($result) {
        return mysqli_num_rows($result) == 0;
    }

    function valid_characters($username, $password, &$error_field) {
        // TODO ...
        return true;
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

    function insert_user_into_database($username, $hash, $salt) {
        require('includes/dbconnection.php');

        $query = "INSERT INTO Accounts(username, hash, salt) VALUES(?, ?, ?)";
        
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sss", $username, $hash, $salt);
        return mysqli_stmt_execute($stmt);
    }

    function login_user($username, $type) {
        $_SESSION['username'] = $username;
        $_SESSION['type'] = $type;
    }
?>