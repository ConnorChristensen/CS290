<html>
<h1>Logout Successful</h1>
<link rel="stylesheet" type="text/css" href="./logout.css">
<a href="../index.html">HOME</a>

<?php
    session_set();
    session_destroy();
?>
<meta http-equiv="refresh" content="2;url=http://web.engr.oregonstate.edu/~chriconn/index.html"/>

</html>

