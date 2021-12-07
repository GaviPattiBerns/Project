<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/VaccinType.php';

    $database = new database();
    $db = $database->getCon();

    $vaccine = new VaccinType($db);

    $vaccine->lot_num = isset($_GET['lot_num']) ? $_GET['lot_num'] : die();

    $vaccine->getVacc();

    if($vaccine->lot_num != null){
        $vaccType = array(
            "lot_num" => $vaccine->lot_num,
            "vaccine_type" => $vaccine->vaccine_type
        );
        echo json_encode($vaccType);
    }else{
        echo "SOMETHING WENT WRONG :-(";
    }


?>