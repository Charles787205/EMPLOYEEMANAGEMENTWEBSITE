<?php
  if($_SESSION['user'] == null){
    header('Location: login.php');
    exit();
  }else {
    
    $retrievedEmployee = $_SESSION['user'];

    if ($retrievedEmployee instanceof Employee) {
      if($retrievedEmployee->getDepartment() != 'ADMIN'){
      header('Location: login.php');
      exit();
    }
    } 
    
  }
?>