<?php
/*
 * Following code will create a new product row
 * All ticket details are read from HTTP Post Request
 */

// array for JSON response
$response = array();

// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();
$num = 0;
$bt = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bt = $_POST["bt"];
}

if($bt === "Suivant"){
    $result1 = mysqli_query($db->connect(),"SELECT * FROM tickets where served=0 and in_progress=0 order by num Asc LIMIT 1");
    $row = mysqli_fetch_array($result1);
    $result = mysqli_query($db->connect(),'UPDATE  tickets SET in_progress=1, in_progress_time=now() where num ='.$row["num"]);

    if ($result1->num_rows !== 0){
        $num = $row["num"];
    }
}

if($bt === "Servir"){
    $last = $_POST["last"];  
    $num = $last;  
    $result = mysqli_query($db->connect(),'UPDATE  tickets SET served=1, served_time=now() where num ='.$last);
}

echo '<html>
    <body>
        <form action="serve_tickets.php" method="post">
            Courant :'.$num.' <br>
            <input type="submit" value="Servir" name="bt">
            <input type="submit" value="Suivant" name="bt">
            <input type="hidden" value="'.$num.'" name="last">
        </form>
    </body>
</html>';
?>