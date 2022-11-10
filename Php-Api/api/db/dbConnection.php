<?php
class DBconnection{

	// //defining details for mysql connection
	// $servername = "localhost";
	// $username = "root";
	// $password = "";
	// $database = "digital_healthData3";
	
	// $connection = new mysqli( $servername, $username, $password, $database );

    private $dbHost     = "localhost";
    private $dbUsername = "root";
    private $dbPassword = "";
    private $dbName     = "digital_healthData3";
    
    public function __construct(){
		if(!isset($this->db)){
			// Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
            if($conn->connect_error){
				die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
				// echo"Connected!";
				$this->db = $conn;
            }
        }
    }
	

	// public function getGovernanceStats($governance_id,$country_id,$year){

	// 	$response = array();
	// 	$response1 = array();
	// 	$response2 = array();
	// 	$governanceStats = array();
	// 	$complete = array();
	// 	$complete1 = array();

	// 	$sqlDevelopment = "select * from development__types";
	// 	$result = $this->db->query($sqlDevelopment);

	// 	if($result->num_rows > 0){
	// 		header("Content-Type: JSON");
	// 		$i = 0;
	// 		$j = 0;
	// 		$k = 0;

	// 		while($row = $result->fetch_assoc()) {
	// 			$response[$i]['id'] = $row['id'];
	// 			$response[$i]['name'] = $row['name'];
	// 			$sqlTaxonomies = "select * from taxonomies where governance_id = '$governance_id'";
	// 			$result1 = $this->db->query($sqlTaxonomies);

	// 				if($result1->num_rows > 0){
	// 					$j= 0;
	// 					while($row = $result1->fetch_assoc()) {
	// 						$response1[$i][$j]['id'] = $row['id'];
	// 						$response1[$i][$j]['name'] = $row['name'];
	// 						$daveId = $response[$i]['id'];
	// 						$daveName = $response[$i]['name'];
	// 						$taxId = $response1[$i][$j]['id'];
	// 						$taxeName = $response1[$i][$j]['name'];

	// 						$sqlUltimate = "select * from ultimate__fields where development_types_id ='$daveId'";
	// 						// $sqlUltimate = "select * from ultimate__fields ";
	// 						$result2 = $this->db->query($sqlUltimate);
		
	// 						if($result2->num_rows > 0){
	// 							header("Content-Type: JSON");
	// 							$k= 0;
		
	// 							while($row = $result2->fetch_assoc()) {
	// 								$governanceStats[$k]['development_id'] =$daveId;
	// 								$governanceStats[$k]['development_name'] =$daveName;
	// 								$governanceStats[$k]['taxonomy_id'] =$taxId;
	// 								$governanceStats[$k]['taxonomy_name'] =$taxeName;
	// 								$governanceStats[$k]['ultimate_id'] =$row['id'];
	// 								$governanceStats[$k]['ultimate_name'] =$row['name'];

	// 								$k++;
	// 							}

	// 							$complete[$i][$response1[$i][$j]['name']] = $governanceStats;
	// 						}

	// 						$j++;
	// 					}
	// 				}
	// 				$complete1[$response[$i]['name']] = $complete[$i];

	// 			$i++;
	// 		}
	// 		echo json_encode($complete1,JSON_PRETTY_PRINT);
	// 	}
	// }

  //GET TABLE CHART
    // public function getTableChart(){

	// 	$response = array();

	// 	// $sqlTableChart = "SELECT 
	// 	// questions.taxonomy_id,
	// 	// taxonomies.name as taxonomy_name,
	// 	// questions.ultimate_id,
	// 	// ultimate__fields.name as ultimate_name,
	// 	// questions.development_types_id,
	// 	// development__types.name as development_name,
	// 	// questions.question_id,
	// 	// question__masters.name as question_name,
	// 	// questions.question_score,
	// 	// questions.indicator_id,
	// 	// indicators.name as indicator_name,
	// 	// questions.indicator_score
	// 	// FROM questions 
	// 	// INNER JOIN development__types ON (questions.development_types_id = development__types.id)
	// 	// INNER JOIN ultimate__fields ON (questions.ultimate_id = ultimate__fields.ultimate_fields_id)
	// 	// INNER JOIN taxonomies ON (questions.taxonomy_id = taxonomies.taxonomies_id)
	// 	// INNER JOIN indicators ON (questions.indicator_id = indicators.id)
	// 	// INNER JOIN question__masters ON (questions.question_id = question__masters.id)";

	// 	$sqlTableChart = "SELECT 
	// 	countries1.name AS c_name,
	// 	development_types_id,
	// 	development__types.name AS development_name,
	// 	ultimate_fields_id,
	// 	countries1.id AS country_id,
	// 	taxonomy_id,
	// 	taxonomies.name AS taxonomy_name,
	// 	indicator_id,
	// 	indicators.name AS indicator_name,
	// 	indicator_score,
	// 	question__masters.name AS question_name,
	// 	question_score,
	// 	ndhs__masters.status,
	// 	question_score AS actual_score

	// 	FROM questions
	// 	INNER JOIN development__types ON questions.development_types_id = development__types.id
	// 	INNER JOIN taxonomies ON  questions.taxonomy_id = taxonomies.id
	// 	INNER JOIN indicators ON questions.indicator_id = indicators.id
	// 	INNER JOIN question__masters ON questions.question_id = question__masters.id
	// 	INNER JOIN ndhs__masters ON questions.id = ndhs__masters.question_id 
	// 	INNER JOIN  countries1 ON countries1.id IN (108,110)";

	// 	$result = $this->db->query($sqlTableChart);
		
		
	// 	if ($result->num_rows > 0) {
	// 		header("Content-Type: JSON");
	// 		$i = 0;
					
	// 		// output data of each row
	// 		while($row = $result->fetch_assoc()) {
	// 			// echo $row;
	// 			$response[$i]['indicator_id'] = $row['indicator_id'];
	// 			$response[$i]['indicator_name'] = $row['indicator_name'];
	// 			$response[$i]['idicator_score'] = $row['idicator_score'];
	// 	 		$response[$i]['question_score'] = $row['question_score'];
	// 		echo json_encode($row,JSON_PRETTY_PRINT);
				
	// 			$i++;
	// 		}
	// 		// echo json_encode($response,JSON_PRETTY_PRINT);
	// 	} 
	// }

	//GET STATS GRAPH
	// public function getStatsGraph(){
	// 	$response = array();

	// 	$sqlStatsGraph =  "SELECT 
	// 		development_types_id,
	// 		development__types.name AS development_name,
	// 		taxonomies.name AS taxonomy_name,
	// 		ultimate_fields_id,
	// 		governance_types.id AS governance_id,
	// 		governance_types.name AS governance_name,
	// 		countries1.id AS country_id,
	// 		countries1.name AS country_name,
	// 		countries1.iso_code AS iso_code,
	// 		taxonomy_score AS total,
	// 		ndhs__masters.score AS actual_score 

	// 	FROM questions
	// 	INNER JOIN countries1 ON countries1.id IN (106,108)
	// 	INNER JOIN development__types ON questions.development_types_id = development__types.id
	// 	INNER JOIN taxonomies ON  questions.taxonomy_id = taxonomies.id
	// 	INNER JOIN indicators ON questions.indicator_id = indicators.id
	// 	INNER JOIN question__masters ON questions.question_id = question__masters.id
	// 	INNER JOIN ndhs__masters ON questions.id = ndhs__masters.question_id
	// 	INNER JOIN governance_types ON governance_types.id";

	// 	$result = $this->db->query($sqlStatsGraph);

	// 	if ($result->num_rows > 0) {
	// 		header("Content-Type: JSON");
	// 		$i = 0;
					
	// 		// output data of each row
	// 		while($row = $result->fetch_assoc()) {
	// 			$response[$i]['indicator_id'] = $row['indicator_id'];
	// 			$response[$i]['indicator_name'] = $row['indicator_name'];
	// 			$response[$i]['idicator_score'] = $row['idicator_score'];
	// 	 		$response[$i]['question_score'] = $row['question_score'];
	// 			echo json_encode($row,JSON_PRETTY_PRINT);
				
	// 			$i++;
	// 		}
	// 	} 
	// }

	//GET COMPARATIVE
	// public function getComparative(){
	// 	$response = array();

	// 	$sqlComparative =  "SELECT 
	// 		ndhs__masters.year,
	// 		governance_types.id AS governance_id,
	// 		governance_types.name AS governance_name,
	// 		development_types_id,
	// 		development__types.name AS development_name,
	// 		ultimate_fields_id,
	// 		countries1.name AS country_name


	// 	FROM questions
	// 	INNER JOIN countries1 ON countries1.id IN (106,108)
	// 	INNER JOIN development__types ON questions.development_types_id = development__types.id
	// 	INNER JOIN taxonomies ON  questions.taxonomy_id = taxonomies.id
	// 	INNER JOIN question__masters ON questions.question_id = question__masters.id
	// 	INNER JOIN ndhs__masters ON questions.id = ndhs__masters.question_id 
	// 	INNER JOIN governance_types ON governance_types.id";

	// 	$result = $this->db->query($sqlComparative);

	// 	if ($result->num_rows > 0) {
	// 		header("Content-Type: JSON");
	// 		$i = 0;
					
	// 		// output data of each row
	// 		while($row = $result->fetch_assoc()) {
	// 			echo json_encode($row,JSON_PRETTY_PRINT);
	// 			$i++;
	// 		}
	// 	} 
	// }

	//GET TOP COUNTRIES
	// public function getTopCountries(){
	// 	$response = array();

	// 	$sqlTopCountries =  "SELECT 
	// 		development__types.name AS dt_name,
	// 		countries1.id AS country_id,
	// 		countries1.name AS country_name,
	// 		governance_types.id AS governance_id,
	// 		governance_types.name AS governance_name,
	// 		taxonomies.name AS taxonomy_name

	// 	FROM questions
	// 	INNER JOIN countries1 ON countries1.id IN (72,106)
	// 	INNER JOIN development__types ON questions.development_types_id = development__types.id
	// 	INNER JOIN taxonomies ON  questions.taxonomy_id = taxonomies.id
	// 	INNER JOIN question__masters ON questions.question_id = question__masters.id
	// 	INNER JOIN ndhs__masters ON questions.id = ndhs__masters.question_id 
	// 	INNER JOIN governance_types ON governance_types.id";

	// 	$result = $this->db->query($sqlTopCountries);

	// 	if ($result->num_rows > 0) {
	// 		header("Content-Type: JSON");
	// 		$i = 0;
					
	// 		// output data of each row
	// 		while($row = $result->fetch_assoc()) {
	// 			echo json_encode($row,JSON_PRETTY_PRINT);
	// 			$i++;
	// 		}
	// 	} 
	// }

	//GET COMPARATIVE INFO
	// public function getComparativeInfo(){
	// 	$response = array();

	// 	$sqlTopCountries =  "SELECT 
	// 		countries1.id AS id,
	// 		countries1.name AS country_name,
	// 		taxonomies.name AS taxonomy_name,
	// 		taxonomies.id AS taxonomy_id,
	// 		development__types.name AS dt_name,
	// 		ultimate_fields_id

	// 	FROM questions
	// 	INNER JOIN countries1 ON countries1.id IN (72,106)
	// 	INNER JOIN development__types ON questions.development_types_id = development__types.id
	// 	INNER JOIN taxonomies ON  questions.taxonomy_id = taxonomies.id
	// 	INNER JOIN question__masters ON questions.question_id = question__masters.id
	// 	INNER JOIN ndhs__masters ON questions.id = ndhs__masters.question_id 
	// 	INNER JOIN governance_types ON governance_types.id";

	// 	$result = $this->db->query($sqlTopCountries);

	// 	if ($result->num_rows > 0) {
	// 		header("Content-Type: JSON");
	// 		$i = 0;
					
	// 		// output data of each row
	// 		while($row = $result->fetch_assoc()) {
	// 			echo json_encode($row,JSON_PRETTY_PRINT);
	// 			$i++;
	// 		}
	// 	} 

	// }

	


}
$db = new DBconnection;

// $db->getCountries();
// $db->getGovernanceStats(1,29,2021);
// $db->getOverview(1,29);

//  $db->getTableChart();
//  $db->getStatsGraph();
// $db->getComparative();
// $db->getTopCountries();
// $db->getComparativeInfo();






	