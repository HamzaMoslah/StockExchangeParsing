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
$result1 = mysqli_query($db->connect(),"SELECT * FROM services");

if ($result1) {
    // successfully inserted into database
    while($row = mysqli_fetch_array($result1)){
        $row_array['id'] = $row ['id'];
        $row_array['label'] = $row ['label'];

        array_push($response,$row_array);
    }

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