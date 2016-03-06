<?php include("_header.php");?>
    <html>

    <head>
        <title>Badges registration page</title>
        <link rel="stylesheet" type="text/css" href="./register.css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>
        <?php
        if($db = connect_db()) {
            $test_db = 1;
        }else{
            $test_db = 0;
        }

//variables
$user_name = $pass1 = $pass2 = $email = $temp = "";
$user_name_err = $pass_err = $pass_err_2 = $email_err = "";
$insert = 0;
//check if a post request method along with database connected exist
if($_SERVER["REQUEST_METHOD"] == "POST" && $test_db == true){
	//test variables are used to establish if all required elements exist
	$test_name = $test_email = $test_pass = 0;
	if(empty($_POST["username"])){
		$user_name_err = "Username is required";
		$test_name = 0;
	}else{
		//check if user_name uses valid characters and saves proper err msg if not
		$user_name = $_POST["username"];
		if(/*!preg_match("/^[A-Za-z0-9_]*S/",$_POST["username"])*/false){
			$user_name_err = "Only letters, numbers and underscores allowed";
			$test_name = 0;
		}else{
			//clean input with htmlspecialchars
			$user_name = htmlspecialchars($_POST["username"]);
			//$user_name = clean_input($_POST["username"]);
			$test_name = 1;
			$user_name_err = "";
		}
	}
	//checks if email was given
	if(empty($_POST["email"])){
		$email_err = "Email is required";
		$test_email = 0;
	}else{
		//verifies that valid email was given
		if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === true){
			$email_err = "Invalid email";
			$test_email = 0;
		}else{
			//clean input
			$email = htmlspecialchars($_POST["email"]);
			//$email = clean_input($_POST["email"]);
			$test_email = 1;
			$email_err = "";
		}
	}
	//checks if either password field is empty
	if(empty($_POST["password1"]) || empty($_POST["password2"])){
		$pass_err = "Password is required";
		$test_pass = 0;
	}else{
		//checks that password1 is equal to password2
		if(strcmp($_POST["password1"],$_POST["password2"]) != 0){
			$pass_err_2 = "Passwords do not match";
			$test_pass = 0;
		}else{
			//password cleaning and encrypting with sha256 appended with username
			$pass1 = hash('sha256',$_POST["password1"].$user_name);
			$pass2 = hash('sha256',$_POST["password2"].$user_name);
			$test_pass = 1;
			$pass_err = $pass_err_2 = "";
		}
	}
	//checks if username and email have been inserted into database before
	if($result = $db->query("select username,email from Users")){
		while($obj = $result->fetch_object()){
			if($obj->username == $user_name){
				$user_name_err = "Username already taken";
				$test_name = 0;
				break;
			}
			if($obj->email == $email){
				$email_err = "Email is already associated with a registered account";
				$test_email = 0;
				break;
			}
		}
	}
	if($test_name === 1 && $test_email === 1 && $test_pass === 1){
        $admin = 0;
        if($stmt=$db->prepare("INSERT INTO Users (username,password,email,admin_status,date_created) VALUES (?,?,?,?,NOW())")){
            $stmt->bind_param('sssi',$user_name,$pass1,$email,$admin);
            $stmt->execute();
            $_SESSION["login_user"] = $user_name;
            $insert=1;
        }else{
            $insert=0;
        }
	}
}

?>
    </head>

    <body>
       <img src="../Images/Logo_Name_Combo_White.png" alt="">
        <div id="home">
           <a href="../index.html">HOME</a>
       </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]); ?>">
            <table>
                <tr>
                    <td>
                        <h1>REGISTER</h1>
                    </td>
                </tr>
                <tr>
                    <td class="inputField">
                        <input type="text" name="username" class="textBox" placeholder="username">
                        <span class="error">
                                <?php echo $user_name_err; ?>
                            </span>
                    </td>
                </tr>
                <tr>
                    <td class="inputField">
                        <input type="password" name="password1" class="textBox" placeholder="password">
                        <span class="error">
                                <?php echo $pass_err; ?>
                            </span>
                    </td>
                </tr>
                <tr>
                    <td class="inputField">
                        <input type="password" name="password2" class="textBox" placeholder="comfirm password">
                        <span class="error">
                                <?php echo $pass_err_2; ?>
                            </span>
                    </td>
                </tr>
                <tr>
                    <td class="inputField">
                        <input type="text" name="email" class="textBox" placeholder="email">
                        <span class="error">
                                <?php echo $email_err; ?>
                            </span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center">
                        <input type="submit" value="submit" id="submit">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if($insert === 1){
            if($result = $db->query("select uid,username from Users")){
                while($obj = $result->fetch_object()){
                    if($obj->username == $user_name){
                        $uid = $obj->uid;
                        //echo "<br>UID: $uid<br>";   //check uid
                    }
                }

                $result = $db->query("select MAX(badgeid) as badgeid from Badges");
		$obj = $result->fetch_object();
		$num_badges = $obj->badgeid;
                for ($i = 1; $i <= $num_badges; $i++) {
                        $db->query("insert into User_Badges(badgeid, uid, obtained, unlocked) VALUES ('$i','$uid',NOW(),'0')");
                }
            }
            $_SESSION["uid"] = "$uid"; //automatically set session when user registers
        ?>
            <script>
                location.replace('http://web.engr.oregonstate.edu/~chriconn/Badges/badge.php');
            </script>
            <?php
            }else{
                session_unset();
                session_destroy();
                die();
            }
            $db->close();
        ?>
                </form>
    </body>

    </html>
