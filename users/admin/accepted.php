<?php

session_start();
require_once('../../php/db.php');
require_once('../../php/autoload.php');
if (!isset($_SESSION['admin'])) {
    header('Location: ../../index.php');
}
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$supervisors = FieldSupervisor::getApprovedSupervisors($db);

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
            <a href="index.php" class="">Home</a>
        </li>
        <li class="mynav-link">  
          <a href="marks.php" class="">Students Marks</a>
        </li>
        
         <li class="mynav-link">  
            <a href="pending.php" class="">Field Supervisor Requests</a>
        </li>
        <li class="mynav-link active" >  
            <a href="accepted.php" class="myactive">Accepted Requests</a>
        </li>
         <li class="mynav-link">  
            <a href="rejected.php" class="">Rejected Requests</a>
        </li>
        </ul>
        <a href="../../logout.php" class="logout">Logout</a>
        </ul>
    </div>
    <div class="container">
    <table class="table table-striped table-bordered">
            <thead class="bg-success text-white">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Id Number</th>
                    <th>Organization</th>
                    <th>Organization Website</th>
                    
                </tr>
            </thead>
            <tbody>
            <?php if($supervisors){
                foreach ($supervisors as $supervisor) {
                    ?>
                    <tr>
                    <td><?php echo $supervisor['first_name'].' '.$supervisor['last_name']; ?></td>
                    <td><?php echo $supervisor['email']; ?></td>
                    <td><?php echo $supervisor['idNumber']; ?></td>
                    <td><?php echo $supervisor['organizationName']; ?></td>
                    <td><?php echo $supervisor['orgWebsite']; ?></td>
                    
                    </tr>
                    <?php
}
            }  ?>
            </tbody>
        </table>
    </div>
    </div>
    <div class="footer">
    <p>&copy; <?php echo date('Y'); ?> Makerere university</p>
</div>
</body>
</html>