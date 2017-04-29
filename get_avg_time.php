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
$result1 = mysqli_query($db->connect(),"SELECT AVG(TIMESTAMPDIFF(SECOND, temps, in_progress_time)) AS wait
, service, poste
 FROM tickets GROUP BY service, poste");

if ($result1) {
    // successfully inserted into database
    while($row = mysqli_fetch_array($result1)){
        $poste = $row ['poste'];
        $result2 = mysqli_query($db->connect(),"SELECT * FROM postes WHERE id='$poste'");
        $row1 = mysqli_fetch_array($result2);

        //  if($result2){
        //     echo "failed";
        //     echo $row1 ['adresse'];
        //     echo utf8_encode($row1 ['adresse']);
        // }
        $label = utf8_encode($row1 ['label']);
        $adresse = utf8_encode($row1 ['adresse']);

        $row_array['wait'] = $row ['wait'];
        $row_array['service'] = $row ['service'];
        $row_array['poste'] = $row ['poste'];
        $row_array['label'] = $label;
        $row_array['adresse'] = $adresse;
         $row_array['lat'] = $row1 ['lat'];
         $row_array['lon'] = $row1 ['lon'];
         $row_array['code'] = $row1 ['code'];

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