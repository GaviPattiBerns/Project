<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../class/PreBookingSurvey.php';

    $database = new database();
    $db = $database->getCon();

    $sur = new PreBookingSurvey($db);

    $surveys = $sur->getAllSurveys();
    $count = $surveys->rowCount();


    
    if($count > 0){

        $surveysArray = array();
        $surveysArray["body"] = array();
        $surveysArray["count"] = $count; 

        while ($row = $surveys->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $x = array(
                "survey_id" => $survey_id,
                "has_symptoms" => $has_symptoms,
                "has_traveled" => $has_traveled,
                "been_exposed" => $been_exposed,
                "aphn" => $aphn
            );

            array_push($surveysArray["body"], $x);
        }

        echo json_encode($surveysArray);


    }else {
        echo "SOMETHING WENT WRONG :-( ";
    }
    


?>