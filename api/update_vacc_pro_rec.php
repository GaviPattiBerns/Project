<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/VaccProRec.php';

    $database = new database();
    $db = $database->getCon();

    $upVaccRec = new VaccProRec($db);

    $data = json_decode(file_get_contents("php://input"));

    $upVaccRec->pro_id = $data->pro_id;

    $upVaccRec->date_time = $data->date_time;
    $upVaccRec->location = $data->location;
    $upVaccRec->vacc_num = $data->vacc_num;
    $upVaccRec->rec_id = $data->rec_id;

    if($upVaccRec->updateVaccProRec()){
        echo 'IT WORKED!';
    }else{
        echo ':-( FAILURE!';}
?>