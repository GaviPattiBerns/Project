<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/PatientMedRecords.php';

    $database = new database();
    $db = $database->getCon();

    $upRec = new PatientMedRecords($db);

    $data = json_decode(file_get_contents("php://input"));

    $upRec->aphn = $data->aphn;

    $upRec->vac_rec_id = $data->vac_rec_id;
    $upRec->test_rec_id = $data->test_rec_id;

    if($upRec->updateMedRec()){
        echo 'IT WORKED!';
    }else{
        echo ':-( FAILURE!';}
?>