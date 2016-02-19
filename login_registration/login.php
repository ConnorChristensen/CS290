<?php
if(!isset($_COOKIE["login_user"])) { //If the session is not set
    session_start();    //Start the session
}
else {
    echo "It looks like you are already logged in. Would you like to log in as a different user?";
}
?>
<!DOCTYPE HTML>
    <html>
    <head>
        <title>Badges Login Page</title>
        <link rel="stylesheet" href="login.css"/>
        <?php
        $emptyUsername = $emptyPassword = "";
        // Create connection
        $connect = mysqli_connect('oniddb.cws.oregonstate.edu','buffumw-db','PizSfykTJBUp3NbW','buffumw-db');

        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: ".mysqli_connect_error();
        }
        else {
            if (isset($_POST["login"])) {
                if (empty($_POST["username"]) || empty($_POST["password"])) {
                    if(empty($_POST["username"])) {
                        $emptyUsername = "&emsp;The username field is required";
                    }
                    if(empty($_POST["password"])) {
                        $emptyPassword = "&emsp;The password field is required";
                    }
                }
                else {
                    $username = $_POST["username"];
                    $password = hash("sha256", $_POST["password"].$username);

                    //SQL injection blockers (only removes backslashes)
                    $username = stripslashes($username);
                    $password = stripslashes($password);

                    //get the user information in an sql query
                    $query = mysqli_query($connect,"SELECT * FROM Users WHERE password = '$password' AND username = '$username'");
                    $rows = mysqli_num_rows($query);
                    if ($rows == 1) {
                        $_SESSION["login_user"] = $username;
                        $sessionSet = true;
                    } else {
                        $error = "The username or password was incorrect";
                    }
                }
            }
        }
        ?>
    </head>
    <body>
    <h1>LOGIN HERE:</h1>
    <form method = "post" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]); ?>">
        <label>USERNAME:</label>
        <input type="text" name="username"><?php echo $emptyUsername;?>
        </br>
        <label>PASSWORD:</label>
        <input type="password" name="password"><?php echo $emptyPassword;?>
        </br>
        <input type="submit" value="Login" name="login">
    </form>
    <p><?php echo $error;?></p>
    <?php if($sessionSet) {
        echo "Your session has been set!";
    }?>
    <a href="register.php">REGISTER HERE</a>
    </body>
</html>
