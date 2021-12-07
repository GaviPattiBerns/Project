<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    include_once '../config/database.php';
    include_once '../class/Appointment.php';

    $database = new database();
    $db = $database->getCon();

    $newApp = new Appointment($db);

    $data = json_decode(file_get_contents("php://input"));


    $newApp->time_date = $data->time_date;
    $newApp->app_type = $data->app_type;
    $newApp->patient_id = $data->patient_id;
    $newApp->tpro_id = $data->tpro_id;
    $newApp->vpro_id = $data->vpro_id;
    $newApp->location = $data->location;
    $newApp->survey_id = $data->survey_id;


    if($newApp->addAppointment()){
        echo 'IT WORKED!';
    }else{
        echo ':-( FAILURE!';
    }

?>