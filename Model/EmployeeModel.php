<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
require_once PROJECT_ROOT_PATH . "/Objects/Employee.php";
class EmployeeModel extends Database
{
    public function getEmployee($requestData=[]) : array
    {   
        $query_string = "SELECT employee.* , department.name AS department FROM employee inner join department on employee.departmentId = department.id ";

        if(!empty($requestData)){
          $query_string .= ' WHERE ';
          $counter = 0;
          foreach($requestData as $key => $value){
            if($counter > 0){
              $query_string .= ' AND ';
            }
            switch($key){
              case 'email':
                $query_string .= "employee.email = '$value' ";

                break;
              case 'departmentId':
                $query_string .= "employee.departmentId = $value ";

                break;
              case 'id':
                $query_string .= "employee.id = $value ";
                break;
              case 'password':
                $query_string .= "employee.password = '$value' ";
                break;
              }
              $counter+= 1;
            }
          $query_string .= " ORDER BY id DESC;";
          
        }
        
        $stmt = $this->connection->prepare($query_string);
        $stmt->execute();
        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $employees = [];
        foreach($results as $result){
          $employee = new Employee();
    
           // Set the properties of the Employee object with data from the result
          $employee->setId($result['id']);
          $employee->setName($result['firstName'], $result['lastName']);
          $employee->setBirthDate($result['birthDate']);
          $employee->setPosition($result['position']);
          $employee->setGender($result['gender']);
          $employee->setMobileNumber($result['mobileNumber']);
          $employee->setSalaryRate($result['salaryRate']);
          $employee->setDepartmentId($result['departmentId']);
          $employee->setDepartment($result['department']);
          $employee->setEmail($result['email']);
          $employee->setImage($result['image']);

          // Add the populated Employee object to the $employees array
          $employees[] = $employee;
          
        }
        return $employees;
        
          
  }



    
    public function insertEmployee(Employee $employee) {
    $query = "INSERT INTO employee (email, birthdate, position, gender, mobileNumber, salaryRate, departmentId, firstName, lastName) 
              VALUES (?, DATE(?), ?, ?, ?, ?, ?, ?, ?)";
    
    try {
        // Check if the email already exists
        if ($this->isEmailExist($employee->getEmail())) {
            return false;
        }

        $email = $employee->getEmail();
        $birthdate = $employee->getBirthDate();
        $position = $employee->getPosition();
        $gender = $employee->getGender();
        $mobileNumber = $employee->getMobileNumber();
        $salaryRate = $employee->getSalaryRate();
        
        $departmentId = $employee->getDepartmentId();
        $firstName = $employee->getFirstName();
        $lastName = $employee->getLastName();
        
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('sssssdiss',
            $email,
            $birthdate,
            $position,
            $gender,
            $mobileNumber,
            $salaryRate,
            $departmentId,
            $firstName,
            $lastName,
            
        );
        
        $stmt->execute();
        return $stmt;
    } catch (Exception $e) {
        throw new Exception($e->getMessage());
    }
  }

    public function updateEmployeeImage($employee){
      $query = 'UPDATE employee SET image=? WHERE id=?';
      $image = $employee->getImage();
      $stmt = $this->connection->prepare($query);
      $stmt->bind_param('si', $employee->getImage(), $employee->getId());
      $stmt->execute();
    }

    public function isEmailExist($email){
      return $this->select("SELECT email  FROM employee WHERE email='". $email ."'");
    }
    public function getEmployeeInDepartment($departmentId){
      return $this->select('SELECT * FROM employee WHERE departmentId='.$departmentId);
    }

    public function updateEmployee($employee){
    $query = "UPDATE employee SET email=?, birthdate=DATE(?), position=?, gender=?, mobileNumber=?, salaryRate=?, departmentId=?, firstName=?, lastName=?, password=? WHERE id=?";
      
    try {
        $email = $employee->getEmail();
        $birthdate = $employee->getBirthDate();
        $position = $employee->getPosition();
        $gender = $employee->getGender();
        $mobileNumber = $employee->getMobileNumber();
        $salaryRate = $employee->getSalaryRate();
        $departmentId = $employee->getDepartmentId();
        $firstName = $employee->getFirstName();
        $lastName = $employee->getLastName();
        $password = $employee->getPassword();
        $id = $employee->getId();
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('sssssdisssi', $email, $birthdate, $position, $gender, $mobileNumber, $salaryRate,  $departmentId, $firstName, $lastName,$password, $id);

        $stmt->execute();
        return $stmt;
        
    } catch (mysqli_sql_exception $e) {
        // Handle the exception or log the error message
        throw new Exception('Error updating employee: ' . $e->getMessage());
    }
  }

  public function deleteEmployeeById($employeeId) {
      $query = "DELETE FROM employee WHERE id = ?";
      
      try {
          $stmt = $this->connection->prepare($query);
          $stmt->bind_param('i', $employeeId); // Assuming 'i' for integer
          
          $stmt->execute();
          return true; // Successful deletion
      } catch (mysqli_sql_exception $e) {
          // Handle the exception or log the error message
          return false; // Deletion failed
      }
  }
  



    
}