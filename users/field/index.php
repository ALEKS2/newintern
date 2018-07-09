<?php
session_start();
require_once '../../php/db.php';
require_once '../../php/autoload.php';
if (isset($_SESSION['field_supervisor'])) {
    $user = $_SESSION['field_supervisor'];
} else {
    header('Location: ../../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../../assets/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/accademic.css">
    <title>MAK-Intern Field-Supervisor</title>
</head>
<body>
<div class="mynavbar">
    <a href="index.php" class="mybrand">MAK-Intern</a>
    <ul class="mynav">
      <li class="mynav-link">
        <a href="index.php" class="myactive">Home</a>
      </li>
      <li class="mynav-link">
        <a href="assess.php" class="">Assessed Students</a>
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
<h3 class="text-center display-4">fill out the form to evaluate a student</h3>
<form action="../../php/handlers/field_assesment_handler.php" method="post">
    <div class="form-group">
        <label for="">Student Number</label>
        <input type="text" required name="student_number" id="student_number" class="form-control" placeholder="Student Number">
    </div>
    <div class="form-group">
        <label for="">Student's area of interest</label>
        <input type="text" required name="area_of_interest" id="area_of_interest" class="form-control" placeholder="Area of interest">
    </div>
    <table class="table table-bordered">
        <tr class="bg-success text-white">
            <th>Assessment</th>
            <th>Marks generated out of 10</th>
        </tr>
        <tr>
            <td>
            <h5>1.Smartness</h5>
            <div class="form-group">
                <input type="radio" name="smart" id="" value="excellent" class="">
                <label for="">Excellent</label>
                <input type="radio" name="smart" id="" value="good" class="">
                <label for="">Good</label>
                <input type="radio" name="smart" id="" value="fair" class="">
                <label for="">Fair</label>
                <input type="radio" name="smart" id="" value="poor" class="">
                <label for="">Poor</label>
            </div>
            <h5>2.Time Management</h5>
            <div class="form-group">
                <input type="radio" name="time_management" id="" value="excellent" class="">
                <label for="">Excellent</label>
                <input type="radio" name="time_management" id="" value="good" class="">
                <label for="">Good</label>
                <input type="radio" name="time_management" id="" value="fair" class="">
                <label for="">Fair</label>
                <input type="radio" name="time_management" id="" value="poor" class="">
                <label for="">Poor</label>
            </div>
            <h5>3.Attendence</h5>
            <div class="form-group">
                <input type="radio" name="attendence" id="" value="excellent" class="">
                <label for="">Excellent</label>
                <input type="radio" name="attendence" id="" value="good" class="">
                <label for="">Good</label>
                <input type="radio" name="attendence" id="" value="fair" class="">
                <label for="">Fair</label>
                <input type="radio" name="attendence" id="" value="poor" class="">
                <label for="">Poor</label>
            </div>
            <h5>4.Ability to meet deadlines</h5>
            <div class="form-group">
                <input type="radio" name="deadlines" id="" value="excellent" class="">
                <label for="">Excellent</label>
                <input type="radio" name="deadlines" id="" value="good" class="">
                <label for="">Good</label>
                <input type="radio" name="deadlines" id="" value="fair" class="">
                <label for="">Fair</label>
                <input type="radio" name="deadlines" id="" value="poor" class="">
                <label for="">Poor</label>
            </div>
            <h5>5.Team Work</h5>
            <div class="form-group">
                <input type="radio" name="team_work" id="" value="excellent" class="">
                <label for="">Excellent</label>
                <input type="radio" name="team_work" id="" value="good" class="">
                <label for="">Good</label>
                <input type="radio" name="team_work" id="" value="fair" class="">
                <label for="">Fair</label>
                <input type="radio" name="team_work" id="" value="poor" class="">
                <label for="">Poor</label>
            </div>
            </td>
            <td>
            <div class="form-group">
            <label for="">Marks (out of 10)</label>
            <input type="number" name="assessment_marks" id="" class="form-control" placeholder="Put marks here" required>
            </div>
            </td>
        </tr>
    </table>
    <div class="form-group">
        <label for="">Mini project marks (out of 10)</label>
        <input type="number" name="project_marks" id="" class="form-control" required>
    </div>
    <div class="form-group">
    <label for="">General Comment</label>
    <textarea name="general_comment" id="" class="form-control" required></textarea>
    </div>
    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
    <input type="submit" value="Submit" name="submit_field_evaluation" class="btn btn-success">
    <input type="reset" value="Clear" class="btn btn-danger">
</form>
</div>
<div class="footer">
    <p>&copy; <?php echo date('Y'); ?> Makerere university</p>
</div>
<script src="../js/jquery.js"></script>
<script src="../js/tether.js"></script>
<script src="../js/bootstrap.js"></script>
</body>
</html>