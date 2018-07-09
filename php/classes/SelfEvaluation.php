<?php
class SelfEvaluation{
    public $area_of_interest;
    public $skills_attained;
    public $challenges_exprienced;
    public $recommend_students;
    public $student_id;

    public function __construct($area_of_interest, $skills_attained, $challenges_exprienced, $recommend_students, $student_id){
        $this->area_of_interest = $area_of_interest;
        $this->skills_attained = $skills_attained;
        $this->challenges_exprienced = $challenges_exprienced;
        $this->recommend_students = $recommend_students;
        $this->student_id = $student_id;
    }

    public function insertEvaluation($db){
        $sql = 'INSERT INTO self_evaluation(id, area_of_interest, skills_attained, challenges_exprienced, recommend_students, student_id) VALUES(:id, :area_of_interest, :skills_attained, :challenges_exprienced, :recommend_students, :student_id)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id", NULL);
        $stmt->bindParam(":area_of_interest", $this->area_of_interest);
        $stmt->bindParam(":skills_attained", $this->skills_attained);
        $stmt->bindParam(":challenges_exprienced", $this->challenges_exprienced);
        $stmt->bindParam(":recommend_students", $this->recommend_students);
        $stmt->bindParam(":student_id", $this->student_id);
        $result = $stmt->execute();
        return $result;
    }

    public static function getSelfEvaluationByStudent($db, $student_id){
        $sql = 'SELECT * FROM self_evaluation WHERE student_id = :student_id';
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