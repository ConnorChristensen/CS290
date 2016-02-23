<?php include("_header.php");?>
<html>
<html>
<link rel="stylesheet" href="badge.css">
<script src="jquery-1.12.0.min.js"></script>
<script src="javaScript.js"></script>
</head>

<script>
	images();
	get_user_badges();
</script>

<body>
    <nav>
        <table>
            <tr>
                <td id="logo"><img src="../Images/IconWithoutBackground.png"></td>
                <td id="toMap"><a href="../Map_Page/travel.html">Map</a></td>
                <td id="dropDown">
                    <div id="dropDownClicker" onclick="dropDown()">
                       <?php 
                        if(isset($_SESSION["login_user"])){
                            echo $_SESSION["login_user"];
                        }
                        ?>
                        <img src="../Images/empty_user.png" alt="">
                    </div>
                    <div class="hiddenDropDown" id="dropDownHolder">
                        <div class="dropDownThings">account settings</div>
                        <a class="dropDownThings" href="../index.html">logout</a>
                    </div>
                </td>

            </tr>
        </table>
    </nav>


    <div id="banner">
        <div id="recentBadge">
            <h1>You recently unlocked</h1>
        </div>
    </div>

    <!--Places the most recently unlocked badge-->

    <script>
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
