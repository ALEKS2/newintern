<?php

session_start();
require_once('../../php/db.php');
require_once('../../php/autoload.php');
if(!isset($_SESSION['admin'])){
    header('Location: ../../index.php');
}
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$requests = FieldSupervisor::getPendingSupervisorRequests($db, $_SESSION['admin']['school_id']);


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
            <a href="pending.php" class="myactive">Field Supervisor Requests</a>
        </li>
        <li class="mynav-link">  
            <a href="accepted.php" class="">Accepted Requests</a>
        </li>
         <li class="mynav-link">  
            <a href="rejected.php" class="">Rejected Requests</a>
        </li>
        </ul>
        <a href="../../logout.php" class="logout">Logout</a>
        </ul>
    </div>
    <div class="container">
        <h3 class="text-center">Pending Field Supervisors' Registration Requests</h3>
        <?php if(empty($requests)) {
            ?>
            <div class="primary-message"><p>No requests are available currently</p></div>
            <?php
        } else{
            ?>
            <table class="table table-bordered table-striped" >
            <thead class="bg-success text-white">
                <th>Name</th>
                <th>Id Number</th>
                <th>Organization</th>
                <th>Position</th>
                <th>Email</th>
                <th>Organization Website</th>
                <th>Approve/Reject</th>
            </thead>
           <?php foreach($requests as $request){ ?>
            <tr>
                </td> 
                <td><?php echo $request['first_name']." ".$request['last_name'] ?></td>
                <td><?php echo $request['idNumber'] ?></td>
                <td><?php echo $request['organizationName'] ?></td>
                <td><?php echo $request['position'] ?></td>
                <td><?php echo $request['email'] ?></td>
                <td><?php echo $request['orgWebsite'] ?></td>
                <td>
                    <div class="approve-form">
                    <form class="" action="../../php/handlers/fieldHandler.php" method="post">
                       <input type="hidden" name="id" value="<?php echo $request['id'] ?>">
                       <input type="submit" value="Approve" class="btn btn-success" name="approve">
                    </form>

                    <a href="./sure.php?req_id=<?php echo $request['id']; ?>" class="btn btn-danger">Reject</a>
                    
                    </div>
                </td>
            </tr>
           <?php } ?>
        </table>
            <?php
        } ?>
        

    </div>
    </div>
    <div class="footer">
    <p>&copy; <?php echo date('Y'); ?> Makerere university</p>
</div>
</body>
</html>