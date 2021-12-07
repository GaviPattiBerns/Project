<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/Patient.php';

    $database = new database();
    $db = $database->getCon();

    $pnt = new Patient($db);

    $pnt->aphn = isset($_GET['aphn']) ? $_GET['aphn'] : die();

    $pnt->getPatient();

    if($pnt->fname != null){
        $patient = array(
            "aphn" => $pnt->aphn,
            "fname" => $pnt->fname,
            "lname" => $pnt->lname,
            "email" => $pnt->email,
            "dob" => $pnt->dob,
            "phone_number" => $pnt->phone_number,
            "address" => $pnt->address
        );
        echo json_encode($patient);
    }else{
        echo "SOMETHING WENT WRONG :-(";
    }


?>