<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/TestType.php';

    $database = new database();
    $db = $database->getCon();

    $upTest = new TestType($db);

    $data = json_decode(file_get_contents("php://input"));

    $upTest->lot_num = $data->lot_num;

    $upTest->test_type = $data->test_type;

    if($upTest->updateTest()){
        echo 'IT WORKED!';
    }else{
        echo ':-( FAILURE!';}
?>