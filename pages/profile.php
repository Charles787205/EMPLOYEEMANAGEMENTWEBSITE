
<?php
require_once __DIR__ . '/../inc/bootstrap.php';
require_once PROJECT_ROOT_PATH . '/Objects/Employee.php';
require_once PROJECT_ROOT_PATH . '/Model/EmployeeModel.php';
session_start();

$user = $_SESSION['user'];
$employee = $user;
$isPasswordUpdated = false;
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
      <h1>My Profile</h1>
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
      <p><?php echo $employee->getSalaryRate() ?>Php</p>
    </div>
    <div class="row">
      <h3>Department:</h3>
      <p><?php echo $employee->getDepartment() ?></p>
    </div>
    <div class="row">
      <h3>Gender:</h3>
      <p><?php echo $employee->getGender() ?></p>
    </div>
    
    
    <button id="update_button" onclick="toggleUpdatePasswordContainer()">Update Password</button>
    
  </div>
  <div class="update_password_container hidden" id='update_password_container'>
    <h1>Update Password:</h1>
    <form action="profile.php" method="POST">
      <label for="password">Password:</label>
      <input type="password" name="password" id="password">
      <button class='update_button' onclick='toggleUpdatedContainer()'>Update</button>
    </form>
    <button class="cancel_button" onclick="toggleUpdatePasswordContainer()">Cancel</button>
  </div>

  <div class="updated_container hidden" id='updated_container'>
    <h2>Password updated</h2>
    <button onclick="toggleUpdatedContainer()">Continue</button>
  </div>
  </div>
  <script>
    function updatePassword() {
      
    }
    function toggleUpdatePasswordContainer(){
      const updateContainer = document.getElementById('update_password_container');
      if(updateContainer.classList.contains('hidden')){
        updateContainer.classList.remove('hidden');
      }else{
        updateContainer.classList.add('hidden');
      }
      
    }
    function toggleUpdatedContainer(){
      console.log("hhh")
      const uContainer = document.getElementById('updated_container');
      if(uContainer.classList.contains('hidden')){
        uContainer.classList.remove('hidden')
      }else{
        uContainer.classList.add('hidden');
      }
    }
    
  </script>
</body>
</html>
<?php 
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee->setPassword($_POST['password']);
    $employeeModel = new EmployeeModel();
    $employeeModel->updatePassword($employee);
    $isPasswordUpdated = true;
  }
?>