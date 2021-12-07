<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../class/VaccineSite.php';

    $database = new database();
    $db = $database->getCon();

    $site = new VaccineSite($db);

    $vaccSite = $site->getAllSites();
    $count = $vaccSite->rowCount();


    
    if($count > 0){

        $vaccSiteArray = array();
        $vaccSiteArray["body"] = array();
        $vaccSiteArray["count"] = $count; 

        while ($row = $vaccSite->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $x = array(
                "location" => $location,
                "vacc_site_id" => $vacc_site_id
            );

            array_push($vaccSiteArray["body"], $x);
        }

        echo json_encode($vaccSiteArray);


    }else {
        echo "SOMETHING WENT WRONG :-( ";
    }
    


?>