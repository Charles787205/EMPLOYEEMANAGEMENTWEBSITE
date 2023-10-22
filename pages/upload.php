<?php
require __DIR__ . "../../inc/bootstrap.php";
require_once PROJECT_ROOT_PATH . '/Objects/Employee.php';
require_once PROJECT_ROOT_PATH . '/Model/EmployeeModel.php';
session_start();
if($_SESSION['user'] == null){
  header('Location: login.php');
  exit();
}
$user = $_SESSION['user'];
if($_SERVER['REQUEST_METHOD'] == 'POST'){

  $target_dir = __DIR__. "/../uploads/";
  $target_file = $target_dir . $user->getId().basename($_FILES["fileToUpload"]["name"]);
  $image_path_for_user = 'pages/../uploads/' . $user->getId().basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $user->setImage($image_path_for_user);
      $employeeModel = new EmployeeModel();
      $employeeModel->updateEmployeeImage($user);
      header('Location: profile.php');
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/style.css">
  <title>Upload</title>
</head>
<body>
  <?php if($user->getDepartment() == 'ADMIN') {
    require_once PROJECT_ROOT_PATH . '/components/admin_navbar.php';
    }else{
      require_once PROJECT_ROOT_PATH . '/components/employee_navbar.php';
    }
    
    ?>
  <div class="upload_page">
    
    <form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <button>Upload Image</button>
    
  </form>
  </div>
</body>
</html>