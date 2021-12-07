<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/Patient.php';

    $database = new database();
    $db = $database->getCon();

    $upPnt = new Patient($db);

    $data = json_decode(file_get_contents("php://input"));

    $upPnt->aphn = $data->aphn;

    $upPnt->fname = $data->fname;
    $upPnt->lname = $data->lname;
    $upPnt->email = $data->email;
    $upPnt->dob = $data->dob;
    $upPnt->phone_number = $data->phone_number;
    $upPnt->address = $data->address;

    if($upPnt->updatePatient()){
        echo 'IT WORKED!';
    }else{
        echo ':-( FAILURE!';}
?>