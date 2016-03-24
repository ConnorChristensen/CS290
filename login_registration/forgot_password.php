<script type="text/javascript" src="validation.js"></script>
<script type="text/javascript" src="../javascript/jquery-1.12.0.min.js"></script>
<?php
    include("../_header.php");
    $emptyEmail = "";

    function msg($username, $key){
        $username = $username['username'];
        
        $message = "Hey $username,<br>This is Billy from GEO! We got a request for help recovering your password. <br>If you did not put in this request, please report it to us!<br><br>Here is your verification code: $key";
        $message = wordwrap($message,300);
        
        return $message;
    }

    function keyGen($username){
        $key = uniqid($username['username']);
        
        return $key;
    }

    if(mysqli_connect_errno()){
        echo("Failed to connect to MySQL: ".mysqli_connect_error());
    }else{
        if(isset($_POST["validate"])){
            if(empty($_POST["email"])){
                $emptyEmail = "&emsp;If you'd like to get your password, then please input an email!";
            }else{
                $email = $_POST["email"];
                if($query = mysqli_query($con,"SELECT username FROM Users WHERE email = '$email'")){
                    //mail(to,subject,message,headers,parameters);
                     ?>
                    <script>
                        changeDOM();
                    </script>
                    <?php
                    $to = $email;
                    $subject = "[GEO] Password Recovery";
                    
                    //gets usable form of query
                    $result = mysqli_fetch_array($query);
                    
                    //generate key for password validation
                    $key = keyGen($result);
                    
                    //message to the user
                    $msgToUser = msg($result,$key);
                    
                    // Always set content-type when sending HTML email
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                    // More headers
                    $headers .= 'From: <GEO God>' . "\r\n";
                    
                    mail($email,$subject,$msgToUser,$headers);
                    
                }
            }
        }
    }
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Forgot Password</title>
        <link rel="stylesheet" href="login.css" />
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>
        
    </head>
    <body>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <table class="validated">
                <tr>
                    <td>
                        <h1>Did you forget your password?</h1>
                        <p>Go ahead and input your email address and we'll help you out!</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="email" placeholder="ILoveMyGeo@Geo.com">
                        <?php echo("<p>$emptyEmail</p>"); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Send Email Verification" name="validate">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>