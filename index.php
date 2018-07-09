<?php
 session_start();
 require_once('./php/autoload.php');
 require_once('./php/db.php');

 $colleges = College::getCollegesExcludeEducation($db);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>MAK-Intern</title>
</head>

<body>
    <header class="header containar">
        <div class="header-content">
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
            <img src="./assets/images/mak.jpg" alt="mak badge">
            <h1>Information Management Support System For Internship Coordination</h1><br>
            <button class="btn btn-login-modal" id="login-trigger">Login</button>
            <div class="has-no-account" id="register-trigger">
            <p>Field Supervisor with no account?</p>
            <span> Register Here</span>
            </div>
        </div> 
    </header>
    <div class="overlay d-none" id="overlay"></div>
    <div class="modal-wrapper">

        <div class="modal d-none" id="login-modal">
        <div class="modal-content login-modal">
            <div class="modal-header">
                <h3 class="modal-title">
                Login as:
                </h3>
                <button class="close" id="login-close">&times;</button>
            </div>
            
                
                <div class="login-header">
                    <ul class="login-nav">
                      <li id="student" class="active">Student</li>
                      <li id="field" class="">Field supervisor</li>
                      <li id="accademic" class="">Academic supervisor</li>
                      <li id="admin" class="">Coordinator/Zone-Leader</li>
                    </ul>
                </div>
              
                <form action="php/handlers/studentHandler.php" id="student-form" class="" method="post">
                    <div class="form-label">
                        <span>Student login</span>
                    </div>
                    <div class="form-group">
                        <label for="">Student Number</label>
                        <input type="text" name="student_number" id="student-number" class="form-control" placeholder="eg 218673524" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Login" class="btn btn-success" name="student_login">
                    </div>
                </form>
                <form action="php/handlers/adminHandler.php" id="admin-form" class="d-none" method="post">
                    <div class="form-label">
                        <span>Coordinator login</span>
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Username" id="admin-username" required>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" id="admin-password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Login" class="btn btn-success" name="admin_login">
                    </div>
                </form>

                <form action="php/handlers/fieldHandler.php" id="field-supervisor-form" class="d-none" method="post">
                    <div class="form-label">
                        <span>Field Supervisor login</span>
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username" id="field-username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" id="field-password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Login" class="btn btn-success" name="field_supervisor_login">
                        <span class="first-login" id="field-first-login">Have No Password! Click to Create One</span></span>
                    </div>
                </form>
                    
                <form action="php/handlers/tokenhandler.php" method="post" class="field-form-2 d-none" id="field-form-2">
                    <div class="form-group">
                        <label for="">Key</label>
                        <input type="text" name="key" id="field-key" class="form-control" placeholder="The Key Sent to Your Email" required>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" id="field-password-1" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="">Verify Password</label>
                        <input type="password" name="password1" id="field-password-2" class="form-control" placeholder="Re-Enter Password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn btn-success" name="field_frist_login">
                    </div>
                </form>
                <form action="php/handlers/accademicHandler.php" id="college-supervisor-form" class="d-none" method="post">
                    <div class="form-label">
                        <span>Accademic Supervisor login</span>
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Username" id="college-username" required>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" id="" class="form-control" placeholder="Password" id="college-password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Login" class="btn btn-success" name="college_supervisor_login">
                        <span class="first-login" id="accademic-first-login">Have No Username and Password! Click to Create One</span>
                    </div>
                    </span>
                </form>
                <form action="php/handlers/tokenhandler.php" method="post" class="accademic-form-2 d-none" id="accademic-form-2">
                    <div class="form-group">
                        <label for="">Key</label>
                        <input type="text" name="key" id="field-key" class="form-control" placeholder="The Key Sent to Your Email" required>
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="username" id="field-key" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" id="accademic-password-1" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="">Verify Password</label>
                        <input type="password" name="password1" id="accademic-password-2" class="form-control" placeholder="Re-Enter Password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn btn-success" name="accademic_first_submit">
                    </div>
                </form>
        </div>
    </div>

            <!-- field supervisor registeration -->
    <div class="modal reg-modal d-none" id="reg-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">
                    Field Supervisor Registration
                </h3>
                <button class="close" id="reg-close">&times;</button>
            </div>
            <form action="php/handlers/fieldHandler.php" method="post">
                <div class="form-group">
                    <label for="">First Name</label>
                    <input type="text" class="form-control" placeholder="eg John Doe" name="fname" required>
                </div>
                <div class="form-group">
                    <label for="">Last Name</label>
                    <input type="text" class="form-control" placeholder="eg John Doe" name="lname" required>
                </div>
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" class="form-control" placeholder="Username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="">Organization Name </label>
                    <input type="text" class="form-control" placeholder="eg kalumbasoft limited" name="organization" required>
                </div>
                <div class="form-group">
                    <label for="">Your Email</label>
                    <input type="text" class="form-control" placeholder="eg JohnDoe@gmail.com" name="email" required>
                </div>
                <div class="form-group">
                    <label for="">Your Id Number</label>
                    <input type="text" class="form-control" placeholder="eg J256" name="id_number" required>
                </div>
                <div class="form-group">
                    <label for="">Position In Organization</label>
                    <input type="text" class="form-control" placeholder="eg Managing director" name="position" required>
                </div>
                <div class="form-group">
                    <label for="">Organization Website</label>
                    <input type="text" class="form-control" placeholder="eg www.organization.com" name="org_website" required>
                </div>
                <div class="form-group">
                    <label for="">School</label>
                    <select name="college" id="" class="form-control">
                        <?php
                        foreach($colleges as $college){
                            ?>
                            <option value="<?php echo $college['id']; ?>"><?php echo $college['name']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                <input type="submit" value="Register" name="field_supervisor_reg" class="btn btn-success">
                <input type="reset" value="clear" name="" class="btn btn-danger">
                </div>
            </form>
        </div>
    </div>

    </div>
    
     
    <script src="./assets/js/index.js"></script>
</body>

</html>