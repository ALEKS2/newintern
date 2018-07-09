<?php 
session_start();
require_once('../db.php');
require_once('../autoload.php');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$errors = [];
$messages = [];
if(isset($_POST['submit_accademic_assesment'])){
    $field_marks = trim($_POST['field_marks']);
    $reprot_marks = trim($_POST['reprot_marks']);
    $logbook_marks = trim($_POST['logbook_marks']);
    $student_id = $_POST['id'];
    $total_marks = $reprot_marks + $logbook_marks + $field_marks;
    
    if($field_marks > 20 || $reprot_marks > 40 || $logbook_marks > 20){
        $errors[] = "invalid marks allocation";
        header('Location: ../../users/accademic/evaluate.php?id='.$student_id);
    }else{
        $student = Student::getStudentById($db, $student_id);
        if($student){
            $updateStudent = Student::updateAccademicMarks($db, $student_id, $field_marks, $logbook_marks, $reprot_marks);
            if($updateStudent){
                $field_supervisor_marks = Student::getStudentById($db, $student_id)['field_sipervisor_field_marks'];
                if($field_supervisor_marks){
                    
                    $new_marks = $total_marks + $field_supervisor_marks;
                   
                    $updatemarks = Student::updateMarks($db, $new_marks, $student_id);
                    if($updatemarks){
                        $messages[] = "Student Evaluation Successful";
                        header('Location: ../../users/accademic/index.php');
                    }else{
                        Student::rollbackAccademicMarks($db, $student_id);
                        $errors[] = "Evaluation failed, please try again";
                        header('Location: ../../users/accademic/evaluate.php?id='.$student_id);
                    }
                }else{
                    $messages[] = "Student Evaluation Successful";
                    header('Location: ../../users/accademic/index.php');
                }
                
            }else{
                Student::rollbackAccademicMarks($db, $student_id);
                $errors[] = "Evaluation failed, please try again";
                header('Location: ../../users/accademic/evaluate.php?id='.$student_id);
            }
        }else{
            $errors[] = "Invalid student";
            header('Location: ../../users/accademic/evaluate.php?id='.$student_id);
        }
        
    }

}
$_SESSION['errors'] = $errors;
$_SESSION['messages'] = $messages;