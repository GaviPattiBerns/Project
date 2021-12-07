<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/MedicalFacility.php';

    $database = new database();
    $db = $database->getCon();

    $mf = new MedicalFacility($db);

    $mf->location = isset($_GET['location']) ? $_GET['location'] : die();

    $mf->getMedFacil();

    if($mf->location != null){
        $medFacil = array(
            "location" => $mf->location,
            "name" => $mf->name,
            "phone_number" => $mf->phone_number
        );
        echo json_encode($medFacil);
    }else{
        echo "SOMETHING WENT WRONG :-(";
    }


?>