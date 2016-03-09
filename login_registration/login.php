<?php include("../_header.php");
$emptyUsername = $emptyPassword = $error = "";
$sessionSet = false;
// Create connection


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
            $query = mysqli_query($con,"SELECT * FROM Users WHERE password = '$password' AND username = '$username'");
            $rows = mysqli_num_rows($query);
            if ($rows == 1) {
                $sql = "select uid from Users where username='$username'";
				$result = mysqli_query($con, $sql);
				$row = mysqli_fetch_array($result);
				$uid = $row['uid'];
                $_SESSION["login_user"] = $username;
                $_SESSION["uid"] = $uid;
                $sessionSet = true;
            } else {
                $error = "The username or password was incorrect";
            }
        }
    }
}
?>
    <!DOCTYPE HTML>
    <html>

    <head>
        <title>Badges Login Page</title>
        <link rel="stylesheet" href="login.css"/>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>
    </head>

    <body>
        <img src="../Images/Logo_Name_Combo_White.png" alt="">
       <div id="register">
           <a href="register.php">REGISTER HERE</a>
       </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <table>
                <tr>
                    <td>
                        <h1>LOGIN</h1>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="username" placeholder="username">
                        <?php echo("<p>$emptyUsername</p>");?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" name="password" placeholder="password">
                        <?php echo("<p>$emptyPassword</p>");?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Login" name="login">
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>
                            <?php 
                            echo $error;
                            if($sessionSet) {
                                echo "<script type=\"text/javascript\">document.location.href=\"http://web.engr.oregonstate.edu/~chriconn/Badges/badge.php\";</script>";
                            }?>
                        </p>
                    </td>
                </tr>
            </table>
        </form>
    </body>

    </html>
