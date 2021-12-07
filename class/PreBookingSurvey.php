<?php

    class PreBookingSurvey{
        // Connection 
        private $conn;

        //Table 
        private $db_table = "pre_booking_survey";

        public $survey_id;
        public $has_symptoms;
        public $has_traveled;
        public $been_exposed;
        public $aphn;

        //Constructor 
        public function __construct($db){
            $this->conn = $db;
        }

        //Create table entry 
        public function addSurvey(){

            $insert = "INSERT INTO
                        ". $this->db_table ."
                        
                        SET 
                            survey_id = :survey_id,
                            has_symptoms = :has_symptoms,
                            has_traveled = :has_traveled,
                            been_exposed = :been_exposed,
                            aphn = :aphn";

            $surveyIn = $this->conn->prepare($insert);

            //Clean input 
            $this->survey_id=htmlspecialchars(strip_tags($this->survey_id));
            $this->has_symptoms=htmlspecialchars(strip_tags($this->has_symptoms));
            $this->has_traveled=htmlspecialchars(strip_tags($this->has_traveled));
            $this->been_exposed=htmlspecialchars(strip_tags($this->been_exposed));
            $this->aphn=htmlspecialchars(strip_tags($this->aphn));

            //bind to insert query
            $surveyIn->bindParam(":survey_id", $this->survey_id);
            $surveyIn->bindParam(":has_symptoms", $this->has_symptoms);
            $surveyIn->bindParam(":has_traveled", $this->has_traveled);
            $surveyIn->bindParam(":been_exposed", $this->been_exposed);
            $surveyIn->bindParam(":aphn", $this->aphn);
            
            //Attempts to add patients tests if successful 
            if($surveyIn->execute()){

                return true;

            }else{

                return false;

            }
        }

        public function getAllSurveys(){
            $readAll = "SELECT survey_id, has_symptoms, has_traveled, been_exposed, aphn FROM pre_booking_survey";
            $allSurvey = $this->conn->prepare($readAll);
            $allSurvey->execute();
            return $allSurvey;
        }


        public function getSurvey(){
            $getSurvey = "SELECT 
                survey_id,
                has_symptoms,
                has_traveled,
                been_exposed, 
                aphn

                FROM
                ". $this->db_table ."
                WHERE 
                    survey_id = ?";

            $getSur = $this->conn->prepare($getSurvey);
            $this->survey_id=htmlspecialchars(strip_tags($this->survey_id));

            $getSur->bindParam(1, $this->survey_id);

            $getSur->execute();

            $entry = $getSur->fetch(PDO::FETCH_ASSOC);

            $this->survey_id = $entry['survey_id'];
            $this->has_symptoms = $entry['has_symptoms'];
            $this->has_traveled = $entry['has_traveled'];
            $this->been_exposed = $entry['been_exposed'];
            $this->aphn = $entry['aphn'];

        }

        public function updateSurvey(){

            //Create SQL query     
            $update = "UPDATE
                ". $this->db_table ."
            
                SET 
                    survey_id = :survey_id,
                    has_symptoms = :has_symptoms,
                    has_traveled = :has_traveled,
                    been_exposed = :been_exposed,
                    aphn= :aphn
                    
                WHERE
                    survey_id = :survey_id";
            
            $surRec = $this->conn->prepare($update);
            
            //Clean input
            $this->survey_id=htmlspecialchars(strip_tags($this->survey_id));
            $this->has_symptoms=htmlspecialchars(strip_tags($this->has_symptoms));
            $this->has_traveled=htmlspecialchars(strip_tags($this->has_traveled));
            $this->been_exposed=htmlspecialchars(strip_tags($this->been_exposed));
            $this->aphn=htmlspecialchars(strip_tags($this->aphn));

            //Bind to the query variables
            $surRec->bindParam(":survey_id", $this->survey_id);
            $surRec->bindParam(":has_symptoms", $this->has_symptoms);
            $surRec->bindParam(":has_traveled", $this->has_traveled);
            $surRec->bindParam(":been_exposed", $this->been_exposed);
            $surRec->bindParam(":aphn", $this->aphn);

            if($surRec->execute()){
                return true;
            }else{
                return false; 
            }

        }

        public function deleteSurRec(){

            $delete = "DELETE FROM " . $this->db_table . " WHERE survey_id = ?";
            $delQuery = $this->conn->prepare($delete);

            $this->survey_id=htmlspecialchars(strip_tags($this->survey_id));

            $delQuery->bindParam(1, $this->survey_id);

            if($delQuery->execute()){
                return true;
            }else{
                return false;
            }
        }
    }

?>