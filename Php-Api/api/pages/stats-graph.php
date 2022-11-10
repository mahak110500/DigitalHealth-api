<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include "./../db/postConnect.php";


    $response = array();

    $sqlStatsGraph =  "SELECT 
    development_types.id AS development_id,
    development_types.name AS development_name,
    taxonomies.name AS taxonomy_name,
    ultimate_fields.id AS ultimate_id,
    ultimate_fields.name AS ultimate_name,
    governance_types.id AS governance_id,
    governance_types.name AS governance_name,
    countries.id AS country_id,
    countries.name AS country_name,
    countries.iso_code AS iso_code,
    taxonomies.taxonomy_score AS total,
    SUM(ndhs_master.score) AS actual_score,

    ROUND(SUM(ndhs_master.score),10) AS percentage	


    FROM questions
    INNER JOIN ultimate_fields ON questions.ultimate_fields_id = ultimate_fields.id AND ultimate_fields.id = 1
    INNER JOIN countries ON countries.id IN (106,108)
    INNER JOIN development_types ON questions.development_types_id = development_types.id AND development_types.id = 1
    INNER JOIN taxonomies ON  questions.taxonomy_id = taxonomies.id AND taxonomies.id = 10
    INNER JOIN indicators ON questions.indicator_id = indicators.id
    INNER JOIN question_master ON questions.question_id = question_master.id
    INNER JOIN ndhs_master ON questions.id = ndhs_master.question_id
    INNER JOIN governance_types ON governance_types.id = taxonomies.governance_id AND taxonomies.governance_id = 2
    GROUP BY (development_types.id,
                ultimate_fields.id,
                governance_types.id,
                countries.name,
                taxonomies.name,
                taxonomies.taxonomy_score,
                countries.id);";

    // $result = $connection->query($sqlStatsGraph);
    $result = pg_query($db, $sqlStatsGraph);

    $i = 0;
    while ($row = pg_fetch_object($result)) {
         header("Content-Type: JSON");

        echo json_encode($row,JSON_PRETTY_PRINT);
        $i++;

    }


    // if ($result->num_rows > 0) {
    //     header("Content-Type: JSON");
    //     $i = 0;
                
    //     // output data of each row
    //     while($row = $result->fetch_assoc()) { 
    //         echo json_encode($row,JSON_PRETTY_PRINT);
    //         $i++;
    //     }
    // } 

?>