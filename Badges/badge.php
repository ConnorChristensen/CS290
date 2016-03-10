<?php include("../_header.php");?>
    <html>
    <head>
    <link rel="stylesheet" href="badge.css">
    <script type="text/javascript" src="../javascript/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="../javascript/javaScript.js"></script>
    <title>Badges</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>
    </head>
    <script>
        function areYouSure() {
        if(confirm("Are you sure you want to log out?")) {
            window.location.href = "http://web.engr.oregonstate.edu/~chriconn/Badges/logout.php";
        }
    }
</script>
<?php
    if(!isset($_SESSION["uid"])){
    	echo "<script type=\"text/javascript\">document.location.href=\"http://web.engr.oregonstate.edu/~chriconn/login_registration/login.php\";</script>";
    }
?>

        <body>
            <nav>
                <table>
                    <tr>
                        <td id="logo"><img src="../Images/IconWithoutBackground.png"></td>
                        <td id="toMap"><a href="../Map_Page/travel.html">Map</a></td>
                        <td id="toMap"><a href="../Check_in/check.php">Validate My Location</a></td>
                        <td id="dropDown">
                            <div id="dropDownClicker" onclick="dropDown()">
                                <?php 
                                    if(isset($_SESSION["login_user"])){
                                        echo "<p>$_SESSION[login_user]</p>";
                                    }
                                ?>
                                    <img src="../Images/empty_user.png" alt="">
                            </div>
                            <div class="hiddenDropDown" id="dropDownHolder">
                                <button class="dropDownThings" onclick="areYouSure()">logout</button>
                            </div>
                        </td>

                    </tr>
                </table>
            </nav>


            <div id="banner">
                <div id="recentBadge">
                    <h1 id="mssg"></h1>         <!--welcome mssg/recently unlocked-->   
                </div>
            </div>

            <!--Places the most recently unlocked badge-->

            <script>
                images();
                get_user_badges();
                mostRecentBadge();
            </script>

            <div class="modal" id="myModal">
                <div id="myModalContent" class="modal-content">

                </div>
            </div>

            <div id="badges">
                <h1>My Badges</h1>
                <div id="display">
                </div>
            </div>

            <!--Populates the list of badges-->
            <script>
                getBadges(); //populates the badges
            </script>

        </body>

    </html>
