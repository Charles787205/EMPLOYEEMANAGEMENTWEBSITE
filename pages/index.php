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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/style.css" />
    <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"
    />
    <title>Employee Management</title>
</head>
<body>
<?php

  

    if ($user->getDepartment() == 'ADMIN') {
        require_once PROJECT_ROOT_PATH . '/components/admin_navbar.php';
        header('Location: employee_list.php');
    } else {
        require_once PROJECT_ROOT_PATH . '/components/employee_navbar.php';
        header('Location: profile.php');
    }

?>
</body>
</html>
