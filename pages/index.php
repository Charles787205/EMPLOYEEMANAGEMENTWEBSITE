<?php
require __DIR__ . "/../inc/bootstrap.php";
require_once PROJECT_ROOT_PATH . 'Objects/Employee.php';
session_start();

if ($_SESSION['user'] == null) {
    header('Location: login.php');
    exit();
} else {
    $user = $_SESSION['user'];
}

  

    if ($user->getDepartment() == 'ADMIN') {
        require_once PROJECT_ROOT_PATH . '/components/admin_navbar.php';
        header('Location: employee_list.php');
    } else {
        require_once PROJECT_ROOT_PATH . '/components/employee_navbar.php';
        header('Location: profile.php');
    }

?>

