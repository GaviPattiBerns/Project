<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/VaccinType.php';

    $database = new database();
    $db = $database->getCon();

    $upVacc = new VaccinType($db);

    $data = json_decode(file_get_contents("php://input"));

    $upVacc->lot_num = $data->lot_num;

    $upVacc->vaccine_type = $data->vaccine_type;

    if($upVacc->updateVacc()){
        echo 'IT WORKED!';
    }else{
        echo ':-( FAILURE!';}
?>