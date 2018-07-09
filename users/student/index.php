<?php
session_start();
require_once '../../php/db.php';
require_once '../../php/autoload.php';
if (isset($_SESSION['student'])) {
    $user = $_SESSION['student'][0];
} else {
    header('Location: ../../index.php');
}
$accdemic_supervisor = AccademicSupervisor::getAccademicSupervisorById($db, $user['academic_supervisor_id']);
$course = Course::getCourseById($db, $user['course_id']);
$field_supervisor = FieldSupervisor::gestSupervisorById($db, $user['field_supervisor_id']);
$college = College::getCollegeById($db, $user['school_id']);
$self_evaluation = SelfEvaluation::getSelfEvaluationByStudent($db, $user['id']);
$company = Company::getCompanyByStudentId($db, $user['id']);
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
    <link rel="stylesheet" href="../../assets/css/student.css">
    <link rel="stylesheet" href="../../assets/css/accademic.css">
    <title>Mak Intern | Sudent</title>
</head>
<body>
<div class="mynavbar">
    <a href="index.php" class="mybrand">MAK-Intern</a>
    <ul class="mynav">
      <li class="mynav-link">
        <a href="index.php" class="myactive">Home</a>
      </li>
    </ul>
      <a href="../../logout.php" class="logout">Logout</a>
    </ul>
</div>

<div class="container">
<?php
if (isset($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $err) {
        ?>
        <div class="error text-center">
          <p><?php echo $err; ?></p>
        </div>
        <?php
}
    $_SESSION['errors'] = null;
}
if (isset($_SESSION['messages'])) {
    foreach ($_SESSION['messages'] as $message) {
        ?>
          <div class="message text-center">
            <p><?php echo $message; ?></p>
          </div>
          <?php
}
    $_SESSION['messages'] = null;
}

?>
    <div class="user_info">
    <h4>Student Infomation</h4>
    <ul class="list-group">
        <li class="list-group-item justify-content-between">
        Name
            <span class="badge badge-success badge-tab"> <?php echo $user['name']; ?></span>
        </li>
        <li class="list-group-item justify-content-between">
        Registration No
            <span class="badge badge-success badge-tab"><?php echo $user['reg_number']; ?></span>
        </li>
        <li class="list-group-item justify-content-between">
        Student No
            <span class="badge badge-success badge-tab"><?php echo $user['student_number']; ?></span>
        </li>
        <li class="list-group-item justify-content-between">
        Accademic Supervisor
            <span class="badge badge-success badge-tab"><?php echo $accdemic_supervisor['firstName'] . ' ' . $accdemic_supervisor['lastName']; ?></span>
        </li>
        <li class="list-group-item justify-content-between">
        <?php if ($college['name'] != "education") {
    echo "Course";
} else {
    echo "Zone";
}?>

            <span class="badge badge-success badge-tab"><?php echo $course['name']; ?></span>
        </li>
<?php if ($college['name'] != "education") {
    ?>
    <li class="list-group-item justify-content-between">
        Field Supervisor
            <span class="badge badge-success badge-tab"><?php if ($field_supervisor) {
        echo $field_supervisor['first_name'] . ' ' . $field_supervisor['last_name'];
    }?></span>
        </li>
    <?php
}?>


        <li class="list-group-item justify-content-between">
        Marks
            <span class="badge badge-success badge-tab"><?php if ($user['marks']) {echo $user['marks'];}?></span>
        </li>
    </ul>
    <p></p>
        <a href="./download.php" class="btn btn-success">Suggested Companies For Internship</a>


    </div>

    <div class="self_evaluation">
        <h4>Self Evaluation</h4>
        <?php if ($self_evaluation) {

    $skills = explode(',', $self_evaluation['skills_attained']);
    $challenges = explode(',', $self_evaluation['challenges_exprienced']);
    ?>
          <h5>Area of interest</h5>
          <ul>
            <li><?php echo $self_evaluation['area_of_interest']; ?></li>
          </ul>
          <h5>Skills Attained</h5>
          <ul>
            <?php foreach ($skills as $skill) {
        ?>
                <li><?php echo $skill; ?></li>
                <?php
}?>
          </ul>
          <h5>Challenges Experienced</h5>
          <ul>
            <?php foreach ($challenges as $challenge) {
        ?>
                <li><?php echo $challenge; ?></li>
                <?php
}?>
          </ul>
          <h5>Recommend organization to other students</h5>
          <ul>
            <li><?php echo $self_evaluation['recommend_students'] ?></li>
          </ul>
          <?php
} else {
    ?>
<form action="../../php/handlers/studentHandler.php" method="post">
            <div class="form-group">
                <label for="">What has been your best are of interest</label>
                <input type="text" required name="area_of_interest" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">What skills did you gain (comma separated)</label>
                <textarea name="skills" required id=""  class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="">What are some of the challenges you experienced (comma separated)</label>
                <textarea required name="challenges" id=""  class="form-control"></textarea>
            </div>
            <label for="">Would you recommend other students to train from the same organisation</label>
            <div class="form-group">
                <input type="radio" checked name="recommend" id="" value="yes" required>
                <label for="">Yes</label>
                <input type="radio" name="recommend" id="" value="no" required>
                <label for="">No</label>
            </div>
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <input type="submit" value="Submit" name="submit_self_evaluation" class="btn btn-success">
        </form>

            <?php
}?>


    </div>
    <div class="company">
        <h4>Company Details</h4>
        <?php
if ($company) {
    ?>
            <h5>Your Phone Number</h5>
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
} else {
    ?>
              <form action="../../php/handlers/studentHandler.php" method="post">
            <div class="form-group">
                <label for="">Your phone number</label>
                <input required type="number" required name="phone" id="" placeholder="Your phone number" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Company Name</label>
                <input required type="text" required name="name" id="" placeholder="company name" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Company Email</label>
                <input required type="text" required name="email" id="" placeholder="company email" class="form-control">
            </div>
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <input type="submit" value="Submit" name="submit_company_details" class="btn btn-success">
        </form>
              <?php
}
?>

    </div>
</div>


<div class="footer">
    <p>&copy; <?php echo date('Y'); ?> Makerere university</p>
</div>
</body>
</html>