<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/TestType.php';

    $database = new database();
    $db = $database->getCon();

    $test = new TestType($db);

    $test->lot_num = isset($_GET['lot_num']) ? $_GET['lot_num'] : die();

    $test->getTest();

    if($test->lot_num != null){
        $testType = array(
            "lot_num" => $test->lot_num,
            "test_type" => $test->test_type
        );
        echo json_encode($testType);
    }else{
        echo "SOMETHING WENT WRONG :-(";
    }


?>