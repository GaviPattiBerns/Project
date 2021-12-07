<?php

    class Appointment{
        // Connection 
        private $conn;

        //Table 
        private $db_table = "appointment";

        public $time_date;
        public $app_type;
        public $patient_id;
        public $tpro_id;
        public $vpro_id;
        public $location;
        public $survey_id; 

        //Constructor 
        public function __construct($db){
            $this->conn = $db;
        }

        //Create table entry 
        public function addAppointment(){

            $insert = "INSERT INTO
                        ". $this->db_table ."
                        
                        SET 
                            time_date = :time_date,
                            app_type = :app_type,
                            patient_id = :patient_id,
                            tpro_id = :tpro_id,
                            vpro_id = :vpro_id,
                            location = :location,
                            survey_id = :survey_id";

            $appIn = $this->conn->prepare($insert);

            //Clean input 
            $this->time_date=htmlspecialchars(strip_tags($this->time_date));
            $this->app_type=htmlspecialchars(strip_tags($this->app_type));
            $this->patient_id=htmlspecialchars(strip_tags($this->patient_id));
            $this->tpro_id=htmlspecialchars(strip_tags($this->tpro_id));
            $this->vpro_id=htmlspecialchars(strip_tags($this->vpro_id));
            $this->location=htmlspecialchars(strip_tags($this->location));
            $this->survey_id=htmlspecialchars(strip_tags($this->survey_id));

            //bind to insert query
            $appIn->bindParam(":time_date", $this->time_date);
            $appIn->bindParam(":app_type", $this->app_type);
            $appIn->bindParam(":patient_id", $this->patient_id);
            $appIn->bindParam(":tpro_id", $this->tpro_id);
            $appIn->bindParam(":vpro_id", $this->vpro_id);
            $appIn->bindParam(":location", $this->location);
            $appIn->bindParam(":survey_id", $this->survey_id);
            
            //Attempts to add patients tests if successful 
            if($appIn->execute()){

                return true;

            }else{

                return false;

            }
        }

        public function getAllApps(){
            $readAll = "SELECT time_date, app_type, patient_id, tpro_id, vpro_id, location, survey_id FROM appointment";
            $allApp = $this->conn->prepare($readAll);
            $allApp->execute();
            return $allApp;
        }


        public function getApp(){
            $getApp = "SELECT 
                time_date,
                app_type,
                patient_id,
                tpro_id,
                vpro_id,
                location,
                survey_id

                FROM
                ". $this->db_table ."
                WHERE 
                    time_date = ?";

            $getC = $this->conn->prepare($getApp);
            $this->time_date=htmlspecialchars(strip_tags($this->time_date));

            $getC->bindParam(1, $this->time_date);

            $getC->execute();

            $entry = $getC->fetch(PDO::FETCH_ASSOC);

            $this->app_type = $entry['app_type'];
            $this->patient_id = $entry['patient_id'];
            $this->tpro_id = $entry['tpro_id'];
            $this->vpro_id = $entry['vpro_id'];
            $this->location = $entry['location'];
            $this->survey_id = $entry['survey_id'];

        }

        public function updateApp(){

            //Create SQL query     
            $update = "UPDATE
                ". $this->db_table ."
            
                SET 
                    app_type = :app_type,
                    patient_id = :patient_id,
                    tpro_id = :tpro_id,
                    vpro_id = :vpro_id,
                    location = :location,
                    survey_id = :survey_id
                    
                WHERE
                    time_date = :time_date";
            
            $appUpdate = $this->conn->prepare($update);
            
            //Clean input
            $this->app_type=htmlspecialchars(strip_tags($this->app_type));
            $this->patient_id=htmlspecialchars(strip_tags($this->patient_id));
            $this->tpro_id=htmlspecialchars(strip_tags($this->tpro_id));
            $this->vpro_id=htmlspecialchars(strip_tags($this->vpro_id));
            $this->location=htmlspecialchars(strip_tags($this->location));
            $this->survey_id=htmlspecialchars(strip_tags($this->survey_id));
            $this->time_date=htmlspecialchars(strip_tags($this->time_date));

            //Bind to the query variables
            $appUpdate->bindParam(":app_type", $this->app_type);
            $appUpdate->bindParam(":patient_id", $this->patient_id);
            $appUpdate->bindParam(":tpro_id", $this->tpro_id);
            $appUpdate->bindParam(":vpro_id", $this->vpro_id);
            $appUpdate->bindParam(":location", $this->location);
            $appUpdate->bindParam(":survey_id", $this->survey_id);
            $appUpdate->bindParam(":time_date", $this->time_date);

            if($appUpdate->execute()){
                return true;
            }else{
                return false; 
            }

        }

        public function deleteApp(){

            $delete = "DELETE FROM " . $this->db_table . " WHERE time_date = ?";
            $delQuery = $this->conn->prepare($delete);

            $this->time_date=htmlspecialchars(strip_tags($this->time_date));

            $delQuery->bindParam(1, $this->time_date);

            if($delQuery->execute()){
                return true;
            }else{
                return false;
            }
        }
    }

?>