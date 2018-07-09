<?php
session_start();
require_once '../db.php';
require_once '../autoload.php';
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $errors = [];

    if (isset($_POST['admin_login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $admin = new Admin($username, $password);
        $admin_login = $admin->adminLogin($db);
        if ($admin_login != "failed") {
            $_SESSION['admin'] = $admin_login;
            header('Location: ../../users/admin/index.php');
        } else {
            $errors[] = "invalid password";
            header('Location: ../../index.php');
        }
    }

    $_SESSION['errors'] = $errors;
} catch (Exception $e) {
    $error = $e->getMessage();
}
