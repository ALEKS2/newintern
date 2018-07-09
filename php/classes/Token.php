<?php
class Token{
    protected $token;
    protected $user_id;

    function __construct($token, $user_id){
        $this->token = $token;
        $this->user_id = $user_id;
    }

    public function insertTocken($db){
        $sql = 'INSERT INTO token(id, supervisor_id, token) VALUES(:id, :supervisor_id, :token)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id", NULL);
        $stmt->bindParam("supervisor_id", $this->user_id);
        $stmt->bindParam("token", $this->token);
        $result = $stmt->execute();
        return $result;
    }

    public static function getToken($db, $token){
        $sql = 'SELECT * FROM token WHERE token = :token';
        $stmt = $db->prepare($sql);
        $stmt->bindParam("token", $token);
        $stmt->execute();
        $rows = $stmt->rowCount();
        if($rows > 0){
        $resultset = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultset[0];
        }else{
            return false;
        }
    }

    public static function killToken($db, $token){
        $sql = 'DELETE FROM token WHERE token = :token';
        $stmt = $db->prepare($sql);
        $stmt->bindParam("token", $token);
        $result = $stmt->execute();
        return $result;
    }
}