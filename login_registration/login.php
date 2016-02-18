<?php
session_start();
if(isset($_SESSION["uid"])){
	session_unset($_SESSION["uid"]);
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Badges Login Page</title>
<link rel="stylesheet" type="text/css" href="./login.css">
<?php
include "_header.php";
	$user_name = $pass_word = "";
	if($db=connect_db()){
		$user_name = $_POST["username"];
		$pass_word = hash('sha256',$_POST["password"] . "$user_name");
		if($result = $db->query("select uid,username,password from Users")){
			while($obj = $result->fetch_object()){
				if($obj->username == $user_name && $obj->password == $pass_word){
					//automatically set session when user registers
					$_SESSION["uid"] = "$obj->uid"; 
				}else{
					//echo "Username did not match password";
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
		  <input type="text" name="username">
		  </br>
		  <label>PASSWORD:</label>
		  <input type="password" name="password">
		  </br>
		  <input type="submit" value=" SUBMIT">
	 </form>

<?php
	if(isset($_SESSION["uid"])){
?>		
	<script>
		location.replace('http://web.engr.oregonstate.edu/~buffumw/Login_page/CS290/login_registration/success.php');
	</script>
<?php
	}
?>
	 <a href="register.php">REGISTER HERE</a>
	 </body>


</html>
