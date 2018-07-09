<?php
class Admin{
    protected $username;
    protected $password;

    public function __construct($username, $password){
        $this->username = $username;
        $this->password = $password;
    }

    public function adminLogin($db){
        $sql ='SELECT * FROM coordinator WHERE username = :username AND password = :password';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $rows = $stmt->rowCount();
        if($rows == 1){
            return $result[0];
        }else{
            return "failed";
        }
    }
    public static function getAdminEmail($db){
        $sql = 'SELECT email FROM coordinator';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result;
    }
}