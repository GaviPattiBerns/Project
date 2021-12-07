<?php

    class TestProRec{
        // Connection 
        private $conn;

        //Table 
        private $db_table = "test_procedure_record";

        public $pro_id;
        public $date_time;
        public $location;
        public $test_result;
        public $rec_id;

        //Constructor 
        public function __construct($db){
            $this->conn = $db;
        }

        //Create table entry 
        public function addTestRec(){

            $insert = "INSERT INTO
                        ". $this->db_table ."
                        
                        SET 
                            pro_id = :pro_id,
                            date_time = :date_time,
                            location = :location,
                            test_result = :test_result,
                            rec_id = :rec_id";

            $recIn = $this->conn->prepare($insert);

            //Clean input 
            $this->pro_id=htmlspecialchars(strip_tags($this->pro_id));
            $this->date_time=htmlspecialchars(strip_tags($this->date_time));
            $this->location=htmlspecialchars(strip_tags($this->location));
            $this->test_result=htmlspecialchars(strip_tags($this->test_result));
            $this->rec_id=htmlspecialchars(strip_tags($this->rec_id));

            //bind to insert query
            $recIn->bindParam(":pro_id", $this->pro_id);
            $recIn->bindParam(":date_time", $this->date_time);
            $recIn->bindParam(":location", $this->location);
            $recIn->bindParam(":test_result", $this->test_result);
            $recIn->bindParam(":rec_id", $this->rec_id);
            
            //Attempts to add patients tests if successful 
            if($recIn->execute()){

                return true;

            }else{

                return false;

            }
        }

        public function getAllRecords(){
            $readAll = "SELECT pro_id, date_time, location, test_result, rec_id FROM test_procedure_record";
            $allRecord = $this->conn->prepare($readAll);
            $allRecord->execute();
            return $allRecord;
        }


        public function getTestRecord(){
            $getRecord = "SELECT 
                pro_id,
                date_time,
                location,
                test_result, 
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
            $this->test_result = $entry['test_result'];
            $this->rec_id = $entry['rec_id'];

        }

        public function updateTestProRec(){

            //Create SQL query     
            $update = "UPDATE
                ". $this->db_table ."
            
                SET 
                    pro_id = :pro_id,
                    date_time = :date_time,
                    location = :location,
                    test_result = :test_result,
                    rec_id= :rec_id
                    
                WHERE
                    pro_id = :pro_id";
            
            $testRec = $this->conn->prepare($update);
            
            //Clean input
            $this->pro_id=htmlspecialchars(strip_tags($this->pro_id));
            $this->date_time=htmlspecialchars(strip_tags($this->date_time));
            $this->location=htmlspecialchars(strip_tags($this->location));
            $this->test_result=htmlspecialchars(strip_tags($this->test_result));
            $this->rec_id=htmlspecialchars(strip_tags($this->rec_id));

            //Bind to the query variables
            $testRec->bindParam(":pro_id", $this->pro_id);
            $testRec->bindParam(":date_time", $this->date_time);
            $testRec->bindParam(":location", $this->location);
            $testRec->bindParam(":test_result", $this->test_result);
            $testRec->bindParam(":rec_id", $this->rec_id);

            if($testRec->execute()){
                return true;
            }else{
                return false; 
            }

        }

        public function deleteTestRec(){

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