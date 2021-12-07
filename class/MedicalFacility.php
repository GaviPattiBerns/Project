<?php

    class MedicalFacility{
        // Connection 
        private $conn;

        //Table 
        private $db_table = "medical_facility";

        public $locaiton;
        public $name;
        public $phone_number;

        //Constructor 
        public function __construct($db){
            $this->conn = $db;
        }

        //Create table entry 
        public function addMedFacil(){

            $insert = "INSERT INTO
                        ". $this->db_table ."
                        
                        SET 
                            location = :location,
                            name = :name,
                            phone_number = :phone_number";

            $medFacilIn = $this->conn->prepare($insert);

            //Clean input 
            $this->location=htmlspecialchars(strip_tags($this->location));
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->phone_number=htmlspecialchars(strip_tags($this->phone_number));

            //bind to insert query
            $medFacilIn->bindParam(":location", $this->location);
            $medFacilIn->bindParam(":name", $this->name);
            $medFacilIn->bindParam(":phone_number", $this->phone_number);
            
            //Attempts to add patients tests if successful 
            if($medFacilIn->execute()){

                return true;

            }else{

                return false;

            }
        }

        public function getAllMedFacils(){
            $readAll = "SELECT location, name, phone_number FROM medical_facility";
            $allMedFacil = $this->conn->prepare($readAll);
            $allMedFacil->execute();
            return $allMedFacil;
        }


        public function getMedFacil(){
            $getMedFacil = "SELECT
                location,
                name,
                phone_number

                FROM
                ". $this->db_table ."
                WHERE 
                    location = ?";

            $getMF = $this->conn->prepare($getMedFacil);
            $this->location=htmlspecialchars(strip_tags($this->location));

            $getMF->bindParam(1, $this->location);

            $getMF->execute();

            $entry = $getMF->fetch(PDO::FETCH_ASSOC);

            $this->location = $entry['location'];
            $this->name = $entry['name'];
            $this->phone_number = $entry['phone_number'];

        }

        public function updateMedFacil(){

            //Create SQL query     
            $update = "UPDATE
                ". $this->db_table ."
            
                SET 
                    location = :location,
                    name = :name,
                    phone_number = :phone_number
                    
                WHERE
                    location = :location";
            
            $medFacilUpdate = $this->conn->prepare($update);
            
            //Clean input
            $this->location=htmlspecialchars(strip_tags($this->location));
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->phone_number=htmlspecialchars(strip_tags($this->phone_number));

            //Bind to the query variables
            $medFacilUpdate->bindParam(":location", $this->location);
            $medFacilUpdate->bindParam(":name", $this->name);
            $medFacilUpdate->bindParam(":phone_number", $this->phone_number);

            if($medFacilUpdate->execute()){
                return true;
            }else{
                return false; 
            }

        }

        public function deleteMedFacil(){

            $delete = "DELETE FROM " . $this->db_table . " WHERE location = ?";
            $delQuery = $this->conn->prepare($delete);

            $this->location=htmlspecialchars(strip_tags($this->location));

            $delQuery->bindParam(1, $this->location);

            if($delQuery->execute()){
                return true;
            }else{
                return false;
            }
        }
    }

?>