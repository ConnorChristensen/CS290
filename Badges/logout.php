<html>
<h1>Logout Successful</h1>
<a href="../index.html">HOME</a>

<?php
    session_start();
    session_destroy();
?>
<meta http-equiv="refresh" content="2;url=http://web.engr.oregonstate.edu/~chriconn/index.html"/>

</html>
