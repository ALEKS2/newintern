<?php 
class Course{
    protected $name;

    public static function getCourseById($db, $id){
        $sql = "SELECT * FROM course where id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $resutSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($stmt->rowCount() == 1){
            return $resutSet[0];
        }else{
            return false;
        }
    }
}