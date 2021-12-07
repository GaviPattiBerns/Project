<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/PreBookingSurvey.php';

    $database = new database();
    $db = $database->getCon();

    $sur = new PreBookingSurvey($db);

    $sur->survey_id = isset($_GET['survey_id']) ? $_GET['survey_id'] : die();

    $sur->getSurvey();

    if($sur->survey_id != null){
        $survey = array(
            "survey_id" => $sur->survey_id,
            "has_symptoms" => $sur->has_symptoms,
            "has_traveled" => $sur->has_traveled,
            "been_exposed" => $sur->been_exposed,
            "aphn" => $sur->aphn
        );
        echo json_encode($survey);
    }else{
        echo "SOMETHING WENT WRONG :-(";
    }


?>