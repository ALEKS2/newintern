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
    <link rel="stylesheet" href="../../assets/css/edu_evaluate.css">
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
     
    <h1 class="text-center">Student Evaluation Form</h1>
    <table class="table table-active table-bordered table-striped">
       <tr class="bg-success text-white text-capitalize">
           <th>School practice assessment form</th>
           <th>Score(click to choose)</th>
           <th>Points Arising From The Lesson</th>
       </tr>
       <tr>
           <td>
               <h5 id="l1">1. Lesson plan and scheme of work (15 marks)</h5>
               <ul>
                   <li>Appropriate format/ Layout</li>
                   <li>Clear statement or objectives</li>
                   <li>Adequate content to be covered in the lesson</li>
                   <li>Appropriate teaching methods</li>
               </ul>
           </td>
           <td>
               <p></p>
               <p id="l1p1">
                   <button class="btn l1p1btn" id="p1zero" value="0">0</button>
                   <button class="btn l1p1btn" value="1" id="l1p1one">1</button>
                   <button class="btn l1p1btn" value="2" id="l1p1two">2</button>
                   <button class="btn l1p1btn" value="3" id="l1p1three">3</button>
               </p>
               <p id="l1p2">
                   <button class="btn l1p2btn" id="l1p2zero" value="0">0</button>
                   <button class="btn l1p2btn" value="1" id="l1p2one">1</button>
                   <button class="btn l1p2btn" value="2" id="l1p2two">2</button>
                   <button class="btn l1p2btn" value="3" id="l1p2three">3</button>
                   <button class="btn l1p2btn" value="4" id="l1p2four">4</button>
               </p>
               <p id="l1p3">
                   <button class="btn l1p3btn" id="l1p3zero" value="0">0</button>
                   <button class="btn l1p3btn" value="1" id="l1p3one">1</button>
                   <button class="btn l1p3btn" value="2" id="l1p3two">2</button>
                   <button class="btn l1p3btn" value="3" id="l1p3three">3</button>
                   <button class="btn l1p3btn" value="4" id="l1p3four">4</button>
               </p>
               <p id="l1p4">
                   <button class="btn l1p4btn" id="l1p4zero" value="0">0</button>
                   <button class="btn l1p4btn" value="1" id="l1p4one">1</button>
                   <button class="btn l1p4btn" value="2" id="l1p4two">2</button>
                   <button class="btn l1p4btn" value="3" id="l1p4three">3</button>
                   <button class="btn l1p4btn" value="4" id="l1p4four">4</button>
               </p>
           </td>
           <td class"marks-td">
                <div class="marks-tds">
                <input type="text" name="l1marks" value="0" class="marks text-center text-success" id="l1marks" disabled>
                </div>
            </td>
       </tr>
       <tr>
           <td>
            <h5 id="l2">2. Teacher's communication (20 marks)</h5>
            <ul>
                <li>Motivating introduction of lessons and clear linkage between previous and current lessons</li>
                <li>Adequate voice level projection</li>
                <li>Clarity of explanation and instruction</li>
                <li>Questioning technique {relevancy, clarity, frequency and distribution, answerability}</li>
                <li>Encourage student participation and interaction in the lesson</li>
            </ul>
           </td>
           <td>
               <p></p>
               <p id="l2p1">
                   <button class="btn l2p1btn" id="l2p1zero" value="0">0</button>
                   <button class="btn l2p1btn" value="1" id="l2p1one">1</button>
                   <button class="btn l2p1btn" value="2" id="l2p1two">2</button>
                   <button class="btn l2p1btn" value="3" id="l2p1three">3</button>
                   <button class="btn l2p1btn" value="4" id="l2p1four">4</button>
               </p>
               <p id="l2p2">
                   <button class="btn l2p2btn" id="l2p2zero" value="0">0</button>
                   <button class="btn l2p2btn" value="1" id="l2p2one">1</button>
                   <button class="btn l2p2btn" value="2" id="l2p2two">2</button>
                   <button class="btn l2p2btn" value="3" id="l2p2three">3</button>
               </p>
               <p id="l2p3">
                   <button class="btn l2p3btn" id="l2p3zero" value="0">0</button>
                   <button class="btn l2p3btn" value="1" id="l2p3one">1</button>
                   <button class="btn l2p3btn" value="2" id="l2p3two">2</button>
                   <button class="btn l2p3btn" value="3" id="l2p3three">3</button>
                   <button class="btn l2p3btn" value="4" id="l2p3four">4</button>
                   <button class="btn l2p3btn" value="5" id="l2p3four">5</button>
               </p>
               <p id="l2p4">
                   <button class="btn l2p4btn" id="l2p4zero" value="0">0</button>
                   <button class="btn l2p4btn" value="1" id="l2p4one">1</button>
                   <button class="btn l2p4btn" value="2" id="l2p4two">2</button>
                   <button class="btn l2p4btn" value="3" id="l2p4three">3</button>
                   <button class="btn l2p4btn" value="4" id="l2p4four">4</button>
               </p>
               <p id="l2p5">
                   <button class="btn l2p5btn" id="l2p5zero" value="0">0</button>
                   <button class="btn l2p5btn" value="1" id="l2p5one">1</button>
                   <button class="btn l2p5btn" value="2" id="l2p5two">2</button>
                   <button class="btn l2p5btn" value="3" id="l2p5three">3</button>
                   <button class="btn l2p5btn" value="4" id="l2p5four">4</button>
               </p>
           </td>
           <td class"marks-td">
                <div class="marks-tds">
                    <input type="text" name="l2marks" value="0" class="marks text-center text-success" id="l2marks" disabled>
                </div>
            </td>
       </tr>
       <tr>
           <td>
               <h5 id="l3">3. Knowledge of subject content (16 marks)</h5>
               <ul>
                   <li>Subject content appropriate to level of class</li>
                   <li>Use of relevant examples and illustrations</li>
                   <li>Transfer knowledge and problem solving</li>
                   <li>Use of students questions and answers</li>
               </ul>
           </td>
           <td>
               <p></p>
                <p id="l3p1">
                   <button class="btn l3p1btn" id="l3p1zero" value="0">0</button>
                   <button class="btn l3p1btn" value="1" id="l3p1one">1</button>
                   <button class="btn l3p1btn" value="2" id="l3p1two">2</button>
                   <button class="btn l3p1btn" value="3" id="l3p1three">3</button>
                   <button class="btn l3p1btn" value="4" id="l3p1four">4</button>
               </p>
               <p id="l3p2">
                   <button class="btn l3p2btn" id="l3p2zero" value="0">0</button>
                   <button class="btn l3p2btn" value="1" id="l3p2one">1</button>
                   <button class="btn l3p2btn" value="2" id="l3p2two">2</button>
                   <button class="btn l3p2btn" value="3" id="l3p2three">3</button>
                   <button class="btn l3p2btn" value="4" id="l3p2four">4</button>
               </p>
               <p id="l3p3">
                   <button class="btn l3p3btn" id="l3p3zero" value="0">0</button>
                   <button class="btn l3p3btn" value="1" id="l3p3one">1</button>
                   <button class="btn l3p3btn" value="2" id="l3p3two">2</button>
                   <button class="btn l3p3btn" value="3" id="l3p3three">3</button>
                   <button class="btn l3p3btn" value="4" id="l3p3four">4</button>
               </p>
               <p id="l3p4">
                   <button class="btn l3p4btn" id="l3p4zero" value="0">0</button>
                   <button class="btn l3p4btn" value="1" id="l3p4one">1</button>
                   <button class="btn l3p4btn" value="2" id="l3p4two">2</button>
                   <button class="btn l3p4btn" value="3" id="l3p4three">3</button>
                   <button class="btn l3p4btn" value="4" id="l3p4four">4</button>
               </p>
           </td>
           <td class"marks-td">
                <div class="marks-tds">
                    <input type="text" name="l3marks" class="marks text-center text-success" id="l3marks" value="0" disabled>
                </div>
            </td>
       </tr>
       <tr>
           <td>
               <h5 id="l4">4.Use of teaching aids and chalkboard (14 marks)</h5>
               <ul>
                   <li>Relevance/suitability of the teaching aids</li>
                   <li>Creativity/use of environment/real objects</li>
                   <li>Clarity, attractiveness of teaching aids, readability of writing/diagrams and pictures</li>
                   <li>correct time and use of teaching aids</li>
                   <li>Systematic use of chalkboard, legibility of letters, straight lines and clean chalkboard after lessons</li>
               </ul>
           </td>
           <td>
               <p></p>
               <p id="l4p1">
                   <button class="btn l4p1btn" id="l4p1zero" value="0">0</button>
                   <button class="btn l4p1btn" value="1" id="l4p1one">1</button>
                   <button class="btn l4p1btn" value="2" id="l4p1two">2</button>
                   <button class="btn l4p1btn" value="3" id="l4p1three">3</button>
               </p>
               <p id="l4p2">
                   <button class="btn l4p2btn" id="l4p2zero" value="0">0</button>
                   <button class="btn l4p2btn" value="1" id="l4p2one">1</button>
                   <button class="btn l4p2btn" value="2" id="l4p2two">2</button>
                   <button class="btn l4p2btn" value="3" id="l4p2three">3</button>
               </p>
               <p id="l4p3">
                   <button class="btn l4p3btn" id="l4p3zero" value="0">0</button>
                   <button class="btn l4p3btn" value="1" id="l4p3one">1</button>
                   <button class="btn l4p3btn" value="2" id="l4p3two">2</button>
                   <button class="btn l4p3btn" value="3" id="l4p3three">3</button>
               </p>
               <p id="l4p4">
                   <button class="btn l4p4btn" id="l4p4zero" value="0">0</button>
                   <button class="btn l4p4btn" value="1" id="l4p4one">1</button>
                   <button class="btn l4p4btn" value="2" id="l4p4two">2</button>
               </p>
               <p id="l4p5">
                   <button class="btn l4p5btn" id="l4p5zero" value="0">0</button>
                   <button class="btn l4p5btn" value="1" id="l4p5one">1</button>
                   <button class="btn l4p5btn" value="2" id="l4p5two">2</button>
                   <button class="btn l4p5btn" value="3" id="l4p5three">3</button>
               </p>
           </td>
           <td class"marks-td">
                <div class="marks-tds">
                    <input type="text" name="l4marks" class="marks text-center text-success" id="l4marks" value="0" disabled>
                </div>
            </td>
       </tr>
       <tr>
           <td>
               <h5 id="l5">5. Classroom organisation and managementn (17 marks)</h5>
               <ul>
                   <li>Classroom cleanliness</li>
                   <li>Effective classroom control and management</li>
                   <li>Use of relevant humour and awareness of class climate/addresses student by names</li>
                   <li>Movement and class organisation</li>
                   <li>Time management</li>
               </ul>
           </td>
           <td>
               <p></p>
               <p id="l5p1">
                   <button class="btn l5p1btn" id="l5p1zero" value="0">0</button>
                   <button class="btn l5p1btn" value="1" id="l5p1one">1</button>
                   <button class="btn l5p1btn" value="2" id="l5p1two">2</button>
               </p>
               <p id="l5p2">
                   <button class="btn l5p2btn" id="l5p2zero" value="0">0</button>
                   <button class="btn l5p2btn" value="1" id="l5p2one">1</button>
                   <button class="btn l5p2btn" value="2" id="l5p2two">2</button>
                   <button class="btn l5p2btn" value="3" id="l5p2three">3</button>
                   <button class="btn l5p2btn" value="4" id="l5p2four">4</button>
                   <button class="btn l5p2btn" value="5" id="l5p2five">5</button>
               </p>
               <p id="l5p3">
                   <button class="btn l5p3btn" id="l5p3zero" value="0">0</button>
                   <button class="btn l5p3btn" value="1" id="l5p3one">1</button>
                   <button class="btn l5p3btn" value="2" id="l5p3two">2</button>
                   <button class="btn l5p3btn" value="3" id="l5p3three">3</button>
               </p>
               <p id="l5p4">
                   <button class="btn l5p4btn" id="l5p4zero" value="0">0</button>
                   <button class="btn l5p4btn" value="1" id="l5p4one">1</button>
                   <button class="btn l5p4btn" value="2" id="l5p4two">2</button>
                   <button class="btn l5p4btn" value="3" id="l5p4three">3</button>
                   <button class="btn l5p4btn" value="4" id="l5p4four">4</button>
               </p>
               <p id="l5p5">
                   <button class="btn l5p5btn" id="l5p5zero" value="0">0</button>
                   <button class="btn l5p5btn" value="1" id="l5p5one">1</button>
                   <button class="btn l5p5btn" value="2" id="l5p5two">2</button>
                   <button class="btn l5p5btn" value="3" id="l5p5three">3</button>
               </p>
           </td>
           <td class"marks-td">
                <div class="marks-tds">
                    <input type="text" name="l5marks" class="marks text-center text-success" id="l5marks" value="0" disabled>
                </div>
            </td>
       </tr>
       <tr>
           <td>
               <h5 id="l6">6. Assesment and evaluation (15 marks)</h5>
               <ul>
                   <li>Relevant assesment and feedback given</li>
                   <li>Evidence of whether learning has taken place through quick review what has been taught</li>
                   <li>Evidence of monitoring students' work</li>
                   <li>Meaningful self evaluation</li>
                   <li>Record keeping</li>
               </ul>
           </td>
           <td>
               <p></p>
               <p id="l6p1">
                   <button class="btn l6p1btn" id="l6p1zero" value="0">0</button>
                   <button class="btn l6p1btn" value="1" id="l6p1one">1</button>
                   <button class="btn l6p1btn" value="2" id="l6p1two">2</button>
                   <button class="btn l6p1btn" value="3" id="l6p1three">3</button>
               </p>
               <p id="l6p2">
                   <button class="btn l6p2btn" id="l6p2zero" value="0">0</button>
                   <button class="btn l6p2btn" value="1" id="l6p2one">1</button>
                   <button class="btn l6p2btn" value="2" id="l6p2two">2</button>
                   <button class="btn l6p2btn" value="3" id="l6p2three">3</button>
                   <button class="btn l6p2btn" value="4" id="l6p2four">4</button>
               </p>
               <p id="l6p3">
                   <button class="btn l6p3btn" id="l6p3zero" value="0">0</button>
                   <button class="btn l6p3btn" value="1" id="l6p3one">1</button>
                   <button class="btn l6p3btn" value="2" id="l6p3two">2</button>
                   <button class="btn l6p3btn" value="3" id="l6p3three">3</button>
               </p>
               <p id="l6p4">
                   <button class="btn l6p4btn" id="l6p4zero" value="0">0</button>
                   <button class="btn l6p4btn" value="1" id="l6p4one">1</button>
                   <button class="btn l6p4btn" value="2" id="l6p4two">2</button>
                   <button class="btn l6p4btn" value="3" id="l6p4three">3</button>
               </p>
               <p id="l6p5">
                   <button class="btn l6p5btn" id="l6p5zero" value="0">0</button>
                   <button class="btn l6p5btn" value="1" id="l6p5one">1</button>
                   <button class="btn l6p5btn" value="2" id="l6p5two">2</button>
               </p>
           </td>
           <td class"marks-td">
            <div class="marks-tds">
                    <input type="text" name="l6marks" class="marks text-center text-success" id="l6marks" value="0" disabled>
                </div>
            </td>
       </tr>
       <tr>
           <td>
               <h5 id="l7">7. Ethics and integrity (3 marks)</h5>
               <ul>
                   <li>Descent dressing/cleanliness</li>
                   <li>Descent language</li>
                   <li>composure and temperament</li>
               </ul>
           </td>
           <td>
               <p></p>
               <p id="l7p1">
                   <button class="btn l7p1btn" id="l7p1zero" value="0">0</button>
                   <button class="btn l7p1btn" value="1" id="l7p1one">1</button>
               </p>
               <p id="l7p2">
                   <button class="btn l7p2btn" id="l7p2zero" value="0">0</button>
                   <button class="btn l7p2btn" value="1" id="l7p2one">1</button>
               </p>
               <p id="l7p3">
                   <button class="btn l7p3btn" id="l7p3zero" value="0">0</button>
                   <button class="btn l7p3btn" value="1" id="l7p3one">1</button>
               </p>
           </td>
           <td class"marks-td">
               <div class="marks-tds">
                <input type="text" name="l7marks" class="marks text-center text-success" id="l7marks" value="0" disabled>
                </div>
            </td>
       </tr>
       <tr>
           <td>
            <form action="../../php/handlers/studentHandler.php" method="post">
                <div class="form-group">
                    <label for="" class="h5">Total Marks</label>
                    <input class="form-control text-primary disabled" type="number" name="marks" id="marks">
                </div>    
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <input type="submit" value="Save" name="edu_evaluation" class="btn btn-success">
            </form>
           </td>
       </tr>
     </table>
</div>
<div class="footer">
    <p>&copy; <?php echo date('Y'); ?> Makerere university</p>
</div>
<script src="../../assets/js/jquery.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<script src="../../assets/js/edu_evaluate.js"></script>
</body>
</html>