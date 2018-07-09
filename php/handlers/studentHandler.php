<?php
session_start();
require_once '../db.php';
require_once '../autoload.php';
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $errors = [];
    $messages = [];

    if (isset($_POST['student_login'])) {
        $student_number = trim($_POST['student_number']);
        $student_login = Student::studentLogin($db, $student_number);
        if ($student_login) {
            $_SESSION['student'] = $student_login;
            header('Location: ../../users/student/index.php');
        } else {
            $errors[] = "invalid student number";
            header('Location: ../../index.php');
        }
    }

    if (isset($_POST['submit_student'])) {
        $name = ucwords(strtolower($_POST['name']));
        $student_number = $_POST['Student_number'];
        $reg_number = $_POST['registration_number'];
        $college_id = $_POST['college_id'];
        $excel_status = 'approved';
        $course_id = $_SESSION['admin']['course_id'];
        $student = new Student($name, $reg_number, $student_number, $college_id, $course_id);
        $insert = $student->insertStudent($db, $excel_status);

        if ($insert == 1) {
            $messages[] = "Student added successfully";
            header('Location: ../../users/admin/index.php');
        } else {
            $errors[] = "add student failed";
            header('Location: ../../users/admin/index.php');

        }
    }

    if (isset($_POST['edu_evaluation'])) {
        $marks = $_POST['marks'];
        $id = $_POST['id'];
        if ($marks > 100) {
            $errors[] = "marks cannot be greater than 100";
            header('Location: ../../users/accademic/edu_evaluate.php');
        } else {
            $update_marks = Student::updateEducationMarks($db, $id, $marks);
            if ($update_marks) {
                $student_name = Student::getStudentById($db, $id)['name'];
                $messages[] = "$student_name evaluated successfully";
                header('Location: ../../users/accademic/index.php');
            } else {
                $errors[] = "marks update failed";
                header('Location: ../../users/accademic/edu_evaluate.php');
            }
        }
    }

    if (isset($_POST['submit_self_evaluation'])) {
        $area_of_interest = trim($_POST['area_of_interest']);
        $skills_attained = trim($_POST['skills']);
        $challenges_exprienced = trim($_POST['challenges']);
        $recommend_students = trim($_POST['recommend']);
        $student_id = trim($_POST['id']);

        $evaluation = new SelfEvaluation($area_of_interest, $skills_attained, $challenges_exprienced, $recommend_students, $student_id);
        $insert = $evaluation->insertEvaluation($db);
        if ($insert) {
            $messages[] = "self evaluation Successful";
            header('Location: ../../users/student/index.php');
        } else {
            $errors[] = "evaluation failed";
            header('Location: ../../users/student/index.php');
        }
    }

    if (isset($_POST['submit_company_details'])) {
        $name = trim($_POST['name']);
        $phone = trim($_POST['phone']);
        $email = trim($_POST['email']);
        $student_id = $_POST['id'];

        $company = new Company($name, $email, $phone, $student_id);
        $insert_company = $company->insertCompany($db);
        if ($insert_company) {
            $messages[] = "Company details added Successfully";
            header('Location: ../../users/student/index.php');
        } else {
            $errors[] = "Failed to add company details";
            header('Location: ../../users/student/index.php');
        }
    }
    // edit student
    if (isset($_POST['edit_student'])) {
        $name = ucwords(strtolower($_POST['name']));
        $student_number = $_POST['Student_number'];
        $reg_number = $_POST['registration_number'];
        $student_id = $_POST['student_id'];

        $update_student = Student::updateStuden($db, $student_id, $name, $student_number, $reg_number);
        if ($update_student) {
            $messages[] = "Student updated successfully";
            header('Location: ../../users/admin/index.php');
        } else {
            $errors[] = "Student update failed";
            header("Location: ../../users/admin/editstudent.php?id=$student_id");
        }
    }

    // change academic supervisor
    if (isset($_POST['change_supervisor'])) {
        $student_id = $_POST['student_id'];
        $academic_supevisor_id = $_POST['supervisor'];

        $update_academic_supervisor = Student::updateAcademicSupervisor($db, $student_id, $academic_supevisor_id);
        if ($update_academic_supervisor) {
            $messages[] = "Academic supervisor Changed";
            header('Location: ../../users/admin/index.php');

        } else {
            $errors[] = "Changing supervisor failed";
            header("Location: ../../users/admin/changestudentsupervisor.php?id=$student_id");
        }
    }

    $_SESSION['errors'] = $errors;
    $_SESSION['messages'] = $messages;
} catch (Exception $e) {
    $error = $e->getMessage();
}
