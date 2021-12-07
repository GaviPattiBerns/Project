<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/PreBookingSurvey.php';

    $database = new database();
    $db = $database->getCon();

    $upSur = new PreBookingSurvey($db);

    $data = json_decode(file_get_contents("php://input"));

    $upSur->survey_id = $data->survey_id;

    $upSur->has_symptoms = $data->has_symptoms;
    $upSur->has_traveled = $data->has_traveled;
    $upSur->been_exposed = $data->been_exposed;
    $upSur->aphn = $data->aphn;

    if($upSur->updateSurvey()){
        echo 'IT WORKED!';
    }else{
        echo ':-( FAILURE!';}
?>