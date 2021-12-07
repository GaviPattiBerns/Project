<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/TestProRec.php';

    $database = new database();
    $db = $database->getCon();

    $upTestRec = new TestProRec($db);

    $data = json_decode(file_get_contents("php://input"));

    $upTestRec->pro_id = $data->pro_id;

    $upTestRec->date_time = $data->date_time;
    $upTestRec->location = $data->location;
    $upTestRec->test_result = $data->test_result;
    $upTestRec->rec_id = $data->rec_id;

    if($upTestRec->updateTestProRec()){
        echo 'IT WORKED!';
    }else{
        echo ':-( FAILURE!';}
?>