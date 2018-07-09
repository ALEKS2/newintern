<?php
session_start();
require_once '../../php/db.php';
require_once '../../php/autoload.php';
if (isset($_SESSION['admin'])) {
    $admin = $_SESSION['admin'];
    $college = College::getCollegeById($db, $admin['college_id']);
    $college_name = $college['name'];

    if (isset($_GET['id'])) {
        $student_id = $_GET['id'];
        $student = Student::getStudentById($db, $student_id);
    } else {
        header('Location: ./index.php');
    }

} else {
    header('Location: ../../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../assets/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="stylesheet" href="../../assets/css/font-awesome.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/navbar.css">
    <title>MAK-Intern Admin</title>

</head>
<body>
  <div class="mynavbar">
    <a href="index.php" class="mybrand">MAK-Intern</a>
    <ul class="mynav">
      <li class="mynav-link">
        <a href="index.php" class="active">Home</a>
      </li>
      <li class="mynav-link">
          <a href="#" class="" id="add-supervisor-toggler">Add Supervisor</a>
      </li>
      <li class="mynav-link">
          <a href="#" class="" id="add-student-toggler">Add Student</a>
      </li>
      <li class="mynav-link">
          <a href="marks.php" class="">Students Marks</a>
      </li>
      <?php if ($college_name != "education") {
    ?>
        <li class="mynav-link">
          <a href="pending.php" class="">Field Supervisor Requests</a>
      </li>
        <?php
}?>

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

    <h3 class="text-center">Edit student </h3>



            <form action="../../php/handlers/studentHandler.php" method="post" id="student-form">
             <div class="form-group">
              <label>Student Name</label>
               <input type="text" class="form-control" name="name" value="<?php echo $student['name']; ?>" required>
             </div>
              <div class="form-group">
              <label>Student Number</label>
               <input type="number" class="form-control" name="Student_number" required value="<?php echo $student['student_number']; ?>">
             </div>
             <div class="form-group">
              <label>Registration Number</label>
               <input type="text" class="form-control" name="registration_number" required value="<?php echo $student['reg_number']; ?>">
             </div>
<input type="hidden" name="student_id" value="<?php echo $student_id; ?>">

             <div class="form-group">
                <button class="btn btn-success" type="submit" name="edit_student">Submit</button>
             </div>
             </form>




    <!-- modal end -->

    <!-- supervisor modal -->


</div>



<div class="footer">
    <p>&copy; <?php echo date('Y'); ?> Makerere university</p>
</div>
<script src="../../assets/js/jquery.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<script src="../../assets/js/admin.js"></script>
</body>
</html>