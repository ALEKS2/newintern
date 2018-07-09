<?php
session_start();
require_once '../../php/db.php';
require_once '../../php/autoload.php';
if (isset($_SESSION['admin'])) {
    $admin = $_SESSION['admin'];
    $academicsupervisors = AccademicSupervisor::getAccademicSupervisor($db, $admin['school_id'], $admin['course_id']);

    $excel_accademic_supervisors = AccademicSupervisor::getExcelAccademicSupervisors($db, $admin['school_id'], $admin['course_id'], "pending");
    $excel_students = Student::getExcelStudents($db, $admin['school_id'], $admin['course_id'], "pending");

    $college = College::getCollegeById($db, $admin['school_id']);
    $college_name = $college['name'];

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    if ($page == '' || $page == 1) {
        $page1 = 0;
    } else {
        $page1 = ($page * 10) - 10;
    }
    $prev = $page - 1;
    $next = $page + 1;
    $students = Student::getPaginatedStudents($db, $admin['school_id'], $admin['course_id'], $page1);
    $total_pages = Student::getPages($db, $admin['school_id'], $admin['course_id']);

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
        <a href="index.php" class="myactive">Home</a>
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
 <li class="mynav-link">
          <a href="academic_supervisors.php" class="">Academic Supervisors</a>
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

    <h3 class="text-center">Intern Supervisor Allocations for <?php echo Course::getCourseById($db, $admin['course_id'])['name'];
if ($college_name == "education") {echo " Zone";}
?> </h3>
        <div class="allocation-report">
            <table class="table table-striped table-bordered">
              <thead class="bg-success text-white text-capitalize">
                <th>Student Name</th>
                <th>Student Number</th>
                <th>Registration Number</th>
                <th>academic Supervisor</th>
                <th>Actions</th>
              </thead>
              <?php
              if (!empty($students)) {
              foreach ($students as $student) {?>
                  <tr>
                  <td> <a href="./student.php?id=<?php echo $student['id']; ?>" class="text-success"> <?php echo $student['name'] ?></a></td>
                  <td><?php echo $student['student_number'] ?></td>
                  <td><?php echo $student['reg_number'] ?></td>
                  <?php if($student['academic_supervisor_id'] != null && $student['academic_supervisor_id'] != ''){ foreach ($academicsupervisors as $academicsupervisor) {
                      if ($academicsupervisor['id'] == $student['academic_supervisor_id']) {
                          echo '<td>' . $academicsupervisor['firstName'] . ' ' . $academicsupervisor['lastName'] . '</td>';
                      }
                  }}else{
                      echo '<td> No Supervisor</td>';
                  }
                      ?>
                      <td>
                          <a href="./editstudent.php?id=<?php echo $student['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                          <a href="./changestudentsupervisor.php?id=<?php echo $student['id']; ?>" class="btn btn-info btn-sm">Change Supervisor</a>
                      </td>
                      </tr>
                  <?php }}?>
            </table>
        </div>
      <nav aria-label="">
        <ul class="pagination">
          <li class="page-item <?php if ($total_pages <= 1 || $prev < 1) {echo "disabled";}?>">
            <a class="page-link" href="?page=<?php echo $prev; ?>" tabindex="-1">Previous</a>
          </li>
          <li class="page-item <?php if ($page == 1) {echo "active";}?>"><a class="page-link" href="?page=1">1</a></li>
          <?php if ($total_pages > 1) {
    for ($i = 2; $i <= $total_pages; $i++) {
        ?>
              <li class="page-item <?php if ($i == $page) {echo "active";}?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
              <?php
}
}?>

          <li class="page-item <?php if ($total_pages <= 1 || $next > $total_pages) {echo "disabled";}?>">
            <a class="page-link" href="?page=<?php echo $next; ?>">Next</a>
          </li>
        </ul>
      </nav>
    </div>

        <div class="overlay d-none" id="admin-overlay"></div>

        <!-- student modal -->
        <div class="mymodal student-modal d-none" id="student-modal">
          <div class="mymodal-content">
            <div class="mymodal-header">
              <h3 class="mymodal-title" id="mymodallable">Enter Student Details</h3>
              <button class="close" id="close-student-modal">&times;</button>
            </div>
            <form action="../../php/handlers/studentHandler.php" method="post" id="student-form">
             <div class="form-group">
              <label>Student Name</label>
               <input type="text" class="form-control" name="name" required>
             </div>
              <div class="form-group">
              <label>Student Number</label>
               <input type="number" class="form-control" name="Student_number" required>
             </div>
             <div class="form-group">
              <label>Registration Number</label>
               <input type="text" class="form-control" name="registration_number" required>
             </div>

             <input type="hidden" value="<?php echo $admin['school_id']; ?>" name="college_id">
             <div class="form-group">
                <button class="btn btn-success" type="submit" name="submit_student">Submit</button>
             </div>
             </form>
             <form action="../../php/handlers/excel.php" method="post" enctype="multipart/form-data" id="student-excel-form" class="d-none">
             <div class="form-group">
               <input type="file" name="student_excel" id="student-excel" class="form-control">
               <input class="btn btn-success" type="submit" name="submit_student_excel">
             </div>
             <div class="form-group">
             <p class="notice"> Note: The fields should be named on the order (name, student_number, reg_number)</p>
             </div>
            </form>
             <button class="btn excel-trigger btn-success" id="student-excel-trigger">Add students from excel sheet</button>
          </div>
        </div>


    <!-- modal end -->

    <!-- supervisor modal -->
    <div class="mymodal d-none" id="supervisor-modal">

        <div class="mymodal-content">
          <div class="mymodal-header">
            <h3 class="mymodal-title" id="mymdallable">Enter Supervisor Details</h3>
            <button class="close" id="close-supervisor-modal">&times;</button>
          </div>

           <form action="../../php/handlers/accademicHandler.php" method="post" id="supervisor-form">
             <div class="form-group">
              <label>Supervisor First Name</label>
               <input type="text" class="form-control" name="fname" required>
             </div>
             <div class="form-group">
              <label>Supervisor Last Name</label>
               <input type="text" class="form-control" name="lname" required>
             </div>
             <div class="form-group">
              <label>Supervisor ID Number</label>
               <input type="text" class="form-control" name="id_number" required>
             </div>
              <div class="form-group">
              <label>Supervisor email</label>
               <input type="text" class="form-control" name="supervisor_email" required>
             </div>
             <input type="hidden" value="<?php echo $admin['school_id']; ?>" name="college_id">
             <div class="form-group">
             <button class="btn btn-success" type="submit" name="submit_supervisor">Submit</button>
             </div>
             </form>
             <form action="../../php/handlers/excel.php" method="post" enctype="multipart/form-data" id="supervisor-excel-form" class="d-none">
              <div class="form-group">
                <input type="file" name="supervisor_excel" id="supervisor-excel" class="form-control">
                <input class="btn btn-success" type="submit" name="submit_supervisor_excel">
              </div>
              <div class="form-group">
             <p class="notice"> Note: The fields should be named on the order (firstName, lastName, idNumber, email)</p>
             </div>
            </form>
             <button class="btn excel-trigger btn-success" id="supervisor-excel-trigger">Add Supervisors from excel sheet</button>
        </div>
    </div>
</div>
    <!-- modal end -->

</div>



<div class="footer">
    <p>&copy; <?php echo date('Y'); ?> Makerere university</p>
</div>
<script src="../../assets/js/jquery.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<script src="../../assets/js/admin.js"></script>
</body>
</html>