<?php 
session_start();
require __DIR__ . "../../inc/bootstrap.php";
require PROJECT_ROOT_PATH . '/Model/EmployeeModel.php'; 

$employeeNotFound = false;
if(isset($_SESSION['user'])){
  if($_SESSION['user'] != null){
    header("Location: http://localhost/employeemanagementwebsite/index.php");
    exit();
  }
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
    <div class="login_page">

      
      <form action="login.php" method="POST">
          <h2>Employee Management System</h2>
            <h2>Login Page</h2>
             Enter Email: <input type="email" 
             name="email" required="required" placeholder="john@example.com"/> <br/>
             Enter Password: <input type="password" 
             name="password"  /> <br/>
             
             <button>Login</button>
          </form>
    </div>
        
  </body>
</html>

<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $employee = new Employee();
  $employee->setEmail($_POST['email']);
 
  $employee->setPassword($_POST['password']);
  if($employee->getPassword() == null){
    $employee->setPassword("");
  }

  $employeeModel = new EmployeeModel();

  $loginData = array('email' => $employee->getEmail(),'password'=>$employee->getPassword());
  $employee = $employeeModel->getEmployee($loginData);
  if(count($employee) > 0){
    $_SESSION['user'] = $employee[0];
    header("Location: http://localhost/employeemanagementwebsite/index.php");
    exit();
  }else{
    header("Location: http://localhost/employeemanagementwebsite/login_error.php");
  }
}
  ?>