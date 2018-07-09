<?php
session_start();
require_once('../../mailfunction.php');
require_once('../classes/Uploader.php');
require_once('./excelReader.php');


require_once('../autoload.php');
require_once('../db.php');
define('DESTINATION', ROOT_PATH.'/uploads');

$errors = [];
$messages = [];
$max_size = 10000 * 1024;
if(!is_dir(DESTINATION) && !is_writable(DESTINATION)){
    mkdir(DESTINATION, 0777);
}

function checkFormat($data, $category){
    if($category == "student"){
        $standard = ["name", "student_number", "reg_number"];
        $data_fields = sizeof($data);
        if($data_fields != 3){
            return false;
        }else{
            $keys = array_keys($data);
            for($i = 0; $i <= 2; $i++){
                if($standard[$i] != $keys[$i]){
                    return false;
                    break;
                }
            }
            return true;
        }
    }

    if($category == "supervisor"){
        $standard = ["firstName", "lastName", "idNumber", "email"];
        $data_fields = sizeof($data);
        if($data_fields != 4){
            return false;
        }else{
            $keys = array_keys($data);
            for($i = 0; $i <= 3; $i++){
                if($standard[$i] != $keys[$i]){
                    return false;
                    break;
                }
            }
            return true;
        }
    }
}

// handle students from an excell sheet
if(isset($_POST['submit_student_excel'])){
    $file = $_FILES['student_excel'];
    $excel_file = Uploader::upload($file, $max_size);
    if($excel_file){
        $file_data = exceler($excel_file);
        $correctFormat = checkFormat($file_data[0], "student");
        if($correctFormat){
            foreach($file_data as $data){
                $name = ucwords(strtolower($data['name']));
                $reg_no = $data['reg_number'];
                $stud_no = $data['student_number'];
                $college_id = $_SESSION['admin']['school_id'];
                $course_id = $_SESSION['admin']['course_id'];
                $excel_status = "pending";
                $student = new Student($name, $reg_no, $stud_no, $college_id, $course_id);
                $insertStudent = $student->insertStudent($db, $excel_status);
                if(!$insertStudent){
                    $errors[] = "The data for $name was not extracted from the excel ";
                }
                header('Location: ../../users/admin/approve.php?approveStudent=true');
            }

        }else{
            $errors[] = "Invalid excel document fields for students";
            header('Location: ../../users/admin/index.php');
        }
    }else{
        foreach(Uploader::getErrors() as $err){
            $errors[] = $err;
        }
        header('Location: ../../users/admin/index.php');
    }
}
// handle supervisor from an excel sheet
if(isset($_POST['submit_supervisor_excel'])){
    $file = $_FILES['supervisor_excel'];
    $excel_file = Uploader::upload($file, $max_size);
    if($excel_file){
        $file_data = exceler($excel_file);
        $correctFormat = checkFormat($file_data[0], "supervisor");
        if($correctFormat){
            $idnumbers = [];
            foreach($file_data as $data){
                $idnumbers[] = $data['idNumber'];
            }
            $idnumbersExist = AccademicSupervisor::checkIdNumbers($db, $idnumbers);
            if($idnumbersExist){
                $errors[] = "some of the supervisor Id Numbers are already used";
                header('Location: ../../users/admin/index.php');
            }else{
                foreach($file_data as $data){
                    $firstName = ucfirst(strtolower($data['firstName']));
                    $lastName = ucfirst(strtolower($data['lastName']));
                    $idNumber = $data['idNumber'];
                    $email = $data['email'];
                    $username = NULL;
                    $password = Null;
                    $excel_status = "pending";
                    $college_id = $_SESSION['admin']['school_id'];
                    $course_id = $_SESSION['admin']['course_id'];
                    $token = $idNumber.uniqid();
                    $supervisor = new AccademicSupervisor($firstName, $lastName, $email, $idNumber, $username, $password, $college_id, $course_id);
                    $insertSupervisor = $supervisor->insertAccademicSupervisor($db, $excel_status);
                    if($insertSupervisor){
                        $id = AccademicSupervisor::getIdByIdNumber($db, $idNumber)['id'];
                        $tokenize = new Token($token, $id);
                        $insertToken = $tokenize->insertTocken($db);
                        if(!$insertToken){
                            AccademicSupervisor::rollBack($db, $id);
                            $errors[] = "The supervisor $firstName $lastName was not added";
                        }else{
                            
                            $subject = "supervisor alert";
                            $message = "You have been registered as an Internship supervisor, Visit <a href='http://makintern.com'>makintern.com</a> and use the key bellow to set your username and password <br> <strong style='color: green'>key: $token </strong>";
                            $altmessage = "You have been registered as an Internship supervisor, Visit makintern and use the key bellow to set your username and password key: $token";
                            $send_email = sendMail($message, $subject, $email, $altmessage);
                        }
                    }else{
                        $errors[] = "The supervisor $firstName $lastName was not added";
                    }
                    header('Location: ../../users/admin/approve.php?approveSupervisors=true');
                }
            }
        }else{
            $errors[] = "Invalid excel document fields for supervisors";
            header('Location: ../../users/admin/index.php');
        }
    }else{
        foreach(Uploader::getErrors() as $err){
            $errors[] = $err;
        }
        header('Location: ../../users/admin/index.php');
    }     
}
$_SESSION['errors'] = $errors;
