<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../class/TestType.php';

    $database = new database();
    $db = $database->getCon();

    $test = new TestType($db);

    $testType = $test->getAllTests();
    $count = $testType->rowCount();


    
    if($count > 0){

        $testTypeArray = array();
        $testTypeArray["body"] = array();
        $testTypeArray["count"] = $count; 

        while ($row = $testType->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $x = array(
                "lot_num" => $lot_num,
                "test_type" => $test_type
            );

            array_push($testTypeArray["body"], $x);
        }

        echo json_encode($testTypeArray);


    }else {
        echo "SOMETHING WENT WRONG :-( ";
    }
    


?>