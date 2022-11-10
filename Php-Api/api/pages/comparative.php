<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include "./../db/postConnect.php";

    // $host        = "host = localhost";
    // $port        = "port = 5432";
    // $dbname      = "dbname = postgres";
    // $credentials = "user = postgres password=postgres";
 
    // $db = pg_connect("$host $port $dbname $credentials");
    // if(!$db) {
    //    echo "Error : Unable to open database\n";
    // } else {
    //    echo "Opened database successfully\n";
    // }


    $response = array();

    $sqlComparative =  "SELECT 
    ndhs_master.year,
    governance_types.id AS governance_id,
    governance_types.name AS governance_name,
    development_types.id AS development_id,
    development_types.name AS development_name,
    ultimate_fields.id AS ultimate_id,
    ultimate_fields.name AS ultimate_name,
    countries.name AS country_name,
    SUM(ndhs_master.score) AS score,

    CASE WHEN governance_types.id = 1 THEN 500 ELSE 700 END as total,
    ROUND(SUM(ndhs_master.score * 100/CASE WHEN governance_types.id = 1 THEN 500 ELSE 700 END),10) AS percentage
    
    FROM questions
    JOIN ultimate_fields ON questions.ultimate_fields_id = ultimate_fields.id
    JOIN countries ON countries.id IN (110,108)
    JOIN development_types ON questions.development_types_id = development_types.id
    JOIN taxonomies ON  questions.taxonomy_id = taxonomies.id
    JOIN question_master ON questions.question_id = question_master.id
    JOIN ndhs_master ON questions.id = ndhs_master.question_id AND countries.id = ndhs_master.country_id 
    JOIN governance_types ON governance_types.id = taxonomies.governance_id
    GROUP BY (development_types.id,ultimate_fields.id,governance_types.id,countries.name,ndhs_master.year)";

    // $result = $db->query($sqlComparative);
    $result = pg_query($db, $sqlComparative);

    $i = 0;

    while ($row = pg_fetch_object($result)) {
         header("Content-Type: JSON");

        echo json_encode($row,JSON_PRETTY_PRINT);
        $i++;

    }
    

    // if ($result->pg_num_rows > 0) {
    //     header("Content-Type: JSON");
    //     $i = 0;
                
    //     // output data of each row
    //     while($row = pg_fetch_row($result)) {
    //         echo json_encode($row,JSON_PRETTY_PRINT);
    //         $i++;
    //     }
    // } 
?>