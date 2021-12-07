<?php

    class VaccProRec{
        // Connection 
        private $conn;

        //Table 
        private $db_table = "vaccine_procedure_record";

        public $pro_id;
        public $date_time;
        public $location;
        public $vacc_num;
        public $rec_id;

        //Constructor 
        public function __construct($db){
            $this->conn = $db;
        }

        //Create table entry 
        public function addVaccRec(){

            $insert = "INSERT INTO
                        ". $this->db_table ."
                        
                        SET 
                            pro_id = :pro_id,
                            date_time = :date_time,
                            location = :location,
                            vacc_num = :vacc_num,
                            rec_id = :rec_id";

            $vaccIn = $this->conn->prepare($insert);

            //Clean input 
            $this->pro_id=htmlspecialchars(strip_tags($this->pro_id));
            $this->date_time=htmlspecialchars(strip_tags($this->date_time));
            $this->location=htmlspecialchars(strip_tags($this->location));
            $this->vacc_num=htmlspecialchars(strip_tags($this->vacc_num));
            $this->rec_id=htmlspecialchars(strip_tags($this->rec_id));

            //bind to insert query
            $vaccIn->bindParam(":pro_id", $this->pro_id);
            $vaccIn->bindParam(":date_time", $this->date_time);
            $vaccIn->bindParam(":location", $this->location);
            $vaccIn->bindParam(":vacc_num", $this->vacc_num);
            $vaccIn->bindParam(":rec_id", $this->rec_id);
            
            //Attempts to add patients tests if successful 
            if($vaccIn->execute()){

                return true;

            }else{

                return false;

            }
        }

        public function getAllRecords(){
            $readAll = "SELECT pro_id, date_time, location, vacc_num, rec_id FROM vaccine_procedure_record";
            $allRecord = $this->conn->prepare($readAll);
            $allRecord->execute();
            return $allRecord;
        }


        public function getVaccRecord(){
            $getRecord = "SELECT 
                pro_id,
                date_time,
                location,
                vacc_num, 
                rec_id

                FROM
                ". $this->db_table ."
                WHERE 
                    pro_id = ?";

            $getRec = $this->conn->prepare($getRecord);
            $this->pro_id=htmlspecialchars(strip_tags($this->pro_id));

            $getRec->bindParam(1, $this->pro_id);

            $getRec->execute();

            $entry = $getRec->fetch(PDO::FETCH_ASSOC);

            $this->pro_id = $entry['pro_id'];
            $this->date_time = $entry['date_time'];
            $this->location = $entry['location'];
            $this->vacc_num = $entry['vacc_num'];
            $this->rec_id = $entry['rec_id'];

        }

        public function updateVaccProRec(){

            //Create SQL query     
            $update = "UPDATE
                ". $this->db_table ."
            
                SET 
                    pro_id = :pro_id,
                    date_time = :date_time,
                    location = :location,
                    vacc_num = :vacc_num,
                    rec_id= :rec_id
                    
                WHERE
                    pro_id = :pro_id";
            
            $vaccRec = $this->conn->prepare($update);
            
            //Clean input
            $this->pro_id=htmlspecialchars(strip_tags($this->pro_id));
            $this->date_time=htmlspecialchars(strip_tags($this->date_time));
            $this->location=htmlspecialchars(strip_tags($this->location));
            $this->vacc_num=htmlspecialchars(strip_tags($this->vacc_num));
            $this->rec_id=htmlspecialchars(strip_tags($this->rec_id));

            //Bind to the query variables
            $vaccRec->bindParam(":pro_id", $this->pro_id);
            $vaccRec->bindParam(":date_time", $this->date_time);
            $vaccRec->bindParam(":location", $this->location);
            $vaccRec->bindParam(":vacc_num", $this->vacc_num);
            $vaccRec->bindParam(":rec_id", $this->rec_id);

            if($vaccRec->execute()){
                return true;
            }else{
                return false; 
            }

        }

        public function deleteVaccRec(){

            $delete = "DELETE FROM " . $this->db_table . " WHERE pro_id = ?";
            $delQuery = $this->conn->prepare($delete);

            $this->pro_id=htmlspecialchars(strip_tags($this->pro_id));

            $delQuery->bindParam(1, $this->pro_id);

            if($delQuery->execute()){
                return true;
            }else{
                return false;
            }
        }
    }

?>