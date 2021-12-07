<?php

    class VaccineSite{
        // Connection 
        private $conn;

        //Table 
        private $db_table = "vaccine_site";

        public $location;
        public $vacc_site_id;

        //Constructor 
        public function __construct($db){
            $this->conn = $db;
        }

        //Create table entry 
        public function addSite(){

            $insert = "INSERT INTO
                        ". $this->db_table ."
                        
                        SET 
                            location = :location,
                            vacc_site_id = :vacc_site_id";

            $siteIn = $this->conn->prepare($insert);

            //Clean input 
            $this->location=htmlspecialchars(strip_tags($this->location));
            $this->vacc_site_id=htmlspecialchars(strip_tags($this->vacc_site_id));

            //bind to insert query
            $siteIn->bindParam(":location", $this->location);
            $siteIn->bindParam(":vacc_site_id", $this->vacc_site_id);

            //Attempts to add patients tests if successful 
            if($siteIn->execute()){

                return true;

            }else{

                return false;

            }
        }

        public function getAllSites(){
            $readAll = "SELECT location, vacc_site_id FROM vaccine_site";
            $allSites = $this->conn->prepare($readAll);
            $allSites->execute();
            return $allSites;
        }


        public function getSite(){
            $getSite = "SELECT 
                location,
                vacc_site_id

                FROM
                ". $this->db_table ."
                WHERE 
                    location = ?";

            $getS = $this->conn->prepare($getSite);
            $this->location=htmlspecialchars(strip_tags($this->location));

            $getS->bindParam(1, $this->location);

            $getS->execute();

            $entry = $getS->fetch(PDO::FETCH_ASSOC);

            $this->location = $entry['location'];
            $this->vacc_site_id = $entry['vacc_site_id'];

        }

        public function updateSite(){

            //Create SQL query     
            $update = "UPDATE
                ". $this->db_table ."
            
                SET 
                    location = :location,
                    vacc_site_id = :vacc_site_id
                    
                WHERE
                    location = :location";
            
            $site = $this->conn->prepare($update);
            
            //Clean input
            $this->location=htmlspecialchars(strip_tags($this->location));
            $this->vacc_site_id=htmlspecialchars(strip_tags($this->vacc_site_id));

            //Bind to the query variables
            $site->bindParam(":location", $this->location);
            $site->bindParam(":vacc_site_id", $this->vacc_site_id);

            if($site->execute()){
                return true;
            }else{
                return false; 
            }

        }

        public function deleteSite(){

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