<?php

    class PatientMedRecords{
        // Connection 
        private $conn;

        //Table 
        private $db_table = "patient_medical_records";

        public $aphn;
        public $vac_rec_id;
        public $test_rec_id;

        //Constructor 
        public function __construct($db){
            $this->conn = $db;
        }

        //Create table entry 
        public function addMedRec(){

            $insert = "INSERT INTO
                        ". $this->db_table ."
                        
                        SET 
                            aphn = :aphn,
                            vac_rec_id = :vac_rec_id,
                            test_rec_id = :test_rec_id";

            $medRecIn = $this->conn->prepare($insert);

            //Clean input 
            $this->aphn=htmlspecialchars(strip_tags($this->aphn));
            $this->vac_rec_id=htmlspecialchars(strip_tags($this->vac_rec_id));
            $this->test_rec_id=htmlspecialchars(strip_tags($this->test_rec_id));

            //bind to insert query
            $medRecIn->bindParam(":aphn", $this->aphn);
            $medRecIn->bindParam(":vac_rec_id", $this->vac_rec_id);
            $medRecIn->bindParam(":test_rec_id", $this->test_rec_id);
            
            //Attempts to add patients tests if successful 
            if($medRecIn->execute()){

                return true;

            }else{

                return false;

            }
        }

        public function getAllMedRecs(){
            $readAll = "SELECT aphn, vac_rec_id, test_rec_id FROM patient_medical_records";
            $allMedRecs = $this->conn->prepare($readAll);
            $allMedRecs->execute();
            return $allMedRecs;
        }


        public function getMedRec(){
            $getMedRec = "SELECT 
                aphn,
                vac_rec_id,
                test_rec_id

                FROM
                ". $this->db_table ."
                WHERE 
                    aphn = ?";

            $getRec = $this->conn->prepare($getMedRec);
            $this->aphn=htmlspecialchars(strip_tags($this->aphn));

            $getRec->bindParam(1, $this->aphn);

            $getRec->execute();

            $entry = $getRec->fetch(PDO::FETCH_ASSOC);

            $this->aphn = $entry['aphn'];
            $this->vac_rec_id = $entry['vac_rec_id'];
            $this->test_rec_id = $entry['test_rec_id'];

        }

        public function updateMedRec(){

            //Create SQL query     
            $update = "UPDATE
                ". $this->db_table ."
            
                SET 
                    aphn = :aphn,
                    vac_rec_id = :vac_rec_id,
                    test_rec_id = :test_rec_id
                    
                WHERE
                    aphn = :aphn";
            
            $medRec = $this->conn->prepare($update);
            
            //Clean input
            $this->aphn=htmlspecialchars(strip_tags($this->aphn));
            $this->vac_rec_id=htmlspecialchars(strip_tags($this->vac_rec_id));
            $this->test_rec_id=htmlspecialchars(strip_tags($this->test_rec_id));

            //Bind to the query variables
            $medRec->bindParam(":aphn", $this->aphn);
            $medRec->bindParam(":vac_rec_id", $this->vac_rec_id);
            $medRec->bindParam(":test_rec_id", $this->test_rec_id);

            if($medRec->execute()){
                return true;
            }else{
                return false; 
            }

        }

        public function deleteMedRec(){

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