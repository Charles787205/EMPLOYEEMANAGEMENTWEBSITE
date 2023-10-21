<?php
session_start();
require __DIR__ . "../../inc/bootstrap.php";
require_once PROJECT_ROOT_PATH . '/Model/EmployeeModel.php';
if (isset($_GET['id'])) {
    
    $employeeId = $_GET['id'];
    $employeeModel = new EmployeeModel();
    $employeeModel -> deleteEmployeeById($employeeId);
    header('Location: department_page.php');
    
} else {
    // Handle invalid requests
    http_response_code(400); // Bad Request
}
?>