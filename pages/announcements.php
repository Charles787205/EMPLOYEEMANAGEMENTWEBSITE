<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="styles/announcement_page.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>
  <title>Announcemnet</title>
</head>
<body>
  <?php 
  require __DIR__ . "../../inc/bootstrap.php";
  require_once PROJECT_ROOT_PATH . '/Objects/Employee.php';
  session_start();
  require_once PROJECT_ROOT_PATH . '/utils/check_session.php';
  require_once PROJECT_ROOT_PATH . 'Model/AnnouncementModel.php';
  require_once PROJECT_ROOT_PATH . 'Objects/Announcement.php';
  $announcementModel = new AnnouncementModel();
  $announcements = $announcementModel->getAnnouncements();
  $user = $_SESSION['user'];
  if($user->getDepartment() == 'ADMIN'){
      require_once PROJECT_ROOT_PATH . '/components/admin_navbar.php';
    }else{
      require_once PROJECT_ROOT_PATH . '/components/employee_navbar.php';
    }
  ?>
  <div class="page">
    <h1>Add Announcement</h1>
    <form action="announcements.php" class="add_announcement" method='POST'>
      
        <label for="title">Title:</label>
        
        <input type="text" name="title" id="title">
        <label for="description">Description:</label>
        <textarea name="description" id="" cols="50" rows="6"></textarea>
      <button>Add Announcement</button>
    </form>
    <h1>Announcements</h1>
    <?php 
      foreach($announcements as $announcement){
        $announcementId = $announcement->getId();
        ?>
        <div class="announcement_card">
          <div class="row">
            
            <h2><?php echo $announcement->getTitle() ?></h2>
             <button
                class='delete_button'
                onclick='toggleDeleteMenu(<?php echo $announcementId?>)'
              >
                <span class='material-symbols-outlined'>close</span>
              </button>
          </div>
          <p><?php echo $announcement->getDescription()?></p>
          <div class="row bottom_row">
            <p>Created by: <?php  echo $announcement->getEmployeeName()?></p>
            <p>Created At: <?php  echo $announcement->getDateCreated()?></p>
          </div>
        </div>
        <div class="delete_container hidden" id="delete_menu">
        <h3>Are you sure you want to delete?</h3>
        <div class="delete_button_row">
          <button class="cancel_button" onclick='toggleDeleteMenu()'>Cancel</button>
          <button class="delete_button" id=delete_button >Delete</button>
        </div>
      </div>

    <?php   }
    ?>
  </div>
  <script>
  
    function toggleDeleteMenu(id) {
      const deleteMenu = document.getElementById('delete_menu');
      const deleteButton = document.getElementById('delete_button');

      // When the "Delete" button is clicked inside the delete confirmation dialog
      deleteButton.addEventListener('click', () => {
          // Send an AJAX request to delete the department
          window.location.href = 'http://localhost/employeemanagementwebsite/delete_announcement.php?id='+id
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
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if($_POST['title'] != '' and $_POST['description'] != ''){

    $announcement = new Announcement();
    $announcement->setTitle($_POST['title']);
    $announcement->setDescription($_POST['description']);
    $announcement->setEmployeeId($user->getId());
    $announcementModel->insertAnnouncement($announcement);
    echo "<meta http-equiv='refresh' content='0'>";
  }
}
?>