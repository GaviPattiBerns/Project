<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/VaccineSite.php';

    $database = new database();
    $db = $database->getCon();

    $upVaccSite = new VaccineSite($db);

    $data = json_decode(file_get_contents("php://input"));

    $upVaccSite->location = $data->location;

    $upVaccSite->vacc_site_id = $data->vacc_site_id;

    if($upVaccSite->updateSite()){
        echo 'IT WORKED!';
    }else{
        echo ':-( FAILURE!';}
?>