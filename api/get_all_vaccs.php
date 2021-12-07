<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../class/VaccinType.php';

    $database = new database();
    $db = $database->getCon();

    $vaccine = new VaccinType($db);

    $vaccType = $vaccine->getAllVaccs();
    $count = $vaccType->rowCount();


    
    if($count > 0){

        $vaccTypeArray = array();
        $vaccTypeArray["body"] = array();
        $vaccTypeArray["count"] = $count; 

        while ($row = $vaccType->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $x = array(
                "lot_num" => $lot_num,
                "vaccine_type" => $vaccine_type
            );

            array_push($vaccTypeArray["body"], $x);
        }

        echo json_encode($vaccTypeArray);


    }else {
        echo "SOMETHING WENT WRONG :-( ";
    }
    


?>