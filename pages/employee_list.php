<?php 
  session_start();
  require __DIR__ . "../../inc/bootstrap.php";
  require_once PROJECT_ROOT_PATH . '/utils/check_session.php';
  require_once PROJECT_ROOT_PATH . 'Model/EmployeeModel.php';
  $employeeModel = new EmployeeModel();
  $employees = $employeeModel->getEmployee();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/style.css">
  
  <title>Document</title>
</head>
<body>
  <?php require_once PROJECT_ROOT_PATH . '/components/admin_navbar.php' ?>
  <div class="employee_list_page">
    <h1>Employees:</h1>
    <div class="employee_table_container">

      <table class="employee_table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Department</th>
            <th>Mobile Number</th>
            <th>Email</th>
            <th>ID</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          foreach ($employees as $employee) {
            // Retrieve employee data
            $name = $employee->getName();
            $department = $employee->getDepartment();
            $mobileNumber = $employee->getMobileNumber();
            $email = $employee->getEmail();
            $id = $employee->getId();

            // Output the data in a table row with an onclick event
            echo "<tr onclick='navigateToEmployee($id)'>";
            echo "<td>$name</td>";
            echo "<td>$department</td>";
            echo "<td>$mobileNumber</td>";
            echo "<td>$email</td>";
            echo "<td>$id</td>";
            echo "</tr>";
          }
          ?>
        </tbody>

      </table>
    </div>

  </div>
  <script>
  function navigateToEmployee(id) {
    // Redirect to the employee.php page with the employee's ID as a URL parameter
    window.location.href = 'employee_page.php?id=' + id;
  }
</script>
</body>
</html>