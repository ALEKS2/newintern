<?php
session_start();
require_once('../../php/db.php');
require_once('../../php/autoload.php');
if(isset($_SESSION['student'])){
    $user = $_SESSION['student'][0];
}else{
    header('Location: ../../index.php');
}
$college = College::getCollegeById($db, $user['school_id']);

if($college['name'] == "education"){
    $file = 'schools.doc';
}else{
    $file = 'internship_companies.doc';
}

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.$file);
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
readfile($file);
exit;