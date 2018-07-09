<?php
 session_start();
 require_once('../../mailfunction.php');
 require_once('../db.php');
 require_once('../autoload.php');

 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 try{
     $errors = [];
     $messages = [];
     if(isset($_POST['college_supervisor_login'])){
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $academic_supervisor_login = AccademicSupervisor::accademicSupervisorLogin($db, $username);
        if($academic_supervisor_login != "failed"){
            $password_matches = password_verify($password, $academic_supervisor_login['password']);
            if($password_matches){
                $_SESSION['accademic_supervisor'] = $academic_supervisor_login;
                header('Location: ../../users/accademic/index.php');
            }else{
                $errors[] = "invalid password";
                header('Location: ../../index.php');
            }
          
        }else{
            $errors[] = "invalid username";
            header('Location: ../../index.php');
        }
    }

    
    if(isset($_POST['submit_supervisor'])){
        
        $fname = ucwords(strtolower($_POST['fname']));
        $lname = ucwords(strtolower($_POST['lname']));
        $id_number = $_POST['id_number'];
        $email = $_POST['supervisor_email'];
        $token = uniqid('');
        $username = Null;
        $password = Null;
        $college_id = $_POST['college_id'];;
        $course_id = $_SESSION['admin']['course_id'];
       

        $supervisor = new AccademicSupervisor($fname, $lname, $email, $id_number, $username, $password, $college_id, $course_id);
        $insert = $supervisor->insertAccademicSupervisor($db);
        if($insert){
            $id = AccademicSupervisor::getIdByIdNumber($db, $id_number)['id'];
            $tokenize = new Token($token, $id);
            $insertTocken = $tokenize->insertTocken($db);
            if($insertTocken){

                // send email
                $subject = "supervisor alert";
                $message = "You have been registered as an Internship supervisor, Visit makintern and use the key bellow to set your username and password <br> <strong style='color: green'>key: $token </strong>";
                $altmessage = "You have been registered as an Internship supervisor, Visit makintern and use the key bellow to set your username and password key: $token";
                $send_email = sendMail($message, $subject, $email, $altmessage);
                if($send_email){
                    $messages[] = "supervisor added successfully";
                    header('Location: ../../users/admin/index.php');
                }else{
                    AccademicSupervisor::rollBack($db, $id);
                    $errors[] = "add supervisor failed";
                    header('Location: ../../users/admin/index.php');
                }
                    
                
            }else{
                AccademicSupervisor::rollBack($db, $id);
                $errors[] = "add supervisor failed";
                header('Location: ../../users/admin/index.php');
            }
        }else{
            $errors[] = "add supervisor failed";
            header('Location: ../../users/admin/index.php');
        }

        
    }
    
    $_SESSION['messages'] = $messages;
     $_SESSION['errors'] = $errors;
 }catch(Exception $e){
    $error = $e->getMessage();
 }
