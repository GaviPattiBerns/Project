<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    include_once '../config/database.php';
    include_once '../class/MedicalFacility.php';

    $database = new database();
    $db = $database->getCon();

    $newMf = new MedicalFacility($db);

    $data = json_decode(file_get_contents("php://input"));


    $newMf->location = $data->location;
    $newMf->name = $data->name;
    $newMf->phone_number = $data->phone_number;


    if($newMf->addMedFacil()){
        echo 'IT WORKED!';
    }else{
        echo ':-( FAILURE!';
    }

?>