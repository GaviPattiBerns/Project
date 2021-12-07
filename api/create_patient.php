<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: multipart/form-data; application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    include_once '../config/database.php';
    include_once '../class/Patient.php';

    $database = new database();
    $db = $database->getCon();

    $newPnt = new Patient($db);

    $data = json_decode(file_get_contents("php://input"));

    $newPnt->aphn = $data->aphn;
    $newPnt->fname = $data->fname;
    $newPnt->lname = $data->lname;
    $newPnt->email = $data->email;
    $newPnt->dob = $data->dob;
    $newPnt->phone_number = $data->phone_number;
    $newPnt->address = $data->address;

    if($newPnt->addPatient()){
        echo 'IT WORKED!';
    }else{
        echo ':-( FAILURE!';
    }

?>