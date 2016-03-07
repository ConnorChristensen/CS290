<html>
<link rel="stylesheet" type="text/css" href="./logout.css">
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>

<div id="container">
    <h1>Logout Successful</h1>
    <a href="../index.html">Redirect in 3 seconds</a>
</div>

<?php
    session_start();
    session_destroy();
?>
<meta http-equiv="refresh" content="2;url=http://web.engr.oregonstate.edu/~chriconn/index.html"/>

</html>
