<?php
   class AccademicSupervisor{
    protected $first_name;
    protected $last_name;
    protected $email;
    protected $id_number;
    protected $username;
    protected $password;
    protected $school_id;
    protected $course_id;
    public $errors = [];

    function __construct($first_name, $last_name, $email, $id_number, $username, $password, $school_id, $course_id){
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->id_number = $id_number;
        $this->username = $username;
        $this->password = $password;
        $this->school_id = $school_id;
        $this->course_id = $course_id;
    }
    public function insertAccademicSupervisor($db, $excel_status = "approved"){
       
       try{
        $sql = 'INSERT INTO accademic_supervisor(id, firstName, lastName, username, idNumber, password, email, school_id, course_id, excel_status) VALUES(:id, :firstName, :lastName, :username, :idNumber, :password, :email, :school_id, :course_id, :excel_status)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', NULL);
        $stmt->bindParam(':firstName', $this->first_name);
        $stmt->bindParam(':lastName', $this->last_name);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':idNumber', $this->id_number);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':school_id', $this->school_id);
        $stmt->bindParam(':course_id', $this->course_id);
        $stmt->bindParam(':excel_status', $excel_status);
        $result = $stmt -> execute();
        return $result;
       }catch(Exception $e){
          $err = $e->getMessage();
          $this->errors[] = $err;
       }
        
    }
    public static function accademicSupervisorLogin($db, $username){
        $sql ='SELECT * FROM accademic_supervisor WHERE username = :username';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $rows = $stmt->rowCount();
        if($rows == 1){
            return $result[0];
        }else{
            return "failed";
        }
    }
    public static function getAccademicSupervisor($db, $school_id, $course_id){
        $sql = 'SELECT * FROM accademic_supervisor WHERE school_id = :school_id AND course_id = :course_id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam("school_id", $school_id);
        $stmt->bindParam("course_id", $course_id);
        $stmt->execute();
        $rows = $stmt->rowCount();
        if($rows > 0){
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }else{
            return false;
        }
       
    }

    public static function checkIdNumbers($db, $idNumbers){
        foreach($idNumbers as $idNumber){
            $sql = 'SELECT * FROM accademic_supervisor WHERE idNumber = :idNumber';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":idNumber", $idNumber);
            $stmt->execute();
            $rows = $stmt->rowCount();
            if($rows < 1 || $rows > 1){
                return false;
                break;
            }
        }
        return true;
    }

    public static function getIdByIdNumber($db, $idNumber){
        $sql = 'SELECT id FROM accademic_supervisor WHERE idNumber = :idNumber';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":idNumber", $idNumber);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function rollBack($db, $id){
        $sql = 'DELETE * FROM accademic_supervisor WHERE id = :id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $result = $stmt->execute();
        return $result;
    }

    public static function getExcelAccademicSupervisors($db, $school_id, $course_id, $excel_status){
        $sql = 'SELECT * FROM accademic_supervisor WHERE school_id = :school_id AND course_id = :course_id AND excel_status = :excel_status';
        $stmt = $db->prepare($sql);
        $stmt->bindParam("school_id", $school_id);
        $stmt->bindParam("course_id", $course_id);
        $stmt->bindParam("excel_status", $excel_status);
        $stmt->execute();
        $resultset = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultset;
    }
    public static function getAccademicSupervisorById($db, $id){
        $sql = 'SELECT * FROM accademic_supervisor WHERE id = :id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $rows = $stmt->rowCount();
        if($rows > 0){
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result[0];
        }else{
            return false;
        }
        
    }
    public static function approveExcel($db, $course_id){
        $sql = 'UPDATE accademic_supervisor SET excel_status = :exel_status WHERE excel_status = :old_exel_status AND course_id = :course_id';
        $stmt = $db->prepare($sql);
        $stmt->bindValue("exel_status", "approved");
        $stmt->bindValue("old_exel_status", "pending");
        $stmt->bindParam("course_id", $course_id);
        $result = $stmt->execute();
        return $result;
    }
    
    public static function rejectExcel($db, $course_id){
        $sql = 'DELETE FROM accademic_supervisor WHERE excel_status = :exel_status AND course_id = :course_id';
        $stmt = $db->prepare($sql);
        $stmt->bindValue("exel_status", "pending");
        $stmt->bindParam("course_id", $course_id);
        $result = $stmt->execute();
        return $result;
    }

    public static function usernameTaken($db, $username){
        $sql = 'SELECT * FROM accademic_supervisor WHERE username = :username';
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

    public static function personaliseSupervisor($db, $username, $password, $id){
        $sql = 'UPDATE accademic_supervisor SET username = :username, password = :password WHERE id = :id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam("username", $username);
        $stmt->bindParam("password", $password);
        $stmt->bindParam("id", $id);
        $result = $stmt->execute();
        return $result;
    }
}