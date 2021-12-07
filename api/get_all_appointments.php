<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../class/Appointment.php';

    $database = new database();
    $db = $database->getCon();

    $app = new Appointment($db);

    $appointment = $app->getAllApps();
    $count = $appointment->rowCount();


    
    if($count > 0){

        $appointmentArray = array();
        $appointmentArray["body"] = array();
        $appointmentArray["count"] = $count; 

        while ($row = $appointment->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $x = array(
                "time_date" => $time_date,
                "app_type" => $app_type,
                "patient_id" => $patient_id,
                "tpro_id" => $tpro_id,
                "vpro_id" => $vpro_id,
                "location" => $location,
                "survey_id" => $survey_id
            );

            array_push($appointmentArray["body"], $x);
        }

        echo json_encode($appointmentArray);


    }else {
        echo "SOMETHING WENT WRONG :-( ";
    }
    


?>