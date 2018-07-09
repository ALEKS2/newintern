<?php
class Company{
    public $name;
    public $email;
    public $student_phone;
    public $student_id;

    public function __construct($name, $email, $student_phone, $student_id){
        $this->name = $name;
        $this->email = $email;
        $this->student_phone = $student_phone;
        $this->student_id = $student_id;
    }

    public function insertCompany($db){
        $sql = 'INSERT INTO company(id, name, email, student_phone, student_id) VALUES(:id, :name, :email, :student_phone, :student_id)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id", NULL);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":student_phone", $this->student_phone);
        $stmt->bindParam(":student_id", $this->student_id);
        $result = $stmt->execute();
        return $result;
    }
    
    public static function getCompanyByStudentId($db, $student_id){
        $sql = 'SELECT * FROM company WHERE student_id = :student_id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":student_id", $student_id);
        $stmt->execute();
        $rows = $stmt->rowCount();
        if($rows > 0){
            $resultset = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultset[0];
        }else{
            return false;
        }
    }
}