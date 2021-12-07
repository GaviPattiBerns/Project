<?php

    class VaccinType{
        // Connection 
        private $conn;

        //Table 
        private $db_table = "vaccin_type";

        public $lot_num;
        public $vaccine_type;

        //Constructor 
        public function __construct($db){
            $this->conn = $db;
        }

        //Create table entry 
        public function addVacc(){

            $insert = "INSERT INTO
                        ". $this->db_table ."
                        
                        SET 
                            lot_num = :lot_num,
                            vaccine_type = :vaccine_type";

            $vaccIn = $this->conn->prepare($insert);

            //Clean input 
            $this->lot_num=htmlspecialchars(strip_tags($this->lot_num));
            $this->vaccine_type=htmlspecialchars(strip_tags($this->vaccine_type));

            //bind to insert query
            $vaccIn->bindParam(":lot_num", $this->lot_num);
            $vaccIn->bindParam(":vaccine_type", $this->vaccine_type);

            //Attempts to add patients tests if successful 
            if($vaccIn->execute()){

                return true;

            }else{

                return false;

            }
        }

        public function getAllVaccs(){
            $readAll = "SELECT lot_num, vaccine_type FROM vaccin_type";
            $allVaccs = $this->conn->prepare($readAll);
            $allVaccs->execute();
            return $allVaccs;
        }


        public function getVacc(){
            $getVacc = "SELECT 
                lot_num,
                vaccine_type

                FROM
                ". $this->db_table ."
                WHERE 
                    lot_num = ?";

            $getV = $this->conn->prepare($getVacc);
            $this->lot_num=htmlspecialchars(strip_tags($this->lot_num));

            $getV->bindParam(1, $this->lot_num);

            $getV->execute();

            $entry = $getV->fetch(PDO::FETCH_ASSOC);

            $this->lot_num = $entry['lot_num'];
            $this->vaccine_type = $entry['vaccine_type'];

        }

        public function updateVacc(){

            //Create SQL query     
            $update = "UPDATE
                ". $this->db_table ."
            
                SET 
                    lot_num = :lot_num,
                    vaccine_type = :vaccine_type
                    
                WHERE
                    lot_num = :lot_num";
            
            $vacc = $this->conn->prepare($update);
            
            //Clean input
            $this->lot_num=htmlspecialchars(strip_tags($this->lot_num));
            $this->vaccine_type=htmlspecialchars(strip_tags($this->vaccine_type));

            //Bind to the query variables
            $vacc->bindParam(":lot_num", $this->lot_num);
            $vacc->bindParam(":vaccine_type", $this->vaccine_type);

            if($vacc->execute()){
                return true;
            }else{
                return false; 
            }

        }

        public function deleteVacc(){

            $delete = "DELETE FROM " . $this->db_table . " WHERE lot_num = ?";
            $delQuery = $this->conn->prepare($delete);

            $this->lot_num=htmlspecialchars(strip_tags($this->lot_num));

            $delQuery->bindParam(1, $this->lot_num);

            if($delQuery->execute()){
                return true;
            }else{
                return false;
            }
        }
    }

?>