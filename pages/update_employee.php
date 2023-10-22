
<?php 
  require __DIR__ . "../../inc/bootstrap.php";
  require_once PROJECT_ROOT_PATH . '/Model/EmployeeModel.php';
  session_start();
  if($_SESSION['user'] == null){
    header('Location: login.php');
    exit();
  }else {
    if($_SESSION['user']->getDepartment() != 'ADMIN'){
      header('Location: login.php');
      exit();
    }
  }

  $employeeModel = new EmployeeModel();
  $employeeId = $_GET['id'];
  
  $employee = $employeeModel->getEmployee(array('id'=>$employeeId))[0];
  $employeeFirstName = $employee->getFirstName();

  
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
    <?php require_once PROJECT_ROOT_PATH . '/components/admin_navbar.php'; ?>
    <div class="register_container">
      <form action="update_employee.php?id=<?php echo $employeeId;?>" method="POST">
        <h2>Update Page</h2>
        <a href="index.php">Click here to go back</a><br /><br />
        <div class="row">
          <label for="">First Name:</label>
          <input type="text" name="firstname" id="first_name" required value=<?php echo $employee->getFirstName(); ?> />
          <input type="text" name="lastname" id="last_name" required value=<?php echo $employee->getLastName(); ?> />
        </div>
        
        <div class="row">
          <label for="">Email:</label>
          <input type="email" name="email" id="email" required value=<?php echo $employee->getEmail() ?> >
        </div>
        
        <div class="row">
          <label for="">Position</label>
          <input type="text" name="position" id="position" required value=<?php echo $employee->getPosition(); ?>>
        </div>
        <div class="row">
          <label for="">Gender</label>
          
          <select id="gender" name='gender' required value=<?php echo $employee->getGender(); ?> >
            <option value="MALE">MALE</option>
            <option value="FEMALE">FEMALE</option>
            <option value="OTHER">OTHER</option>
          </select>
        </div>
        <div class="row">
          <label for="">Mobile Number:</label>
          <input type="tel" name="mobile_number" id="mobile_number" value=<?php echo $employee->getMobileNumber(); ?> >
        </div>
        
        <div class="row">
        
          <label for="">Department:</label>
          <select id="department" name='department' required value=<?php echo $employee->getDepartment(); ?>>
            <?php 
            #fetch data from database to display in the selection
            
            require_once PROJECT_ROOT_PATH . '/Model/DepartmentModel.php';
            $departmentModel = new DepartmentModel();    
            $arrDepartments = $departmentModel->getDepartments();
            foreach($arrDepartments as $department){
              $id = $department->getId();
              $name = $department->getName();
              print "<option value=$id>$name</option>";
            }
            ?>
            
          </select>
        </div>
        <div class="row">
          <label for="">Salary Rate:</label>
          <input type="number" name="salary_rate" id="salary_rate" value=<?php echo $employee->getSalaryRate(); ?> >
        </div>
        <div class="row">
          <label for="">Birth Date:</label>
          <input type="date" name="date" id="date" value=<?php echo $employee->getBirthDate() ?>>
        </div>
        <button type="submit" class='update_button'>Submit</button>
      </form>
    </div>
  </body>
</html>

<?php
  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Collect form data
  
    $employee->setFirstname($_POST['firstname']);
    $employee->setLastname($_POST['lastname']);
    $employee->setEmail($_POST['email']);
    $employee->setMobileNumber($_POST['mobile_number']);
    $employee->setPosition($_POST[ 'position']);
    $employee->setGender(filter_input(INPUT_POST, 'gender'));
    $employee->setDepartmentId($_POST['department']);
    $employee->setSalaryRate($_POST['salary_rate']);
    $employee->setBirthdate($_POST['date']);
    
    $employeeModel = new EmployeeModel();
    $employeeModel -> updateEmployee($employee);
    header('Location: employee_list.php');
}
?>
