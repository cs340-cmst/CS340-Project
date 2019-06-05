<?php
    session_start();

    $error_field = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        handle_login($error_field);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/styles.css" />
        <link rel="stylesheet" href="css/forms.css" />
    </head>
<body>
    <?php include('includes/header.php'); ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <h1>Login</h1>
        <i class="fa fa-user fa-lg"></i>
        <input class="text-box" name="username" type="text" placeholder="Username" />
        <br><br>
        <i class="fa fa-key fa-lg"></i>
        <input class="text-box" name="password" type="password" placeholder="Password" />
        <br><br>
             
        <input class="button" name="submit" type="submit" value="Login" />
        <span id="error-message" class="error"><?php echo "$error_field"; ?></span>
    </form>
</body>
</html>

<?php
    function handle_login(&$error_field) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $result = search_db_for_user($username);

        if (user_found($result)) {     
            $row = mysqli_fetch_assoc($result);
            $hash = $row['hash'];
            $salt = $row['salt'];

            if (is_correct_password($password, $hash, $salt)) {
                login_user($username, $row['type']);
                redirect_user();
            }
        }

        $error_field = "Incorrect username or password.";
    }

    function search_db_for_user($username) {
        require('includes/dbconnection.php');

        $query = "SELECT * FROM Accounts WHERE username = ?";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    function user_found($result) {
        return mysqli_num_rows($result) == 1;
    }

    function is_correct_password($password, $hash, $salt) {
        return hash('sha256', $password . $salt) == $hash;
    }

    function login_user($username, $type) {
        $_SESSION['username'] = $username;
        $_SESSION['type'] = $type;
    }

    function redirect_user() {
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = 'index.php';
        header("Location: http://$host$uri/$extra");
    }
?>