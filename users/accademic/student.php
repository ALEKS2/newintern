<?php
session_start();
require_once('../../php/db.php');
require_once('../../php/autoload.php');
if(isset($_SESSION['accademic_supervisor'])){
    $user = $_SESSION['accademic_supervisor'];
   
}else{
    header('Location: ../../index.php');
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    header("Location: ./index.php");
}
$student = Student::getStudentById($db, $id);
$accdemic_supervisor = AccademicSupervisor::getAccademicSupervisorById($db, $student['academic_supervisor_id']);
$course = Course::getCourseById($db, $student['course_id']);
$field_supervisor = FieldSupervisor::gestSupervisorById($db, $student['field_supervisor_id']);
$college = College::getCollegeById($db, $user['college_id']);
$self_evaluation = SelfEvaluation::getSelfEvaluationByStudent($db,$id);
$company = Company::getCompanyByStudentId($db, $id);
$field_evaluation = FieldAssessment::getAssessmentByStudent($db, $id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../assets/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/accademic.css">
    <link rel="stylesheet" href="../../assets/css/student.css">
    <title>MAK-Intern</title>
</head>
<body>
<div class="mynavbar">
    <a href="index.php" class="mybrand">MAK-Intern</a>
    <ul class="mynav">
      <li class="mynav-link">
        <a href="index.php" class="">Home</a>
      </li>
    </ul>
      <a href="../../logout.php" class="logout">Logout</a>
    </ul>
  </div>

    <div class="container">
    <div class="user_info">
    <h4>Student Infomation</h4>
    <ul class="list-group">
        <li class="list-group-item justify-content-between">
        Name
            <span class="badge badge-success badge-tab"> <?php echo $student['name']; ?></span>
        </li>
        <li class="list-group-item justify-content-between">
        Registration No
            <span class="badge badge-success badge-tab"><?php echo $student['reg_number']; ?></span>
        </li>
        <li class="list-group-item justify-content-between">
        Student No
            <span class="badge badge-success badge-tab"><?php echo $student['student_number']; ?></span>
        </li>
        <li class="list-group-item justify-content-between">
        Accademic Supervisor
            <span class="badge badge-success badge-tab"><?php echo $accdemic_supervisor['firstName']. ' '. $accdemic_supervisor['lastName']; ?></span>
        </li>
        <li class="list-group-item justify-content-between">
        <?php if($college['name'] != "education"){
            echo "Course";
        }else{
            echo "Zone";
        } ?>
        
            <span class="badge badge-success badge-tab"><?php echo $course['name']; ?></span>
        </li>
<?php if($college['name'] != "education"){
    ?>
    <li class="list-group-item justify-content-between">
        Field Supervisor
            <span class="badge badge-success badge-tab"><?php if($field_supervisor){
            echo $field_supervisor['first_name']. ' '. $field_supervisor['last_name'];
        } ?></span>
        </li>
    <?php
} ?>
        

        <li class="list-group-item justify-content-between">
        Marks
            <span class="badge badge-success badge-tab"><?php if($student['marks']){ echo $student['marks'];} ?></span>
        </li>
    </ul>
    
        

    </div>


    <div class="self_evaluation">
        
        <h4>Self Evaluation</h4>
        <?php if($self_evaluation){
          
          $skills = explode(',', $self_evaluation['skills_attained']);
          $challenges = explode(',', $self_evaluation['challenges_exprienced']);
          ?>
          <h5>Area of interest</h5>
          <ul>
            <li><?php echo $self_evaluation['area_of_interest']; ?></li>
          </ul>
          <h5>Skills Attained</h5>
          <ul>
            <?php foreach($skills as $skill){
                ?>
                <li><?php echo $skill; ?></li>
                <?php
            } ?>
          </ul>
          <h5>Challenges Experienced</h5>
          <ul>
            <?php foreach($challenges as $challenge){
                ?>
                <li><?php echo $challenge; ?></li>
                <?php
            } ?>
          </ul>
          <h5>Recommend organization to other students</h5>
          <ul>
            <li><?php echo $self_evaluation['recommend_students'] ?></li>
          </ul>
          <?php
        } ?>
        <?php
        if($college['name'] != "education"){
            ?>
<h4>Field Supervisor Evaluation</h4>
        <?php if($field_evaluation){
            ?>
            <h5>Smartness</h5>
            <ul>
                <li><?php echo $field_evaluation['smartness']; ?></li>
            </ul>
            <h5>Time Management</h5>
            <ul>
                <li><?php echo $field_evaluation['time_management']; ?></li>
            </ul>
            <h5>Attendence</h5>
            <ul>
                <li><?php echo $field_evaluation['attendence']; ?></li>
            </ul>
            <h5>Ability to meet deadlines</h5>
            <ul>
                <li><?php echo $field_evaluation['ability_to_meet_deadlines']; ?></li>
            </ul>
            <h5>team_work</h5>
            <ul>
                <li><?php echo $field_evaluation['team_work']; ?></li>
            </ul>
            <h5>Area Of Interest</h5>
            <ul>
                <li><?php echo $field_evaluation['student_field_of_interest']; ?></li>
            </ul>
            <h5>Field Supervisor's Comment</h5>
            <ul>
                <li><?php echo $field_evaluation['general_comment']; ?></li>
            </ul>
            <?php
        } ?>
            
            <?php
        }
        ?>
        
    </div>

    <div class="company">
        <h4>Company Details</h4>
        <?php
          if($company){
            ?>
            <h5>Student Phone Number</h5>
            <ul>
                <li><?php echo $company['student_phone']; ?></li>
            </ul>
            <h5>Company name</h5>
             <ul>
                <li><?php echo $company['name']; ?></li>
             </ul>
             <h5>Company Email</h5>
             <ul>
                <li><?php echo $company['email']; ?></li>
             </ul>
            <?php
          }
        ?>
        
    </div>
</div>
    
    </div>
    
    <div class="footer">
    <p>&copy; <?php echo date('Y'); ?> Makerere university</p>
</div>
<script src="../../assets/js/jquery.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
</body>
</html>