<html>

<head>
    <link rel="stylesheet" href="thephp.css">
    <title>Connor Christensen</title>
</head>

<body>
    <nav>
        <h1>Test Website: by Connor Christensen</h1>
    </nav>

    <div>
        <p id="description">This is a test website that was made for homework assignment #2 in the CS 290 course</p>
    </div>
    <div>
        <p class="bold">People in the group</p>
        <ul>
            <li>Connor Christensen</li>
            <li>Heidi Clayton</li>
            <li>Ian Prine</li>
            <li>Lily Shellhammer</li>
            <li>Robert Rosenberger</li>
            <li>William Buffum</li>
        </ul>
    </div>
    <div>
        <?php
            $dbhost = 'oniddb.cws.oregonstate.edu';
            $dbname = 'chriconn-db';
            $dbuser = 'chriconn-db';
            $dbpass = 'NC5O8Fuf5DMgHABX';

            $mysql_handle = mysql_connect($dbhost, $dbuser, $dbpass) or die("Error connecting to database server");
            mysql_select_db($dbname, $mysql_handle) or die("Error selecting database: $dbname");
            echo 'Successfully connected to database!';
            mysql_close($mysql_handle);

            $mysqli = new mysqli($dbhost, $dbname, $dbpass, $dbuser);


            $mysqli->query("drop table grades");

            if(!$mysqli->query("create table grades(cid integer)")) {
                echo "Cannot create table.\n";
            }

            $mysqli->close();
            $mysqli->query("insert into grades(cid) values(100)");
            $mysqli->query("insert into grades(cid) values(1)");
            $mysqli->query("insert into grades(cid) values(545)");
            $mysqli->query("insert into grades(cid) values(132)");
            $mysqli->query("insert into grades(cid) values(76)");
            echo "<table>"
            if($result = $mysqli->query("select cid")) {
                while($obj = result->fetch_object()) {
                    echo "<tr>";
                    echo "<td>".htmlspechialchars($obj->cid)."</td>";
                }
                
                $result->close();
            }

            echo "</table>";*/
        ?>
    </div>
    <footer>
        <p>This site was loaded on:
            <?php
            echo date('Y-m-d h:i.s');
        ?>
        </p>
    </footer>
</body>

</html>