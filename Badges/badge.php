<html>
<html>
	<link rel="stylesheet" href="badge.css">
    <script src="jquery-1.12.0.min.js"></script>
    <script src="javaScript.js"></script>
</head>

<script>
images();
</script>

<body>
	<nav>
        <table>
            <tr>
                <td><img src="../Images/logo.png"></td>
                <td><a href="../Map_Page/travel.html">Map</a></td>
                <td>
                	<div id="dropDown">
                		<button id="dropDownClicker" onclick="dropDown()">USERNAME and IMAGE</button>
                		<div id="dropDownHolder" class="hiddenDropDown">
                			<button class="dropDownThings">account settings</button>
                			<button class="dropDownThings">logout</button>
                		</div>
                	</div>
                </td>

            </tr>
        </table>
    </nav>


   <div id="banner">
    	<div id="recentBadge" style="width: 100%; margin-top: 200px">
    		<h1>You recently unlocked</h1>
         </div>
    </div>

<!--Places the most recently unlocked badge-->

<script>
	mostRecentBadge();
</script>

    <div id="myModal" class="modal">
    	<div id= "myModalContent" class="modal-content">

    	</div>
    </div>

    <div id="badges">
        <h1>My Badges</h1>
        <div id="display">
        </div>
    </div>

<!--Populates the list of badges-->
<script>
	getBadges();  //populates the badges
</script>

</body>

</html>
