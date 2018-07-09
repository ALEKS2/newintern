<?php
session_start();
require_once('../../php/db.php');
require_once('../../php/autoload.php');
if(isset($_SESSION['accademic_supervisor'])){
    $user = $_SESSION['accademic_supervisor'];
   
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
        <a href="index.php" class="">Home</a>
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
    <form action="../../php/handlers/accademic_evaluation_handler.php" method="post">
        <table class="table table-bordered">
            <tr class="bg-success text-white">
                <th>Evaluation Questions</th>
                <th>Marks Generated Out Of 20</th>
            </tr>
            <tr>
                <td>
                    <ol>
                        <li>What are your soft skills attained?</li>
                        <li>What is your best area of interest?</li>
                        <li>Are there any allowances given to you?</li>
                        <li>What is your most exciting experience?</li>
                        <li>What are the challenges faced in your internship?</li>
                        <li>How did you find the environment?</li>
                    </ol>
                </td>
                <td>
                    <div class="form-group">
                        <label for="">Marks (out of 20)</label>
                        <input type="number" required name="field_marks" id="" class="form-control">
                    </div>
                </td>
            </tr>
        </table>
        <div class="from-group">
            <label for="">Report Marks (Out Of 40)</label>
            <input type="number" required name="reprot_marks" id="" class="form-control">
        </div>
        <div class="form-group">
        <label for="">Logbook Marks (out of 20)</label>
        <input type="number" required name="logbook_marks" id="" class="form-control">
        </div>
        <input type="hidden" name="id" value="<?php if(isset($_GET['id'])){echo $_GET['id'];}  ?>">
        <input type="submit" value="Submit" name="submit_accademic_assesment" class="btn btn-success">
        <input type="reset" value="Clear" class="btn btn-danger">
    </form>
             
    </div>
<div class="footer">
<p>&copy; <?php echo date('Y'); ?> Makerere university</p>
</div>
<script src="../../assets/js/jquery.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
</body>
</html>