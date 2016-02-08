<?php
session_start()
?>
    <html>

    <head>
        <title>Badges registration page</title>
        <link rel="stylesheet" type="text/css" href="./register.css">
        <?php
include "_header.php";
if($db = connect_db()){$test_db = 1;}else{$test_db = 0;}

//variables
$user_name = $pass1 = $pass2 = $email = $temp = "";
$user_name_err = $pass_err = $pass_err_2 = $email_err = "";
$insert = 0;
//check if a post request method along with database connected exist
if($_SERVER["REQUEST_METHOD"] == "POST" && $test_db == true){
	//test variables are used to establish if all required elements exist
	$test_name = $test_email = $test_pass = 0;
	if(empty($_POST["username"])){
		$user_name_err = "Username is required!";
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
		$email_err = "Email is required!";
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
		$pass_err = "Password is a required field";
		$test_pass = 0;
	}else{
		//checks that password1 is equal to password2
		if(strcmp($_POST["password1"],$_POST["password2"]) != 0){
			$pass_err_2 = "Passwords do not match";
			$test_pass = 0;
		}else{
			//password cleaning and encrypting with sha256 appended with username
			$pass1 = hash('sha256',$_POST["password1"]);
			$pass2 = hash('sha256',$_POST["password2"]);
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
		$insert = 1;
		$db->query("insert into Users(username,password,email,admin,created) VALUES ('{$user_name}','{$pass1}','{$email}','0',NOW())");
	}
}

?>
    </head>

    <body>
        <a href="../index.html">HOME</a>
        <h1>REGISTER HERE: </h1>
        <div id="around">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]); ?>">
                <table>
                    <tr>
                        <td class="alignRight">
                            <label>Username: </label>
                        </td>
                        <td class="inputField">
                            <input type="text" name="username" class="textBox"><span class="error"><?php echo $user_name_err; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="alignRight">
                            <label>Password: </label>
                        </td>
                        <td class="inputField">
                            <input type="password" name="password1" class="textBox"><span class="error"><?php echo $pass_err; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="alignRight">
                            <label>Re-Type Password: </label>
                        </td>
                        <td class="inputField">
                            <input type="password" name="password2" class="textBox"><span class="error"><?php echo $pass_err_2; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="alignRight">
                            <label>Email: </label>
                        </td>
                        <td class="inputField">
                            <input type="text" name="email" class="textBox"><span class="error"><?php echo $email_err; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center">
                            <input type="submit" value="SUBMIT">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <?php
	if($insert === 1){
		if($result = $db->query("select uid,username from Users")){
			while($obj = $result->fetch_object()){
				if($obj->username == $user_name){
					$uid = $obj->uid;
					//echo "<br>UID: $uid<br>";   //check uid
				}
			}
		}
		$_SESSION["uid"] = "$uid"; //automatically set session when user registers
	?>
            <script>
                location.replace('http://web.engr.oregonstate.edu/~buffumw/Login_page/CS290/login_registration/success.php');
            </script>
            <?php
	}else{
		session_unset();
		session_destroy();
		die();
	}
	$db->close();
	?>
    </body>

    </html>