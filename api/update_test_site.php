<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/TestingSite.php';

    $database = new database();
    $db = $database->getCon();

    $upTestSite = new TestingSite($db);

    $data = json_decode(file_get_contents("php://input"));

    $upTestSite->location = $data->location;

    $upTestSite->test_site_id = $data->test_site_id;

    if($upTestSite->updateSite()){
        echo 'IT WORKED!';
    }else{
        echo ':-( FAILURE!';}
?>