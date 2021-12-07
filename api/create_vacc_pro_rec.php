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

    $newVaccRec = new VaccProRec($db);

    $data = json_decode(file_get_contents("php://input"));


    $newVaccRec->pro_id = $data->pro_id;
    $newVaccRec->date_time = $data->date_time;
    $newVaccRec->location = $data->location;
    $newVaccRec->vacc_num = $data->vacc_num;
    $newVaccRec->rec_id = $data->rec_id;


    if($newVaccRec->addVaccRec()){
        echo 'IT WORKED!';
    }else{
        echo ':-( FAILURE!';
    }

?>