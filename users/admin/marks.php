<?php
session_start();
require_once('../../php/db.php');
require_once('../../php/autoload.php');
if(isset($_SESSION['admin'])){
   $admin = $_SESSION['admin'];
}else{
    header('Location: ../../index.php');
}

if(isset($_GET['page'])){
  $page = $_GET['page'];
}else{
  $page = 1;
}

if($page == '' || $page == 1){
  $page1 = 0;
}else{
  $page1 = ($page * 10) - 10;
}
$prev = $page - 1;
$next = $page + 1;
$total_pages = Student::getPages($db, $admin['school_id'], $admin['course_id']);
$marks = Student::getStudentsFinalMarks($db, $admin['school_id'], $admin['course_id'], $page1);

$college = College::getCollegeById($db, $admin['school_id']);
$college_name = $college['name'];
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
    <title>Mak-intern</title>
</head>
<body>
<div class="mynavbar">
    <a href="index.php" class="mybrand">MAK-Intern</a>
    <ul class="mynav">
      <li class="mynav-link">
        <a href="index.php" class="">Home</a>
      </li>
      <li class="mynav-link">  
          <a href="marks.php" class="myactive">Students Marks</a>
      </li>
      <?php if($college_name != "education"){
        ?>
        <li class="mynav-link">  
          <a href="pending.php" class="">Field Supervisor Requests</a>
      </li>
        <?php
      } ?>
    </ul>
    <a href="../../logout.php" class="logout">Logout</a>
    </ul>
  </div>

  <div class="container">  
    <table class="table table-bordered table-striped">
      <tr class="bg-success text-white">
        <th>Name</th>
        <th>Student Number</th>
        <th>Registration Number</th>
        <th>Marks</th>
      </tr>
      <?php
        foreach($marks as $mark){
          ?>
          <tr>
            <td><?php echo $mark['name'] ?></td>
            <td><?php echo $mark['student_number'] ?></td>
            <td><?php echo $mark['reg_number'] ?></td>
            <td><?php echo $mark['marks'] === NULL ? "Not Evaluated" : $mark['marks'] ?></td>
          </tr>
          <?php
        }
      ?>
    </table>
    <nav aria-label="">
        <ul class="pagination">
          <li class="page-item <?php if($total_pages <= 1 || $prev < 1){echo "disabled";} ?>">
            <a class="page-link" href="?page=<?php echo $prev; ?>" tabindex="-1">Previous</a>
          </li>
          <li class="page-item <?php if($page == 1){echo "active";} ?>"><a class="page-link" href="?page=1">1</a></li>
          <?php if($total_pages > 1){
            for($i = 2; $i <= $total_pages; $i++){
              ?>
              <li class="page-item <?php if($i == $page){echo "active";} ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
              <?php
            }
          } ?>
          
          <li class="page-item <?php if($total_pages <= 1 || $next > $total_pages){echo "disabled";} ?>">
            <a class="page-link" href="?page=<?php echo $next; ?>">Next</a>
          </li>
        </ul>
      </nav>
    <div class="mark-download-wrapper">
      <form action="../../php/handlers/marksExcel.php" method="post">
      <button class="btn marks-download-btn btn-success" type="submit" name="download_marks"> Export marks as Excel</button>
      </form>
    </div>
  </div>
  <div class="footer">
    <p>&copy; <?php echo date('Y'); ?> Makerere university</p>
</div>

<script src="../../assets/js/jquery.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
</body>
</html>