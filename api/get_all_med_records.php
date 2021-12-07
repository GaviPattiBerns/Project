<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../class/PatientMedRecords.php';

    $database = new database();
    $db = $database->getCon();

    $medRecs = new PatientMedRecords($db);

    $medRecords = $medRecs->getAllMedRecs();
    $count = $medRecords->rowCount();


    
    if($count > 0){

        $medRecsArray = array();
        $medRecsArray["body"] = array();
        $medRecsArray["count"] = $count; 

        while ($row = $medRecords->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $x = array(
                "aphn" => $aphn,
                "vac_rec_id" => $vac_rec_id,
                "test_rec_id" => $test_rec_id
            );

            array_push($medRecsArray["body"], $x);
        }

        echo json_encode($medRecsArray);


    }else {
        echo "SOMETHING WENT WRONG :-( ";
    }
    


?>