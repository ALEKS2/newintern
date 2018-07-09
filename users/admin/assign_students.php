<?php
/**
 * Created by PhpStorm.
 * User: aleks
 * Date: 7/9/18
 * Time: 1:20 PM
 */
session_start();
require_once '../../php/db.php';
require_once '../../php/autoload.php';
if (isset($_SESSION['admin'])) {
    $admin = $_SESSION['admin'];
    $college = College::getCollegeById($db, $admin['school_id']);
    $college_name = $college['name'];
    $students = Student::getStudents($db, $admin['school_id'], $admin['course_id']);
    if(isset($_GET['supervisor_id'])){
        $supervisor_id = $_GET['supervisor_id'];
    }else{
        header('Location: ./academic_supervisors.php');
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
                <a href="academic_supervisors.php" class="myactive">Academic Supervisors</a>
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
            <p>
                <?php echo $err; ?>
            </p>
        </div>
        <?php
        }
        $_SESSION['errors'] = null;
    }
if (isset($_SESSION['messages'])) {
    foreach ($_SESSION['messages'] as $message) {
        ?>
        <div class="message text-center">
            <p>
                <?php echo $message; ?>
            </p>
        </div>
        <?php
    }
    $_SESSION['messages'] = null;
}

?>

<table class="table table-striped table-bordered">
<thead class="bg-success text-white">
<tr>
    <th>Name</th>
    <th>Student Number</th>
    <th>Reg Number</th>
    <th>Actions</th>
</tr>
</thead>
<tbody>
<?php if($students){foreach($students as $student){
    if($student['academic_supervisor_id'] == null || $student['academic_supervisor_id'] == '') {
        ?>
        <tr>
            <td><?php echo $student['name']; ?></td>
            <td><?php echo $student['student_number'] ?></td>
            <td><?php echo $student['reg_number'] ?></td>
            <td>
                <form action="../../php/handlers/assign_students.php" method="post">
                    <input type="hidden" name="student_id" value="<?php echo $student['id']; ?>">
                    <input type="hidden" name="supervisor_id" value="<?php echo $supervisor_id; ?>">
                    <input type="submit" value="Assign" name="assign_student" class="btn btn-success">
                </form>
            </td>
        </tr>
        <?php
    }
}
} ?>
</tbody>
</table>
</div>



    <div class="footer">
        <p>&copy;
            <?php echo date('Y'); ?>Makerere university</p>
    </div>
    <script src="../../assets/js/jquery.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/admin.js"></script>
</body>

</html>