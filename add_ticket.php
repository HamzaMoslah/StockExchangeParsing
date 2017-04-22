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

// mysql inserting a new row
$service = $_POST["service"];
$poste = $_POST["poste"];

$result = mysqli_query($db->connect(),"INSERT INTO tickets(temps,served,in_progress,service,poste) 
VALUES (now(),0,0,'$service','$poste')");

// check if row inserted or not
if ($result) {
    // successfully inserted into database
    $result1 = mysqli_query($db->connect(),"SELECT * FROM tickets order by num Desc LIMIT 1");
    $row = mysqli_fetch_array($result1);
    array_push($response,array("success"=>1,"message"=>$row["num"]));

    // echoing JSON response
    echo json_encode($response);
} else {
    // failed to insert row
    $response["success"] = 0;
    $response["message"] = "Oops! An error occurred.";
        
    // echoing JSON response
    echo json_encode($response);
}
?>