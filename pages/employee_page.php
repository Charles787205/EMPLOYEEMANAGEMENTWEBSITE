
<?php
require_once __DIR__ . '/../inc/bootstrap.php';
require_once PROJECT_ROOT_PATH . '/Objects/Employee.php';
require_once PROJECT_ROOT_PATH . '/Model/EmployeeModel.php';
session_start();
require_once PROJECT_ROOT_PATH . '/utils/check_session.php';
$user = $_SESSION['user'];

if (isset($_GET['id'])) {
    
    $employeeId = $_GET['id'];
    $requestData = array('id'=> $employeeId);
    $employeeModel = new EmployeeModel();
    $employee = $employeeModel -> getEmployee($requestData)[0];

   
    
} else {
    // Handle the case when 'id' is not provided in the URL
    echo "Employee ID not provided.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="styles/style.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="styles/employee_page.css?v=<?php echo time(); ?>">

  <title><?php echo $employee->getFirstName() ?></title>
</head>
<body>
  <?php
    if($user->getDepartment() == 'ADMIN'){
      require_once PROJECT_ROOT_PATH . '/components/admin_navbar.php';
    }else{
      require_once PROJECT_ROOT_PATH . '/components/employee_navbar.php';
    }
  ?>
  <div class="employee_page">
    <div class="employee_detail_container">
      <h2><?php echo $employee->getName()?></h2>
    
    <div class="row">
      <h3>Employee Number:</h3>
      <p><?php echo $employee->getMobileNumber() ?></p>
    </div>
    <div class="row">
      <h3>Email:</h3>
      <p><?php echo $employee->getEmail() ?></p>
    </div>
    <div class="row">
      <h3>Birthdate:</h3>
      <p><?php echo $employee->getBirthDate() ?></p>
    </div>
    <div class="row">
      <h3>Position:</h3>
      <p><?php echo $employee->getPosition() ?></p>
    </div>
    <div class="row">
      <h3>Gender:</h3>
      <p><?php echo $employee->getGender() ?></p>
    </div>
    <div class="row">
      <h3>Salary Rate:</h3>
      <p><?php echo $employee->getSalaryRate() ?></p>
    </div>
    <div class="row">
      <h3>Department:</h3>
      <p><?php echo $employee->getDepartment() ?></p>
    </div>
    <div class="row">
      <h3>Gender:</h3>
      <p><?php echo $employee->getGender() ?></p>
    </div>
    
    <button id="update_button" onclick="updateEmployee(<?php echo $employeeId ?>)">Update</button>
    <button id="delete_button" onclick="deleteEmployee(<?php echo $employeeId ?>)">Delete</button>
  </div>
  </div>
  <script>
    function updateEmployee(id) {
      window.location.href = 'http://localhost/employeemanagementwebsite/update_employee.php?id=' + id;
    }
    function deleteEmployee(id){
      window.location.href = 'http://localhost/employeemanagementwebsite/delete_employee.php?id='+ id;
    }
  </script>
</body>
</html>