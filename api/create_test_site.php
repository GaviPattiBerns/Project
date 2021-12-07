<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    include_once '../config/database.php';
    include_once '../class/TestingSite.php';

    $database = new database();
    $db = $database->getCon();

    $newSite = new TestingSite($db);

    $data = json_decode(file_get_contents("php://input"));


    $newSite->location = $data->location;
    $newSite->test_site_id = $data->test_site_id;


    if($newSite->addSite()){
        echo 'IT WORKED!';
    }else{
        echo ':-( FAILURE!';
    }

?>