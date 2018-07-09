<?php
session_start();
require_once('../../php/db.php');
require_once('../../php/autoload.php');
if(isset($_SESSION['field_supervisor'])){
    $user = $_SESSION['field_supervisor'];
}else{
    header('Location: ../../index.php');
}
$students = Student::getStudentsByFieldSupervisor($db, $user['id']);
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
        <a href="index.php" class="">Home</a>
      </li>
      <li class="mynav-link">
        <a href="assess.php" class="myactive">Assessed Students</a>
      </li>
    </ul>
      <a href="../../logout.php" class="logout">Logout</a>
    </ul>
</div>
<div class="container">

<h3 class="text-center display-4">Students You Assessed</h3>
    <table class="table table-bordered table-striped">
        <tr class="bg-success text-white text-capitalize">
            <td>name</td>
            <td>registration number</td>
            <td>student number</td>
            <td>marks given</td>
        </tr>
        <?php foreach($students as $student){
            ?>
            <tr>
                <td><?php echo $student['name']; ?></td>
                <td><?php echo $student['reg_number']; ?></td>
                <td><?php echo $student['student_number']; ?></td>
                <td><?php echo $student['field_sipervisor_field_marks']; ?></td>
            </tr>
            <?php
        } ?>
        
    </table>
</div>
<div class="footer">
    <p>&copy; <?php echo date('Y'); ?> Makerere university</p>
</div>
<script src="../js/jquery.js"></script>
<script src="../js/tether.js"></script>
<script src="../js/bootstrap.js"></script>
</body>
</html>