<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include "./../db/connection.php";


    $response = array();

    $sqlTableChart = "SELECT 
    countries1.name AS c_name,
    development__types.id AS development_id,
    development__types.name AS development_name,
    ultimate__fields.id AS ultimate_id,
    ultimate__fields.name AS ultimate_name,
    countries1.id AS country_id,
    taxonomy_id,
    taxonomies.name AS taxonomy_name,
    indicator_id,
    indicators.name AS indicator_name,
    indicator_score,
    question__masters.name AS question_name,
    question_score,
    ndhs__masters.status,
    question_score AS actual_score

    FROM questions
    JOIN ultimate__fields ON questions.ultimate_fields_id = ultimate__fields.id
    JOIN development__types ON questions.development_types_id = development__types.id
    JOIN taxonomies ON  questions.taxonomy_id = taxonomies.id
    JOIN indicators ON questions.indicator_id = indicators.id
    JOIN question__masters ON questions.question_id = question__masters.id
    JOIN ndhs__masters ON questions.id = ndhs__masters.question_id 
    JOIN  countries1 ON countries1.id IN (108,110)";

    $result = $connection->query($sqlTableChart);
    
    
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