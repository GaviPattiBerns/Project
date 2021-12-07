<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../class/VaccProRec.php';

    $database = new database();
    $db = $database->getCon();

    $vaccRec = new VaccProRec($db);

    $vaccRecords = $vaccRec->getAllRecords();
    $count = $vaccRecords->rowCount();


    
    if($count > 0){

        $vaccRecordsArray = array();
        $vaccRecordsArray["body"] = array();
        $vaccRecordsArray["count"] = $count; 

        while ($row = $vaccRecords->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $x = array(
                "pro_id" => $pro_id,
                "date_time" => $date_time,
                "location" => $location,
                "vacc_num" => $vacc_num,
                "rec_id" => $rec_id
            );

            array_push($vaccRecordsArray["body"], $x);
        }

        echo json_encode($vaccRecordsArray);


    }else {
        echo "SOMETHING WENT WRONG :-( ";
    }
    


?>