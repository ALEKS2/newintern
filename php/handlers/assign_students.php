<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 7/9/18
 * Time: 1:45 PM
 */
session_start();
require_once('../../mailfunction.php');
require_once('../db.php');
require_once('../autoload.php');

$errors = [];
$messages = [];

if(isset($_POST['assign_student'])){
    $student_id = $_POST['student_id'];
    $supervisor_id = $_POST['supervisor_id'];
    if($supervisor_id === '' || $student_id === ''){
        if($supervisor_id === ''){
            $errors[] = 'Invalid supervisor id';
        }
        if($student_id === ''){
            $errors[] = 'Invalid Student id';
        }
        header("Location: ../../users/admin/assign_students.php?supervisor_id=$supervisor_id");
    }else{
        $update = Student::updateAcademicSupervisor($db, $student_id, $supervisor_id);
        if($update){
            $messages[] = 'student assigned successfully';
            header("Location: ../../users/admin/assign_students.php?supervisor_id=$supervisor_id");
        }else{
            $errors[] = 'Assign student failed';
            header("Location: ../../users/admin/assign_students.php?supervisor_id=$supervisor_id");
        }
    }
}

$_SESSION['messages'] = $messages;
$_SESSION['errors'] = $errors;