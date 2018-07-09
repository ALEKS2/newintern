<?php
class FieldSupervisor{
    public $first_name;
    public $last_name;
    public $username;
    public $email;
    public $id_number;
    public $position;
    public $organization;
    public $org_website;
    public $password;
    public $status;
    public $school_id;
    /**
     * field supervisor constructor
     */
    function __construct($first_name, $last_name, $username, $email, $id_number, $position, $organization, $org_website, $password, $status, $school_id){
        $this->first_name = $first_name;
        $this->username = $username;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->id_number = $id_number;
        $this->position = $position;
        $this->organization = $organization;
        $this->org_website = $org_website;
        $this->password = $password;
        $this->status = $status;
        $this->school_id = $school_id;
        
    }

    public function insertFieldSupervisor($db){
        $sql = 'INSERT INTO field_supervisor(id, first_name, last_name, username, idNumber, organizationName, password, position, email, status, orgWebsite, school_id)
        VALUES(:id, :first_name, :last_name, :username, :idNumber, :organizationName, :password, :position, :email, :status, :orgWebsite, :school_id)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', NULL);
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':idNumber', $this->id_number);
        $stmt->bindParam(':organizationName', $this->organization);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':position', $this->position);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':orgWebsite', $this->org_website);
        $stmt->bindParam(':school_id', $this->school_id);
        $result = $stmt->execute();
        return $result;
    }
    public static function field_supervisor_login($db, $username){
        $sql = 'SELECT * FROM field_supervisor WHERE username = :username';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $rows = $stmt->rowCount();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($rows == 1){
            return $result[0];
        }else{
            return false;
        }
    }

    public static function usernameTaken($db, $username){
        $sql = 'SELECT * FROM field_supervisor WHERE username = :username';
        $stmt = $db->prepare($sql);
        $stmt->bindParam("username", $username);
        $stmt->execute();
        $rows = $stmt->rowCount();
        if($rows > 0){
            return true;
        }else{
            return false;
        }
    }
    
    public static function approve($id, $db){
        $sql = 'UPDATE field_supervisor SET status = :status WHERE id = :id';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':status', 'approved');
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        return $result;
    }
    public static function reject($id, $db){
        $sql = 'DELETE FROM field_supervisor WHERE id = :id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        return $result;
    }
    public static function allocateFieldSupervisor($db, $student_number, $supervisor_id){
        $select = 'SELECT field_supervisor_id FROM student WHERE student_number = :student_number';
        $stmt1 = $db->prepare($select);
        $stmt1->bindParam('student_number', $student_number);
        $stmt1->execute();
        $results = $stmt1->fetchColumn();
        if($results == 0){
            $sql = 'UPDATE student SET field_supervisor_id = :field_supervisor_id WHERE student_number = :student_number';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':field_supervisor_id', $supervisor_id);
            $stmt->bindParam(':student_number', $student_number);
            $result = $stmt->execute();
            return $result;
        }else{
            return 'student already taken';
        }
       
    }

    public static function gestSupervisorById($db, $id){
        $sql = "SELECT * FROM field_supervisor WHERE id = :id AND status = :status";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":status", "approved");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $resultset = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($stmt->rowCount() == 1){
            return $resultset[0];
        }else{
            return false;
        }
    }
    
    public static function getPendingSupervisorRequests($db, $schoo_id){
        $sql = 'SELECT * FROM field_supervisor WHERE status = :status AND school_id = :school_id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":school_id", $schoo_id);
        $stmt->bindValue(':status', 'pending');
        $stmt->execute();
        $resultset = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultset;
    }

    public static function updatePassword($db, $id, $password){
        $sql = 'UPDATE field_supervisor SET password = :password WHERE id = :id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam("password", $password);
        $stmt->bindParam("id", $id);
        $result = $stmt->execute();
        return $result;
    }

    public static function rollBack($db, $id){
        $sql = 'UPDATE field_supervisor SET status = :status WHERE id = :id';
        $stmt = $db->prepare($sql);
        $stmt->bindValue("status", "pending");
        $stmt->bindParam("id", $id);
        $stmt->execute();
    }

    public static function getApprovedSupervisors($db){
        $sql = 'SELECT * FROM field_supervisor WHERE status = :status';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":status", 'approved');
        $stmt->execute();
        $rows = $stmt->rowCount();
        if($rows > 0){
            $resultset = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultset;
        }else{
            return false;
        }
    }

     public static function getSupervisorById($db, $id){
        $sql = "SELECT * FROM field_supervisor WHERE id = :id";
        $stmt = $db->prepare($sql);
        
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $resultset = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($stmt->rowCount() == 1){
            return $resultset[0];
        }else{
            return false;
        }
    }

}