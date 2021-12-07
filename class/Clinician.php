<?php 

    class Clinician{
        // Connection 
        private $conn;

        //Table 
        private $db_table = "clinician";

        public $eid;
        public $fname;
        public $lname;
        public $email;
        public $dob;
        public $phone_number;
        public $address;
        public $qualification;
        public $mf_location; 

        //Constructor 
        public function __construct($db){
            $this->conn = $db;
        }

        //Create table entry 
        public function addClinician(){

            $insert = "INSERT INTO
                        ". $this->db_table ."
                        
                        SET 
                        eid = :eid,
                        fname = :fname,
                        lname = :lname,
                        email = :email,
                        dob = :dob,
                        phone_number = :phone_number,
                        address = :address,
                        qualification = :qualification,
                        mf_location = :mf_location";

            $clinicianIn = $this->conn->prepare($insert);

            //Clean input 
            $this->eid=htmlspecialchars(strip_tags($this->eid));
            $this->fname=htmlspecialchars(strip_tags($this->fname));
            $this->lname=htmlspecialchars(strip_tags($this->lname));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->dob=htmlspecialchars(strip_tags($this->dob));
            $this->phone_number=htmlspecialchars(strip_tags($this->phone_number));
            $this->address=htmlspecialchars(strip_tags($this->address));
            $this->qualification=htmlspecialchars(strip_tags($this->qualification));
            $this->mf_location=htmlspecialchars(strip_tags($this->mf_location));

            //bind to insert query
            $clinicianIn->bindParam(":eid", $this->eid);
            $clinicianIn->bindParam(":fname", $this->fname);
            $clinicianIn->bindParam(":lname", $this->lname);
            $clinicianIn->bindParam(":email", $this->email);
            $clinicianIn->bindParam(":dob", $this->dob);
            $clinicianIn->bindParam(":phone_number", $this->phone_number);
            $clinicianIn->bindParam(":address", $this->address);
            $clinicianIn->bindParam(":qualification", $this->qualification);
            $clinicianIn->bindParam(":mf_location", $this->mf_location);
            
            //Attempts to add patients tests if successful 
            if($clinicianIn->execute()){

                return true;

            }else{

                return false;

            }
        }

        public function getAllClinicians(){
            $readAll = "SELECT eid, fname, lname, email, dob, phone_number, address, qualification, mf_location FROM clinician";
            $allClinicians = $this->conn->prepare($readAll);
            $allClinicians->execute();
            return $allClinicians;
        }


        public function getClinician(){
            $getClinician = "SELECT 
                eid,
                fname,
                lname,
                email,
                dob,
                phone_number,
                address,
                qualification,
                mf_location

                FROM
                ". $this->db_table ."
                WHERE 
                    eid = ?";

            $getC = $this->conn->prepare($getClinician);
            $this->eid=htmlspecialchars(strip_tags($this->eid));

            $getC->bindParam(1, $this->eid);

            $getC->execute();

            $entry = $getC->fetch(PDO::FETCH_ASSOC);

            $this->fname = $entry['fname'];
            $this->lname = $entry['lname'];
            $this->email = $entry['email'];
            $this->dob = $entry['dob'];
            $this->phone_number = $entry['phone_number'];
            $this->address = $entry['address'];
            $this->qualification = $entry['qualification'];
            $this->mf_location = $entry['mf_location'];

        }

        public function updateClinician(){

            //Create SQL query     
            $update = "UPDATE
                ". $this->db_table ."
            
                SET 
                    fname = :fname,
                    lname = :lname,
                    email = :email,
                    dob = :dob,
                    phone_number = :phone_number,
                    address = :address,
                    qualification = :qualification,
                    mf_location = :mf_location
                    
                WHERE
                    eid = :eid";
            
            $clinicianUpdate = $this->conn->prepare($update);
            
            //Clean input
            $this->fname=htmlspecialchars(strip_tags($this->fname));
            $this->lname=htmlspecialchars(strip_tags($this->lname));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->dob=htmlspecialchars(strip_tags($this->dob));
            $this->phone_number=htmlspecialchars(strip_tags($this->phone_number));
            $this->address=htmlspecialchars(strip_tags($this->address));
            $this->eid=htmlspecialchars(strip_tags($this->eid));
            $this->qualification=htmlspecialchars(strip_tags($this->qualification));
            $this->mf_location=htmlspecialchars(strip_tags($this->mf_location));

            //Bind to the query variables
            $clinicianUpdate->bindParam(":fname", $this->fname);
            $clinicianUpdate->bindParam(":lname", $this->lname);
            $clinicianUpdate->bindParam(":email", $this->email);
            $clinicianUpdate->bindParam(":dob", $this->dob);
            $clinicianUpdate->bindParam(":phone_number", $this->phone_number);
            $clinicianUpdate->bindParam(":address", $this->address);
            $clinicianUpdate->bindParam(":eid", $this->eid);
            $clinicianUpdate->bindParam(":qualification", $this->qualification);
            $clinicianUpdate->bindParam(":mf_location", $this->mf_location);

            if($clinicianUpdate->execute()){
                return true;
            }else{
                return false; 
            }



        }

        public function deleteClinician(){

            $delete = "DELETE FROM " . $this->db_table . " WHERE eid = ?";
            $delQuery = $this->conn->prepare($delete);

            $this->eid=htmlspecialchars(strip_tags($this->eid));

            $delQuery->bindParam(1, $this->eid);

            if($delQuery->execute()){
                return true;
            }else{
                return false;
            }
        }
    }


?>