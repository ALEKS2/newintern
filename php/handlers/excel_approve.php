<?php 
session_start();
require_once('../db.php');
require_once('../autoload.php');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$messages = [];
$errors = [];

// aprove students
if(isset($_POST['approve_excel_student'])){
    $approve_students = Student::approveExcel($db, $_SESSION['admin']['course_id']);
    if($approve_students){
        $messages[] = "Students added successfully";
        header('Location: ../../users/admin/index.php');
    }else{
        $errors[] = "Students Approval Failed";
        header('Location: ../../users/admin/index.php?approveStudent=true');
    }
}
// reject students
if(isset($_POST['reject_excel_student'])){
    $reject_students = Student::rejectExcel($db, $_SESSION['admin']['course_id']);
    if($reject_students){
        $messages[] = "Students Rejected successfully";
        header('Location: ../../users/admin/index.php');
    }else{
        $errors[] = "Students Rejection Failed";
        header('Location: ../../users/admin/index.php?approveStudent=true');
    }
}
// aprove supervisors
if(isset($_POST['approve_excel_supervisor'])){
    $approve_supervisors = AccademicSupervisor::approveExcel($db, $_SESSION['admin']['course_id']);
    if($approve_supervisors){
        $messages[] = "Accademic Supervisors added successfully";
        header('Location: ../../users/admin/index.php');
    }else{
        $errors[] = "Accademic Supervisors Approval Failed";
        header('Location: ../../users/admin/index.php?approveStudent=true');
    }
}
// reject supervisors
if(isset($_POST['reject_excel_supervisor'])){
    $reject_supervisors = AccademicSupervisor::rejectExcel($db, $_SESSION['admin']['course_id']);
    if($reject_supervisors){
        $messages[] = "Accademic Supervisors Rejected successfully";
        header('Location: ../../users/admin/index.php');
    }else{
        $errors[] = "Accademic Supervisors Rejection Failed";
        header('Location: ../../users/admin/index.php?approveStudent=true');
    }
}
$_SESSION['errors'] = $errors;
$_SESSION['messages'] = $messages;