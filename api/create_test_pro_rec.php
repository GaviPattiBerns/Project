<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    include_once '../config/database.php';
    include_once '../class/TestProRec.php';

    $database = new database();
    $db = $database->getCon();

    $newTestRec = new TestProRec($db);

    $data = json_decode(file_get_contents("php://input"));


    $newTestRec->pro_id = $data->pro_id;
    $newTestRec->date_time = $data->date_time;
    $newTestRec->location = $data->location;
    $newTestRec->test_result = $data->test_result;
    $newTestRec->rec_id= $data->rec_id;


    if($newTestRec->addTestRec()){
        echo 'IT WORKED!';
    }else{
        echo ':-( FAILURE!';
    }

?>