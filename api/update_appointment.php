<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/Appointment.php';

    $database = new database();
    $db = $database->getCon();

    $upPnt = new Appointment($db);

    $data = json_decode(file_get_contents("php://input"));

    $upApp->time_date = $data->time_date;

    $upApp->app_type = $data->app_type;
    $upApp->patient_id = $data->patient_id;
    $upApp->tpro_id = $data->tpro_id;
    $upApp->vpro_id = $data->vpro_id;
    $upApp->location = $data->location;
    $upApp->survey_id = $data->address;

    if($upPnt->updateApp()){
        echo 'IT WORKED!';
    }else{
        echo ':-( FAILURE!';}
?>