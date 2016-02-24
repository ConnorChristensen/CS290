<html>
<h1>Logout Successful</h1>
<h3>(Actually its not successful. The session is not being unset. Someone help.)</h3>
<a href="../index.html">HOME</a>

<?php
    session_destroy();
?>
<meta http-equiv="refresh" content="3;url=http://web.engr.oregonstate.edu/~chriconn/index.html"/>

</html>