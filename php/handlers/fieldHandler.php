<?php
 session_start();
 require_once('../../mailfunction.php');
 require_once('../db.php');
 require_once('../autoload.php');

 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $errors = [];
 $messages = [];
 try{
     if(isset($_POST['field_supervisor_login'])){
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $login = FieldSupervisor::field_supervisor_login($db, $username);
        if($login){
           $password_matches = password_verify($password, $login['password']);
           if($password_matches){
             $_SESSION['field_supervisor'] = $login;
             header('Location: ../../users/field/index.php');
           }else{
            $errors[] = "invalid Password";
            header('Location: ../../index.php');
           }
        }else{
            $errors[] = "invalid username";
            header('Location: ../../index.php');
        }
    }
    if(isset($_POST['field_supervisor_reg'])){
        $organization = trim($_POST['organization']);
        $first_name = trim($_POST['fname']);
        $last_name = trim($_POST['lname']);
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $id_number = trim($_POST['id_number']);
        $position = trim($_POST['position']);
        $org_website = trim($_POST['org_website']);
        $status = 'pending';
        $college_id = $_POST['college'];
        $password = NULL;
        
        // check if the username is alredy taken
        $username_taken = FieldSupervisor::usernameTaken($db, $username);
        if($username_taken){
            $errors[] = "Username already taken, try using another one";
            header('Location: ../../index.php');
        }else{
            $superviser = new FieldSupervisor($first_name, $last_name, $username, $email, $id_number, $position, $organization, $org_website, $password, $status, $college_id);
            $register = $superviser->insertFieldSupervisor($db);
            if($register){
                $messages[] = "Your details have been submited for approval, We shall send the approval message to your email after the assessment";
                header('Location: ../../index.php');
            }else{
                $errors[] = "Registration failed, please try again";
                header('Location: ../../index.php');
            }
        }
    }   
    if(isset($_POST['approve'])){
        $id = $_POST['id'];
        $approve = FieldSupervisor::approve($id, $db);
        $token = uniqid(true);
        if($approve == 1){
            $supervisorToken = new Token($token, $id);
            $add_token = $supervisorToken->insertTocken($db);
            if($add_token){
               $superviser = FieldSupervisor::gestSupervisorById($db, $id);
            //    send email
               $email = $superviser['email'];
               $username = $superviser['username'];
                $subject = "supervisor alert";
                $message = "Your request for being a field supervisor was approved. Vist makintern.com and Use the key provided to set your password. <br> <strong style='color: green'>key: $token </strong>";
                $altmessage = "Your request for being a field supervisor was approved. Vist makintern.com and Use the key provided to set your password. Key= $token";
                $send_email = sendMail($message, $subject, $email, $altmessage);

               if($send_email){
                    $messages[] = "approval sucessful";
                    header('Location: ../../users/admin/pending.php');
               }else{
                    FieldSupervisor::rollBack($db, $id);
                    $errors[] = "approval failed";
                    header('Location: ../../users/admin/pending.php');
               }
               
            }else{
                FieldSupervisor::rollBack($db, $id);
                $errors[] = "approval failed";
                header('Location: ../../users/admin/pending.php');
            }
            
        }else{
            $errors[] = "approval failed";
            header('Location: ../../users/admin/pending.php');
        }
    }
    if(isset($_POST['reject'])){
        $id = trim($_POST['id']);
        $reason = $_POST['reason'];
        $superviser = FieldSupervisor::getSupervisorById($db, $id);
        $email = $superviser['email'];
        $subject = "supervisor alert";
        $message = "Your request for being a field supervisor was rejected.";
        $altmessage = "Your request for being a field supervisor was rejected.";
        $reject = FieldSupervisor::reject($id, $db);
        if($reject == 1){
            $rejected = new Rejectedsupervisor($superviser['first_name'], $superviser['last_name'], $superviser['organizationName'], $superviser['email'], $superviser['idNumber'], $superviser['orgWebsite'], $reason);
            $rejected->insertRejectedSupervisor($db);
            // send email
            $send_email = sendMail($message, $subject, $email, $altmessage);
            
            $messages[] = "rejection sucessful";
            header('Location: ../../users/admin/pending.php');
        }else{
            $errors[] = "rejection failed";
            header('Location: ../../users/admin/pending.php');
        }
    }
    if(isset($_POST['submit_student_to_supervise'])){
        $student_number = $_POST['Student_number'];
        $supervisor_id = $_POST['supervisor_id'];
        $supervise = FieldSupervisor::allocateFieldSupervisor($db, $student_number, $supervisor_id);
        if($supervise == 1){
            $messages = "Student added sucessful";
            header('Location: ../../users/field/index.php');
        }else{
            $message = $supervise;
            header('Location: ../../users/field/index.php');
        }
    }

     
     
 }catch(Exception $e){
    $error = $e->getMessage();
 }
 $_SESSION['messages'] = $messages;
 $_SESSION['errors'] = $errors;