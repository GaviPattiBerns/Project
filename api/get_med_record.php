<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/PatientMedRecords.php';

    $database = new database();
    $db = $database->getCon();

    $medRec = new PatientMedRecords($db);

    $medRec->aphn = isset($_GET['aphn']) ? $_GET['aphn'] : die();

    $medRec->getMedRec();

    if($medRec->aphn != null){
        $medRec = array(
            "aphn" => $medRec->aphn,
            "vac_rec_id" => $medRec->vac_rec_id,
            "test_rec_id" => $medRec->test_rec_id
        );
        echo json_encode($medRec);
    }else{
        echo "SOMETHING WENT WRONG :-(";
    }


?>