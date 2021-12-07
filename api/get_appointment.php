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

    $app = new Appointment($db);

    $app->time_date = isset($_GET['time_date']) ? $_GET['time_date'] : die();

    $app->getApp();

    if($app->time_date != null){
        $appointment = array(
            "time_date" => $app->time_date,
            "app_type" => $app->app_type,
            "patient_id" => $app->patient_id,
            "tpro_id" => $app->tpro_id,
            "vpro_id" => $app->vpro_id,
            "location" => $app->location,
            "survey_id" => $app->survey_id
        );
        echo json_encode($appointment);
    }else{
        echo "SOMETHING WENT WRONG :-(";
    }


?>