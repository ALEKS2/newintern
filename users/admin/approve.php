<?php
session_start();
require_once('../../php/db.php');
require_once('../../php/autoload.php');
if(isset($_SESSION['admin'])){
   $admin = $_SESSION['admin'];
   $academicsupervisors = AccademicSupervisor::getAccademicSupervisor($db, $admin['school_id'], $admin['course_id']);
   $students = Student::getStudents($db, $admin['school_id'], $admin['course_id']);
   $excel_accademic_supervisors = AccademicSupervisor::getExcelAccademicSupervisors($db, $admin['school_id'], $admin['course_id'], "pending");
   $excel_students = Student::getExcelStudents($db, $admin['school_id'], $admin['course_id'], "pending");
   
   $college = College::getCollegeById($db, $admin['school_id']);
   $college_name = $college['name'];
}else{
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
          <a href="marks.php" class="">Students Marks</a>
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
    <?php 
      if(isset($_SESSION['errors'])){
        foreach($_SESSION['errors'] as $err){
        ?>
        <div class="error text-center">
          <p><?php echo $err; ?></p>
        </div>
        <?php
        }
        $_SESSION['errors'] = NULL;
      }
      if(isset($_SESSION['messages'])){
        foreach($_SESSION['messages'] as $message){
          ?>
          <div class="message text-center">
            <p><?php echo $message; ?></p>
          </div>
          <?php
        }
        $_SESSION['messages'] = NULL;
      }
     
    ?>
   
 
    


<?php
if(isset($_GET['approveSupervisors'])){
    if(!empty($excel_accademic_supervisors)){
  ?>
  <div class="approve">
  <div class="approve-content">
  
    <h2 class="text-center">The following supervisors shall be added to the database</h2>
  <table class="table table-bordered table-striped">
  <thead class="bg-success text-white">
  <th>First Name</th>
  <th>Last Name</th>
  <th>Id Number</th>
  <th>Email</th>
  </thead>
  <?php
  
  foreach($excel_accademic_supervisors as $supervisor){
    ?>
    <tr>
    <td><?php echo $supervisor['firstName']; ?></td>
    <td><?php echo $supervisor['lastName']; ?></td>
    <td><?php echo $supervisor['idNumber']; ?></td>
    <td><?php echo $supervisor['email']; ?></td>
    </tr>
    <?php
  
}
  ?>
  </table>

  <div class="excel-wrapper">
  <div class="excel-handler">
  <form action="../../php/handlers/excel_approve.php" method="post" class="regecter">
  <input class="btn btn-success" type="submit" value="Approve" name="approve_excel_supervisor">
  </form>
  <form action="../../php/handlers/excel_approve.php" method="post" class="approver">
  <input class="btn btn-danger" type="submit" value="Reject" name="reject_excel_supervisor">
  </div>
  </div>

  </div>
  </div>
  </div>
  <?php
}else{
    echo "<h2 class=\"text-center\">No Supervisors to Approve</h2>";
}
}

if(isset($_GET['approveStudent'])){
    if(!empty($excel_students)){
  ?>
  <div class="approve">
  <div class="approve-content">
  
    <h2 class="text-center">The following Students shall be added to the database</h2>
  <table class="table table-bordered table-striped">
  <thead class="bg-success text-white">
  <th>Name</th>
  <th>Registration Number</th>
  <th>Student Number</th>
  </thead>
  <?php
  
  foreach($excel_students as $student){
    ?>
    <tr>
    <td><?php echo $student['name']; ?></td>
    <td><?php echo $student['reg_number']; ?></td>
    <td><?php echo $student['student_number']; ?></td>
    </tr>
    <?php
  }

  ?>
  </table>
  

  <div class="excel-wrapper">
  <div class="excel-handler">
  <form action="../../php/handlers/excel_approve.php" method="post" class="regecter">
  <input class="btn btn-success" type="submit" value="Approve" name="approve_excel_student">
  </form>
  <form action="../../php/handlers/excel_approve.php" method="post" class="approver">
  <input class="btn btn-danger" type="submit" value="Reject" name="reject_excel_student">
  </div>
  </div>

  </div>
  </div>
  </div>
  <?php
   } else{
       echo "<h2 class=\"text-center\">No Students to Approve</h2>";
   }
}

?>
</div>
<div class="footer">
    <p>&copy; <?php echo date('Y'); ?> Makerere university</p>
</div>

<script src="../../assets/js/admin.js"></script>
</body>
</html>