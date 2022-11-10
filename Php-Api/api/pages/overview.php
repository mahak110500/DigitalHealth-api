<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include "./../db/connection.php";


    function  getOverview($governance_id,$country_id,$db){
        $response = array();


        $sqlOverview = "SELECT 
        countries.id AS c_id,
        countries.name AS c_name,
        development_types.id AS development_id,
        development_types.name AS development_name,
        ultimate_fields.id AS ultimate_id,
        ultimate_fields.name AS ultimate_name,
        countries.id AS country_id,
        taxonomy_id,
        taxonomies.name AS taxonomy_name,
        indicator_id,
        indicators.name AS indicator_name,
        indicator_score,
        question_master.id AS question_id,
        question_master.name AS question_name,
        question_score,
        ndhs_master.status AS status ,
        question_score AS actual_score

        FROM questions
        JOIN ultimate_fields ON questions.ultimate_fields_id = ultimate_fields.id
        
        JOIN development_types ON questions.development_types_id = development_types.id
        JOIN taxonomies ON  questions.taxonomy_id = taxonomies.id
        JOIN indicators ON questions.indicator_id = indicators.id
        JOIN question_master ON questions.question_id = question_master.id
        JOIN ndhs_master ON questions.id = ndhs_master.question_id 
        JOIN  countries ON countries.id IN (108,110)";


        // $result = $db->query($sqlOverview);
        $result = pg_query($db, $sqlOverview);

        if ($result->num_rows > 0) {
            header("Content-Type: JSON");
            $i = 0;
                    
            //output data of each row
            $formattedArray = array();
            while($row = $result->fetch_assoc()) {

                $formattedArray [$row['development_name']][$row['ultimate_name']][$row['taxonomy_name']][$row['indicator_name']][$row['question_name']][] = $row;


                $response[$i]['c_id'] = $row['c_id'];
                $response[$i]['c_name'] = $row['c_name'];
                $response[$i]['development_id'] = $row['development_id'];
                $response[$i]['development_name'] = $row['development_name'];
                $response[$i]['ultimate_id'] = $row['ultimate_id'];
                $response[$i]['ultimate_name'] = $row['ultimate_name'];
                $response[$i]['country_id'] = $row['country_id'];
                $response[$i]['taxonomy_id'] = $row['taxonomy_id'];
                $response[$i]['taxonomy_name'] = $row['taxonomy_name'];
                $response[$i]['indicator_id'] = $row['indicator_id'];
                $response[$i]['indicator_name'] = $row['indicator_name'];
                $response[$i]['indicator_score'] = $row['indicator_score'];
                $response[$i]['question_id'] = $row['question_id'];
                $response[$i]['question_name'] = $row['question_name'];
                $response[$i]['question_score'] = $row['question_score'];
                $response[$i]['status'] = $row['status'];
                $response[$i]['actual_score'] = $row['actual_score'];

                $i++;
            }

            // $z = array("Healthcare Governance", $response);
            // $y = array("Readiness", $z);
            // $x = array("Present Development", $y);

        echo json_encode ($formattedArray,JSON_PRETTY_PRINT);

        } 
    }

//function calling
getOverview(1,29,$connection);

?>