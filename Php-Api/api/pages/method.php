<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

	include "./../db/connection.php";


	function getOverview($governance_id,$country_id,$db){

		$response = array();
		$response1 = array();
		$response2 = array();
		$governanceStats = array();
		$governanceStats1 = array();
		$governanceStats2 = array();
		$complete = array();
		$complete1 = array();
		$complete2 = array();
	
		$sqlDevelopment = "select * from development__types";
		$result = $db->query($sqlDevelopment);
	
		if($result->num_rows > 0){
			header("Content-Type: JSON");
			$i = 0;
			$j = 0;
			$k = 0;
	
			while($row = $result->fetch_assoc()) {
				$response[$i]['id'] = $row['id'];
				$response[$i]['name'] = $row['name'];
	
				$sqlUltimate = "SELECT * FROM ultimate__fields WHERE development_types_id ='1'";
				$result1 = $db->query($sqlUltimate);
	
					if($result1->num_rows > 0){
		                header("Content-Type: JSON");
						$j= 0;
                        
						while($row = $result1->fetch_assoc()) {
							$response1[$i][$j]['id'] = $row['id'];
							$response1[$i][$j]['name'] = $row['name'];
							$devId = $response[$i]['id'];
							$devName = $response[$i]['name'];
							$ultId = $response1[$i][$j]['id'];
							$ultName = $response1[$i][$j]['name'];
	
							$sqlTax = "SELECT * FROM taxonomies WHERE governance_id = '$governance_id'";
							$result2 = $db->query($sqlTax);
		
							if($result2->num_rows > 0){
			                    header("Content-Type: JSON");
								$k= 0;
		
								while($row = $result2->fetch_assoc()) {
									$taxId = $row['id'];
									$taxName = $row['name'];
									$governanceStats[$k]['development_id'] =$devId;
									$governanceStats[$k]['development_name'] =$devName;
									$governanceStats[$k]['ultimate_id'] =$ultId;
									$governanceStats[$k]['ultimate_name'] =$ultName;
									

									$sqlInd = "SELECT * FROM indicators";
									$result3 = $db->query($sqlInd);

									if($result3->num_rows > 0){
                                        header("Content-Type: JSON");
										$m =0;

										while($row = $result3->fetch_assoc()){
											$indId = $row['id'];
											$indName = $row['name'];
											$governanceStats1[$m]['development_id'] =$devId;
											$governanceStats1[$m]['development_name'] =$devName;
											$governanceStats1[$m]['ultimate_id'] =$ultId;
											$governanceStats1[$m]['ultimate_name'] =$ultName;
											$governanceStats1[$m]['taxonomy_id'] =$taxId;
											$governanceStats1[$m]['taxonomy_name'] =$taxName;

											$sqlQues = "SELECT * FROM question__masters";
											$result4 = $db->query($sqlQues);

											if($result4->num_rows > 0){
                                                header("Content-Type: JSON");
												$n =0;

												while($row = $result4->fetch_assoc()){
													$quesId = $row['id'];
													$quesName = $row['name'];
													$governanceStats2[$n]['development_id'] =$devId;
													$governanceStats2[$n]['development_name'] =$devName;
													$governanceStats2[$n]['ultimate_id'] =$ultId;
													$governanceStats2[$n]['ultimate_name'] =$ultName;
													$governanceStats2[$n]['taxonomy_id'] =$taxId;
													$governanceStats2[$n]['taxonomy_name'] =$taxName;
													$governanceStats2[$n]['indicator_id'] =$indId;
													$governanceStats2[$n]['indicator_name'] =$indName;
													$governanceStats2[$n]['question_id'] =$quesId;
													$governanceStats2[$n]['question_name'] =$quesName;

													// $sqlCountries = "SELECT * FROM countries1";
													// $result5 = $db->query($sqlCountries);

													// if($result5->num_rows > 0){
													// 	$q =0;

													// 	while($row = $result5->fetch_assoc()){
													// 		$countryId = $row['id'];
													// 		$countryName = $row['name'];
													// 		$governanceStats3[$q]['development_id'] =$devId;
													// 		$governanceStats3[$q]['development_name'] =$devName;
													// 		$governanceStats3[$q]['ultimate_id'] =$ultId;
													// 		$governanceStats3[$q]['ultimate_name'] =$ultName;
													// 		$governanceStats3[$q]['taxonomy_id'] =$taxId;
													// 		$governanceStats3[$q]['taxonomy_name'] =$taxName;
													// 		$governanceStats3[$q]['indicator_id'] =$indId;
													// 		$governanceStats3[$q]['indicator_name'] =$indName;
													// 		$governanceStats3[$q]['question_id'] =$quesId;
													// 		$governanceStats3[$q]['question_name'] =$quesName;
													// 		$governanceStats3[$q]['country_id'] =$countryId;
													// 		$governanceStats3[$q]['country_name'] =$countryName;

													// 		$q++;
													// 	}
													// }
													$n++;
												}
											}
											$m++;
										}
									}
									$k++;
								}
								$complete[$i][$response1[$i][$j]['name']] = $governanceStats2;
	
							}
	
							$j++;
						}
					}
					$complete1[$response[$i]['name']] = $complete[$i];
	
				$i++;
			}
			echo json_encode($complete1,JSON_PRETTY_PRINT);
		}
	}

    getOverview(1,29,$connection);
?>


