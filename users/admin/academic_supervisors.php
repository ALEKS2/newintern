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
    <th>Email</th>
    <th>Id Number</th>
    <th>Actions</th>
</tr>
</thead>
<tbody>
<?php if($academicsupervisors){foreach($academicsupervisors as $academicsupervisor){
    ?>
    <tr>
        <td><a class="text-success" href="./academic.php?id=<?php echo $academicsupervisor['id']; ?>"><?php echo $academicsupervisor['firstName'].' '.$academicsupervisor['lastName']; ?></a></td>
        <td><?php echo $academicsupervisor['email'] ?></td>
        <td><?php echo $academicsupervisor['idNumber'] ?></td>
        <td><a class="btn btn-success" href="./assign_students.php?supervisor_id=<?php echo $academicsupervisor['id'];?>">Assign Students</a></td>
    </tr>
    <?php
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