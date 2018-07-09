<?php
class FieldAssessment{
    public $student_id;
    public $supervisor_id;
    public $smartness;	
    public $time_management;	
    public $attendence;	
    public $ability_to_meet_deadlines;
    public $team_work;
    public $student_field_of_interest;
    public $general_comment;

    public function __construct($student_id,  $supervisor_id, $smartness, $time_management, $attendence, $ability_to_meet_deadlines, $team_work, $student_field_of_interest, $general_comment){
        $this->student_id = $student_id;
        $this->supervisor_id = $supervisor_id;
        $this->smartness = $smartness;
        $this->time_management = $time_management;
        $this->attendence = $attendence;
        $this->ability_to_meet_deadlines =$ability_to_meet_deadlines;
        $this->team_work = $team_work;
        $this->student_field_of_interest = $student_field_of_interest;
        $this->general_comment = $general_comment;
    }

    public function insertAssessment($db){
        $sql = 'INSERT INTO evaluation(id, student_id, supervisor_id, smartness, time_management, attendence, ability_to_meet_deadlines, team_work, student_field_of_interest, general_comment) VALUES(:id, :student_id, :supervisor_id, :smartness, :time_management, :attendence, :ability_to_meet_deadlines, :team_work, :student_field_of_interest, :general_comment)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id", NULL);
        $stmt->bindParam(":student_id", $this->student_id);
        $stmt->bindParam(":supervisor_id", $this->supervisor_id);
        $stmt->bindParam(":smartness", $this->smartness);
        $stmt->bindParam(":time_management", $this->time_management);
        $stmt->bindParam(":attendence", $this->attendence);
        $stmt->bindParam(":ability_to_meet_deadlines", $this->ability_to_meet_deadlines);
        $stmt->bindParam(":team_work", $this->team_work);
        $stmt->bindParam(":student_field_of_interest", $this->student_field_of_interest);
        $stmt->bindParam(":general_comment", $this->general_comment);
        $result = $stmt->execute();
        return $result;
    }
    
    public static function getAssessmentByStudent($db, $student_id){
        $sql = 'SELECT * FROM evaluation WHERE student_id = :student_id';
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
    public static function rollBack($db, $student_id){
        $sql = 'DELETE FROM evaluation WHERE student_id = :student_id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":student_id", $student_id);
        $stmt->execute();
    }
}