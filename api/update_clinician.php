<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/Clinician.php';

    $database = new database();
    $db = $database->getCon();

    $upCln = new Clinician($db);

    $data = json_decode(file_get_contents("php://input"));

    $upCln->eid = $data->eid;

    $upCln->fname = $data->fname;
    $upCln->lname = $data->lname;
    $upCln->email = $data->email;
    $upCln->dob = $data->dob;
    $upCln->phone_number = $data->phone_number;
    $upCln->address = $data->address;
    $upCln->qualification = $data->qualification;
    $upCln->mf_location = $data->mf_location;

    if($upCln->updateClinician()){
        echo 'IT WORKED!';
    }else{
        echo ':-( FAILURE!';}
?>