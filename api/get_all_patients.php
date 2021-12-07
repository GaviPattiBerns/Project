<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../class/Patient.php';

    $database = new database();
    $db = $database->getCon();

    $pnt = new Patient($db);

    $patients = $pnt->getAllPatients();
    $count = $patients->rowCount();


    
    if($count > 0){

        $patientArray = array();
        $patientArray["body"] = array();
        $patientArray["count"] = $count; 

        while ($row = $patients->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $x = array(
                "aphn" => $aphn,
                "fname" => $fname,
                "lname" => $lname, 
                "email" => $email,
                "dob" => $dob,
                "phone_number" => $phone_number,
                "address" => $address
            );

            array_push($patientArray["body"], $x);
        }

        echo json_encode($patientArray);


    }else {
        echo "SOMETHING WENT WRONG :-( ";
    }
    


?>