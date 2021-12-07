<?php

    class Patient{

        // Connection 
        private $conn;

        //Table 
        private $db_table = "patient";

        public $aphn;
        public $fname;
        public $lname;
        public $email;
        public $dob;
        public $phone_number;
        public $address; 

        //Constructor 
        public function __construct($db){
            $this->conn = $db;
        }

        //Create table entry 
        public function addPatient(){

            $insert = "INSERT INTO
                        ". $this->db_table ."
                        
                        SET 
                            aphn = :aphn,
                            fname = :fname,
                            lname = :lname,
                            email = :email,
                            dob = :dob,
                            phone_number = :phone_number,
                            address = :address";

            $patientIn = $this->conn->prepare($insert);

            //Clean input 
            $this->aphn=htmlspecialchars(strip_tags($this->aphn));
            $this->fname=htmlspecialchars(strip_tags($this->fname));
            $this->lname=htmlspecialchars(strip_tags($this->lname));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->dob=htmlspecialchars(strip_tags($this->dob));
            $this->phone_number=htmlspecialchars(strip_tags($this->phone_number));
            $this->address=htmlspecialchars(strip_tags($this->address));

            //bind to insert query
            $patientIn->bindParam(":aphn", $this->aphn);
            $patientIn->bindParam(":fname", $this->fname);
            $patientIn->bindParam(":lname", $this->lname);
            $patientIn->bindParam(":email", $this->email);
            $patientIn->bindParam(":dob", $this->dob);
            $patientIn->bindParam(":phone_number", $this->phone_number);
            $patientIn->bindParam(":address", $this->address);
            
            //Attempts to add patients tests if successful 
            if($patientIn->execute()){

                return true;

            }else{

                return false;

            }
        }

        //Function to read all of the patients
        public function getAllPatients(){
            $readAll = "SELECT aphn, fname, lname, email, dob, phone_number, address FROM patient";
            $allPatients = $this->conn->prepare($readAll);
            $allPatients->execute();
            return $allPatients;
        }


        //Function to get one patient
        public function getPatient(){
            $getPatient = "SELECT 
                aphn,
                fname,
                lname,
                email,
                dob,
                phone_number,
                address
                FROM
                ". $this->db_table ."
                WHERE 
                    aphn = ?";

            $getPat = $this->conn->prepare($getPatient);
            $this->aphn=htmlspecialchars(strip_tags($this->aphn));

            $getPat->bindParam(1, $this->aphn);

            $getPat->execute();

            $entry = $getPat->fetch(PDO::FETCH_ASSOC);

            $this->fname = $entry['fname'];
            $this->lname = $entry['lname'];
            $this->email = $entry['email'];
            $this->dob = $entry['dob'];
            $this->phone_number = $entry['phone_number'];
            $this->address = $entry['address'];

        }

        //Fucntion to update patient
        public function updatePatient(){

            //Create SQL query     
            $update = "UPDATE
                ". $this->db_table ."
            
                SET 
                    fname = :fname,
                    lname = :lname,
                    email = :email,
                    dob = :dob,
                    phone_number = :phone_number,
                    address = :address
                    
                WHERE
                    aphn = :aphn";
            
            $patientUpdate = $this->conn->prepare($update);
            
            //Clean input
            $this->fname=htmlspecialchars(strip_tags($this->fname));
            $this->lname=htmlspecialchars(strip_tags($this->lname));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->dob=htmlspecialchars(strip_tags($this->dob));
            $this->phone_number=htmlspecialchars(strip_tags($this->phone_number));
            $this->address=htmlspecialchars(strip_tags($this->address));
            $this->aphn=htmlspecialchars(strip_tags($this->aphn));

            //Bind to the query variables
            $patientUpdate->bindParam(":fname", $this->fname);
            $patientUpdate->bindParam(":lname", $this->lname);
            $patientUpdate->bindParam(":email", $this->email);
            $patientUpdate->bindParam(":dob", $this->dob);
            $patientUpdate->bindParam(":phone_number", $this->phone_number);
            $patientUpdate->bindParam(":address", $this->address);
            $patientUpdate->bindParam(":aphn", $this->aphn);

            if($patientUpdate->execute()){
                return true;
            }else{
                return false; 
            }



        }

        //Function to delete patient
        public function deletePatient(){

            $delete = "DELETE FROM " . $this->db_table . " WHERE aphn = ?";
            $delQuery = $this->conn->prepare($delete);

            $this->aphn=htmlspecialchars(strip_tags($this->aphn));

            $delQuery->bindParam(1, $this->aphn);

            if($delQuery->execute()){
                return true;
            }else{
                return false;
            }
        }
    }

?>