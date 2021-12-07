<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    include_once '../config/database.php';
    include_once '../class/Clinician.php';

    $database = new database();
    $db = $database->getCon();

    $newClin = new Clinician($db);

    $data = json_decode(file_get_contents("php://input"));


    $newClin->eid = $data->eid;
    $newClin->fname = $data->fname;
    $newClin->lname = $data->lname;
    $newClin->email = $data->email;
    $newClin->dob = $data->dob;
    $newClin->phone_number = $data->phone_number;
    $newClin->address = $data->address;
    $newClin->qualification = $data->qualification;
    $newClin->mf_location = $data->mf_location;


    if($newClin->addClinician()){
        echo 'IT WORKED!';
    }else{
        echo ':-( FAILURE!';
    }

?>