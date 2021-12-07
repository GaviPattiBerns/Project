<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/VaccineSite.php';

    $database = new database();
    $db = $database->getCon();

    $vaccSite = new VaccineSite($db);

    $vaccSite->location = isset($_GET['location']) ? $_GET['location'] : die();

    $vaccSite->getSite();

    if($vaccSite->location != null){
        $testSiteArray = array(
            "location" => $vaccSite->location,
            "vacc_site_id" => $vaccSite->vacc_site_id
        );
        echo json_encode($testSiteArray);
    }else{
        echo "SOMETHING WENT WRONG :-(";
    }


?>