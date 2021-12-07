<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../class/TestProRec.php';

    $database = new database();
    $db = $database->getCon();

    $testRec = new TestProRec($db);

    $testRecords = $testRec->getAllRecords();
    $count = $testRecords->rowCount();


    
    if($count > 0){

        $testRecordsArray = array();
        $testRecordsArray["body"] = array();
        $testRecordsArray["count"] = $count; 

        while ($row = $testRecords->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $x = array(
                "pro_id" => $pro_id,
                "date_time" => $date_time,
                "location" => $location,
                "test_result" => $test_result,
                "rec_id" => $rec_id
            );

            array_push($testRecordsArray["body"], $x);
        }

        echo json_encode($testRecordsArray);


    }else {
        echo "SOMETHING WENT WRONG :-( ";
    }
    


?>