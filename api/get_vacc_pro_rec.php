<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/VaccProRec.php';

    $database = new database();
    $db = $database->getCon();

    $proRec = new VaccProRec($db);

    $proRec->pro_id = isset($_GET['pro_id']) ? $_GET['pro_id'] : die();

    $proRec->getVaccRecord();

    if($proRec->location != null){
        $proRecord = array(
            "pro_id" => $proRec->pro_id,
            "date_time" => $proRec->date_time,
            "location" => $proRec->location,
            "vacc_num" => $proRec->vacc_num,
            "rec_id" => $proRec->rec_id
        );
        echo json_encode($proRecord);
    }else{
        echo "SOMETHING WENT WRONG :-(";
    }


?>