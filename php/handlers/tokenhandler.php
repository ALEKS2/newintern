<?php
session_start();
require_once('../db.php');
require_once('../autoload.php');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$errors = [];
$messages = [];
if(isset($_POST['accademic_first_submit'])){
   
    $username = trim($_POST['username']);
    $password1 = trim($_POST['password']);
    $password2 = trim($_POST['password1']);
    $token = trim($_POST['key']);

    if($password1 == $password2){
        $password = password_hash($password1, PASSWORD_DEFAULT);
        $username_taken = AccademicSupervisor::usernameTaken($db, $username);
        if($username_taken){
            $errors[] = "Username already taken";
            header('Location: ../../index.php');
        }else{
            $tocken_from_db = Token::getToken($db, $token);
            if($tocken_from_db){
               $id = $tocken_from_db['supervisor_id'];
               $update_supervisor = AccademicSupervisor::personaliseSupervisor($db, $username, $password, $id);
                if($update_supervisor){
                   $kill_token = Token::killToken($db, $token);
                    $login = AccademicSupervisor::accademicSupervisorLogin($db, $username);
                    if($login != "failed"){
                        $password_matches = password_verify($password1, $login['password']);
                        if($password_matches){
                            $_SESSION['accademic_supervisor'] = $login;
                            header('Location: ../../users/accademic/index.php');
                        }else{
                            $errors[] = "Try logging in with your email and password. If the problem persisits, contact a coordinator or a system admin";
                            header('Location: ../../index.php');
                        }
                       
                    }else{
                        $errors[] = "username and password were set but login failed. Please login with your username and password";
                        header('Location: ../../index.php');
                    }
               }else{
                    $errors[] = "username and password not set. Please try again";
                    header('Location: ../../index.php');
               }
            }else{
                $errors[] = "The key you provided is invalid";
                header('Location: ../../index.php');
            }
        }
    }else{
        $errors[] = "passwords don't match";
        header('Location: ../../index.php');
    }
}

if(isset($_POST['field_frist_login'])){
    $token = trim($_POST['key']);
    $password1 = trim($_POST['password']);
    $password2 = trim($_POST['password1']);

    if($password1 == $password2){
      $hashed_password = password_hash($password1, PASSWORD_DEFAULT);
      $tocken_from_db = Token::getToken($db, $token);
      if($tocken_from_db){
        $id = $tocken_from_db['supervisor_id'];
        $update_password = FieldSupervisor::updatePassword($db, $id, $hashed_password);
        
        if($update_password){
           $kill_token = Token::killToken($db, $token);
           $messages[] = "Your password has been set successfully. login with your username and password";
           header('Location: ../../index.php');
        }else{
            $errors[] = "Password setting failed";
            header('Location: ../../index.php');
        }
      }else{
        $errors[] = "The key you provided is invalid";
        header('Location: ../../index.php');
      }
    }else{
        $errors[] = "passwords don't match";
        header('Location: ../../index.php');
    }
}

$_SESSION['errors'] = $errors;
$_SESSION['messages'] = $messages;