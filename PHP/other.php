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
        <p id="description">This is a test website that was made for homework assignment #3 in the CS 290 course</p>
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
        $mysqli = new mysqli("oniddb.cws.oregonstate.edu","shellhal-db","mScqRgHWYdhtGzQ6","shellhal-db");

        $mysqli->query("drop table grades");
        $mysqli->query("drop table students");
        $mysqli->query("drop table courses");
        
        /* watch out for, and remove, extra carriage returns below */
        if (!$mysqli->query("create table courses(cid integer, prof varchar(64), cred integer, cap integer, title varchar(200), primary key(cid))")
         || !$mysqli->query("create table students(sid integer, onid varchar(32), name varchar(200), primary key(sid))")
         || !$mysqli->query("create table grades(cid integer, sid integer, grade decimal(3,2), primary key(sid,cid), foreign key(sid) references students, foreign key(cid) references courses)")
         ) {
            printf("Cannot create table(s).\n");
        }

        $mysqli->query("insert into courses(cid,prof,cred,cap,title) values(001,'chriconn',4,70,'Connor')");
        $mysqli->query("insert into courses(cid,prof,cred,cap,title) values(010,'shellhal',4,70,'Lily')");
        $mysqli->query("insert into courses(cid,prof,cred,cap,title) values(011,'buffumw',4,70,'Billy')");
        $mysqli->query("insert into courses(cid,prof,cred,cap,title) values(100,'claytonh',4,70,'Heidi')");
        $mysqli->query("insert into courses(cid,prof,cred,cap,title) values(101,'rosenber',4,70,'Robert')");
        $mysqli->query("insert into courses(cid,prof,cred,cap,title) values(110,'prinei',4,70,'Ian')");
        
        
        $mysqli->query("insert into students(sid,onid,name) values(931905000,'chriconn','C. Christensen')");
        $mysqli->query("insert into students(sid,onid,name) values(931905001,'buffumw','B. Buffman')");
        $mysqli->query("insert into students(sid,onid,name) values(931905000,'shellhal','L. Shellhammer')");

        echo "<table>";
        echo "<h1>Mysqli table</h1>";
        if ($result = $mysqli->query("select cid,prof,cred,cap,title from courses")) {
            while($obj = $result->fetch_object()){ 
                    echo "<tr>";
                    echo "<td>".htmlspecialchars($obj->cid)."</td>"; 
                    echo "<td>".htmlspecialchars($obj->title)."</td>"; 
                    echo "<td>".htmlspecialchars($obj->prof)."</td>"; 
                    echo "<td>".htmlspecialchars($obj->cred)."</td>"; 
                    echo "<td>".htmlspecialchars($obj->cap)."</td>"; 
                    echo "</tr>";
            } 

            $result->close();
        }
        echo "</table>"; 

        
        $mysqli->close();
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