<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../class/Clinician.php';

$database = new database();
$db = $database->getCon();

$cln = new Clinician($db);

$data = json_decode(file_get_contents("php://input"));

$cln->eid = $data->eid;

if($cln->deleteClinician()){
    echo "IT WORKED!!!!";
}else{
    echo "SOMETHING WENT WRONG :-(";
}

?>