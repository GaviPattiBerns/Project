<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../class/TestingSite.php';

    $database = new database();
    $db = $database->getCon();

    $site = new TestingSite($db);

    $testSite = $site->getAllSites();
    $count = $testSite->rowCount();


    
    if($count > 0){

        $testSiteArray = array();
        $testSiteArray["body"] = array();
        $testSiteArray["count"] = $count; 

        while ($row = $testSite->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $x = array(
                "location" => $location,
                "test_site_id" => $test_site_id
            );

            array_push($testSiteArray["body"], $x);
        }

        echo json_encode($testSiteArray);


    }else {
        echo "SOMETHING WENT WRONG :-( ";
    }
    


?>