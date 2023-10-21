<?php
session_start();
require __DIR__ . "../../inc/bootstrap.php";
require_once PROJECT_ROOT_PATH . '/Model/DepartmentModel.php';
if (isset($_GET['id'])) {
    
    $departmentId = $_GET['id'];
    $departmentModel = new DepartmentModel();
    $departmentModel->deleteDepartmentById($departmentId);
    header('Location: department_page.php');
    
} else {
    // Handle invalid requests
    http_response_code(400); // Bad Request
}
?>