<?php
session_start();
require_once '../db.php';
require_once '../autoload.php';
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$errors = [];
$messages = [];
if (isset($_POST['submit_field_evaluation'])) {
    $student_number = trim($_POST['student_number']);
    $area_of_interest = trim($_POST['area_of_interest']);
    $smartness = $_POST['smart'] ?? '';
    $time_management = $_POST['time_management'] ?? '';
    $attendence = $_POST['attendence'] ?? '';
    $deadlines = $_POST['deadlines'] ?? '';
    $team_work = $_POST['team_work'] ?? '';
    $assessment_marks = trim($_POST['assessment_marks']);
    $project_marks = trim($_POST['project_marks']);
    $general_comment = trim($_POST['general_comment']);
    $supervisor_id = $_POST['id'];

    if ($assessment_marks > 10 || $project_marks > 10) {
        $errors[] = "assesment marks and mini project marks must be less than 10";
        header('Location: ../../users/field/assess.php');
    } else {
        $student = Student::getStudentByStudentNumber($db, $student_number);
        if ($student) {
            if (Student::getStudentByStudentNumber($db, $student_number)['field_supervisor_id']) {
                $errors[] = "Student already assessed";
                header('Location: ../../users/field/index.php');
            } else {
                $marks = $project_marks + $assessment_marks;

                $accademic_supervisor_marks = Student::getStudentByStudentNumber($db, $student_number)['accademic_supervisor_field_marks'];

                $student_id = Student::getStudentByStudentNumber($db, $student_number)['id'];
                $assessment = new FieldAssessment($student_id, $supervisor_id, $smartness, $time_management, $attendence, $deadlines, $team_work, $area_of_interest, $general_comment);
                $insert = $assessment->insertAssessment($db);
                if ($insert) {
                    $updateStudent = Student::updateFieldInfo($db, $supervisor_id, $marks, $student_id);
                    if ($updateStudent) {
                        if ($accademic_supervisor_marks) {
                            $accademic_marks = Student::getStudentByStudentNumber($db, $student_number)['accademic_supervisor_field_marks'] + Student::getStudentByStudentNumber($db, $student_number)['logbook_marks'] + Student::getStudentByStudentNumber($db, $student_number)['report_marks'];
                            $new_marks = $accademic_marks + $marks;
                            $update_marks = Student::updateMarks($db, $new_marks, $student_id);
                            if ($update_marks) {
                                $messages[] = "Student Assessed Successfully";
                                header('Location: ../../users/field/index.php');
                            } else {
                                Student::rollbackFieldInfo($db, $student_id);
                                FieldAssessment::rollBack($db, $student_id);
                                $errors[] = "assesment failed, please try again";
                                header('Location: ../../users/field/index.php');
                            }
                        } else {
                            $messages[] = "Student Assessed Successfully";
                            header('Location: ../../users/field/index.php');
                        }

                    } else {
                        FieldAssessment::rollBack($db, $student_id);
                        $errors[] = "assesment failed, please try again";
                        header('Location: ../../users/field/index.php');
                    }
                } else {
                    $errors[] = "assesment failed, please try again";
                    header('Location: ../../users/field/index.php');
                }
            }
        } else {
            $errors[] = "Invalid Student Number";
            header('Location: ../../users/field/index.php');
        }

    }

}
$_SESSION['messages'] = $messages;
$_SESSION['errors'] = $errors;
