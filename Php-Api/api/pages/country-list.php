<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    

include "./../db/connection.php";

$response = array();

$sql = "select * from countries1";
$result = $connection->query($sql);
		
if ($result->num_rows > 0) {
    header("Content-Type: JSON");
    $i = 0;
            
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $response[$i]['id'] = $row['id'];
        $response[$i]['name'] = $row['name'];
        $response[$i]['iso_code'] = $row['iso_code'];
        $response[$i]['flag_path'] = $row['flag_path'];
        $response[$i]['lat'] = $row['lat'];
        $response[$i]['lng'] = $row['lng'];
        $response[$i]['country_name'] = $row['name'];
        $response[$i]['country_id'] = $row['id'];
        $i++;
    }
    echo json_encode($response,JSON_PRETTY_PRINT);
    return $response;
} else {
    echo "0 results";
}
	


?>