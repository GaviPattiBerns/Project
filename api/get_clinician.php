<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/Clinician.php';

    $database = new database();
    $db = $database->getCon();

    $cln = new Clinician($db);

    $cln->eid = isset($_GET['eid']) ? $_GET['eid'] : die();

    $cln->getClinician();

    if($cln->fname != null){
        $clinician = array(
            "eid" => $cln->eid,
            "fname" => $cln->fname,
            "lname" => $cln->lname,
            "email" => $cln->email,
            "dob" => $cln->dob,
            "phone_number" => $cln->phone_number,
            "address" => $cln->address,
            "qualification" => $cln->qualification,
            "mf_location" => $cln->mf_location
        );
        echo json_encode($clinician);
    }else{
        echo "SOMETHING WENT WRONG :-(";
    }


?>