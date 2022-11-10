<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "./../db/postConnect.php";

    $response = array();

    $sqlTopCountries =  "SELECT 
        countries1.id AS id,
        countries1.name AS country_name,
        taxonomies.name AS taxonomy_name,
        taxonomies.id AS taxonomy_id,
        development__types.name AS dt_name,
        ultimate_fields_id

    FROM questions
    INNER JOIN countries1 ON countries1.id IN (72,106)
    INNER JOIN development__types ON questions.development_types_id = development__types.id
    INNER JOIN taxonomies ON  questions.taxonomy_id = taxonomies.id
    INNER JOIN question__masters ON questions.question_id = question__masters.id
    INNER JOIN ndhs__masters ON questions.id = ndhs__masters.question_id 
    INNER JOIN governance_types ON governance_types.id";

    // $result = $connection->query($sqlTopCountries);
    $result = pg_query($db, $sqlTopCountries);


    if ($result->num_rows > 0) {
        header("Content-Type: JSON");
        $i = 0;
                
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo json_encode($row,JSON_PRETTY_PRINT);
            $i++;
        }
    } 


?>