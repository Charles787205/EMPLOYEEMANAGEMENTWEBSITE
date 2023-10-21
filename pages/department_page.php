<?php 
 session_start();
  require __DIR__ . "../../inc/bootstrap.php";
  require PROJECT_ROOT_PATH . '/utils/check_session.php';
  require_once PROJECT_ROOT_PATH . 'Model/DepartmentModel.php';
  require_once PROJECT_ROOT_PATH . '/Objects/Employee.php';
  require_once PROJECT_ROOT_PATH . '/Model/EmployeeModel.php';
  $employeeModel = new EmployeeModel();
  $departmentModel =  new DepartmentModel();
  $departments = $departmentModel->getDepartments();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/style.css"/>
  <link rel="stylesheet" href="styles/department_page.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>
  <title>Departments</title>
</head>
<body>
  <?php require_once PROJECT_ROOT_PATH . '/components/admin_navbar.php' ?>
  <div class="department_container">
    <div class="add_department">
      <form action="department_page.php" method="POST">
        <div class="row">
          <label>Name:</label>
          <input type="text" name="departmentName" id="departmentName">
        </div>
        <button>Add Department</button>
      </form>
    </div>
      <?php 
        foreach($departments as $department){
          $departmentName = $department->getName();
          $departmentId = $department->getId();
          $employees = $employeeModel->getEmployee(array('departmentId' => $department->getId()));
          
          ?>
          <div class='department_card'>
            <div class='row'>
              <h3>Department: <?php echo $departmentName ?></h3>
              
              <button
                class='delete_button'
                onclick='toggleDeleteMenu(<?php echo $departmentId?>)'
              >
                <span class='material-symbols-outlined'>close</span>
              </button>
            </div>
            <div class='row'>
              <h3> Employees:</h3>
              <?php if (count($employees) != 0){
              ?>
                <button class='open_button'  onclick='toggleTable(<?php echo $departmentId?>)' id='department_button'>
                  Open
                </button>
                <?php }else{ ?>  
                  <h3>No employees</h3>
                  <?php } ?>
              </div>;
          <table class="employee_table hidden" id="department_table_<?php echo $departmentId?>">
            <thead>
              <tr>
                <th>Name</th>
                <th>Department</th>
                <th>Mobile Number</th>
                <th>Email</th>
                <th>ID</th>
              </tr>
            </thead>
            <tbody>;
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
          
          echo  "</tbody></table>";
          echo "</div>";
        }
      ?>
      <div class="delete_container hidden" id="delete_menu">
        <h3>Are you sure you want to delete?</h3>
        <div class="delete_button_row">
          <button class="cancel_button" onclick='toggleDeleteMenu()'>Cancel</button>
          <button class="delete_button" id=delete_button >Delete</button>
        </div>
      </div>
      
  <script>
    function navigateToEmployee(id) {
    // Redirect to the employee.php page with the employee's ID as a URL parameter
    window.location.href = 'employee_page.php?id=' + id;
  }
    function toggleTable(id){
      const table = document.getElementById('department_table_'+id);
      const button = document.getElementById('department_button');
      if(table.classList.contains('hidden')){
        table.classList.remove('hidden');
        button.innerText = 'Close'
      }else{
        table.classList.add('hidden');
        button.innerText = 'Open'
      }
    }
    function toggleDeleteMenu(id) {
    const deleteMenu = document.getElementById('delete_menu');
    const deleteButton = document.getElementById('delete_button');

    // When the "Delete" button is clicked inside the delete confirmation dialog
    deleteButton.addEventListener('click', () => {
        // Send an AJAX request to delete the department
        window.location.href = 'http://localhost/employeemanagementwebsite/delete_department.php?id='+id
    });

    if (deleteMenu.classList.contains('hidden')) {
        deleteMenu.classList.remove('hidden');
    } else {
        deleteMenu.classList.add('hidden');
    }
}

    
  </script>
</body>
</html>

<?php 
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try{

      $departmentName = $_POST['departmentName'];
      $departmentModel->insertDepartment($departmentName);
      echo "<script>window.location.reload()</script>";
      
    }catch(Exception $e){
      
    }
  }
?>
