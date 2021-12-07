<?php 
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../class/Clinician.php';

    $database = new database();
    $db = $database->getCon();

    $pnt = new Clinician($db);

    $clinicians = $pnt->getAllClinicians();
    $count = $clinicians->rowCount();


    
    if($count > 0){

        $clinicianArray = array();
        $clinicianArray["body"] = array();
        $clinicianArray["count"] = $count; 

        while ($row = $clinicians->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $x = array(
                "eid" => $eid,
                "fname" => $fname,
                "lname" => $lname, 
                "email" => $email,
                "dob" => $dob,
                "phone_number" => $phone_number,
                "address" => $address,
                "qualification" => $qualification,
                "mf_location" => $mf_location
            );

            array_push($clinicianArray["body"], $x);
        }

        echo json_encode($clinicianArray);


    }else {
        echo "SOMETHING WENT WRONG :-( ";
    }
    


?>