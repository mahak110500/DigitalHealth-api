<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "./../db/cononnecti.php";

 function getGovernanceStats($governance_id,$country_id,$year,$db){

    $response = array();
    $response1 = array();
    $response2 = array();
    $governanceStats = array();
    $complete = array();
    $complete1 = array();

    $sqlDevelopment = "select * from development__types";
    $result = $db->query($sqlDevelopment);

    if($result->num_rows > 0){
        $i = 0;
        $j = 0;
        $k = 0;

        while($row = $result->fetch_assoc()) {
            $response[$i]['id'] = $row['id'];
            $response[$i]['name'] = $row['name'];
            $sqlTaxonomies = "select * from taxonomies where governance_id = '$governance_id'";
            $result1 = $db->query($sqlTaxonomies);

                if($result1->num_rows > 0){
                    $j= 0;
                    while($row = $result1->fetch_assoc()) {
                        $response1[$i][$j]['id'] = $row['id'];
                        $response1[$i][$j]['name'] = $row['name'];
                        $daveId = $response[$i]['id'];
                        $daveName = $response[$i]['name'];
                        $taxId = $response1[$i][$j]['id'];
                        $taxeName = $response1[$i][$j]['name'];

                        $sqlUltimate = "select * from ultimate__fields where development_types_id ='$daveId'";
                        // $sqlUltimate = "select * from ultimate__fields ";
                        $result2 = $db->query($sqlUltimate);
    
                        if($result2->num_rows > 0){
                            header("Content-Type: JSON");
                            $k= 0;
    
                            while($row = $result2->fetch_assoc()) {
                                $governanceStats[$k]['development_id'] =$daveId;
                                $governanceStats[$k]['development_name'] =$daveName;
                                $governanceStats[$k]['taxonomy_id'] =$taxId;
                                $governanceStats[$k]['taxonomy_name'] =$taxeName;
                                $governanceStats[$k]['ultimate_id'] =$row['id'];
                                $governanceStats[$k]['ultimate_name'] =$row['name'];

                                $k++;
                            }

                            $complete[$i][$response1[$i][$j]['name']] = $governanceStats;
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

getGovernanceStats(1,29,2021,$connection);

?>