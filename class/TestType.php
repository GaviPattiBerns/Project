<?php

    class TestType{
        // Connection 
        private $conn;

        //Table 
        private $db_table = "test_type";

        public $lot_num;
        public $test_type;

        //Constructor 
        public function __construct($db){
            $this->conn = $db;
        }

        //Create table entry 
        public function addTest(){

            $insert = "INSERT INTO
                        ". $this->db_table ."
                        
                        SET 
                            lot_num = :lot_num,
                            test_type = :test_type";

            $testIn = $this->conn->prepare($insert);

            //Clean input 
            $this->lot_num=htmlspecialchars(strip_tags($this->lot_num));
            $this->test_type=htmlspecialchars(strip_tags($this->test_type));

            //bind to insert query
            $testIn->bindParam(":lot_num", $this->lot_num);
            $testIn->bindParam(":test_type", $this->test_type);

            //Attempts to add patients tests if successful 
            if($testIn->execute()){

                return true;

            }else{

                return false;

            }
        }

        public function getAllTests(){
            $readAll = "SELECT lot_num, test_type FROM test_type";
            $allTests = $this->conn->prepare($readAll);
            $allTests->execute();
            return $allTests;
        }


        public function getTest(){
            $getTest = "SELECT 
                lot_num,
                test_type

                FROM
                ". $this->db_table ."
                WHERE 
                    lot_num = ?";

            $getT = $this->conn->prepare($getTest);
            $this->lot_num=htmlspecialchars(strip_tags($this->lot_num));

            $getT->bindParam(1, $this->lot_num);

            $getT->execute();

            $entry = $getT->fetch(PDO::FETCH_ASSOC);

            $this->lot_num = $entry['lot_num'];
            $this->test_type = $entry['test_type'];

        }

        public function updateTest(){

            //Create SQL query     
            $update = "UPDATE
                ". $this->db_table ."
            
                SET 
                    lot_num = :lot_num,
                    test_type = :test_type
                    
                WHERE
                    lot_num = :lot_num";
            
            $test = $this->conn->prepare($update);
            
            //Clean input
            $this->lot_num=htmlspecialchars(strip_tags($this->lot_num));
            $this->test_type=htmlspecialchars(strip_tags($this->test_type));

            //Bind to the query variables
            $test->bindParam(":lot_num", $this->lot_num);
            $test->bindParam(":test_type", $this->test_type);

            if($test->execute()){
                return true;
            }else{
                return false; 
            }

        }

        public function deleteTest(){

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