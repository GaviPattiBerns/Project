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

    $newSur = new PreBookingSurvey($db);

    $data = json_decode(file_get_contents("php://input"));


    $newSur->survey_id = $data->survey_id;
    $newSur->has_symptoms = $data->has_symptoms;
    $newSur->has_traveled = $data->has_traveled;
    $newSur->been_exposed = $data->been_exposed;
    $newSur->aphn = $data->aphn;


    if($newSur->addSurvey()){
        echo 'IT WORKED!';
    }else{
        echo ':-( FAILURE!';
    }

?>