<?php

class College{
    protected $name;

    public static function getCollegeById($db, $id){
        $sql = "SELECT * FROM schools where id = :id";
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

    public static function getCollegesExcludeEducation($db){
        $sql = 'SELECT * FROM schools WHERE name NOT LIKE :name';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":name", "education");
        $stmt->execute();
        $resutSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resutSet;
    }
}