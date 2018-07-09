<?php
session_start();
require_once('../../php/db.php');
require_once('../../php/autoload.php');
if(isset($_SESSION['accademic_supervisor'])){
    $user = $_SESSION['accademic_supervisor'];
   
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
$total_pages = Student::getStudentPagesBySupervisorId($db, $user['id']);
$students = Student::getPaginatedStudentBySupervisorId($db, $user['id'], $page1);
$college_name = College::getCollegeById($db, $user['school_id'])['name'];

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
    <title>MAK-Intern</title>
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
        <h1 class="text-center">Students You Are Supervising</h1>

        <?php if($college_name == "education"){
            ?>
            <table class="table table-striped table-bordered">
             <thead class="bg-success text-white text-capitalize">
                 <th>student name</th>
                 <th>student number</th>
                 <th>registeration number</th>
                 <th>marks</th>
             </thead>
             <?php foreach($students as $student){ ?>
                <tr>
                    <td><?php echo $student['name']; ?></td>
                    <td><?php echo $student['student_number']; ?></td>
                    <td><?php echo $student['reg_number']; ?></td>
                    <td><?php
                        if($student['marks']){
                            echo $student['marks'];
                        }else{
                            ?>
                            <a href="./edu_evaluate.php?id=<?php echo $student['id']; ?>" class="btn btn-success">Evaluate</a>
                            <?php
                        }
                    ?></td>
                </tr>
             <?php } ?>
        </table>

            <?php
        }else{
          ?>
          <table class="table table-striped table-bordered">
            <thead class="bg-success text-white text-capitalize">
              <th>student name</th>
              <th>student number</th>
              <th>registeration number</th>
              <th>Field marks by field supervisor</th>
              <th>field marks by you</th>
              <th>Logbook Marks</th>
              <th>report marks</th>
              <th>total marks</th>
            </thead>
            <?php foreach($students as $student){ ?>
                <tr>
                    <td> <a class="text-success" href="./student.php?id=<?php echo $student['id']; ?>"> <?php echo $student['name']; ?></a></td>
                    <td><?php echo $student['student_number']; ?></td>
                    <td><?php echo $student['reg_number']; ?></td>
                    <td><?php echo $student['field_sipervisor_field_marks'] ?></td>
                    <td><?php
                        if($student['accademic_supervisor_field_marks']){
                            echo $student['accademic_supervisor_field_marks'];
                        }else{
                            ?>
                            <a href="./evaluate.php?id=<?php echo $student['id']; ?>" class="btn btn-success">Evaluate</a>
                            <?php
                        }
                    ?></td>
                    <td>
                      <?php if($student['logbook_marks']){
                        echo $student['logbook_marks'];
                      }else{
                        ?>
                        <a href="./evaluate.php?id=<?php echo $student['id']; ?>" class="btn btn-success">Evaluate</a>
                        <?php
                      } ?>
                    </td>
                    <td><?php
                        if($student['report_marks']){
                            echo $student['report_marks'];
                        }else{
                            ?>
                            <a href="./evaluate.php?id=<?php echo $student['id']; ?>" class="btn btn-success">Evaluate</a>
                            <?php
                        }
                    ?></td>
                    <td><?php echo $student['marks'] ?></td>
                </tr>
             <?php } ?>
          </table>
          <?php
        } ?>
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
    </div>
    
    <div class="footer">
    <p>&copy; <?php echo date('Y'); ?> Makerere university</p>
</div>
<script src="../../assets/js/jquery.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
</body>
</html>