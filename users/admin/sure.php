<?php
session_start();
require_once('../../php/db.php');
require_once('../../php/autoload.php');
if (!isset($_SESSION['admin'])) {
    header('Location: ../../index.php');
}
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(isset($_GET['req_id'])){
    $req_id = $_GET['req_id'];
}else{
    header('Location: ./pending.php');
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
        <h3 class="text-center">Are you sure you want to reject this request?</h3>
        <h4 class="text-center">If you are, please give a reason</h4>
        <div class="row">
        <div class="col-md-6 offset-md-3">
       
        <div class="card card-body">
        <form action="../../php/handlers/fieldHandler.php" method="post">
        <div class="form-group">
        <label for="reason">Reason</label>
        <input type="text" name="reason" id="reason" required class="form-control">
        </div>
        <div class="form-group">
        <input type="hidden" name="id" value="<?php echo $req_id; ?>">
        <input type="submit" value="Yes" name="reject" class="btn btn-success">
        <a href="./pending.php" class="btn btn-danger">No</a>
        </div>
        </form>
        </div>
       
        </div>
        </div>
    </div>
    </div>
    <div class="footer">
    <p>&copy; <?php echo date('Y'); ?> Makerere university</p>
</div>
</body>
</html>