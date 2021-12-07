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

    $testSite = new TestingSite($db);

    $testSite->location = isset($_GET['location']) ? $_GET['location'] : die();

    $testSite->getSite();

    if($testSite->location != null){
        $testSiteArray = array(
            "location" => $testSite->location,
            "test_site_id" => $testSite->test_site_id
        );
        echo json_encode($testSiteArray);
    }else{
        echo "SOMETHING WENT WRONG :-(";
    }


?>