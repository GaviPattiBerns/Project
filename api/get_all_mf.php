<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../class/MedicalFacility.php';

    $database = new database();
    $db = $database->getCon();

    $mf = new MedicalFacility($db);

    $medFacil = $mf->getAllMedFacils();
    $count = $medFacil->rowCount();


    
    if($count > 0){

        $medFacilArray = array();
        $medFacilArray["body"] = array();
        $medFacilArray["count"] = $count; 

        while ($row = $medFacil->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $x = array(
                "location" => $location,
                "name" => $name,
                "phone_number" => $phone_number
            );

            array_push($medFacilArray["body"], $x);
        }

        echo json_encode($medFacilArray);


    }else {
        echo "SOMETHING WENT WRONG :-( ";
    }
    


?>